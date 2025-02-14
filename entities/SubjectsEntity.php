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
    #[Column(name: 'subject_id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $subjectId;

    #[Column(name: 'subject_name', type: Types::STRING)]
    private string $subjectName;

    #[Column(name: 'subject_score', type: Types::INTEGER)]
    private int $subjectScore;

    #[Column(name: 'subject_lectures_time', type: Types::INTEGER, nullable: true)]
    private ?int $subjectLecturesTime = null;

    #[Column(name: 'subject_seminar_time', type: Types::INTEGER, nullable: true)]
    private ?int $subjectSeminarTime = null;

    #[Column(name: 'subject_laboratory_time', type: Types::INTEGER, nullable: true)]
    private ?int $subjectLaboratoryTime = null;

    #[Column(name: 'subject_description', type: Types::STRING, nullable: true)]
    private ?string $subjectDescription = null;

    #[Column(name: 'subject_department', type: Types::STRING)]
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

    public function getSubjectScore(): int
    {
        return $this->subjectScore;
    }

    public function setSubjectScore(int $subjectScore): void
    {
        $this->subjectScore = $subjectScore;
    }

    public function getSubjectLecturesTime(): ?int
    {
        return $this->subjectLecturesTime;
    }

    public function setSubjectLecturesTime(?int $subjectLecturesTime): void
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

    public function getSubjectDescription(): ?string
    {
        return $this->subjectDescription;
    }

    public function setSubjectDescription(?string $subjectDescription): void
    {
        $this->subjectDescription = $subjectDescription;
    }

    public function setSubjectLaboratoryTime(?int $subjectLaboratoryTime): void
    {
        $this->subjectLaboratoryTime = $subjectLaboratoryTime;
    }

    public function getSubjectLaboratoryTime(): ?int
    {
        return $this->subjectLaboratoryTime;
    }

    public function getSubjectSeminarTime(): ?int
    {
        return $this->subjectSeminarTime;
    }

    public function setSubjectSeminarTime(?int $subjectSeminarTime): void
    {
        $this->subjectSeminarTime = $subjectSeminarTime;
    }

}
