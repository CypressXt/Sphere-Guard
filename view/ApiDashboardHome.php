<?php

$dashboardContent = '
    <script type="text/javascript">
    $(document).ready(function() {
        checkGrav("' . $userMail . '", 400);
    });
</script>
<div class="page-header">
    <div class="row hidden-xs hidden-sm">
        <div class="col-xs-2">
            <img id="image" class="img-responsive img-circle" alt="Responsive image" width="80%">
        </div>
        <div class="col-xs-10 helloh1">
            <h1 class="text-left">Welcome ' . $userName . ' !</h1>
        </div>
    </div>
    <div class="row hidden-md hidden-lg">
        <div class="col-xs-12">
            <h1 class="text-left">Welcome ' . $userName . ' !</h1>
        </div>
    </div>
</div>
<div class="row hidden-xs hidden-sm">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Temperature overview</h3>
            </div>
            <div class="panel-body">
              ' . $tmpTable . '
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Top 5 active users</h3>
            </div>
            <div class="panel-body">
              ' . $activeUserTable . '
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Cpu usage overview</h3>
            </div>
            <div class="panel-body">
                ' . $cpuUsageTable . '
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Alerts</h3>
            </div>
            <div class="panel-body">
                Don\'t panic, <span class="label label-success">green</span> light everywhere...
            </div>
        </div>
    </div>
</div>

<div class="row hidden-md hidden-lg">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Temperature overview</h3>
            </div>
            <div class="panel-body">
                ' . $tmpTableRespon . '
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Cpu usage overview</h3>
            </div>
            <div class="panel-body">
                ' . $cpuUsageTableRespon . '
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Top 5 active users</h3>
            </div>
            <div class="panel-body">
              '.$activeUserTableRespon.'
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Alerts</h3>
            </div>
            <div class="panel-body">
                Don\'t panic, <span class="label label-success">green</span> light everywhere...
            </div>
        </div>
    </div>
</div>
';
