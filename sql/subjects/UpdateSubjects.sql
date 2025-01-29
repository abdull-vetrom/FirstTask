UPDATE subjects
SET subjects_name = :subjects_name,
    subjects_score = :subjects_score,
    subjects_lectures_time = :subjects_lectures_time,
    subjects_seminar_time = :subjects_seminar_time,
    subjects_laboratory_time = :subjects_laboratory_time,
    subjects_description = :subjects_description,
    subjects_department = :subjects_department
WHERE subjects_id = :primaryKeyValue