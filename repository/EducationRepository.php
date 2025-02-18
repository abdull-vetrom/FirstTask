<?php

namespace app\repository;

use Doctrine\ORM\EntityRepository;

class EducationRepository extends EntityRepository
{
    /**
     * Запрос на получение информации о предметах определённого студента
     * @param int $studentId
     * @return array
     */
    public function getEducation(int $studentId): array
    {
        return $this->createQueryBuilder('edu')
            ->select('stu.studentId, stu.studentName, stu.studentSurname, stu.studentLastname, stu.studentGroup, sub.subjectId, sub.subjectName')
            ->innerJoin('edu.student', 'stu')
            ->innerJoin('edu.subject', 'sub')
            ->where('stu.studentId = :studentId')
            ->setParameter('studentId', $studentId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Запрос на получение информации о предметах всех студентов
     * @return array
     */
    public function getEducations(): array
    {
        return $this->createQueryBuilder('edu')
            ->select('stu.studentId, stu.studentName, stu.studentSurname, stu.studentLastname, stu.studentGroup, sub.subjectId, sub.subjectName')
            ->innerJoin('edu.student', 'stu')
            ->innerJoin('edu.subject', 'sub')
            ->getQuery()
            ->getResult();
    }
}
