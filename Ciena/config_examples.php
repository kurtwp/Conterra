<?php require_once '../header.html'; ?>

<div id="right_box">
    <h4>Management Port Configuration</h4>
    <ul class="ciena">
        <li>port enable port 1</li>
        <li>vlan add vlan 2 port 1</li>
        <li>port set port 1 pvid 2</li>
        <li>port set port 1 acceptable-frame-type all</li>
        <li>port set port 1 description "MGMT to FW01"</li>
    </ul>
    <br />
     <h4>Data/Customer Port Configuration</h4>
    <ul class="ciena">
        <li>port enable port 1</li>
        <li>port set port 1 mode sfp</li>
        <li>vlan add vlan 10,11,12,13 port 1</li>
        <li>port set port 9-12 max-frame-size 9216</li>
        <li>port set port 1 acceptable-frame-type all</li>
        <li>port set port 1 description "DATA to ND01"</li>
    </ul>
    <br />
    <h4>LAG (link aggregation) group</h4>
    <ul class="ciena">
        <li>aggregation enable</li>
        <li>aggregation create agg EC1</li>
        <li>aggregation add agg EC1 port 10,11</li>
        <li>vlan add vlan 10,11,12,13 port EC1</li>
        <li>port set port EC1 max-frame-size 9216</li>
        <li>port set port EC1 description "Data to MR01 MR02"</li>
    </ul>
    <br /> 
</div>
</div>
</body>
</html>