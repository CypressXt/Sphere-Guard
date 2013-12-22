<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/global.css">
		<link rel="stylesheet" type="text/css" href="style/onepage-scroll.css">
		<script src="javascript/jquery-2.0.3.min.js"></script>
        <script src="javascript/jquery.knob.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script src="javascript/jquery.onepage-scroll.js"></script>
        <script src="javascript/init.js"></script>
		<title>Sphere Guard</title>
	</head>
	<body onload='initChart([<?php echo $chartValue; ?>])'>
		<div class="main">
			<section class="slideFirst">
				<h1 class="h1Master">Sphere Guard</h1>
				<div class="menuBot BgGlass">
				    <nav>
				            <ul>
				                    <div id="logo" onclick="document.location.href='/'">
				                        &nbsp;
				                    </div>
				                    <li>
				                            <a href="/#">item1</a>
				                    </li>
				                    <li>
				                            <a href="/#">item2</a>
				                    </li>
				                    <li>
				                            <a href="/#">item3</a>
				                    </li>
				                    <li>
				                            <a href="#">item4</a>
				                    </li>
				                    <li>
				                            <a href="#">item5</a>
				                    </li>
				            </ul>
				    </nav>
				</div>
			</section>
			<section class"slide">
				<div class="content30 BgGlass">
					<h1>Performances</h1>
					<table>
						<tr>
							<td>
								<label for="CpuUsage">CPU Usage</label>
							</td>
							<td>
								<label for="RamUsage">Ram Usage</label>
							</td>
							<td>
								<label for="DiskUsage">Disk Usage</label>
							</td>
						</tr>
						<tr>
							<td>
								<input value="<?php echo $cpuPerfArray[value]; ?>" id="CpuUsage" type="text" class="dial" >
							</td>
							<td>
								<input value="<?php echo $ramPerfArray[value]; ?>" id="RamUsage" type="text" class="dial">
							</td>
							<td>
								<input value="<?php echo $diskPerfArray[value]; ?>" id="DiskUsage" type="text" class="dial">
							</td>
						</tr>
					</table>
					<p><?php 
						$date = date_create($cpuPerfArray[date]);
    					$dateFormated = date_format($date, "d.m H:i");
    					echo $dateFormated;
					?></p>
				</div>
			</section>
			<section class="slideEmpty BgGlass">
				<div class="content70">
					<h1>Stats</h1>
					<table>
						<tr>
							<td>
								<label for="cpuTemp">CPU : <?php echo $cpuTempArray[value]; ?>°C</label>
							</td>
							<td>
								<label for="hddTemp">HDD (sda) : <?php echo $diskTempArray[value]; ?>°C</label>
							</td>
						</tr>
						<tr>
							<td>
								<progress id="cpuTemp" value="<?php echo $cpuTempArray[value]; ?>" max="100"></progress>
							</td>
							<td>
								<progress id="hddTemp" value="<?php echo $diskTempArray[value]; ?>" max="100"></progress>
							</td>
						</tr>
					</table>
					<div id="chartTemp"></div>
				</div>
			</section>
		</div>
	</body>
</html>