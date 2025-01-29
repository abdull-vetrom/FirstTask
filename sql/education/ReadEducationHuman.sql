SELECT stu.student_id, stu.student_name, stu.student_surname, stu.student_lastname,
       stu.student_group, sub.subject_id, sub.subject_name
FROM students stu, subjects sub, education edu
WHERE stu.student_id = edu.student_id AND
      sub.subject_id = edu.subject_id AND
      edu.student_id = :student_id