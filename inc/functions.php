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
function new_entry($title, $date, $time_spent, $entry, $link_name = null, $link_address = null) {
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
            echo "Unable to add entry1 <br />" . $e->getMessage();
            return false;
    }
  //   $newEntry2 = "INSERT INTO resources(link_name, link_address, journal_id) VALUES (?, ?, ?)";
  //   try {
  //     $results2 = $db->prepare($newEntry2);
  //     $results2->bindValue(1, $link_name, PDO::PARAM_STR);
  //     $results2->bindValue(2, $link_address, PDO::PARAM_STR);
  //     $results2->bindValue(3, $id, PDO::PARAM_INT);
  //     $results2->execute();
  //   }  catch (Exception $e)  {
  //         echo "Unable to add entry <br />" . $e->getMessage();
  //         return false;
  // }
  $newEntry2 = "INSERT INTO resources(link_name, link_address, journal_id) VALUES (?, ?, ?)";

for($i=0; $i < count($link_name); $i++) {

     $link = $link_name[$i];
     $address = $link_address[$i];

         if($link == null)
         {}  else {

         try {
           $the_links = $db->prepare($newEntry2);
           $the_links->bindValue(1, $link, PDO::PARAM_STR);
           $the_links->bindValue(2, $address, PDO::PARAM_STR);
           $the_links->bindValue(3, $id, PDO::PARAM_INT);
           $the_links->execute();

         }  catch (Exception $e)  {
               echo "Unable to add entry2 <br />" . $e->getMessage();
               return false;
         }

       }

   }

        return true;
}

function update_entry($title, $date, $time_spent, $entry, $link_name, $link_address, $q) {
    include('connection.php');

    $sql = "UPDATE journal SET title = ?, date = ?, time_spent = ?, entry = ?
            WHERE journal_id = ?";

    try {
          $results = $db->prepare($sql);
          $results->bindValue(1, $title, PDO::PARAM_STR);
          $results->bindValue(2, $date, PDO::PARAM_STR);
          $results->bindValue(3, $time_spent, PDO::PARAM_STR);
          $results->bindValue(4, $entry, PDO::PARAM_STR);
          $results->bindValue(5, $q, PDO::PARAM_INT);

          $results->execute();



            }   catch (Exception $e) {
              echo "Unable to add newentry1 <br />" . $e->getMessage();
              return false;
 }
      $sql2 = "UPDATE resources SET link_name = ?, link_address = ?, journal_id = ?
                WHERE journal_id = ?";
       try {
            $results2 = $db->prepare($sql2);
            $results2->bindValue(1, $link_name, PDO::PARAM_STR);
            $results2->bindValue(2, $link_address, PDO::PARAM_STR);
            $results2->bindValue(3, $q, PDO::PARAM_INT);
            $results2->bindValue(4, $q, PDO::PARAM_INT);

            $results2->execute();
          }  catch (Exception $e)  {
                echo "Unable to add newentry2 <br />" . $e->getMessage();
                return false;

                }
              return true;

 }
