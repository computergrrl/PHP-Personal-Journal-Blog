<?php
require('inc/connection.php');
include('inc/functions.php');




if(!empty($_POST)) {
     $linkName = $_POST['link_name'];
     $linkAddress = $_POST['link_address'];
    foreach($linkName as $link) {

      $newEntry1 = "INSERT INTO resources(link_name) VALUES (?)";
      try {
        $the_link_names = $db->prepare($newEntry1);
        $the_link_names->bindValue(1, $link, PDO::PARAM_STR);
        $the_link_names->execute();

      }  catch (Exception $e)  {
            echo "Unable to add entry1 <br />" . $e->getMessage();
            return false;
      }
      foreach($linkAddress as $address) {
      $newEntry2 = "UPDATE resources SET link_address = ? WHERE link_id = ?";
      $id = $db->lastInsertId();
      try {
        $the_link_addresses = $db->prepare($newEntry2);
        $the_link_addresses->bindValue(1, $address, PDO::PARAM_STR);
        $the_link_addresses->bindValue(2, $id, PDO::PARAM_INT);
        $the_link_addresses->execute();

      }  catch (Exception $e)  {
            echo "Unable to add entry2 <br />" . $e->getMessage();
            return false;
                      }

                    }


      }

}
include('inc/header.php');
?>
<html>
<body>
<section>
    <div class="container">
        <div class="new-entry">
<form action="test.php" method="post">
  <fieldset>
    <legend>Resources to remember:</legend>
    <legend>Save a web link for later reference</legend>
  <label for="link_name">Enter name for link:</label>
  <input id="link_name" type="text" name="link_name[]">
  <label for="link_address">Enter web link here:</label>
  <input id="link_address" type="text" name="link_address[]">
  <label for="link_name">Enter name for link:</label>
  <input id="link_name" type="text" name="link_name[]">
  <label for="link_address">Enter web link here:</label>
  <input id="link_address" type="text" name="link_address[]">
  <label for="link_name">Enter name for link:</label>
  <input id="link_name" type="text" name="link_name[]">
  <label for="link_address">Enter web link here:</label>
  <input id="link_address" type="text" name="link_address[]">
</fieldset>
  <input type="submit" value="Publish Entry" class="button">
  <a href="#" class="button button-secondary">Cancel</a>
</form>
</div>
</div>
</section>
<?php include('inc/footer.php'); ?>
</body>
</html>
