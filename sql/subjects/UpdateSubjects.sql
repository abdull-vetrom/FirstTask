UPDATE subjects
SET subject_name = :subject_name,
    subject_score = :subject_score,
    subject_lectures_time = :subject_lectures_time,
    subject_seminar_time = :subject_seminar_time,
    subject_laboratory_time = :subject_laboratory_time,
    subject_description = :subject_description,
    subject_department = :subject_department
WHERE subject_id = :subject_id