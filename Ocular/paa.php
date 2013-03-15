<?php

$lines = gzfile('G048-1565.csv.gz');
foreach ($lines as $line) {
    $fields = explode(",", $line);
    echo $fields[3] . " | " . $fields[26] . " | " . $fields[20] ."<br />";
}
?>