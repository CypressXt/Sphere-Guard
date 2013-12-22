# Sphere Guard

Sphere Guard is a simple and splendid web based monitoring tool for unix servers.


# Demo

Global server usage view:
![Alt text](https://lh5.googleusercontent.com/-OM3nLdYtyHI/Urbf5yqMiZI/AAAAAAAAByM/vQ0N3BAcxl8/w2234-h872-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2013-12-22+a%25CC%2580+13.49.08.png "Global server usage")

Server stats view:
![Alt text](https://lh6.googleusercontent.com/-UK0ZacKukRs/Urbf56PGUqI/AAAAAAAAByI/hFNKdKU4f68/w2236-h912-no/Capture+d%25E2%2580%2599e%25CC%2581cran+2013-12-22+a%25CC%2580+13.49.17.png "Global server usage")

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
dbName=sphereguard	    #Mysql database name
hddToWatch=/dev/sda     #temp form this hdd
#############################################
```

Now you're ready to use the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/GuardUpdater.sh">GuardUpdater.sh</a> file.
You can place this file where you want on your server and set it in your "crontab" file.

Here is an exemple with an update every 15 min:
(/etc/crontab file)
```bash
*/15 *	* * *	root	/home/cypress/GuardUpdater.sh
```
## MySQL Database

A MySQL database is required because the GuardUpdater will store its values ​​obtained during it survey.
You can easily create this database using the "SphereGuard.sql" sql script. So just use the phpmyadmin "import" fonction or execute it in a MySQL terminal.

<a href="https://github.com/CypressXt/Sphere-Guard/blob/master/SphereGuard.sql">SphereGuard.sql</a>

## Web GUI

Ok, the Web Gui can now soon operate.

### model/MysqlConnect.php
On the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/model/MysqlConnect.php">model/MysqlConnect.php</a> file you have to modify the database information.

```php
 $host='127.0.0.1';
    $dbName='sphereguard';
    $dbUser='user';
    $dbPassword='password';
```
### Web directory

Now you're done ! 
Just host the main folder where you want and configure your web server (apache/nginx or whatever) to point into it.

```apache
Alias /sphereGuard     /var/www/htdocs/sphereGuard/

<Directory /var/www/htdocs/sphereGuard/>
    Order Allow,Deny
    Allow from all
</Directory>
```

Enjoy !

# Customization
You can simply customize your menu in the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/views/home.php">views/home.php</a> file:

```html
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
```

and for the logo just edit the <a href="https://github.com/CypressXt/Sphere-Guard/blob/master/views/home.php">style/global.css</a>:

```css
#logo {
	display: inline-block;
	height: 90px;
	width: 90px;
	background-image: url("https://lh5.googleusercontent.com/--HJ3CY-6zKE/UdF4Eg5Iv5I/AAAAAAAAAOE/bcS_F8htlu4/w416-h1000-no/logoCy.png");
	background-size: auto 80px;
	background-position: 0% 50%;
	background-repeat: no-repeat;
	cursor: pointer;
}
```

