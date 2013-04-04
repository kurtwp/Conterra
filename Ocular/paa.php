<?php
require_once '../header.html';
$fldNmbers = ""; //Place Holder for field numbers
$fail = "";
$k = 0;
function validateFields($field) {
    if ($field != "") {
        $tempFields = explode(",", $field);
        $arrayCount = count($tempFields);
         for ($i=0; $i<$arrayCount;$i++)
            {
              echo $tempFields[$i] . ",";
            }
            echo "<br />";
        return "";
    } else {
        return "Enter In Field Numbers";
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['fldNmbers'])) {
        $fldNmbers = $_POST['fldNmbers'];
        $tempFields = explode(",", $fldNmbers);
        $arrayCount = count($tempFields);
        for ($i=0; $i<$arrayCount;$i++) {
                $tempFields[$i] = $tempFields[$i] - 1;
        }
    } 
    $fail = validateFields($fldNmbers);
    if ($fail == "") {
        echo $_FILES['paa']['name'] . "<br />";
        move_uploaded_file($_FILES['paa']['tmp_name'], 'C:\wamp\tmp\paa.cvs.gz');
        $lines = gzfile('C:\wamp\tmp\paa.cvs.gz');
        $linesCount = count($lines);
        require_once "../header.html";
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
        require_once '../footer.html';
       // fclose("$lines");
       // unlink("C:/wamp/tmp/paa.cvs.gz");
        exit;
    }
}
echo <<<_END
<div id="container">
<p>$fail</p>
<form id="contactform" action="paa.php" method="post" enctype="multipart/form-data">
<h3>Ocular PAA/Regulator Check</h3>
    <div class='field'>
        <label for='insideNetwork'>Enter Field Numbers: </label>
        <input type='text' class='input' size="20" maxlength='150' name='fldNmbers' value='$fldNmbers'/>
        <p class='hint'>To enter in multiple field numbers use "," in between:<br />
        e.g. - 20,21,22,23,24</p>
    </div> <br /><br />
    <label>Input file: </label>
   <input type="file" name="paa" />
   <input type='submit' class='sbutton' value='submit' /> 
</form>
</div>
_END;
require_once '../footer.html';
?>
