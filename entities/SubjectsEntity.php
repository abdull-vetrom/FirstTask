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

    /**
     * @return int
     */
    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    /**
     * @return string
     */
    public function getSubjectName(): string
    {
        return $this->subjectName;
    }

    /**
     * @param string $subjectName
     * @return $this
     */
    public function setSubjectName(string $subjectName): SubjectsEntity
    {
        $this->subjectName = $subjectName;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubjectScore(): int
    {
        return $this->subjectScore;
    }

    /**
     * @param int $subjectScore
     * @return $this
     */
    public function setSubjectScore(int $subjectScore): SubjectsEntity
    {
        $this->subjectScore = $subjectScore;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubjectLecturesTime(): ?int
    {
        return $this->subjectLecturesTime;
    }

    /**
     * @param int|null $subjectLecturesTime
     * @return $this
     */
    public function setSubjectLecturesTime(?int $subjectLecturesTime): SubjectsEntity
    {
        $this->subjectLecturesTime = $subjectLecturesTime;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubjectSeminarTime(): ?int
    {
        return $this->subjectSeminarTime;
    }

    /**
     * @param int|null $subjectSeminarTime
     * @return $this
     */
    public function setSubjectSeminarTime(?int $subjectSeminarTime): SubjectsEntity
    {
        $this->subjectSeminarTime = $subjectSeminarTime;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubjectLaboratoryTime(): ?int
    {
        return $this->subjectLaboratoryTime;
    }

    /**
     * @param int|null $subjectLaboratoryTime
     * @return $this
     */
    public function setSubjectLaboratoryTime(?int $subjectLaboratoryTime): SubjectsEntity
    {
        $this->subjectLaboratoryTime = $subjectLaboratoryTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubjectDescription(): ?string
    {
        return $this->subjectDescription;
    }


    /**
     * @param string|null $subjectDescription
     * @return $this
     */
    public function setSubjectDescription(?string $subjectDescription): SubjectsEntity
    {
        $this->subjectDescription = $subjectDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubjectDepartment(): string
    {
        return $this->subjectDepartment;
    }

    /**
     * @param string $subjectDepartment
     * @return $this
     */
    public function setSubjectDepartment(string $subjectDepartment): SubjectsEntity
    {
        $this->subjectDepartment = $subjectDepartment;
        return $this;
    }
}
