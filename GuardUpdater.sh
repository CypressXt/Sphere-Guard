#!/bin/bash

## Config ###################################
dbHost=127.0.0.1        #Mysql Host name/Ip
dbUser=user             #Mysql user
dbPassword=password     #Mysql user's pass
dbName=SphereGuard      #Mysql database name
hostNumberID=1324       #Unique ID of your watched server
hddToWatch=/dev/sda     #temp form this hdd
isLVMStorage=0          #set to 1 if your storage is using lvm
#############################################



## Requirement check ################################
if [ -z $(command -v cat) ]
then
    echo "cat is required !"
    echo "Exiting"
    exit 1
fi

if [ -z $(command -v grep) ]
then
    echo "grep is required !"
    echo "Exiting"
    exit 1
fi

if [ -z $(command -v pvdisplay) ] && [ "$isLVMStorage" = 1 ]
then
    echo "pvdisplay is required !"
    echo "Exiting"
    exit 1
fi

if [ -z $(command -v sensors) ]
then
    echo "lm-sensors is required !"
    echo "Exiting"
    exit 1
fi

if [ -z $(command -v hddtemp) ]
then
    echo "hddtemp is required !"
    echo "Exiting"
    exit 1
fi
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
CpuUsage=$(top -bn 1 | awk '{print $9}' | tail -n +8 | awk '{s+=$1} END {print s}')
#############################################

## Disk Usage ###############################
if [ "$isLVMStorage" = 1 ]
then
    ## Disk Usage (lvmVolume)
    dT=`pvdisplay | grep 'Total PE'`
    dTotal=${dT#*PE}
    let "DiskTotal=4*$dTotal"

    dF=`pvdisplay | grep 'Free PE'`
    dFree=${dF#*PE}
    let "DiskFree=4*$dFree"

    DiskUs=$(echo 100-$DiskFree*100/$DiskTotal | bc -l)
    DiskUsage=$(echo $DiskUs | cut -d"." -f1);
else
    ## Disk Usage (No-lvmVolume)
    DiskCapacity=$(df -Ph $hddToWatch | tail -1 | awk '{print $2}' |  cut -d'G' -f1)
    DiskCurrentUsage=$(df -Ph $hddToWatch | tail -1 | awk '{print $4}' |  cut -d'G' -f1)
    DiskUsage=$(($DiskCapacity/($DiskCapacity-$DiskCurrentUsage)))
fi
#############################################

## CPU Temp ##############################
tmp=$(sensors | grep "Core 0" | awk '{print $3}')
t=${tmp#*+}
tempCPU=${t/°C/}
##########################################

## HDD Temp ##############################
tmpH=`sudo hddtemp $hddToWatch | awk '{print $4}'`
tHD=${tmpH#*+}
tempHD=${tHD/°C/}
##########################################

## HDD Temp ##############################
localIp=$(ip a s|sed -ne '/127.0.0.1/!{s/^[ \t]*inet[ \t]*\([0-9.]\+\)\/.*$/\1/p}')
##########################################

## SQL REQUEST ###########################
mysql --host=$dbHost --user=$dbUser --password=$dbPassword $dbName << EOF
UPDATE host SET ip="${localIp}" WHERE pk_host="${hostNumberID}";
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('1','${UsedMem}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('2','${CpuUsage}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('3','${DiskUsage}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('4','${tempCPU}','${hostNumberID}',NOW());
INSERT INTO performance (fk_type, value, fk_host, date) VALUES ('5','${tempHD}','${hostNumberID}',NOW());
exit
EOF
##########################################
