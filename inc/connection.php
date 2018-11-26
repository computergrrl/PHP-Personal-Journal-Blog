<?php

try {

  $db = new PDO('sqlite:./journaldb.db');

  } catch (Exception $e)  {

      echo "Error: " .$e->getMessage();
      exit;

  }
