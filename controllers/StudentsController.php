<?php

namespace app\controllers;

use app\DTO\StudentsDTO;
use app\service;
use app\service\StudentsService;
use Doctrine\ORM\EntityManager;

class StudentsController {

    public StudentsService $studentsService;

    public function __construct(EntityManager $entityManager) {
        $this->studentsService = new StudentsService($entityManager);
    }

    public function create(array $request): void  {

        $studentsDTO = new StudentsDTO();

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

        $this->studentsService->create($studentsDTO);


    }

}
