<?php

namespace app\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table(name: 'students')]
class StudentsEntity {
    #[Id]
    #[Column(name: 'student_id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $studentId;

    #[Column(name: 'student_name', type: Types::STRING)]
    private string $studentName;

    #[Column(name: 'student_lastname', type: Types::STRING)]
    private string $studentLastname;

    #[Column(name: 'student_surname', type: Types::STRING, nullable: true)]
    private string $studentSurname;

    #[Column(name: 'student_group', type: Types::STRING, nullable: true)]
    private string $studentGroup;

    #[Column(name: 'student_birthday', type: Types::STRING)]
    private string $studentBirthday;

    #[Column(name: 'student_gender', type: Types::STRING)]
    private string $studentGender;

    #[Column(name: 'student_email', type: Types::STRING, unique: true, nullable: true)]
    private string $studentEmail;

    #[Column(name: 'student_phone', type: Types::STRING, unique: true)]
    private string $studentPhone;

    #[Column(name: 'student_address', type: Types::STRING)]
    private string $studentAddress;

    #[Column(name: 'student_faculty', type: Types::STRING)]
    private string $studentFaculty;

    #[Column(name: 'student_study_start_date', type: Types::STRING)]
    private string $studentStudyStartDate;

    public function getStudentId(): int
    {
        return $this->studentId;
    }

    public function getStudentName(): string
    {
        return $this->studentName;
    }

    public function setStudentName(string $studentName): void
    {
        $this->studentName = $studentName;
    }

    public function getStudentLastname(): string
    {
        return $this->studentLastname;
    }

    public function setStudentLastname(string $studentLastname): void
    {
        $this->studentLastname = $studentLastname;
    }

    public function getStudentSurname(): string
    {
        return $this->studentSurname;
    }

    public function setStudentSurname(string $studentSurname): void
    {
        $this->studentSurname = $studentSurname;
    }

    public function getStudentGroup(): string
    {
        return $this->studentGroup;
    }

    public function setStudentGroup(string $studentGroup): void
    {
        $this->studentGroup = $studentGroup;
    }

    public function getStudentBirthday(): string
    {
        return $this->studentBirthday;
    }

    public function setStudentBirthday(string $studentBirthday): void
    {
        $this->studentBirthday = $studentBirthday;
    }

    public function getStudentGender(): string
    {
        return $this->studentGender;
    }

    public function setStudentGender(string $studentGender): void
    {
        $this->studentGender = $studentGender;
    }

    public function getStudentEmail(): string
    {
        return $this->studentEmail;
    }

    public function setStudentEmail(string $studentEmail): void
    {
        $this->studentEmail = $studentEmail;
    }

    public function getStudentPhone(): string
    {
        return $this->studentPhone;
    }

    public function setStudentPhone(string $studentPhone): void
    {
        $this->studentPhone = $studentPhone;
    }

    public function getStudentAddress(): string
    {
        return $this->studentAddress;
    }

    public function setStudentAddress(string $studentAddress): void
    {
        $this->studentAddress = $studentAddress;
    }

    public function getStudentFaculty(): string
    {
        return $this->studentFaculty;
    }

    public function setStudentFaculty(string $studentFaculty): void
    {
        $this->studentFaculty = $studentFaculty;
    }

    public function getStudentStudyStartDate(): string
    {
        return $this->studentStudyStartDate;
    }

    public function setStudentStudyStartDate(string $studentStudyStartDate): void
    {
        $this->studentStudyStartDate = $studentStudyStartDate;
    }

}
