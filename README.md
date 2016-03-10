# d-tester API version 2.1 built with Kohana Framework

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


## Some diffs between version 2.0
 * Added HTTP 400 Exception when wrong request
 * Fixed response when "no records" changed two-dim array to normal JSON
 * Some other little fixes


