Sphere-Guard
============

System monitoring api &amp; administrative panel



# Description

Sphere-Guard is a simple monitoring tools available with his proper API.

This tool can be installed easily on most of the UNIX based OS.

## Admin panel

Here are some screenshot of the API admin panel:

Login view:
![Alt text](https://lh4.googleusercontent.com/-qq0ZpTVwVyg/U5N91ITF_nI/AAAAAAAAB80/BR9aGsYAk5Y/w2868-h1598-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-07+a%25CC%2580+23.01.15.png "Login view")

Api key and user management view:
![Alt text](https://lh6.googleusercontent.com/-VomJR6E0ukc/U5OAOJN48TI/AAAAAAAAB9E/fNlT0REb0L4/w2876-h1608-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-07+a%25CC%2580+23.05.42.png "Api key and user management view")
You can refresh all the api key here. You can also create new users (futur api client) and manage access to your api's admin panel.


# Developments in progress

You can follow here the (futur) development of Sphere-Guard

## General development

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Publishing the MySQL database script                                                                     | Not implemented yet X |
| Document all the api's functions                                                                         | Not implemented yet X |
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

## Admin panel

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Manage api users and key:                                                                                | Operational √         |
| -- Refresh a user api's key                                                                              | Operational √         |
| -- Delete a api's user                                                                                   | Operational √         |
| Manage your personnal information                                                                        | Operational √         |
| Manage your personnal information in AJAX                                                                | Not implemented yet X |
| Administrator authentication                                                                             | Operational √         |
| Manage watched hosts:                                                                                    | Not implemented yet X |
| -- Add a watched host                                                                                    | Not implemented yet X |
| -- Remove a watched host                                                                                 | Not implemented yet X |
| -- Manage watched hosts                                                                                  | Not implemented yet X |


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
You can easily create this database using the "SphereGuard.sql" sql script. So just use the phpmyadmin "import" fonction or execute it in a MySQL terminal.

/!\ 
After having imported this database, create a new user and set him grant on the SphereGuard db. 

**Don't forget to set theses credentials in the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> script !**

<a href="https://github.com/CypressXt/Sphere-Guard/blob/master/SphereGuard.sql">SphereGuard.sql</a>

