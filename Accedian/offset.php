<?php
require_once '../header.html';
echo <<<_END
<div id='container'>
    <div id='contactform'>
    <h3>Accedian NID History Offset Calculation</h3><br />
        <div class='field'>
            <label for='myInput'>Management IP: </label>
            <input class='input' type='text' name='myInput' id='myInput' autofocus='autofocus'</p><br />
        </div>
        <p><input class='button' type='button' onclick='hstyOffset()' value='Submit'/><br /></p>
    </div>
</div>
<div id='container'>
    <div id='contactform'>
        <div class='field'>
            <pre>Schedule Offset = <b id='myOutput'>_</b>    Random Offset = <b>30</b></pre>
        </div>
    </div>
</div>
_END;

require_once '../footer.html';
?>