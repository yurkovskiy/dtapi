<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-07-14 00:09:21 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: results ~ APPPATH/classes/Controller/BaseAjax.php [ 46 ] in /var/www/dtapi/application/classes/Controller/BaseAjax.php:46
2015-07-14 00:09:21 --- DEBUG: #0 /var/www/dtapi/application/classes/Controller/BaseAjax.php(46): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/dtapi/...', 46, Array)
#1 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecords()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/dtapi/application/classes/Controller/BaseAjax.php:46
2015-07-14 00:13:21 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: results ~ APPPATH/classes/Controller/BaseAjax.php [ 85 ] in /var/www/dtapi/application/classes/Controller/BaseAjax.php:85
2015-07-14 00:13:21 --- DEBUG: #0 /var/www/dtapi/application/classes/Controller/BaseAjax.php(85): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/dtapi/...', 85, Array)
#1 /var/www/dtapi/system/classes/Kohana/Controller.php(84): Controller_BaseAjax->action_getRecordsRange()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/dtapi/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Faculty))
#4 /var/www/dtapi/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/dtapi/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dtapi/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/dtapi/application/classes/Controller/BaseAjax.php:85