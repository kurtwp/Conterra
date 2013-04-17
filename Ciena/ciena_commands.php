<?php require_once '../header.html'; ?>

<div id="right_box">
    <h4>Save Configuration</h4>
    <ul class="ciena">
        <li>configuration save</li>
    </ul>
    <br />
     <h4>Set Hostname</h4>
    <ul class="ciena">
        <li>system set host-name "host name"</li>
        <li>system set host-name SE.HKBF.PORTERS.ES01</li>
    </ul>
    <br />
    <h4>Add Port discripition</h4>
    <ul class="ciena">
        <li>port set port 1 description "Data to MR01"</li>
    </ul>
    <br />
    <h4>Enable Port</h4>
    <ul class="ciena">
        <li>port enable port "port number" </li>
    </ul>
    <br />
    <h4>Disable Port</h4>
    <ul class="ciena">
        <li>port disable port "port number" </li>
    </ul>
    <br />
    <h4>Set Port MTU to 9216</h4>
    <ul class="ciena">
        <li>port set port "port number" max-frame-size 9216</li>
    </ul>
    <br />
    <h4>Create a VLAN</h4>
    <ul class="ciena">
        <li>vlan create vlan "vlan ID"</li>
        <li>vlan create vlan 2,1033-1035,2001</li>
    </ul>
    <br />
    <h4>Add VLANs to a port.</h4>
    <ul class="ciena">
        <li>vlan add vlan "vlan ID" port "port number"</li>
        <li>port set port 1033-1035,2001 port 2,6-11</li>
    </ul>
    <br />
    <h4>Remove VLANs from port</h4>
    <ul class="ciena">
        <li>vlan remove vlan "vlan ID" port "port number"</li>
        <li>vlan remove vlan 1033-1035 port 2</li>
    </ul>
    <br />
    <h4>Tag all Traffic on a Port</h4>
    <ul class="ciena">
        <li>port set 1 pvid 2</li>
    </ul>
    <br />
    <h4>Configure NTP </h4>
    <ul class="ciena">
        <li>ntp-client set polling-interval 4096</li>
        <li>ntp-client add server "IP Address"</li>
        <li>ntp-client md5-auth disable</li>
    </ul>
</div>

</div>


</body>
</html>