<?php
require('inc/connection.php');
include('inc/functions.php');





if(!empty($_POST)) {
     $linkName = $_POST['link_name'];
     $linkAddress = $_POST['link_address'];

     for($i=0; $i <= count($linkName); i++) {

          $link = $linkName[$i];
          $address = $linkAddress[$i];

          $newEntry1 = "INSERT INTO resources(link_name, link_address) VALUES (?, ?)";


                      try {
                        $the_links = $db->prepare($newEntry1);
                        $the_links->bindValue(1, $link, PDO::PARAM_STR);
                        $the_links->bindValue(2, $address, PDO::PARAM_STR);
                        $the_links->execute();

                      }  catch (Exception $e)  {
                            echo "Unable to add entry1 <br />" . $e->getMessage();
                            return false;
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
