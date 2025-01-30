UPDATE students
SET student_name = :student_name,
    student_lastname = :student_lastname,
    student_surname = :student_surname,
    student_group = :student_group,
    student_birthday = :student_birthday,
    student_gender = :student_gender,
    student_email = :student_email,
    student_phone = :student_phone,
    student_address = :student_address,
    student_faculty = :student_faculty,
    student_study_start_date = :student_study_start_date
WHERE student_id = :student_id