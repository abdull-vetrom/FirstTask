<?php
namespace app\service;

use app\DTO\StudentsDTO;
use app\entities\StudentsEntity;
use Doctrine\ORM\EntityManager;
use Throwable;

class StudentsService {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function create(StudentsDTO $studentsDTO) : void {
        try {

            $student = new StudentsEntity;
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

            $this->entityManager->persist($student);
            $this->entityManager->flush();

        } catch (Throwable $e) {
            var_dump($e->getMessage());
        }



    }
}
