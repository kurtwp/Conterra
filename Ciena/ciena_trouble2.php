<?php require_once '../header.html'; ?>

<div id="right_box">
    <h4>Command - port show port 1</h4>
    <br />
    <p><strong>Description:</strong> gives more detail about an individual port than "show port status" or "show port" commands
    Note that a MANAGEMENT port is shown on the left. A CUSTOMER DATA port is shown on the right.
    </p> <br />
    <img src="../../images/portShowPort1.png"> <br />
    <h4>Command - port 1 show port statistics</h4>
    <ol class="cienaol">
        <li>RxBytes and TxBytes should increment on a port that is passing data</li>
        <li>RxCrcErrorPkts , FragmentPkts, RxInErrorPkts, TxCrcErrorPkts, TxCollPkts: if these counters increment, there could be a connection problem.</li>
    </ol>
    <br />
    <img src="../../images/port1ShowPortStatics.png"> <br />
    <h4>Command - aggregation show agg EC1</h4><br />
    <p>
         <strong>Description:</strong> used to view the status of a LAG (link aggregation group). Note there are 2 ports in this LAG group. They are ports 10 and 11   
    </p>
    <br />
    <img src="../../images/showAgg.png"> <br />
</div>
</div>
</body>
</html>