<?php
require('inc/connection.php');
include('inc/functions.php');

$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['delete'])) {
    delete_entry($q);
    header('location:index.php');
    exit;
    }

if($_SERVER['REQUEST_METHOD'] == 'POST') {
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$time_spent = filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_STRING);
$entry = filter_input(INPUT_POST, 'entry', FILTER_SANITIZE_STRING);
$link_name = filter_input(INPUT_POST, 'link_name', FILTER_SANITIZE_STRING);
$link_address = filter_input(INPUT_POST, 'link_address', FILTER_SANITIZE_URL);
$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);




  if(update_entry($title, $date, $time_spent, $entry,
  $link_name, $link_address, $notes, $q)) {
        header('location:index.php');
  }

}

$q--;
$get_id = $journals[$q];
include('inc/header.php');
?>
        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                      <?php echo '<form action="edit.php?q=' .($q+1) .'" method="post">'; ?>
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $get_id['title'];?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $get_id['date'];?>"><br>
                        <label for="time_spent" > Time Spent</label>
                        <input id="time_spent" type="text" name="time_spent" value="<?php echo $get_id['time_spent'];?>">><br>
                        <label for="entry">What I Learned</label>
                        <textarea id="entry" rows="5" name="entry"><?php echo $get_id['entry'];?></textarea>
                        <fieldset>
                          <legend>Resources to remember:</legend><br />
                          <legend>Update web link </legend>

      <?php
            foreach($resources as $link) {

//if this entry already has links associated with it then pull them up
                  if($link['journal_id'] == ($q+1)) {

                    echo '<label for="link_name">Enter name for link:</label>';
                    echo '<input id="link_name" type="text" name="link_name" value="' .$link["link_name"] .'">';
                    echo '<label for="link_address">Enter web link here:</label>';
                    echo '<input id="link_address" type="text" name="link_address" value="' .$link['link_address'] .'">';
                    echo '<textarea rows="5" id="notes" name="notes">' . $link['notes'] . '</textarea>';
                    }
                } ?>
                        <input type="submit" value="Edit Entry" class="button">
                        <a href="#" class="button button-secondary">Cancel</a>
                      </form>
            <p><form method='post' action='edit.php?q=<?php echo ($q +1);?>'
              onsubmit="return confirm('Are you sure you want to delete this entry? (Can NOT be undone)')">
            <input type='hidden' value='<?php echo ($entry_id +1);?>' name='delete' />
        <input type='submit' class="button delete" value='Delete Entry'  />
      </form></p>

                </div>
            </div>
        </section>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
