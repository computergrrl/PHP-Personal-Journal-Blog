<?php
require('inc/connection.php');
include('inc/functions.php');
include('inc/header.php');
$entry_id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['delete'])) {
    delete_entry($entry_id);
    header('location:index.php');
    exit;
    }
$entry_id--;

?>
        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>

          <?php
          foreach($journals as $entry) {
              if($entry['journal_id'] == ($entry_id+1) ) {
              echo "<h1>" .$entry['title'] . "</h1>";

                  $getdate = $entry['date'];
                  $date = date("F d, Y", strtotime($getdate));

              echo '<time datetime="' .$getdate .'">';
              echo $date . "</time>";
              echo '<div class="entry"><h3>Time Spent: </h3>';
              echo '<p>' . $journals[$entry_id]['time_spent'];
              echo '</p></div><div class="entry"><h3>Entry</h3>';
              echo "<p>" .$entry['entry'] . "</p>";
            }
          } ?>
              </div><div class="entry">
              <h3>Resources to Remember:</h3>
              <p>
          <?php
            foreach($resources as $resource) {
                if ($resource['journal_id'] ==                $journals[$entry_id]['journal_id']) {
                        echo '<ul><li><a href="'
                          . $resource['link_address']
                          .'">'
                          . $resource['link_name']
                          . '</a></li></ul>';
                          echo "<br />";
                          echo "<h3> Additional Notes </h3>";
                          echo '<p>' .$resource['notes'] . '</p>';
              }
          }
                   ?>  </p></div>
                    </article>

                </div>
            </div>

            <div class="edit">
                  <p>
                  <?php

                  $project_id = $journals[$entry_id]['journal_id'];

                  echo '<a href="edit.php?q='
                        . $project_id
                        . '">Edit Entry</a></p>';
                        ?>
          <br>
          <p>
            <form method='post' action='detail.php?q=<?php echo ($entry_id +1);?>' onsubmit="return confirm('Are you sure you want to delete this entry? (Can NOT be undone)')">

          <input type='hidden' value='<?php echo ($entry_id +1);?>' name='delete' />

          <input type='submit' class="button" value='Delete Entry'  />
            </form>
          </p>

            </div>
        </section>

        <?php
        include('inc/footer.php'); ?>
    </body>
</html>
