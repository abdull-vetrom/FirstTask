<?php

namespace app\controllers;

use app\dto\SubjectsDto;
use app\service\SubjectsService;
use Doctrine\ORM\EntityManager;
use Throwable;

class SubjectsController
{
    public SubjectsService $subjectsService;

    public function __construct(SubjectsService $subjectsService)
    {
        $this->subjectsService = $subjectsService;
    }

    /**
     * Добавление нового предмета
     * @param array $request
     * @return void
     */
    public function create(array $request): void
    {
        $subjectsDto = new subjectsDto();
        $this->setDtoFromRequest($request, $subjectsDto);
        $this->subjectsService->create($subjectsDto);
    }

    /**
     * Получение определённого предмета
     * @param array $request
     * @return array
     */
    public function get(array $request): array
    {
        $subjectId = $request['id'];

        if ($subjectId) {
            return $this->subjectsService->getSubject($subjectId);
        }

        return $this->subjectsService->getSubjects();
    }

    /**
     * Обновление данных о предмете
     * @param array $request
     * @return void
     */
    public function update(array $request): void
    {
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $subjectsDto = new subjectsDto();
        $this->setDtoFromRequest($request, $subjectsDto);
        $this->subjectsService->update($subjectsDto, $id);
    }


    /**
     * Удаление предмета
     * @param array $request
     * @return void
     */
    public function delete(array $request): void
    {
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $this->subjectsService->delete($id);
    }

    /**
     * Запись значений из request в dto для предмета
     * @param array $request
     * @param SubjectsDto $subjectsDto
     * @return void
     */
    private function setDtoFromRequest(array $request, SubjectsDto $subjectsDto): void
    {
        try {

            $subjectsDto->subjectName = $request['subjectName'];
            $subjectsDto->subjectScore = $request['subjectScore'];
            $subjectsDto->subjectLecturesTime = $request['subjectLecturesTime'];
            $subjectsDto->subjectSeminarTime = $request['subjectSeminarTime'];
            $subjectsDto->subjectLaboratoryTime = $request['subjectLaboratoryTime'];
            $subjectsDto->subjectDescription = $request['subjectDescription'];
            $subjectsDto->subjectDepartment = $request['subjectDepartment'];

        } catch (Throwable) {
            printErrorMessage(422, 'Переданные параметры неверные');
        }
    }
}
