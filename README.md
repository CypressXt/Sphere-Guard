Sphere-Guard
============

System monitoring api &amp; administrative panel

# Readme Index

* [Description](https://github.com/CypressXt/Sphere-Guard#description)
* [Developments in progress](https://github.com/CypressXt/Sphere-Guard#developments-in-progress)
* [Installation](https://github.com/CypressXt/Sphere-Guard#installation)
* [API manipulation](https://github.com/CypressXt/Sphere-Guard#api-manipulation)

---
# Description

Sphere-Guard is a simple monitoring tools available with his proper API.

This tool can be installed easily on most of the UNIX based OS.

## Admin panel

Here are some screenshot of the API admin panel:


### Api key and user management view
You can refresh all the api key here. You can also create new users (futur api client) and manage access to your api's admin panel.
![Alt text](https://lh6.googleusercontent.com/-VomJR6E0ukc/U5OAOJN48TI/AAAAAAAAB9E/fNlT0REb0L4/w2876-h1608-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-07+a%25CC%2580+23.05.42.png "Api key and user management view")

### Api host management view
You can add or remove your watched hosts on this panel.
![Alt text](https://lh5.googleusercontent.com/-UfYH11GXTBc/U5R29sjrILI/AAAAAAAAB9w/F_rA-cVoUFI/w2878-h1576-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-08+a%25CC%2580+16.44.17.png "Login view")

---
# Developments in progress

You can follow here the (futur) development of Sphere-Guard

## General development

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Publishing the MySQL database script                                                                     | Done √                |
| Document all the api's functions                                                                         | Done √                |
| Set up a demo website                                                                                    | Done √                |
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
| Return getInfoByHost in JSON                                                                             | Operational √         |

## Admin panel

| Feature                                                                                                  | Status                |
| :------------------------------------------------------------------------------------------------------- |:----------------------|
| Manage api users and key:                                                                                | Operational √         |
| -- Refresh a user api's key                                                                              | Operational √         |
| -- Delete a api's user                                                                                   | Operational √         |
| Manage your personnal information                                                                        | Operational √         |
| Manage your personnal information in AJAX                                                                | Not implemented yet X |
| Log in with AJAX                                                                                         | Not implemented yet X |
| Administrator authentication                                                                             | Operational √         |
| Manage watched hosts:                                                                                    | Operational √         |
| -- Add a watched host                                                                                    | Operational √         |
| -- Remove a watched host                                                                                 | Operational √         |
| Display some global information about your domain                                                        | Not implemented yet X |
| Display some statistics about your api's usage                                                           | Not implemented yet X |
| First launch wizard                                                                                      | Operational √         |

---
# Installation
Here are the differents steps:


# MySQL Database

A MySQL database is required because the GuardUpdater will store its values ​​obtained during it survey.
You can easily create this database using the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/SphereGuard.sql">SphereGuard.sql</a> sql script. So just use the phpmyadmin "import" fonction or execute it in a MySQL terminal.

After having imported this database, create a new user and set him grant on the SphereGuard db. 

**/!\ Don't forget to set these credentials in the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> script !**


## Web server

Now you're ready to set up the administration panel. You need to have, obviously, a web server available (Apache, Nginx, or whatever).

I'm not an expert of Nginx but here is the apache configuration for running properly the admin area:

This configuration file stay normal (on linux OS) in  ```/etc/apache2/sites-available/yourConfigFileName```
```

Alias /SphereGuard	/path/to/your/SphereGuard/directory/

<Directory /path/to/your/SphereGuard/directory/>
    Order Allow,Deny
    Allow from all
</Directory>

```

After this, just open the SphereGuard url in your browser and you normally will see this:

![Alt text](https://lh3.googleusercontent.com/-uenkd-kFxOA/U5SmFQlXs-I/AAAAAAAAB-E/_jszrmFBpTA/w2868-h1612-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2014-06-08+a%25CC%2580+20.05.26.png "Install view")

Fill the form and you're done.

You can log in with these credential:

**User:** Admin

**Password:** Password

**Don't forget to instantly change the default username and password with your personal identifier !!!**


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

You can find your host unique ID in the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/README.md#api-host-management-view">"Manage hosts"</a> section on your admin panel.

Now you're ready to use the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> file.
You can place this file where you want on your server and set it in your "crontab" file.

Here is an exemple with an update every 15 min:(/etc/crontab file)
```bash
*/15 *	* * *	root	/home/cypress/SphereGuard/GuardUpdater.sh
```

**Your SphereGuard installation is now finished !**

If you have any question, remark or advice please let me know.
Send me a [mail](mailto:cypress@cypressxt.net?Subject=SphereGuard%20github) or create a new [issue](https://github.com/CypressXt/Sphere-Guard/issues/new).
Thanks in advance !

---
# API manipulation

You can find <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/README_API.md">here</a> all the syntax and the methods available in the API.

