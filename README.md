Sphere-Guard
============

System monitoring api &amp; administrative panel



# Description

Sphere-Guard is a simple monitoring tools available with his proper API.

This tool can be installed easily on most of the UNIX based OS.

## Admin panel

Here are some screenshot of the API admin panel:


Api key and user management view:
You can refresh all the api key here. You can also create new users (futur api client) and manage access to your api's admin panel.
![Alt text](https://lh6.googleusercontent.com/-VomJR6E0ukc/U5OAOJN48TI/AAAAAAAAB9E/fNlT0REb0L4/w2876-h1608-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-07+a%25CC%2580+23.05.42.png "Api key and user management view")

Api host management view:
You can add or remove your watched hosts on this panel.
![Alt text](https://lh5.googleusercontent.com/-UfYH11GXTBc/U5R29sjrILI/AAAAAAAAB9w/F_rA-cVoUFI/w2878-h1576-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-08+a%25CC%2580+16.44.17.png "Login view")


# Developments in progress

You can follow here the (futur) development of Sphere-Guard

## General development

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Publishing the MySQL database script                                                                     | Done √                |
| Document all the api's functions                                                                         | Done √                |
| Set up a demo website                                                                                    | Not implemented yet X |
| Develope a mobile client application (IOS):                                                              | nearly finished   ... |
| -- Release the application on the App Store                                                              | Not implemented yet X |
| -- Document the mobile application                                                                       | Not implemented yet X |
| Develope a mobile client application (Android)                                                           | Not implemented yet X |
| Develope a mobile client application (Windows Phone)                                                     | Not implemented yet X |
| Manage to get normal volume information (not only lvm volume)                                            | Not implemented yet X |

## API

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Get all you'r watched server (Hostname, IP, actual cpu & ram & disk usage)                               | Operational √         |
| Get all measures saved by server                                                                         | Operational √         |
| Get all measures saved by host for last past 24h                                                         | Operational √         |
| Get all measures saved by host for a chosen period of time                                               | Not implemented yet X |
| Return getInfoByHost in JSON                                                                             | Not implemented yet X |

## Admin panel

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Manage api users and key:                                                                                | Operational √         |
| -- Refresh a user api's key                                                                              | Operational √         |
| -- Delete a api's user                                                                                   | Operational √         |
| Manage your personnal information                                                                        | Operational √         |
| Manage your personnal information in AJAX                                                                | Not implemented yet X |
| Administrator authentication                                                                             | Operational √         |
| Manage watched hosts:                                                                                    | Operational √         |
| -- Add a watched host                                                                                    | Operational √         |
| -- Remove a watched host                                                                                 | Operational √         |
| Display some global information about your domain                                                        | Not implemented yet X |
| Display some statistics about your api's usage                                                           | Not implemented yet X |


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
dbName=SphereGuard      #Mysql database name
hostNumberID=1324       #Unique ID of your watched server
hddToWatch=/dev/sda     #temp form this hdd
#############################################
```

You can find your host unique ID in the "Manage hosts" section on your admin panel.

Now you're ready to use the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> file.
You can place this file where you want on your server and set it in your "crontab" file.

Here is an exemple with an update every 15 min:(/etc/crontab file)
```bash
*/15 *	* * *	root	/home/cypress/SphereGuard/GuardUpdater.sh
```


## MySQL Database

A MySQL database is required because the GuardUpdater will store its values ​​obtained during it survey.
You can easily create this database using the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/SphereGuard.sql">SphereGuard.sql</a> sql script. So just use the phpmyadmin "import" fonction or execute it in a MySQL terminal.

After having imported this database, create a new user and set him grant on the SphereGuard db. 

**/!\ Don't forget to set these credentials in the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> script !**

# API manipulation

You can find here all the syntax and the methods available in the API.

All the variables like "[myVar]" have to be set with correct value found in your Database or in the admin panel.

For example the web address of your api is written like this:
```
http://[yourWebServer]/SphereGuard/
```

replace the variable like this:

```
http://example.com/SphereGuard/
```

## Available methods

* getAllHosts
* getInfoByHost
* getChartByHost

### getAllHosts

This method return all the server that you're monitoring with the actual hostname, Ip address, cpu usage, ram usage, disk usage and disk temperature.

#### The call

#####Input parameters: 

* user=[yourApiUser]
* key=[theApiUserKey]
* function=getAllHosts

```
http://[yourWebServer]/SphereGuard/index.php?l=api&user=[youApiUser]&key=[theApiUserKey]&function=getAllHosts
```

#### The JSON result

```
[
    { "id":"1" ,"name":"Grenth" , "ip":"192.168.1.70", "cpuTemp":"53.0", "usedRam":"100", "usedCpu":"6.5", "diskUsage":"59", "diskTemp":"38"}
    { "id":"2" ,"name":"Dwayna" , "ip":"192.168.1.72", "cpuTemp":"56.0", "usedRam":"54", "usedCpu":"8.5", "diskUsage":"43", "diskTemp":"38"}
]
```

### getInfoByHost

This method return the actual server state by id (hostname, Ip address, cpu usage, ram usage, disk usage and disk temperature).

#### The call

#####Input parameters:

* user=[yourApiUser]
* key=[theApiUserKey]
* inset=[HostUniqueID]
* function=getInfoByHost

```
http://[yourWebServer]/SphereGuard/index.php?l=api&user=[youApiUser]&key=[theApiUserKey]&function=getInfoByHost&inset=[HostUniqueID]
```

#### The result (NOT JSON !! will be updated soon)

```
Array
(
    [0] => Array
        (
            [pk_performance] => 81103
            [fk_type] => 1
            [value] => 100
            [fk_host] => 1
            [date] => 2014-06-08 00:45:02
            [pk_type] => 1
            [name] => Used RAM
            [unit] => %
        )

    [1] => Array
        (
            [pk_performance] => 81104
            [fk_type] => 2
            [value] => 13
            [fk_host] => 1
            [date] => 2014-06-08 00:45:02
            [pk_type] => 2
            [name] => Cpu usage
            [unit] => %
        )

    [2] => Array
        (
            [pk_performance] => 81105
            [fk_type] => 3
            [value] => 59
            [fk_host] => 1
            [date] => 2014-06-08 00:45:02
            [pk_type] => 3
            [name] => Disk usage
            [unit] => %
        )

    [3] => Array
        (
            [pk_performance] => 81106
            [fk_type] => 4
            [value] => 53.0
            [fk_host] => 1
            [date] => 2014-06-08 00:45:02
            [pk_type] => 4
            [name] => cpuTemp
            [unit] => °C
        )

    [4] => Array
        (
            [pk_performance] => 81107
            [fk_type] => 5
            [value] => 38
            [fk_host] => 1
            [date] => 2014-06-08 00:45:02
            [pk_type] => 5
            [name] => hddTemp
            [unit] => °C
        )

)
```



### getChartByHost

This method return information about an host for the last 24 hours (cpu usage, ram usage, disk usage, disk temperature and the statement date).

#### The call

#####Input parameters:

* user=[yourApiUser]
* key=[theApiUserKey]
* inset=[HostUniqueID]
* function=getChartByHost

```
http://[yourWebServer]/SphereGuard/index.php?l=api&user=[youApiUser]&key=[theApiUserKey]&function=getChartByHost&inset=[HostUniqueID]
```

#### The JSON result
```
{
    "cpuUsage": [
        {
            "value": "104.6"
        },
        {
            "value": "19.6"
        },
        {
            "value": "26.1"
        }
    ],
    "cpuTemp": [
        {
            "value": "57.0"
        },
        {
            "value": "54.0"
        },
        {
            "value": "54.0"
        }
    ],
    "ramUsage": [
        {
            "value": "100"
        },
        {
            "value": "100"
        },
        {
            "value": "100"
        }
    ],
    "diskUsage": [
        {
            "value": "59"
        },
        {
            "value": "59"
        },
        {
            "value": "59"
        }
    ],
    "diskTemp": [
        {
            "value": "40"
        },
        {
            "value": "40"
        },
        {
            "value": "38"
        }
    ],
    "date": [
        {
            "value": "2014-06-07 01:15:02"
        },
        {
            "value": "2014-06-07 01:30:02"
        },
        {
            "value": "2014-06-08 01:00:02"
        }
    ]
}
```