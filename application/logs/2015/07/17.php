<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-07-17 05:19:17 --- EMERGENCY: ErrorException [ 1 ]: Class 'Auth_Orm' not found ~ MODPATH/auth/classes/Kohana/Auth.php [ 37 ] in file:line
2015-07-17 05:19:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-07-17 05:23:52 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt in your bootstrap.php. For more information check the documentation ~ SYSPATH/classes/Kohana/Cookie.php [ 151 ] in /var/www/dtapi/system/classes/Kohana/Cookie.php:67
2015-07-17 05:23:52 --- DEBUG: #0 /var/www/dtapi/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('session', NULL)
#1 /var/www/dtapi/system/classes/Kohana/Request.php(151): Kohana_Cookie::get('session')
#2 /var/www/dtapi/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /var/www/dtapi/system/classes/Kohana/Cookie.php:67
2015-07-17 05:30:12 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::redirect() ~ APPPATH/classes/Controller/BaseAjax.php [ 23 ] in file:line
2015-07-17 05:30:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-07-17 05:32:38 --- EMERGENCY: Kohana_Exception [ 0 ]: Invalid redirect code '403' ~ SYSPATH/classes/Kohana/HTTP.php [ 36 ] in /var/www/dtapi/system/classes/Kohana/Controller.php:127
2015-07-17 05:32:38 --- DEBUG: #0 /var/www/dtapi/system/classes/Kohana/Controller.php(127): Kohana_HTTP::redirect('/', 403)
#1 /var/www/dtapi/application/classes/Controller/BaseAjax.php(20): Kohana_Controller::redirect('/', 403)
#2 /var/www/dtapi/system/classes/Kohana/Controller.php(69): Controller_BaseAjax->before()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#5 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/dtapi/system/classes/Kohana/Controller.php:127
2015-07-17 05:38:59 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_user' not found ~ MODPATH/orm/classes/Kohana/ORM.php [ 46 ] in file:line
2015-07-17 05:38:59 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-07-17 05:39:16 --- EMERGENCY: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/Kohana/Database/PDO.php [ 235 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 05:39:16 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_PDO->list_columns('users')
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#2 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#3 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#4 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#5 /var/www/dtapi/application/classes/Controller/Admin.php(12): Kohana_ORM::factory('User')
#6 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Admin->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin))
#9 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#11 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#12 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 05:40:08 --- EMERGENCY: ORM_Validation_Exception [ 0 ]: Failed to validate array ~ MODPATH/orm/classes/Kohana/ORM.php [ 1275 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1302
2015-07-17 05:40:08 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1302): Kohana_ORM->check(NULL)
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1421): Kohana_ORM->create(NULL)
#2 /var/www/dtapi/application/classes/Controller/Admin.php(18): Kohana_ORM->save()
#3 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Admin->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin))
#6 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1302
2015-07-17 05:47:29 --- EMERGENCY: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/Kohana/Database/PDO.php [ 235 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 05:47:29 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_PDO->list_columns('users')
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#2 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#3 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#4 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#5 /var/www/dtapi/modules/orm/classes/Kohana/Auth/ORM.php(79): Kohana_ORM::factory('User')
#6 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(92): Kohana_Auth_ORM->_login('admin', 'dtapiadmin', false)
#7 /var/www/dtapi/application/classes/Controller/Login.php(12): Kohana_Auth->login('admin', 'dtapiadmin', false)
#8 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Login->action_index()
#9 [internal function]: Kohana_Controller->execute()
#10 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#11 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#14 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 05:58:49 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /var/www/dtapi/system/classes/Kohana/Session.php:125
2015-07-17 05:58:49 --- DEBUG: #0 /var/www/dtapi/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /var/www/dtapi/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(58): Kohana_Session::instance('native')
#3 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(37): Kohana_Auth->__construct(Object(Config_Group))
#4 /var/www/dtapi/application/classes/Controller/BaseAjax.php(18): Kohana_Auth::instance()
#5 /var/www/dtapi/system/classes/Kohana/Controller.php(69): Controller_BaseAjax->before()
#6 [internal function]: Kohana_Controller->execute()
#7 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Subject))
#8 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#11 {main} in /var/www/dtapi/system/classes/Kohana/Session.php:125
2015-07-17 06:11:14 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /var/www/dtapi/system/classes/Kohana/Session.php:125
2015-07-17 06:11:14 --- DEBUG: #0 /var/www/dtapi/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /var/www/dtapi/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(58): Kohana_Session::instance('native')
#3 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(37): Kohana_Auth->__construct(Object(Config_Group))
#4 /var/www/dtapi/application/classes/Controller/BaseAjax.php(18): Kohana_Auth::instance()
#5 /var/www/dtapi/system/classes/Kohana/Controller.php(69): Controller_BaseAjax->before()
#6 [internal function]: Kohana_Controller->execute()
#7 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Subject))
#8 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#11 {main} in /var/www/dtapi/system/classes/Kohana/Session.php:125
2015-07-17 06:11:35 --- EMERGENCY: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/Kohana/Database/PDO.php [ 235 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:11:35 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_PDO->list_columns('users')
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#2 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#3 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#4 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#5 /var/www/dtapi/modules/orm/classes/Kohana/Auth/ORM.php(79): Kohana_ORM::factory('User')
#6 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(92): Kohana_Auth_ORM->_login('admin', 'dtapi_admin', false)
#7 /var/www/dtapi/application/classes/Controller/Login.php(12): Kohana_Auth->login('admin', 'dtapi_admin', false)
#8 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Login->action_index()
#9 [internal function]: Kohana_Controller->execute()
#10 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#11 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#14 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:26:53 --- EMERGENCY: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/Kohana/Database/PDO.php [ 235 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:26:53 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_PDO->list_columns('users')
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#2 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#3 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#4 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#5 /var/www/dtapi/modules/orm/classes/Kohana/Auth/ORM.php(79): Kohana_ORM::factory('User')
#6 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(92): Kohana_Auth_ORM->_login('admin', 'dtapi_admin', false)
#7 /var/www/dtapi/application/classes/Controller/Login.php(12): Kohana_Auth->login('admin', 'dtapi_admin', false)
#8 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Login->action_index()
#9 [internal function]: Kohana_Controller->execute()
#10 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#11 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#14 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:28:58 --- EMERGENCY: Kohana_Exception [ 0 ]: Database method list_columns is not supported by Kohana_Database_PDO ~ MODPATH/database/classes/Kohana/Database/PDO.php [ 235 ] in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:28:58 --- DEBUG: #0 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(1668): Kohana_Database_PDO->list_columns('users')
#1 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(444): Kohana_ORM->list_columns()
#2 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(389): Kohana_ORM->reload_columns()
#3 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(254): Kohana_ORM->_initialize()
#4 /var/www/dtapi/modules/orm/classes/Kohana/ORM.php(46): Kohana_ORM->__construct(NULL)
#5 /var/www/dtapi/modules/orm/classes/Kohana/Auth/ORM.php(79): Kohana_ORM::factory('User')
#6 /var/www/dtapi/modules/auth/classes/Kohana/Auth.php(92): Kohana_Auth_ORM->_login('admin', 'dtapi_admin', false)
#7 /var/www/dtapi/application/classes/Controller/Login.php(12): Kohana_Auth->login('admin', 'dtapi_admin', false)
#8 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Login->action_index()
#9 [internal function]: Kohana_Controller->execute()
#10 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#11 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#14 {main} in /var/www/dtapi/modules/orm/classes/Kohana/ORM.php:1668
2015-07-17 06:49:02 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: sucsses ~ APPPATH/classes/Controller/Login.php [ 18 ] in /var/www/dtapi/application/classes/Controller/Login.php:18
2015-07-17 06:49:02 --- DEBUG: #0 /var/www/dtapi/application/classes/Controller/Login.php(18): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/dtapi/...', 18, Array)
#1 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_Login->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Login))
#4 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/dtapi/application/classes/Controller/Login.php:18