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
try {  $sql2 = "SELECT link_id, link_name, link_address, resources.journal_id
   FROM resources JOIN journal ON journal.journal_id = resources.journal_id";
  $getResources = $db->prepare($sql2);
  $getResources->execute();
  $resources = $getResources->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
      echo "Bad request from query 2: " . $e->getMessage();
      exit;
}


function new_entry($title, $date, $time_spent, $entry, $link_name, $link_address) {
        include('connection.php');
    $newEntry1 = "INSERT INTO journal(title, date, time_spent, entry)
                  VALUES(?, ?, ?, ?)" ;

  try {
        $results = $db->prepare($newEntry1);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time_spent, PDO::PARAM_STR);
        $results->bindValue(4, $entry, PDO::PARAM_STR);


        $results->execute();
        $id = $db->lastInsertId();



      }   catch (Exception $e) {
            echo "Unable to add entry <br />" . $e->getMessage();
            return false;

    }


    $newEntry2 = "INSERT INTO resources(link_name, link_address, journal_id) VALUES (?, ?, ?)";
    try {
      $results2 = $db->prepare($newEntry2);
      $results2->bindValue(1, $link_name, PDO::PARAM_STR);
      $results2->bindValue(2, $link_address, PDO::PARAM_STR);
      $results2->bindValue(3, $id, PDO::PARAM_INT);
      $results2->execute();
    }  catch (Exception $e)  {
          echo "Unable to add entry <br />" . $e->getMessage();
          return false;

  }
        return true;

}
