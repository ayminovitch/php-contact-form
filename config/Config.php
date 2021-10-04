<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contactdb');

define('PHPMAILER_EXCEPTION', false);
define('MAIL_SENDER_TYPE', 'smtp');   //sendmail, mail, smtp (please put ur own in order to work perfectly)
//SMTP Configurations
define('SMTP_DEBUG', '2');
define('SMTP_HOST', 'smtp1.example.com;smtp2.example.com');// Specify main and backup SMTP servers
define('SMTP_AUTH', 'true');// Enable SMTP authentication
define('SMTP_USERNAME', 'user@example.com');// SMTP username
define('SMTP_PASWWORD', 'secret');// SMTP password
define('SMTP_SECURE', 'tls');// Enable TLS encryption, `ssl` also accepted
define('SMTP_PORT', '587');// TCP port to connect to

//Mail Configurations
define('MAIL_FROM_MAIL', 'info@valid-digital.com');
define('MAIL_FROM_NAME', 'Valid');
define('MAIL_HTML', 'true');// Set email format to HTML
define('MAIL_CC', 'vor@live.com');

