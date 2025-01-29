UPDATE students
SET students_name = :students_name,
    students_lastname = :students_lastname,
    students_surname = :students_surname,
    students_group = :students_group,
    students_birthday = :students_birthday,
    students_gender = :students_gender,
    students_email = :students_email,
    students_phone = :students_phone,
    students_address = :students_address,
    students_faculty = :students_faculty,
    students_study_start_date = :students_study_start_date
WHERE students_id = :primaryKeyValue