<?php
$startDate = new DateTime("2019-10-27");
$endDate = new DateTime("2019-10-31");

$difference = $endDate->diff($startDate);
echo $difference->format("%a");

?>