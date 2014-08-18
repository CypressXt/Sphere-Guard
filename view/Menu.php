<div class="hidden-sm hidden-xs col-md-3 leftMenu"> 
    <div class="MenuSeparator">General</div>
    <ul> 
        <li onClick="location.href = 'index.php?l=apiDashboard'" class="clearer">Home</li>
        <li onClick="location.href = '#'" class="darker">Chart</li>
        <li onClick="location.href = '#'" class="clearer">Statistics</li>
    </ul> 
    <div class="MenuSeparator">Settings</div>
    <ul>
        <li onClick="location.href = 'index.php?l=apiHostsManagement'" class="clearer">Manage Hosts</li>
        <li onClick="location.href = 'index.php?l=apiKeyManagement'" class="darker">API Users & API Keys</li>
    </ul>
    <div class="MenuSeparator">My account</div>
    <ul> 
        <li onClick="location.href = 'index.php?l=personalInfo'" class="clearer">Personnal setting</li>
        <li onClick="location.href = 'index.php?l=logout'" class="darker">Logout</li>
    </ul>
</div>
<header class="hidden-lg hidden-md navbar navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/SphereGuard/" class="navbar-brand">Sphere Guard</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">General <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?l=apiDashboard">Home</a></li>
                        <li class="disabled"><a href="#">Chart</a></li>
                        <li class="disabled"><a href="#">Statistics</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?l=apiHostsManagement">Manage Hosts</a></li>
                        <li><a href="index.php?l=apiKeyManagement">API Users & API Keys</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My account <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?l=personalInfo">Personnal setting</a></li>
                        <li><a href="index.php?l=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

