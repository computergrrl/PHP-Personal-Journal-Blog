<?php
require('inc/connection.php');
include('inc/header.php');
$entry_id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
$entry_id--;

?>
        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>

                        <?php
                        echo "<h1>" .$journals[$entry_id]['title'] . "</h1>";
                        $getdate = $journals[$entry_id]['date'];
                        $date = date("F d, Y", strtotime($getdate));
                        ?>
                        <time datetime="2016-01-11"><?php
                        echo $date; ?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $journals[$entry_id]['time_spent']; ?></p>
                        </div>
                        <div class="entry">
                            <h3>Entry</h3>
                              <?php echo "<p>" .$journals[$entry_id]['entry'] . "</p>";?>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <?php

                              $sql2 = "SELECT link_id, display_text, link, resources.journal_id FROM resources JOIN journal ON resources.journal_id = journal.journal_id";
                              $getResources = $db->prepare($sql2);
                              $getResources->execute();
                              $resources = $getResources->fetchAll(PDO::FETCH_ASSOC);

                              ?>


                            <ul>
                                <?php
                                $entry_id++;
                                foreach($resources as $resource) {
                                  var_dump($resource);
                                  echo "<br /> <br />";

                                }

                                ?>
                                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                                <li><a href="">Cras accumsan cursus ante, non dapibus tempor</a></li>
                                <li>Nunc ut rhoncus felis, vel tincidunt neque</li>
                                <li><a href="">Ipsum dolor sit amet</a></li>
                            </ul>
                        </div>

                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php">Edit Entry</a></p>
            </div>
        </section>
        <?php include('inc/footer.php'); ?>
    </body>
</html>
