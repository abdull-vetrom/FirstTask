<?php

namespace app\dto;

class SubjectsDto
{
    public int $subjectId;
    public string $subjectName;
    public int $subjectScore;
    public string $subjectDepartment;
    public ?int $subjectLecturesTime;
    public ?int $subjectSeminarTime;
    public ?int $subjectLaboratoryTime;
    public ?string $subjectDescription;
}