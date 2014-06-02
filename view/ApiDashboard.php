<?php include_once 'Header.php'; ?>
<body>
    <div class="row dashWrapper">
        <?php include_once 'Menu.php'; ?>
        <div class="col-md-9 dashBoard">
            <?php echo $dashboardError; ?>
            <?php echo $dashboardContent; ?>
        </div>
    </div>
</body>
</html>

