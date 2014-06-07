#!/bin/bash

## Config ###################################
dbHost=127.0.0.1        #Mysql Host name/Ip
dbUser=user             #Mysql user
dbPassword=password     #Mysql user's pass
dbName=sphereguard      #Mysql database name
hostNumberID=1324       #Unique ID of your watched server
hddToWatch=/dev/sda     #temp form this hdd
#############################################




## RAM USAGE ################################
Ram=`cat /proc/meminfo | grep 'MemFree:'`
Ramf=${Ram#*:}
FreeRam=${Ramf/kB/}

Ram2=`cat /proc/meminfo | grep 'MemTotal:'`
Ramt=${Ram2#*:}
RamTotal=${Ramt/kB/}

let "UsedMem=100-$FreeRam*100/RamTotal"
#############################################


## CPU Usage ################################
#idl=`mpstat | awk '{print $12}'`
#idle=${idl#*%idle}
CpuUsage=`top -bn 1 | awk '{print $9}' | tail -n +8 | awk '{s+=$1} END {print s}'`
#############################################


## Disk Usage (lvmVolume) #########################
dT=`sudo pvdisplay | grep 'Total PE'`
dTotal=${dT#*PE}
let "DiskTotal=4*$dTotal"

dF=`sudo pvdisplay | grep 'Free PE'`
dFree=${dF#*PE}
let "DiskFree=4*$dFree"

DiskUs=`echo 100-$DiskFree*100/$DiskTotal | bc -l`
DiskUsage=$(echo $DiskUs | cut -d"." -f1);
###################################################


## CPU Temp ##############################
tmp=`sensors | awk 'NR==3 {print $4}'`
t=${tmp#*+}
tempCPU=${t/°C/}
##########################################

## HDD Temp ##############################
tmpH=`sudo hddtemp $hddToWatch | awk '{print $4}'`
tHD=${tmpH#*+}
tempHD=${tHD/°C/}
##########################################

## SQL REQUEST ###########################
mysql --host=$dbHost --user=$dbUser --password=$dbPassword $dbName << EOF
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('1','${UsedMem}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('2','${CpuUsage}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('3','${DiskUsage}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('4','${tempCPU}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('5','${tempHD}','${hostNumberID}',NOW());
exit
EOF
##########################################