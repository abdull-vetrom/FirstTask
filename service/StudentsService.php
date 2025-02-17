<?php

namespace app\service;

use app\DTO\StudentsDTO;
use app\entities\StudentsEntity;
use Doctrine\ORM\EntityManager;
use Exception;
use Throwable;

class StudentsService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getStudentsAttributes(array $students): array
    {

        $result = [];

        foreach ($students as $student) {

            $studentDTO = new StudentsDTO();
            $studentDTO->studentId = $student->getStudentId();
            $studentDTO->studentName = $student->getStudentName();
            $studentDTO->studentLastname = $student->getStudentLastname();
            $studentDTO->studentSurname = $student->getStudentSurname();
            $studentDTO->studentGroup = $student->getStudentGroup();
            $studentDTO->studentBirthday = $student->getStudentBirthday();
            $studentDTO->studentGender = $student->getStudentGender();
            $studentDTO->studentEmail = $student->getStudentEmail();
            $studentDTO->studentPhone = $student->getStudentPhone();
            $studentDTO->studentAddress = $student->getStudentAddress();
            $studentDTO->studentFaculty = $student->getStudentFaculty();
            $studentDTO->studentStudyStartDate = $student->getStudentStudyStartDate();

            $result[] = $studentDTO;

        }

        return $result;

    }

    private function setStudentsAttributes(StudentsEntity $student, StudentsDTO $studentsDTO): void
    {

        try {

            $student->setStudentName($studentsDTO->studentName)
                ->setStudentLastname($studentsDTO->studentLastname)
                ->setStudentSurname($studentsDTO->studentSurname)
                ->setStudentGroup($studentsDTO->studentGroup)
                ->setStudentBirthday($studentsDTO->studentBirthday)
                ->setStudentGender($studentsDTO->studentGender)
                ->setStudentEmail($studentsDTO->studentEmail)
                ->setStudentPhone($studentsDTO->studentPhone)
                ->setStudentAddress($studentsDTO->studentAddress)
                ->setStudentFaculty($studentsDTO->studentFaculty)
                ->setStudentStudyStartDate($studentsDTO->studentStudyStartDate);

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

    }

    public function create(StudentsDTO $studentsDTO): void
    {

        try {

            $student = new StudentsEntity;
            $this->setStudentsAttributes($student, $studentsDTO);

            $this->entityManager->persist($student);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверны');
        }

    }

    public function getStudent(int $studentId): array
    {


        try {
            $student = $this->entityManager->find(StudentsEntity::class, $studentId)
                ? [$this->entityManager->find(StudentsEntity::class, $studentId)]
                : throw new Exception();

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

        return $this->getStudentsAttributes($student);

    }

    public function getStudents(): array
    {

        $students = $this->entityManager->getRepository(StudentsEntity::class)->findAll();
        return $this->getStudentsAttributes($students);

    }

    public function update(StudentsDTO $studentsDTO, int $id): void
    {

        try {

            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ?: throw new Exception();

            $this->setStudentsAttributes($student, $studentsDTO);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

    }

    public function delete(int $id): void
    {

        try {

            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ?: throw new Exception();

            $this->entityManager->remove($student);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

    }

}
