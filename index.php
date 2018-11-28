<?php
require('inc/connection.php');
include('inc/header.php');
?>

      <section>
            <div class="container">
                <div class="entry-list">
                    <?php
                    foreach($journals as $entry) {
                      echo '<article><h2><a href="detail.php?q=' .$entry["journal_id"]
                              .'">' .$entry['title'] . '</a></h2>';
                           $getdate = $entry['date'];
                             $date = date("F d, Y", strtotime($getdate));
                          echo '<time datetime="' .$getdate .'">'
                                .$date .'</time></article>';
                              }
                              ?>

                </div>
            </div>
        </section>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
