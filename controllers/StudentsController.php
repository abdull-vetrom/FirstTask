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
            $studentsDTO->student_name = $request['student_name'];
            $studentsDTO->student_lastname = $request['student_lastname'];
            $studentsDTO->student_surname = $request['student_surname'];
            $studentsDTO->student_group = $request['student_group'];
            $studentsDTO->student_birthday = $request['student_birthday'];
            $studentsDTO->student_gender = $request['student_gender'];
            $studentsDTO->student_email = $request['student_email'];
            $studentsDTO->student_phone = $request['student_phone'];
            $studentsDTO->student_address = $request['student_address'];
            $studentsDTO->student_faculty = $request['student_faculty'];
            $studentsDTO->student_study_start_date = $request['student_study_start_date'];
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
