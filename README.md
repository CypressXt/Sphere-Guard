Sphere-Guard
============

System monitoring api &amp; administrative panel



# Description

Sphere-Guard is a simple monitoring tools available with his proper API.

This tool can be installed easily on most of the UNIX based OS.



# Installation
Here are the differents steps:

## Server to observe
### Package required
You need to install the following linux package on your futur monitored server:
* mpstat
* pvdisplay (if you use some lvm drive)
* sudo
* lm-sensors
* hddtemp
* Mysql-client

### GuardUpdater.sh
<a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">This file</a> is a bash script that collect all theses server information
* CPU usage
* Ram usage
* Disk (lvm drive) usage
* CPU temperature
* Disk temperature

For proper operation you need to edit the "config" section.

```bash
#!/bin/bash

## Config ###################################
dbHost=127.0.0.1        #Mysql Host name/Ip
dbUser=user             #Mysql user
dbPassword=password     #Mysql user's pass
dbName=sphereguard      #Mysql database name
hostNumberID=1324       #Unique ID of your watched server
hddToWatch=/dev/sda     #temp form this hdd
#############################################
```

Now you're ready to use the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> file.
You can place this file where you want on your server and set it in your "crontab" file.

Here is an exemple with an update every 15 min:
(/etc/crontab file)
```bash
*/15 *	* * *	root	/home/cypress/SphereGuard/GuardUpdater.sh
```


## MySQL Database (IN DEVELOPMENT)

A MySQL database is required because the GuardUpdater will store its values ​​obtained during it survey.
You can easily create this database using the "SphereGuard.sql" sql script. So just use the phpmyadmin "import" fonction or execute it in a MySQL terminal.

