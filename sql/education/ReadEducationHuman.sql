SELECT stu.students_id, stu.students_name, stu.students_surname, stu.students_lastname,
       stu.students_group, sub.subjects_id, sub.subjects_name
FROM students stu, subjects sub, education edu
WHERE stu.students_id = edu.students_id AND
      sub.subjects_id = edu.subjects_id AND
      edu.students_id = :studentId