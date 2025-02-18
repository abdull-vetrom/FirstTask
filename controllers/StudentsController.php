<?php

namespace app\controllers;

use app\dto\StudentsDto;
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

    /**
     * Добавление нового студента
     * @param array $request
     * @return void
     */
    public function create(array $request): void
    {
        $studentsDto = new StudentsDto();
        $this->setDtoFromRequest($request, $studentsDto);
        $this->studentsService->create($studentsDto);
    }

    /**
     * Получение нового студента
     * @param array $request
     * @return array
     */
    public function get(array $request): array
    {
        $studentId = $request['id'];

        if ($studentId) {
            return $this->studentsService->getStudent($studentId);
        }

        return $this->studentsService->getStudents();
    }

    /**
     * Обновление данных о студенте
     * @param array $request
     * @return void
     */
    public function update(array $request): void
    {
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $studentsDto = new StudentsDto();
        $this->setDtoFromRequest($request, $studentsDto);
        $this->studentsService->update($studentsDto, $id);
    }


    /**
     * Удаление студента
     * @param array $request
     * @return void
     */
    public function delete(array $request): void
    {
        $variableArray = checkParameterExistence('id', $request);
        extract($variableArray);

        $this->studentsService->delete($id);
    }

    /**
     * Запись значений из request в dto для студента
     * @param array $request
     * @param StudentsDto $studentsDto
     * @return void
     */
    private function setDtoFromRequest(array $request, StudentsDto $studentsDto): void
    {
        try {
            $studentsDto->studentName = $request['studentName'];
            $studentsDto->studentLastname = $request['studentLastname'];
            $studentsDto->studentSurname = $request['studentSurname'];
            $studentsDto->studentGroup = $request['studentGroup'];
            $studentsDto->studentBirthday = $request['studentBirthday'];
            $studentsDto->studentGender = $request['studentGender'];
            $studentsDto->studentEmail = $request['studentEmail'];
            $studentsDto->studentPhone = $request['studentPhone'];
            $studentsDto->studentAddress = $request['studentAddress'];
            $studentsDto->studentFaculty = $request['studentFaculty'];
            $studentsDto->studentStudyStartDate = $request['studentStudyStartDate'];
        } catch (Throwable) {
            printErrorMessage(422, 'Переданные параметры неверные');
        }
    }
}
