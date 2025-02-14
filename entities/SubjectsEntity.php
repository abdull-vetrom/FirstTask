<?php

namespace app\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table(name: 'subjects')]
class SubjectsEntity {
    #[Id]
    #[Column(name: 'subjectId', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $subjectId;

    #[Column(name: 'subjectName', type: Types::STRING)]
    private string $subjectName;

    #[Column(name: 'subjectScore', type: Types::INTEGER)]
    private string $subjectScore;

    #[Column(name: 'subjectLecturesTime', type: Types::INTEGER, nullable: true)]
    private string $subjectLecturesTime;

    #[Column(name: 'subjectSeminarTime', type: Types::INTEGER, nullable: true)]
    private string $subjectSeminarTime;

    #[Column(name: 'subjectLaboratoryTime', type: Types::INTEGER, nullable: true)]
    private string $subjectLaboratoryTime;

    #[Column(name: 'subjectDescription', type: Types::STRING, nullable: true)]
    private string $subjectDescription;

    #[Column(name: 'subjectDepartment', type: Types::STRING)]
    private string $subjectDepartment;

    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setSubjectName(string $subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    public function getSubjectScore(): string
    {
        return $this->subjectScore;
    }

    public function setSubjectScore(string $subjectScore): void
    {
        $this->subjectScore = $subjectScore;
    }

    public function getSubjectLecturesTime(): string
    {
        return $this->subjectLecturesTime;
    }

    public function setSubjectLecturesTime(string $subjectLecturesTime): void
    {
        $this->subjectLecturesTime = $subjectLecturesTime;
    }

    public function getSubjectDepartment(): string
    {
        return $this->subjectDepartment;
    }

    public function setSubjectDepartment(string $subjectDepartment): void
    {
        $this->subjectDepartment = $subjectDepartment;
    }

    public function getSubjectDescription(): string
    {
        return $this->subjectDescription;
    }

    public function setSubjectDescription(string $subjectDescription): void
    {
        $this->subjectDescription = $subjectDescription;
    }

    public function getSubjectLaboratoryTime(): string
    {
        return $this->subjectLaboratoryTime;
    }

    public function setSubjectLaboratoryTime(string $subjectLaboratoryTime): void
    {
        $this->subjectLaboratoryTime = $subjectLaboratoryTime;
    }

    public function getSubjectSeminarTime(): string
    {
        return $this->subjectSeminarTime;
    }

    public function setSubjectSeminarTime(string $subjectSeminarTime): void
    {
        $this->subjectSeminarTime = $subjectSeminarTime;
    }

}
