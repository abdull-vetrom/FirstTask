<?php

namespace app\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use app\repository\EducationRepository;

#[Entity(repositoryClass: EducationRepository::class)]
#[Table(name: 'education')]
class EducationEntity
{
    #[Id]
    #[Column(name: 'education_id', type: Types::INTEGER)]
    #[GeneratedValue]
    private int $educationId;

    #[ManyToOne(targetEntity: StudentsEntity::class)]
    #[JoinColumn(name: 'student_id', referencedColumnName: 'student_id', nullable: false, onDelete: 'CASCADE')]
    private StudentsEntity $student;

    #[ManyToOne(targetEntity: SubjectsEntity::class)]
    #[JoinColumn(name: 'subject_id', referencedColumnName: 'subject_id', nullable: false, onDelete: 'CASCADE')]
    private SubjectsEntity $subject;

    /**
     * @return int
     */
    public function getEducationId(): int
    {
        return $this->educationId;
    }

    /**
     * @return StudentsEntity
     */
    public function getStudent(): StudentsEntity
    {
        return $this->student;
    }

    /**
     * @param StudentsEntity $student
     * @return $this
     */
    public function setStudent(StudentsEntity $student): EducationEntity
    {
        $this->student = $student;
        return $this;
    }


    /**
     * @return SubjectsEntity
     */
    public function getSubject(): SubjectsEntity
    {
        return $this->subject;
    }

    /**
     * @param SubjectsEntity $subject
     * @return $this
     */
    public function setSubject(SubjectsEntity $subject): EducationEntity
    {
        $this->subject = $subject;
        return $this;
    }
}
