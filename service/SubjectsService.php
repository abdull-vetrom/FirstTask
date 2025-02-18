<?php

namespace app\service;

use app\dto\SubjectsDto;
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

    /**
     * @param SubjectsDto $subjectsDto
     * @return void
     */
    public function create(subjectsDto $subjectsDto): void
    {
        try {

            $subject = new subjectsEntity;
            $this->setSubjectsAttributes($subject, $subjectsDto);

            $this->entityManager->persist($subject);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Переданные параметры неверны');
        }
    }

    /**
     * @param int $subjectId
     * @return array
     */
    public function getSubject(int $subjectId): array
    {
        try {

            $subject = $this->entityManager->find(subjectsEntity::class, $subjectId);

            $subject
                ? $subject = array($subject)
                : throw new Exception();

        } catch (Throwable) {
            printErrorMessage(422, 'Параметры заданы неверно');
        }

        return $this->getSubjectsAttributes($subject);
    }

    /**
     * @return array
     */
    public function getSubjects(): array
    {
        $subjects = $this->entityManager->getRepository(subjectsEntity::class)->findAll();
        return $this->getSubjectsAttributes($subjects);
    }


    /**
     * @param SubjectsDto $subjectsDto
     * @param int $id
     * @return void
     */
    public function update(subjectsDto $subjectsDto, int $id): void
    {
        try {

            $subject = $this->entityManager->find(subjectsEntity::class, $id)
                ?: throw new Exception();

            $this->setSubjectsAttributes($subject, $subjectsDto);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Данного студента не существует');
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {

            $subject = $this->entityManager->find(subjectsEntity::class, $id)
                ?: throw new Exception();

            $this->entityManager->remove($subject);
            $this->entityManager->flush();

        } catch (Throwable) {
            printErrorMessage(422, 'Данного студента не существует');
        }
    }

    /**
     * @param array $subjects
     * @return array
     */
    private function getSubjectsAttributes(array $subjects): array
    {
        $result = [];

        foreach ($subjects as $subject) {

            $subjectDto = new subjectsDto();
            $subjectDto->subjectId = $subject->getSubjectId();
            $subjectDto->subjectName = $subject->getSubjectName();
            $subjectDto->subjectScore = $subject->getSubjectScore();
            $subjectDto->subjectLecturesTime = $subject->getSubjectLecturesTime();
            $subjectDto->subjectSeminarTime = $subject->getSubjectSeminarTime();
            $subjectDto->subjectLaboratoryTime = $subject->getSubjectLaboratoryTime();
            $subjectDto->subjectDescription = $subject->getSubjectDescription();
            $subjectDto->subjectDepartment = $subject->getSubjectDepartment();

            $result[] = $subjectDto;

        }
        return $result;
    }

    /**
     * @param SubjectsEntity $subject
     * @param SubjectsDto $subjectsDto
     * @return void
     */
    private function setSubjectsAttributes(subjectsEntity $subject, subjectsDto $subjectsDto): void
    {
        try {

            $subject->setsubjectName($subjectsDto->subjectName)
                ->setSubjectScore($subjectsDto->subjectScore)
                ->setSubjectLecturesTime($subjectsDto->subjectLecturesTime)
                ->setSubjectSeminarTime($subjectsDto->subjectSeminarTime)
                ->setSubjectLaboratoryTime($subjectsDto->subjectLaboratoryTime)
                ->setSubjectDescription($subjectsDto->subjectDescription)
                ->setSubjectDepartment($subjectsDto->subjectDepartment);

        } catch (Throwable) {
            printErrorMessage(422, 'Параметры заданы неверно');
        }
    }
}
