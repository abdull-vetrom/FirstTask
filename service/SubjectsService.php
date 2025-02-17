<?php

namespace app\service;

use app\DTO\SubjectsDTO;
use app\entities\SubjectsEntity;
use Doctrine\ORM\EntityManager;
use Exception;
use Throwable;

class SubjectsService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getSubjectsAttributes(array $subjects): array
    {

        $result = [];

        foreach ($subjects as $subject) {

            $subjectDTO = new subjectsDTO();
            $subjectDTO->subjectId = $subject->getSubjectId();
            $subjectDTO->subjectName = $subject->getSubjectName();
            $subjectDTO->subjectScore = $subject->getSubjectScore();
            $subjectDTO->subjectLecturesTime = $subject->getSubjectLecturesTime();
            $subjectDTO->subjectSeminarTime = $subject->getSubjectSeminarTime();
            $subjectDTO->subjectLaboratoryTime = $subject->getSubjectLaboratoryTime();
            $subjectDTO->subjectDescription = $subject->getSubjectDescription();
            $subjectDTO->subjectDepartment = $subject->getSubjectDepartment();

            $result[] = $subjectDTO;

        }

        return $result;

    }

    private function setSubjectsAttributes(subjectsEntity $subject, subjectsDTO $subjectsDTO): void
    {

        try {

            $subject->setsubjectName($subjectsDTO->subjectName)
                ->setSubjectScore($subjectsDTO->subjectScore)
                ->setSubjectLecturesTime($subjectsDTO->subjectLecturesTime)
                ->setSubjectSeminarTime($subjectsDTO->subjectSeminarTime)
                ->setSubjectLaboratoryTime($subjectsDTO->subjectLaboratoryTime)
                ->setSubjectDescription($subjectsDTO->subjectDescription)
                ->setSubjectDepartment($subjectsDTO->subjectDepartment);

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

    }

    public function create(subjectsDTO $subjectsDTO): void
    {

        try {

            $subject = new subjectsEntity;
            $this->setSubjectsAttributes($subject, $subjectsDTO);

            $this->entityManager->persist($subject);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверны');
        }

    }

    public function getSubject(int $subjectId): array
    {

        try {
            $subject = $this->entityManager->find(subjectsEntity::class, $subjectId)
                ? [$this->entityManager->find(subjectsEntity::class, $subjectId)]
                : throw new Exception();

        } catch (Throwable) {
            printErrorMessage(400, 'Параметры заданы неверно');
        }

        return $this->getSubjectsAttributes($subject);

    }

    public function getSubjects(): array
    {

        $subjects = $this->entityManager->getRepository(subjectsEntity::class)->findAll();
        return $this->getSubjectsAttributes($subjects);

    }

    public function update(subjectsDTO $subjectsDTO, int $id): void
    {

        try {

            $subject = $this->entityManager->find(subjectsEntity::class, $id)
                ?: throw new Exception();

            $this->setSubjectsAttributes($subject, $subjectsDTO);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

    }

    public function delete(int $id): void
    {

        try {

            $subject = $this->entityManager->find(subjectsEntity::class, $id)
                ?: throw new Exception();

            $this->entityManager->remove($subject);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(400, 'Данного студента не существует');
        }

    }

}
