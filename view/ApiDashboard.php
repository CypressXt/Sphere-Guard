<?php include_once 'Header.php'; ?>
<body>
    <div class="row dashWrapper">
        <?php include_once 'Menu.php'; ?>
        <div class="col-md-9 dashBoard">
            <?php echo $dashboardError; ?>
            <?php echo $dashboardContent; ?>
        </div>
    </div>
    <?php include_once 'Modal.php'; ?>
    <footer>
        <div class="glass">
            <h6 id="aut" onmouseover="$('#aut').tooltip('show');" data-toggle="tooltip" title="2014 - ∞">Clément Hampaï</h6>
        </div>
    </footer>
</body>
</html>

