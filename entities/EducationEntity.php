<?php

namespace app\entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'education')]
class EducationEntity
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: StudentsEntity::class)]
    #[ORM\JoinColumn(name: 'student_id', referencedColumnName: 'student_id', nullable: false, onDelete: 'CASCADE')]
    private StudentsEntity $student;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: SubjectsEntity::class)]
    #[ORM\JoinColumn(name: 'subject_id', referencedColumnName: 'subject_id', nullable: false, onDelete: 'CASCADE')]
    private SubjectsEntity $subject;

    public function getStudent(): StudentsEntity
    {
        return $this->student;
    }

    public function setStudent(StudentsEntity $student): EducationEntity
    {
        $this->student = $student;
        return $this;
    }

    public function getSubject(): SubjectsEntity
    {
        return $this->subject;
    }

    public function setSubject(SubjectsEntity $subject): EducationEntity
    {
        $this->subject = $subject;
        return $this;
    }
}
