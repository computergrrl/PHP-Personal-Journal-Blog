<?php

//1st query - used for all information except resource links
try {
      $sql = "SELECT * FROM journal";
      $results = $db->prepare($sql);
      $results->execute();
      $journals =  $results->fetchAll(PDO::FETCH_ASSOC);


      }  catch (Exception $e) {
    echo "Bad request from query 1: " . $e->getMessage();
    exit;
}

//2nd query - used for resources to remember links
try {  $sql2 = "SELECT link_id, display_text, link, resources.journal_id
   FROM resources JOIN journal ON journal.journal_id = resources.journal_id";
  $getResources = $db->prepare($sql2);
  $getResources->execute();
  $resources = $getResources->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
      echo "Bad request from query 2: " . $e->getMessage();
      exit;
}
