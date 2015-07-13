<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-07-13 02:07:14 --- EMERGENCY: ErrorException [ 2 ]: json_decode() expects parameter 1 to be string, array given ~ APPPATH/classes/Controller/Specialities.php [ 15 ] in file:line
2015-07-13 02:07:14 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'json_decode() e...', '/var/www/dtapi/...', 15, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(15): json_decode(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in file:line
2015-07-13 02:09:35 --- EMERGENCY: ErrorException [ 2 ]: json_decode() expects parameter 1 to be string, array given ~ APPPATH/classes/Controller/Specialities.php [ 15 ] in file:line
2015-07-13 02:09:35 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'json_decode() e...', '/var/www/dtapi/...', 15, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(15): json_decode(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in file:line
2015-07-13 02:11:09 --- EMERGENCY: ErrorException [ 2 ]: json_decode() expects parameter 1 to be string, array given ~ APPPATH/classes/Controller/Specialities.php [ 15 ] in file:line
2015-07-13 02:11:09 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'json_decode() e...', '/var/www/dtapi/...', 15, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(15): json_decode(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in file:line
2015-07-13 02:12:00 --- EMERGENCY: ErrorException [ 2 ]: json_decode() expects parameter 1 to be string, array given ~ APPPATH/classes/Controller/Specialities.php [ 15 ] in file:line
2015-07-13 02:12:00 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'json_decode() e...', '/var/www/dtapi/...', 15, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(15): json_decode(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in file:line
2015-07-13 02:12:42 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Controller/Specialities.php [ 15 ] in /var/www/dtapi/application/classes/Controller/Specialities.php:15
2015-07-13 02:12:42 --- DEBUG: #0 /var/www/dtapi/application/classes/Controller/Specialities.php(15): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 15, Array)
#1 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#4 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/dtapi/application/classes/Controller/Specialities.php:15
2015-07-13 06:11:06 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 1 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:11:06 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:14:53 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:14:53 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:14:59 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:14:59 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:17:00 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:17:00 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:17:53 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:17:53 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:19:24 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Model/Common.php [ 151 ] in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:19:24 --- DEBUG: #0 /var/www/dtapi/application/classes/Model/Common.php(151): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 151, Array)
#1 /var/www/dtapi/application/classes/Controller/Specialities.php(22): Model_Common->registerRecord(Array)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/application/classes/Model/Common.php:151
2015-07-13 06:22:31 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH/classes/Controller/Specialities.php [ 23 ] in /var/www/dtapi/application/classes/Controller/Specialities.php:23
2015-07-13 06:22:31 --- DEBUG: #0 /var/www/dtapi/application/classes/Controller/Specialities.php(23): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/dtapi/...', 23, Array)
#1 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Specialities->action_insertData()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Specialities))
#4 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/dtapi/application/classes/Controller/Specialities.php:23