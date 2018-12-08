<?php
require('inc/connection.php');
include('inc/functions.php');
$page = 'test';

if($page == 'index') { echo "this is the page!";}
else {echo "that did NOT work";}
