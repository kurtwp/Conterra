<?php
require_once '../header.html';
$k=0;
session_start();
echo "<div id='right_box'>";
$tempFields = explode(",", $_SESSION['fldNmbers']);
        $arrayCount = count($tempFields);
        for ($i=0; $i<$arrayCount;$i++) {
                $tempFields[$i] = $tempFields[$i] - 1;
        }
        echo $_SESSION['fldNmbers'] . "<br />";
        echo $_SESSION['paa'] . "<br />";
        $lines = gzfile('C:\wamp\tmp\paa.cvs.gz');
        $linesCount = count($lines);
        echo "<table id='hor-zebra'>";
        echo "Lines in GZ = " . $linesCount . "<br />";
        foreach ($lines as $line) {
            if ($k == 0) {
                echo "<tr>";
                $fields = explode(",", $line);
                for ($i=0; $i<$arrayCount;$i++) {
                    echo "<th>" . $fields[$tempFields[$i]] . "</th>";
                }
                echo "</tr>";
                $k++;
            } elseif ($k%2 == 0) {
                echo "<tr>";
                $fields = explode(",", $line);
                for ($i=0; $i<$arrayCount;$i++) {
                    echo "<td>" . $fields[$tempFields[$i]] . "</td>";
                }
                  $k++;
                echo "</tr>";
            } else {
                echo "<tr class='odd'>";
                $fields = explode(",", $line);
                for ($i=0; $i<$arrayCount;$i++) {
                    echo "<td >" . $fields[$tempFields[$i]] . "</td>";
                }
                  $k++;
                echo "</tr>";
            }
        }
        echo "</table>";
       
echo "</div>";
echo "</body>";
echo "</html>";        

?>