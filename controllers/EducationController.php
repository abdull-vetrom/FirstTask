<?php

namespace app\controllers;

use app\dto\EducationDto;
use app\service\EducationService;
use Doctrine\ORM\EntityManager;
use Throwable;

class EducationController
{

    public EducationService $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }


    /**
     * Добавление нового предмета студенту
     * @param array $request
     * @return void
     */
    public function create(array $request): void
    {
        $educationDto = new EducationDto();
        $this->setDtoFromRequest($request, $educationDto);
        $this->educationService->create($educationDto);
    }


    /**
     * Получение расписания студента или всех студентов
     * @param array $request
     * @return array
     */
    public function get(array $request): array
    {
        $studentId = $request['id'];

        if ($studentId) {
            return $this->educationService->getEducation($studentId);
        }

        return $this->educationService->getEducations();
    }


    /**
     * Запись значений из request в dto для расписания
     * @param array $request
     * @param EducationDto $educationDto
     * @return void
     */
    private function setDtoFromRequest(array $request, EducationDto $educationDto): void
    {
        try {
            $educationDto->studentId = $request['studentId'];
            $educationDto->subjectId = $request['subjectId'];
        } catch (Throwable) {
            printErrorMessage(422, 'Переданные параметры неверные');
        }
    }
}
