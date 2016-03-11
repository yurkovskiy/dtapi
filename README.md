# d-tester API version 2.1 built with Kohana Framework 3.3.1

[Kohana](http://kohanaframework.org/) is an elegant, open source, and object oriented HMVC framework built using PHP5, by a team of volunteers. It aims to be swift, secure, and small.

# d-tester API description
## Entities
 * Faculty: {faculty_id, faculty_name, faculty_description}
 * Speciality: {speciality_id, speciality_code, speciality_name}
 * Group: {group_id, group_name, faculty_id, speciality_id}
 * Subject: {subject_id, subject_name}
 * Test: {test_id, test_name, subject_id, tasks, time_for_test, enabled, attempts}
 * TestDetail: {id, test_id, level, tasks, rate}
 * TimeTable: {timetable_id, group_id, subject_id, event_date}
 * Question: {question_id, test_id, question_text, level, type, attachment}
 * Answwer: {answer_id, question_id, true_answer, answer_text, attachment}
 * Student: {user_id, gradebook_id, student_surname, student_name, student_fname, group_id, plain_password, photo}
 * User [AdminUser]: {id, email, username, password, logins, last_login}
 * Log: {log_id, user_id, test_id, log_date, log_time}
 * Result: {session_id, student_id, test_id, session_date, start_time, end_time, result, questions, true_answers, answers}

## CRUD Actions which can be used with almost all entities
   HTTP_METHOD/URL

 * GET/ (http://<host>/<entity>/getRecords) -- returns JSON with all records of database
 * GET/ (http://<host>/<entity>/getRecords/<id>) -- returns JSON with one record of database with ID
 * GET/ http://<host>/<entity>/getRecordsRange/<limit>/<offset> -- returns JSON with records of database for pagination
 * GET/ http://<host>/<entity>/countRecords -- returns JSON in following format {"numberOfRecords": "10"} using for pagination
 * POST/ http://<host>/<entity>/insertData -- using for insert new record. Returns JSON with new record id and some status
 * POST/ http://<host>/<entity>/update/<id> -- using for update info about record with ID
 * DELETE (GET)/ http://<host>/<entity>/del/<id> -- using for remove record with ID



## Some diffs between version 2.0
 * Added HTTP 400 Exception when wrong request
 * Fixed response when "no records" changed two-dim array to normal JSON
 * Some other little fixes