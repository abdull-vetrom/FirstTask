<?php

namespace app\DTO;

class SubjectsDTO
{
    public int $subjectId;
    public string $subjectName;
    public int $subjectScore;
    public ?int $subjectLecturesTime;
    public ?int $subjectSeminarTime;
    public ?int $subjectLaboratoryTime;
    public ?string $subjectDescription;
    public string $subjectDepartment;

}
