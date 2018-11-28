<?php

try {

  $db = new PDO('sqlite:'.__DIR__.'/journaldb.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (Exception $e)  {

      echo "Error: " .$e->getMessage();
      exit;

  }

  try {
        $sql = "SELECT * FROM journal";
        $results = $db->prepare($sql);
        $results->execute();
        $journals =  $results->fetchAll(PDO::FETCH_ASSOC);


        }  catch (Exception $e) {
      echo "Bad request: " . $e->getMessage();
      exit;
  }
