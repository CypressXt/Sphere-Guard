<?php

/*
 * CypressXt
 */

$dashboardContent = '
<div class="page-header">
    <h1>Sphere-Guard Installation...</h1>
</div>
<div>
    <form class="form-horizontal" id="installForm" role="form" method="POST">
        <div class="form-group">
            <label for="inputDbHost" class="col-sm-2 control-label">MySQL Srv IP</label>
            <div class="col-sm-10">
                <input name="inputDbHost" type="text" class="form-control"  id="inputDbHost" placeholder="MySQL server address">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDbName" class="col-sm-2 control-label">Database name</label>
            <div class="col-sm-10">
                <input name="inputDbName" type="text" class="form-control" value="SphereGuard" id="inputDbName" placeholder="Database\'s name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDbUser" class="col-sm-2 control-label">Database user name</label>
            <div class="col-sm-10">
                <input name="inputDbUser" type="text" class="form-control" id="inputDbUser" placeholder="Database user\'s name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDbPass" class="col-sm-2 control-label">Database user\'s password</label>
            <div class="col-sm-10">
                <input name="inputDbPass" type="text" class="form-control" id="inputDbPass" placeholder="Database user\'s password">
            </div>
        </div>
        <div class = "form-group">
            <div class = "col-sm-offset-2 col-sm-10">
                <button name = "submitInstall" type = "submit" class = "btn btn-primary btn-sm">Finish !</button>
            </div>
        </div>
    </form>
</div>';
