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
class SubjectsEntity
{
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

    public function setSubjectId(int $subjectId): SubjectsEntity
    {
        $this->subjectId = $subjectId;
        return $this;
    }

    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    public function setSubjectName(string $subjectName): SubjectsEntity
    {
        $this->subjectName = $subjectName;
        return $this;
    }

    public function getSubjectScore(): int
    {
        return $this->subjectScore;
    }

    public function setSubjectScore(int $subjectScore): SubjectsEntity
    {
        $this->subjectScore = $subjectScore;
        return $this;
    }

    public function getSubjectLecturesTime(): ?int
    {
        return $this->subjectLecturesTime;
    }

    public function setSubjectLecturesTime(?int $subjectLecturesTime): SubjectsEntity
    {
        $this->subjectLecturesTime = $subjectLecturesTime;
        return $this;
    }

    public function getSubjectSeminarTime(): ?int
    {
        return $this->subjectSeminarTime;
    }

    public function setSubjectSeminarTime(?int $subjectSeminarTime): SubjectsEntity
    {
        $this->subjectSeminarTime = $subjectSeminarTime;
        return $this;
    }

    public function getSubjectLaboratoryTime(): ?int
    {
        return $this->subjectLaboratoryTime;
    }

    public function setSubjectLaboratoryTime(?int $subjectLaboratoryTime): SubjectsEntity
    {
        $this->subjectLaboratoryTime = $subjectLaboratoryTime;
        return $this;
    }

    public function getSubjectDescription(): ?string
    {
        return $this->subjectDescription;
    }

    public function setSubjectDescription(?string $subjectDescription): SubjectsEntity
    {
        $this->subjectDescription = $subjectDescription;
        return $this;
    }

    public function getSubjectDepartment(): string
    {
        return $this->subjectDepartment;
    }

    public function setSubjectDepartment(string $subjectDepartment): SubjectsEntity
    {
        $this->subjectDepartment = $subjectDepartment;
        return $this;
    }


}
