<?php

$dashboardContent = '
    <script type="text/javascript">
    $(document).ready(function() {
        checkGrav("' . $userMail . '", 400);
    });
</script>
<div class="page-header">
    <div class="row">
        <div class="col-md-12" style="">
        <img id="image" class="img-responsive img-circle" alt="Responsive image" width="82">
        <h1 id="welcomeH1">Welcome ' . $userName . '</h1>
        </div>
    </div>
</div>
';
