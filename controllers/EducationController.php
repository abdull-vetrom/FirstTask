<?php

namespace app\controllers;

use app\DTO\EducationDTO;
use app\service\EducationService;
use Doctrine\ORM\EntityManager;
use Throwable;

class EducationController
{

    public EducationService $educationService;

    public function __construct(EntityManager $entityManager)
    {
        $this->educationService = new EducationService($entityManager);
    }

    private function setDTOFromRequest(array $request, EducationDTO $educationDTO): void
    {
        try {
            $educationDTO->studentId = $request['student_id'];
            $educationDTO->subjectName = $request['subject_name'];
        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверные');
        }
    }

    public function create(array $request): void
    {

        $educationDTO = new EducationDTO();
        $this->setDTOFromRequest($request, $educationDTO);
        $this->educationService->create($educationDTO);

    }

    public function get(array $request): array
    {

        $studentId = $request['id'];

        $studentId
            ? $result = $this->educationService->getEducation($studentId)
            : $result = $this->educationService->getEducations();

        return $result;

    }

}
