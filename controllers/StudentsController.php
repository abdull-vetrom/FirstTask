<?php

namespace app\controllers;

use app\DTO\StudentsDTO;
use app\service\StudentsService;
use Doctrine\ORM\EntityManager;
use Throwable;

class StudentsController {

    public StudentsService $studentsService;

    public function __construct(EntityManager $entityManager) {
        $this->studentsService = new StudentsService($entityManager);
    }

    private function setDTOFromRequest(array $request, StudentsDTO $studentsDTO): void {
        try {
            $studentsDTO->studentName = $request['studentName'];
            $studentsDTO->studentLastname = $request['studentLastname'];
            $studentsDTO->studentSurname = $request['studentSurname'];
            $studentsDTO->studentGroup = $request['studentGroup'];
            $studentsDTO->studentBirthday = $request['studentBirthday'];
            $studentsDTO->studentGender = $request['studentGender'];
            $studentsDTO->studentEmail = $request['studentEmail'];
            $studentsDTO->studentPhone = $request['studentPhone'];
            $studentsDTO->studentAddress = $request['studentAddress'];
            $studentsDTO->studentFaculty = $request['studentFaculty'];
            $studentsDTO->studentStudyStartDate = $request['studentStudyStartDate'];
        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверные');
        }
    }

    public function create(array $request): void  {

        $studentsDTO = new StudentsDTO();
        $this->setDTOFromRequest($request, $studentsDTO);
        $this->studentsService->create($studentsDTO);

    }

    public function get(array $request): array {

        return $this->studentsService->get($request);

    }

    public function update(array $request): void {

        $studentsDTO = new StudentsDTO();
        $this->setDTOFromRequest($request, $studentsDTO);
        $this->studentsService->update($studentsDTO, $request);

    }

    public function delete(array $request): void {

        $this->studentsService->delete($request);

    }

}
