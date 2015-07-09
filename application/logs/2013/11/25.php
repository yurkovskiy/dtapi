<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-11-25 01:54:27 --- EMERGENCY: Database_Exception [ 1044 ]: Access denied for user ''@'localhost' to database 'kohana' ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 108 ] in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 01:54:27 --- DEBUG: #0 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(75): Kohana_Database_MySQL->_select_db('kohana')
#1 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(171): Kohana_Database_MySQL->connect()
#2 /home/pupkin/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `faculty...', true, Array)
#3 /home/pupkin/public_html/application/classes/Model/Common.php(121): Kohana_Database_Query->execute()
#4 /home/pupkin/public_html/application/classes/Controller/Faculty.php(13): Model_Common->getRecords()
#5 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_Faculty->action_getFaculties()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#8 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#11 {main} in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 01:56:19 --- EMERGENCY: Database_Exception [ 1049 ]: Unknown database 'bv_universities' ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 108 ] in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 01:56:19 --- DEBUG: #0 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(75): Kohana_Database_MySQL->_select_db('bv_universities')
#1 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(171): Kohana_Database_MySQL->connect()
#2 /home/pupkin/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `faculty...', true, Array)
#3 /home/pupkin/public_html/application/classes/Model/Common.php(121): Kohana_Database_Query->execute()
#4 /home/pupkin/public_html/application/classes/Controller/Faculty.php(13): Model_Common->getRecords()
#5 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_Faculty->action_getFaculties()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#8 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#11 {main} in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 01:56:22 --- EMERGENCY: Database_Exception [ 1049 ]: Unknown database 'bv_universities' ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 108 ] in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 01:56:22 --- DEBUG: #0 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(75): Kohana_Database_MySQL->_select_db('bv_universities')
#1 /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php(171): Kohana_Database_MySQL->connect()
#2 /home/pupkin/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `faculty...', true, Array)
#3 /home/pupkin/public_html/application/classes/Model/Common.php(121): Kohana_Database_Query->execute()
#4 /home/pupkin/public_html/application/classes/Controller/Faculty.php(13): Model_Common->getRecords()
#5 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_Faculty->action_getFaculties()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#8 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#11 {main} in /home/pupkin/public_html/modules/database/classes/Kohana/Database/MySQL.php:75
2013-11-25 06:27:45 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:27:45 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:28:49 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:28:49 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:28:51 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:28:51 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:29:57 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:29:57 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:41 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:41 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:50 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:50 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:54 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:31:54 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:34:26 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:34:26 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:34:30 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: modelName ~ APPPATH/classes/Controller/BaseAjax.php [ 19 ] in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:34:30 --- DEBUG: #0 /home/pupkin/public_html/application/classes/Controller/BaseAjax.php(19): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/pupkin/pu...', 19, Array)
#1 /home/pupkin/public_html/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/pupkin/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /home/pupkin/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/pupkin/public_html/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/pupkin/public_html/index.php(118): Kohana_Request->execute()
#7 {main} in /home/pupkin/public_html/application/classes/Controller/BaseAjax.php:19
2013-11-25 06:36:53 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::getFieldNames() ~ APPPATH/classes/Controller/BaseAjax.php [ 26 ] in file:line
2013-11-25 06:36:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-11-25 06:36:57 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::getFieldNames() ~ APPPATH/classes/Controller/BaseAjax.php [ 26 ] in file:line
2013-11-25 06:36:57 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-11-25 06:49:00 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '=>' (T_DOUBLE_ARROW) ~ APPPATH/classes/Controller/BaseAjax.php [ 33 ] in file:line
2013-11-25 06:49:00 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line