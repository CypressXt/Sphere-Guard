# Sphere Guard

Sphere Guard is a simple and splendid web based monitoring tool for unix servers.


## Demo

Global server usage view:
![Alt text](https://lh5.googleusercontent.com/-OM3nLdYtyHI/Urbf5yqMiZI/AAAAAAAAByM/vQ0N3BAcxl8/w2234-h872-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2013-12-22+a%25CC%2580+13.49.08.png "Global server usage")

Server stats view:
![Alt text](https://lh6.googleusercontent.com/-UK0ZacKukRs/Urbf56PGUqI/AAAAAAAAByI/hFNKdKU4f68/w2236-h912-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2013-12-22+a%25CC%2580+13.49.17.png "Global server usage")

## Installation
Here are the differents steps:

### Server to observe
#### Package required
You need to install the following linux package on your futur monitored server:
* mpstat
* pvdisplay (if you use some lvm drive)
* sudo
* lm-sensors
* hddtemp
* Mysql-client

#### GuardUpdate.sh
This file is a bash script that collect all theses server information
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
dbName=dbMonitoring     #Mysql database name
hddToWatch=/dev/sda     #temp form this hdd
#############################################
```

#!/bin/bash

## Config ###################################
dbHost=127.0.0.1        #Mysql Host name/Ip
dbUser=user             #Mysql user
dbPassword=password     #Mysql user's pass
dbName=dbMonitoring     #Mysql database name
hddToWatch=/dev/sda     #temp form this hdd
#############################################



Now you're ready to use the GuardUpdater.sh file. 


### Web GUI

### MySQL Database

