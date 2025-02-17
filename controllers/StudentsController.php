<?php

namespace app\controllers;

use app\DTO\StudentsDTO;
use app\service\StudentsService;
use Doctrine\ORM\EntityManager;
use Throwable;

class StudentsController
{

    public StudentsService $studentsService;

    public function __construct(EntityManager $entityManager)
    {
        $this->studentsService = new StudentsService($entityManager);
    }

    private function setDTOFromRequest(array $request, StudentsDTO $studentsDTO): void
    {
        try {
            $studentsDTO->studentName = $request['student_name'];
            $studentsDTO->studentLastname = $request['student_lastname'];
            $studentsDTO->studentSurname = $request['student_surname'];
            $studentsDTO->studentGroup = $request['student_group'];
            $studentsDTO->studentBirthday = $request['student_birthday'];
            $studentsDTO->studentGender = $request['student_gender'];
            $studentsDTO->studentEmail = $request['student_email'];
            $studentsDTO->studentPhone = $request['student_phone'];
            $studentsDTO->studentAddress = $request['student_address'];
            $studentsDTO->studentFaculty = $request['student_faculty'];
            $studentsDTO->studentStudyStartDate = $request['student_study_start_date'];
        } catch (Throwable) {
            printErrorMessage(400, 'Переданные параметры неверные');
        }
    }

    public function create(array $request): void
    {

        $studentsDTO = new StudentsDTO();
        $this->setDTOFromRequest($request, $studentsDTO);
        $this->studentsService->create($studentsDTO);

    }

    public function get(array $request): array
    {

        $studentId = $request['id'];

        $studentId ? $result = $this->studentsService->getStudent($studentId)
            : $result = $this->studentsService->getStudents();

        return $result;

    }

    public function update(array $request): void
    {

        //get studentId or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $studentsDTO = new StudentsDTO();
        $this->setDTOFromRequest($request, $studentsDTO);
        $this->studentsService->update($studentsDTO, $id);

    }

    public function delete(array $request): void
    {

        //get studentId or error
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $this->studentsService->delete($id);

    }

}
