<?php
require('inc/connection.php');
include('inc/functions.php');
include('inc/header.php');

$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
$q--;
if(isset($_GET)) {
      $get_id = $journals[$q];
  }
?>
        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                    <form>
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $get_id['title'];?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $get_id['date'];?>"><br>
                        <label for="time_spent" > Time Spent</label>
                        <input id="time_spent" type="text" name="time_spent" value="<?php echo $get_id['time_spent'];?>">><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="entry" rows="5" name="entry"><?php echo $get_id['entry'];?></textarea>
                        <fieldset>
                          <legend>Resources to remember:</legend>
                          <legend>Save a web link for later reference</legend>
                        <label for="link_name">Enter name for link:</label>
                        <input id="link_name" type="text" name="link_name" value="<?php echo $get_id['link_name'];?>">>
                        <label for="link_address">Enter web link here:</label>
                        <input id="link_address" type="text" name="link_address" value="<?php echo $get_id['link_address'];?>">>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="#" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
