<?php
$getTitles = "SELECT DISTINCT title FROM journal JOIN resources ON
        resources.journal_id = journal.journal_id";
$getTitles = $db->prepare($getTitles);
$getTitles->execute();
$titles =  $getTitles->fetchAll(PDO::FETCH_ASSOC);


$getDates = "SELECT DISTINCT date FROM journal JOIN resources ON
        resources.journal_id = journal.journal_id";
$getDates = $db->prepare($getDates);
$getDates->execute();
$dates =  $getDates->fetchAll(PDO::FETCH_ASSOC);







 ?>
