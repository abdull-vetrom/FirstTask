<?php
namespace app\service;

use app\DTO\StudentsDTO;
use app\entities\StudentsEntity;
use Doctrine\ORM\EntityManager;
use Exception;
use Throwable;

class StudentsService {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    private function getStudentsAttributes(array $students) : array {

        $result = [];

        foreach ($students as $student) {

            $studentDTO = new StudentsDTO();
            $studentDTO->student_id = $student->getStudentId();
            $studentDTO->student_name = $student->getStudentName();
            $studentDTO->student_lastname = $student->getStudentLastname();
            $studentDTO->student_surname = $student->getStudentSurname();
            $studentDTO->student_group = $student->getStudentGroup();
            $studentDTO->student_birthday = $student->getStudentBirthday();
            $studentDTO->student_gender = $student->getStudentGender();
            $studentDTO->student_email = $student->getStudentEmail();
            $studentDTO->student_phone = $student->getStudentPhone();
            $studentDTO->student_address = $student->getStudentAddress();
            $studentDTO->student_faculty = $student->getStudentFaculty();
            $studentDTO->student_study_start_date = $student->getStudentStudyStartDate();

            $result[] = $studentDTO;

        }

        return $result;

    }

    private function setStudentsAttributes(StudentsEntity $student, StudentsDTO $studentsDTO) : void {

        try {

            $student->setStudentName($studentsDTO->student_name);
            $student->setStudentLastname($studentsDTO->student_lastname);
            $student->setStudentSurname($studentsDTO->student_surname);
            $student->setStudentGroup($studentsDTO->student_group);
            $student->setStudentBirthday($studentsDTO->student_birthday);
            $student->setStudentGender($studentsDTO->student_gender);
            $student->setStudentEmail($studentsDTO->student_email);
            $student->setStudentPhone($studentsDTO->student_phone);
            $student->setStudentAddress($studentsDTO->student_address);
            $student->setStudentFaculty($studentsDTO->student_faculty);
            $student->setStudentStudyStartDate($studentsDTO->student_study_start_date);

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

    }

    public function create(StudentsDTO $studentsDTO) : void {

        try {

            $student = new StudentsEntity;
            $this->setStudentsAttributes($student, $studentsDTO);

            $this->entityManager->persist($student);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверны');
        }

    }

    public function get(array $request): array {

        $student_id = $request['id'];
        $student_id ? $result = $this->getStudent($student_id) : $result = $this->getStudents();
        return $result;

    }
    private function getStudent(int $id): array {

        try {
            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ? [$this->entityManager->find(StudentsEntity::class, $id)]
                : throw new Exception();

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

        return $this->getStudentsAttributes($student);

    }

    private function getStudents(): array {

        $students = $this->entityManager->getRepository(StudentsEntity::class)->findAll();
        return $this->getStudentsAttributes($students);

    }

    public function update(StudentsDTO $studentsDTO, array $request): void {

        //get student_id or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        try {

            $student = $this->entityManager->find(StudentsEntity::class, $id)
                ?: throw new Exception();

            $this->setStudentsAttributes($student, $studentsDTO);

        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

    }

    public function delete(array $request): void {

        //get student_id or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

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
