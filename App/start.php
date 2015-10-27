<?php
//-- set up the required default timezone
date_default_timezone_set('Europe/London');
// Start the session
if (session_status() == PHP_SESSION_NONE) { session_start(); }   
//-- get the autload page
require_once __DIR__ . '../../vendor/autoload.php';

//-- load in a some settings/configuration file.
require_once __DIR__ . '/config.php';

//-- inittate the Veezi class
use VeeziAPI\VeeziAPIWrapper as VeeziAPI;
$Veezi = new VeeziAPI(VEEZI_API_TOKEN);


