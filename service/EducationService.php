<?php

namespace app\service;

use app\DTO\EducationDTO;
use app\entities\EducationEntity;
use app\entities\StudentsEntity;
use app\entities\SubjectsEntity;
use Doctrine\ORM\EntityManager;
use Exception;
use Throwable;

class EducationService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(EducationDTO $educationDTO): void
    {
        $subjectName = $educationDTO->subjectName;
        $studentId = $educationDTO->studentId;

        $queryBuilderForSubjectId = $this->entityManager->createQueryBuilder();
        $queryForSubjectId = $queryBuilderForSubjectId
            ->select('sub.subjectId')
            ->from(SubjectsEntity::class, 'sub')
            ->where('sub.subjectName = :subjectName')
            ->setParameter('subjectName', $subjectName)
            ->getQuery();

        !empty(($queryForSubjectId->getResult())[0])
            ? $subjectId = ($queryForSubjectId->getResult())[0]['subjectId']
            : printErrorMessage(400, 'Данный предмет не найден');

        $subject = $this->entityManager->find(SubjectsEntity::class, $subjectId);

        try {
            $student = $this->entityManager->find(StudentsEntity::class, $studentId)
                ?: throw new Exception();
        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

        try {
            $education = new EducationEntity();
            $education->setStudent($student);
            $education->setSubject($subject);

            $this->entityManager->persist($education);
            $this->entityManager->flush();
        } catch (Throwable) {
            printErrorMessage(400, 'Студент уже имеет этот предмет в расписании');
        }

    }

    public function getEducation(int $studentId): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $query = $queryBuilder
            ->select('stu.studentId, stu.studentName, stu.studentSurname, stu.studentLastname, stu.studentGroup, sub.subjectId, sub.subjectName')
            ->from(EducationEntity::class, 'edu')
            ->innerJoin('edu.student', 'stu')
            ->innerJoin('edu.subject', 'sub')
            ->where('stu.studentId = :studentId')
            ->setParameter('studentId', $studentId)
            ->getQuery();

        !empty($query->getResult())
            ? $result = $query->getResult()
            : printErrorMessage(400, 'Данный студент не найден');

        return $result;


    }

    public function getEducations(): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $query = $queryBuilder
            ->select('stu.studentId, stu.studentName, stu.studentSurname, stu.studentLastname, stu.studentGroup, sub.subjectId, sub.subjectName')
            ->from(EducationEntity::class, 'edu')
            ->innerJoin('edu.student', 'stu')
            ->innerJoin('edu.subject', 'sub')
            ->getQuery();

        return $query->getResult();

    }

}
