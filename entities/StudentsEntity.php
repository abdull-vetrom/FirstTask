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
class StudentsEntity
{
    #[Id]
    #[Column(name: 'student_id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $studentId;

    #[Column(name: 'student_name', type: Types::STRING)]
    private string $studentName;

    #[Column(name: 'student_lastname', type: Types::STRING)]
    private string $studentLastname;

    #[Column(name: 'student_surname', type: Types::STRING, nullable: true)]
    private ?string $studentSurname = null;

    #[Column(name: 'student_group', type: Types::STRING, nullable: true)]
    private ?string $studentGroup = null;

    #[Column(name: 'student_birthday', type: Types::STRING)]
    private string $studentBirthday;

    #[Column(name: 'student_gender', type: Types::STRING)]
    private string $studentGender;

    #[Column(name: 'student_email', type: Types::STRING, unique: true, nullable: true)]
    private ?string $studentEmail = null;

    #[Column(name: 'student_phone', type: Types::STRING, unique: true)]
    private string $studentPhone;

    #[Column(name: 'student_address', type: Types::STRING)]
    private string $studentAddress;

    #[Column(name: 'student_faculty', type: Types::STRING)]
    private string $studentFaculty;

    #[Column(name: 'student_study_start_date', type: Types::STRING)]
    private string $studentStudyStartDate;

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }


    /**
     * @return string
     */
    public function getStudentName(): string
    {
        return $this->studentName;
    }

    /**
     * @param string $studentName
     * @return $this
     */
    public function setStudentName(string $studentName): StudentsEntity
    {
        $this->studentName = $studentName;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentLastname(): string
    {
        return $this->studentLastname;
    }

    /**
     * @param string $studentLastname
     * @return $this
     */
    public function setStudentLastname(string $studentLastname): StudentsEntity
    {
        $this->studentLastname = $studentLastname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStudentSurname(): ?string
    {
        return $this->studentSurname;
    }

    /**
     * @param string|null $studentSurname
     * @return $this
     */
    public function setStudentSurname(?string $studentSurname): StudentsEntity
    {
        $this->studentSurname = $studentSurname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStudentGroup(): ?string
    {
        return $this->studentGroup;
    }

    /**
     * @param string|null $studentGroup
     * @return $this
     */
    public function setStudentGroup(?string $studentGroup): StudentsEntity
    {
        $this->studentGroup = $studentGroup;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentBirthday(): string
    {
        return $this->studentBirthday;
    }

    /**
     * @param string $studentBirthday
     * @return $this
     */
    public function setStudentBirthday(string $studentBirthday): StudentsEntity
    {
        $this->studentBirthday = $studentBirthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentGender(): string
    {
        return $this->studentGender;
    }

    /**
     * @param string $studentGender
     * @return $this
     */
    public function setStudentGender(string $studentGender): StudentsEntity
    {
        $this->studentGender = $studentGender;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStudentEmail(): ?string
    {
        return $this->studentEmail;
    }

    /**
     * @param string|null $studentEmail
     * @return $this
     */
    public function setStudentEmail(?string $studentEmail): StudentsEntity
    {
        $this->studentEmail = $studentEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentPhone(): string
    {
        return $this->studentPhone;
    }

    /**
     * @param string $studentPhone
     * @return $this
     */
    public function setStudentPhone(string $studentPhone): StudentsEntity
    {
        $this->studentPhone = $studentPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentAddress(): string
    {
        return $this->studentAddress;
    }

    /**
     * @param string $studentAddress
     * @return $this
     */
    public function setStudentAddress(string $studentAddress): StudentsEntity
    {
        $this->studentAddress = $studentAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentFaculty(): string
    {
        return $this->studentFaculty;
    }

    /**
     * @param string $studentFaculty
     * @return $this
     */
    public function setStudentFaculty(string $studentFaculty): StudentsEntity
    {
        $this->studentFaculty = $studentFaculty;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentStudyStartDate(): string
    {
        return $this->studentStudyStartDate;
    }

    /**
     * @param string $studentStudyStartDate
     * @return $this
     */
    public function setStudentStudyStartDate(string $studentStudyStartDate): StudentsEntity
    {
        $this->studentStudyStartDate = $studentStudyStartDate;
        return $this;
    }


}
