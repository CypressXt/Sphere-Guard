Sphere-Guard
============

System monitoring api &amp; administrative panel

# Readme Index

* [Description](https://github.com/CypressXt/Sphere-Guard#description)
* [Upcoming development](https://github.com/CypressXt/Sphere-Guard#upcoming-development)
* [Installation](https://github.com/CypressXt/Sphere-Guard#installation)
* [API manipulation](https://github.com/CypressXt/Sphere-Guard#api-manipulation)

---
# Description

Sphere-Guard is a simple monitoring tools available with his proper API.

This tool can be installed easily on most of the UNIX based OS.

## Admin panel

Here are some screenshot of the API admin panel:


### Home view
Here is the page that you can see just after a successful login.
You have access to an overview of all your domain.
![Alt text](https://lh6.googleusercontent.com/-6mZvWzQ3Hhg/VDlJ_Fb069I/AAAAAAAACFE/J0uVcATmkD8/w2236-h1200-no/Capture%2Bd’écran%2B2014-10-11%2Bà%2B17.09.50.png "Home view")

### Api key and user management view
You can refresh all the api key here. You can also create new users (futur api client) and manage access to your api's admin panel.
![Alt text](https://lh6.googleusercontent.com/-0m3mHbn_p5g/VDlKAMkQaOI/AAAAAAAACFI/boVsC6YkZxo/w2236-h1196-no/Capture%2Bd’écran%2B2014-10-11%2Bà%2B17.12.46.png "Api key and user management view")

### Api host management view
You can add or remove your watched hosts on this panel.
![Alt text](https://lh4.googleusercontent.com/-t0x7esjkZ3Y/VDlJ_GHcNvI/AAAAAAAACFA/e_BMS_KSrxs/w2236-h1198-no/Capture%2Bd’écran%2B2014-10-11%2Bà%2B17.12.35.png "Login view")


### Personal informations view
This page allow you to update and modify your personal data:
![Alt text](https://lh5.googleusercontent.com/-5UbXqRvbS-U/VDlKAoGhCzI/AAAAAAAACFM/lSQwTmZKloo/w2236-h1194-no/Capture%2Bd’écran%2B2014-10-11%2Bà%2B17.13.16.png "Personal informations view")


---
# Upcoming Development

You can <a href="https://github.com/CypressXt/Sphere-Guard/wiki/Upcoming-development">follow here</a> the (futur) development of Sphere-Guard

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

