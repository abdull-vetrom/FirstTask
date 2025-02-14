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
    private int $student_id;

    #[Column(name: 'student_name', type: Types::STRING)]
    private string $student_name;

    #[Column(name: 'student_lastname', type: Types::STRING)]
    private string $student_lastname;

    #[Column(name: 'student_surname', type: Types::STRING, nullable: true)]
    private string $student_surname;

    #[Column(name: 'student_group', type: Types::STRING, nullable: true)]
    private string $student_group;

    #[Column(name: 'student_birthday', type: Types::STRING)]
    private string $student_birthday;

    #[Column(name: 'student_gender', type: Types::STRING)]
    private string $student_gender;

    #[Column(name: 'student_email', type: Types::STRING, unique: true, nullable: true)]
    private string $student_email;

    #[Column(name: 'student_phone', type: Types::STRING, unique: true)]
    private string $student_phone;

    #[Column(name: 'student_address', type: Types::STRING)]
    private string $student_address;

    #[Column(name: 'student_faculty', type: Types::STRING)]
    private string $student_faculty;

    #[Column(name: 'student_study_start_date', type: Types::STRING)]
    private string $student_study_start_date;

    public function getStudentId(): int
    {
        return $this->student_id;
    }

    public function getStudentName(): string
    {
        return $this->student_name;
    }

    public function setStudentName(string $student_name): void
    {
        $this->student_name = $student_name;
    }

    public function getStudentLastname(): string
    {
        return $this->student_lastname;
    }

    public function setStudentLastname(string $student_lastname): void
    {
        $this->student_lastname = $student_lastname;
    }

    public function getStudentSurname(): string
    {
        return $this->student_surname;
    }

    public function setStudentSurname(string $student_surname): void
    {
        $this->student_surname = $student_surname;
    }

    public function getStudentGroup(): string
    {
        return $this->student_group;
    }

    public function setStudentGroup(string $student_group): void
    {
        $this->student_group = $student_group;
    }

    public function getStudentBirthday(): string
    {
        return $this->student_birthday;
    }

    public function setStudentBirthday(string $student_birthday): void
    {
        $this->student_birthday = $student_birthday;
    }

    public function getStudentGender(): string
    {
        return $this->student_gender;
    }

    public function setStudentGender(string $student_gender): void
    {
        $this->student_gender = $student_gender;
    }

    public function getStudentEmail(): string
    {
        return $this->student_email;
    }

    public function setStudentEmail(string $student_email): void
    {
        $this->student_email = $student_email;
    }

    public function getStudentPhone(): string
    {
        return $this->student_phone;
    }

    public function setStudentPhone(string $student_phone): void
    {
        $this->student_phone = $student_phone;
    }

    public function getStudentAddress(): string
    {
        return $this->student_address;
    }

    public function setStudentAddress(string $student_address): void
    {
        $this->student_address = $student_address;
    }

    public function getStudentFaculty(): string
    {
        return $this->student_faculty;
    }

    public function setStudentFaculty(string $student_faculty): void
    {
        $this->student_faculty = $student_faculty;
    }

    public function getStudentStudyStartDate(): string
    {
        return $this->student_study_start_date;
    }

    public function setStudentStudyStartDate(string $student_study_start_date): void
    {
        $this->student_study_start_date = $student_study_start_date;
    }

}
