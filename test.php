<?php
require('inc/connection.php');
include('inc/functions.php');


foreach($resources as $resource) {

  echo $resource['notes'];
  echo "<br />";

}
