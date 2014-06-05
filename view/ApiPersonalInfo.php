<?php

/*
 * CypressXt
 */

$dashboardContent = '
<div class="page-header">
    <h1>Personal Informations</h1>
</div>
<form class="form-horizontal" role="form" method="POST">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input name="inputName" type="text" class="form-control" value="' . $userName . '"  id="inputName" placeholder="Name">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input name="inputMail" type="email" class="form-control" value="' . $userMail . '"  id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input name="inputPass" type="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPasswordConf" class="col-sm-2 control-label">Password confirmation</label>
        <div class="col-sm-10">
            <input name="inputPassConf" type="password" class="form-control" id="inputPasswordConf" placeholder="Password confirmation">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button name="submitUpdate" type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
    </div>
</form>';
?>