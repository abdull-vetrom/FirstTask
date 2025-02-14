<?php

namespace app\controllers;

use app\DTO\SubjectsDTO;
use app\service\SubjectsService;
use Doctrine\ORM\EntityManager;
use Throwable;

class SubjectsController {

    public SubjectsService $subjectsService;

    public function __construct(EntityManager $entityManager) {
        $this->subjectsService = new SubjectsService($entityManager);
    }

    private function setDTOFromRequest(array $request, SubjectsDTO $subjectsDTO): void {
        try {
            $subjectsDTO->subjectName = $request['subjectName'];
            $subjectsDTO->subjectScore = $request['subjectScore'];
            $subjectsDTO->subjectLecturesTime = $request['subjectLecturesTime'];
            $subjectsDTO->subjectSeminarTime = $request['subjectSeminarTime'];
            $subjectsDTO->subjectLaboratoryTime = $request['subjectLaboratoryTime'];
            $subjectsDTO->subjectDescription = $request['subjectDescription'];
            $subjectsDTO->subjectDepartment = $request['subjectDepartment'];

        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверные');
        }
    }

    public function create(array $request): void  {

        $subjectsDTO = new subjectsDTO();
        $this->setDTOFromRequest($request, $subjectsDTO);
        $this->subjectsService->create($subjectsDTO);

    }

    public function get(array $request): array {

        $subjectId = $request['id'];

        $subjectId ? $result = $this->subjectsService->getSubject($subjectId)
            : $result = $this->subjectsService->getSubjects();

        return $result;

    }

    public function update(array $request): void {

        //get subjectId or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $subjectsDTO = new subjectsDTO();
        $this->setDTOFromRequest($request, $subjectsDTO);
        $this->subjectsService->update($subjectsDTO, $id);

    }

    public function delete(array $request): void {

        //get subjectId or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $this->subjectsService->delete($id);

    }

}
