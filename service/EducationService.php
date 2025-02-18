<?php

namespace app\service;

use app\dto\EducationDto;
use app\entities\EducationEntity;
use app\entities\StudentsEntity;
use app\entities\SubjectsEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Throwable;

class EducationService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param EducationDto $educationDto
     * @return void
     * @throws ORMException|OptimisticLockException
     */
    public function create(EducationDto $educationDto): void
    {
        $subjectId = $educationDto->subjectId;
        $studentId = $educationDto->studentId;

        $subject = $this->entityManager->find(SubjectsEntity::class, $subjectId);
        if (!$subject) {
            printErrorMessage(422, 'Данного предмета не существует');
        }

        $student = $this->entityManager->find(StudentsEntity::class, $studentId);
        if (!$student) {
            printErrorMessage(422, 'Данного студента не существует');
        }

        try {
            $education = new EducationEntity();
            $education->setStudent($student);
            $education->setSubject($subject);

            $this->entityManager->persist($education);
            $this->entityManager->flush();
        } catch (Throwable) {
            printErrorMessage(422, 'Студент уже имеет этот предмет в расписании');
        }
    }

    /**
     * @param int $studentId
     * @return array
     */
    public function getEducation(int $studentId): array
    {
        $schedule = $this->entityManager->getRepository(EducationEntity::class)->getEducation($studentId);

        if (empty($schedule)) {
            printErrorMessage(422, 'Расписание для данного студента не найдено');
        }

        return $schedule;
    }


    /**
     * @return array
     */
    public function getEducations(): array
    {
        return $this->entityManager->getRepository(EducationEntity::class)->getEducations();
    }
}
