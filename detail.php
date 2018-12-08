<?php
require('inc/connection.php');
include('inc/functions.php');
include('inc/header.php');
$entry_id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
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
          <?php
            foreach($resources as $resource) {
                if ($resource['journal_id'] ==                $journals[$entry_id]['journal_id']) {
                        echo '<ul><li><a href="'
                          . $resource['link_address']
                          .'">'
                          . $resource['link_name']
                          . '</a></li></ul>';

                          echo "<h3> Additional Notes </h3>";
                          echo '<p>' .$resource['notes'] . '</p>';
              }
          }
                   ?>  </div>
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

            </div>
        </section>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
