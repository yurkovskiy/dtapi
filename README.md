d-tester API version 2.1 built with Kohana Framework 3.3.1
----------

[Kohana](http://kohanaframework.org/) is an elegant, open source, and object oriented HMVC framework built using PHP5, by a team of volunteers. It aims to be swift, secure, and small.

# d-tester API description
## Entities
 * ```Faculty: {faculty_id, faculty_name, faculty_description}```
 * ```Speciality: {speciality_id, speciality_code, speciality_name}```
 * ```Group: {group_id, group_name, faculty_id, speciality_id}```
 * ```Subject: {subject_id, subject_name, subject_description}```
 * ```Test: {test_id, test_name, subject_id, tasks, time_for_test, enabled, attempts}```
 * ```TestDetail: {id, test_id, level, tasks, rate}```
 * ```TimeTable: {timetable_id, group_id, subject_id, start_date, start_time, end_date, end_time}```
 * ```Question: {question_id, test_id, question_text, level, type, attachment}```
 * ```Answer: {answer_id, question_id, true_answer, answer_text, attachment}```
 * ```Student: {user_id, gradebook_id, student_surname, student_name, student_fname, group_id, plain_password, photo}```
 * ```User [AdminUser]: {id, email, username, password, logins, last_login}```
 * ```Log: {log_id, user_id, test_id, log_date, log_time, remote_ip}```
 * ```Result: {session_id, student_id, test_id, session_date, start_time, end_time, result, questions, true_answers, answers}```

## CRUD Actions which can be used with almost all entities
   HTTP_METHOD / URL

 * ```GET/ http://<host>/<entity>/getRecords``` -- returns JSON with all records of database
 * ```GET/ http://<host>/<entity>/getRecords/<id>``` -- returns JSON with one record of database with ID
 * ```GET/ http://<host>/<entity>/getRecordsRange/<limit>/<offset>``` -- returns JSON with records of database for pagination
 * ```GET/ http://<host>/<entity>/countRecords``` -- returns JSON in following format {"numberOfRecords": "10"} using for pagination
 * ```POST/ http://<host>/<entity>/insertData``` -- using for insert new record. Returns JSON with new record id and some status
 * ```POST/ http://<host>/<entity>/update/<id>``` -- using for update info about record with ID
 * ```DELETE (GET)/ http://<host>/<entity>/del/<id>``` -- using for remove record with ID

## Search action
 * ``` GET/ http://<host>/<entity>/getRecordsBySearch/<search_criteria_string>``` -- returns JSON with all records of database which are suitable for search criteria```
 * System do search only by using entity fields like: xxxx_name 

## EntityManager
 * EntityManager is a special functionality for simplify requests to the server-side
 * For perform the action please do request which are placed below.
 * ```POST/ http://<host>/EntityManager/getEntityValues``` -- returns JSON with entitites
 * In request body we need to use JSON with following structure: {"entity":"Subject", "ids":[1,2,3,4,5]}
 * Value of entity property should start from capital letter
 
## Auth Actions
 * ```POST/ http://<host>/login/index``` -- returns JSON with roles and something else if success
 * ```GET/ http://<host>/login/logout``` -- returns JSON {"user has been logout"} if OK
 * ```GET/ http://<host>/login/isLogged``` -- for auth checking, returns JSON with roles if logged or {"response":"not logged"}
 * How to login (enter to the system)
   Need to request with following JSON ```{"username":"some_user_name", "password":"some_password"}```

## Questions / Answers functionality
 * Almost all CRUD operations are allowed
 * ```GET/ http://<host>/question/getQuestionsByLevelRand/<test_id>/<level>/<number>``` -- returns JSON with random generated list of questions [@deprecated]
 * ```GET/ http://<host>/question/getQuestionIdsByLevelRand/<test_id>/<level>/<number>``` -- returns JSON with a list of random generated question ids
 * ```GET/ http://<host>/question/getRecordsRangeByTest/<test_id>/<limit>/<offset>``` -- returns JSON with records for pagination
 * ```GET/ http://<host>/question/countRecordsByTest/<test_id>``` -- returns JSON in following format {"numberOfRecords": "10"} using for pagination
 * ```GET/ http://<host>/answer/getAnswersByQuestion/<question_id>``` -- returns JSON with answers which related to question with question_id

## Test [Quiz]
 * Almost all CRUD operations are allowed
 * ```GET/ http://<host>/test/getTestsBySubject/<subject_id>``` -- returns JSON with tests which related to the subject with subject_id

## TestDetail
 * ```GET/ http://<host>/testDetail/getTestDetailsByTest/<test_id>``` -- returns JSON with test's parameters 
 
## Groups
 * ```GET/ http://<host>/group/getGroupsBySpeciality/<speciality_id>``` -- returns JSON with groups which related to the speciality with speciality_id      
 * ```GET/ http://<host>/group/getGroupsByFaculty/<faculty_id>``` -- returns JSON with groups which related to the faculty with faculty_id

## TimeTable
 * ```GET/ http://<host>/timeTable/getTimeTablesForGroup/<group_id>``` -- returns JSON with timetables by group 
 * ```GET/ http://<host>/timeTable/getTimeTablesForSubject/<subject_id>``` -- returns JSON with timetables by subject

## Results
 * ```GET/ http://<host>/Result/getRecordsbyStudent/<student_id>``` -- returns JSON with student's results
 * ```GET/ http://<host>/Result/countTestPassesByStudent/<student_id>/<test_id>``` -- returns JSON {"numberOfRecords": someValue}
 * ```GET/ http://<host>/Result/getRecordsByTestGroupDate/<test_id>/<[group_id]>/<[tdate]>``` -- returns JSON with student's results by test_id, group_id (optional) and date (optional)
 * ```GET/ http://<host>/Result/getResultTestIdsByGroup/<group_id>``` -- returns JSON test_ids which were passed by students of some group (group_id)

## User's side [Test Player]
 * ```GET/ http://<host>/TestPlayer/getTimeStamp``` -- returns JSON ```{"unix_timestamp":1458060816,"offset":"7200","curtime":1458068016}```
 * ```POST/ http://<host>/SAnswer/checkAnswers``` -- returns JSON with result ```{"full_mark":5,"number_of_true_answers":2}```
 * ```POST/ http://<host>/TestPlayer/saveData``` -- the server's storage slot for save some needed information
 * ```GET/ http://<host>/TestPlayer/getData``` -- returns JSON with information from server's torage slot
 * ```POST/ http://<host>/TestPlayer/saveEndTime``` -- the second server's storage slot good for save endtime for user
 * ```GET/ http://<host>/TestPlayer/getEndTime``` -- returns JSON with infromation from second server's storage slot
 * ```GET/ http://<host>/TestPlayer/resetSessionData``` -- clear infromation from all server's storage slots
 * ```GET/ http://<host>/TestPlayer/getTest``` -- checking possibility to make a test by some user using infromtation from timetables, returns Test entity or HTTP400 error

## Some diffs between version 2.0
 * Added HTTP 400 Exception when wrong request
 * Fixed response when "no records" changed two-dim array to normal JSON
 * Some other little fixes
