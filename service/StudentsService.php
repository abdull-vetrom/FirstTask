<?php

namespace app\service;

use app\dto\StudentsDto;
use app\entities\StudentsEntity;
use Doctrine\ORM\EntityManager;
use Dompdf\Dompdf;
use Exception;
use Throwable;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StudentsService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param StudentsDto $studentsDto
     * @return void
     */
    public function create(StudentsDto $studentsDto): void
    {
        try {

            $student = new StudentsEntity;
            $this->setStudentsAttributes($student, $studentsDto);

            $this->entityManager->persist($student);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Переданные параметры неверны');
        }
    }


    /**
     * @param int $studentId
     * @return array
     */
    public function getStudent(int $studentId): array
    {
        try {
            $student = $this->entityManager->find(StudentsEntity::class, $studentId);
            $student
                ? $student = array($student)
                : throw new Exception();
        } catch (Throwable) {
            printErrorMessage(422, 'Параметры заданы неверно');
        }

        return $this->getStudentsAttributes($student);
    }

    /**
     * @return array
     */
    public function getStudents(): array
    {
        $students = $this->entityManager->getRepository(StudentsEntity::class)->findAll();
        return $this->getStudentsAttributes($students);
    }

    /**
     * @param StudentsDto $studentsDto
     * @param int $id
     * @return void
     */
    public function update(StudentsDto $studentsDto, int $id): void
    {
        try {

            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ?: throw new Exception();

            $this->setStudentsAttributes($student, $studentsDto);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Данного студента не существует');
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {

            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ?: throw new Exception();

            $this->entityManager->remove($student);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Данного студента не существует');
        }
    }

    public function getPdfForAllStudents(): void
    {
        $directoryForTemplates = new FilesystemLoader('templates');
        $twig = new Environment($directoryForTemplates);
        $students = $this->getStudents();

        $template = $twig->render('StudentsTable.html.twig', ['students' => $students]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($template);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    /**
     * @param array $students
     * @return array
     */
    private function getStudentsAttributes(array $students): array
    {
        $result = [];

        foreach ($students as $student) {

            $studentDto = new StudentsDto();
            $studentDto->studentId = $student->getStudentId();
            $studentDto->studentName = $student->getStudentName();
            $studentDto->studentLastname = $student->getStudentLastname();
            $studentDto->studentSurname = $student->getStudentSurname();
            $studentDto->studentGroup = $student->getStudentGroup();
            $studentDto->studentBirthday = $student->getStudentBirthday();
            $studentDto->studentGender = $student->getStudentGender();
            $studentDto->studentEmail = $student->getStudentEmail();
            $studentDto->studentPhone = $student->getStudentPhone();
            $studentDto->studentAddress = $student->getStudentAddress();
            $studentDto->studentFaculty = $student->getStudentFaculty();
            $studentDto->studentStudyStartDate = $student->getStudentStudyStartDate();

            $result[] = $studentDto;

        }

        return $result;
    }

    /**
     * @param StudentsEntity $student
     * @param StudentsDto $studentsDto
     * @return void
     */
    private function setStudentsAttributes(StudentsEntity $student, StudentsDto $studentsDto): void
    {
        try {

            $student->setStudentName($studentsDto->studentName)
                ->setStudentLastname($studentsDto->studentLastname)
                ->setStudentSurname($studentsDto->studentSurname)
                ->setStudentGroup($studentsDto->studentGroup)
                ->setStudentBirthday($studentsDto->studentBirthday)
                ->setStudentGender($studentsDto->studentGender)
                ->setStudentEmail($studentsDto->studentEmail)
                ->setStudentPhone($studentsDto->studentPhone)
                ->setStudentAddress($studentsDto->studentAddress)
                ->setStudentFaculty($studentsDto->studentFaculty)
                ->setStudentStudyStartDate($studentsDto->studentStudyStartDate);

        } catch (Throwable) {
            printErrorMessage(422, 'Параметры заданы неверно');
        }
    }
}
