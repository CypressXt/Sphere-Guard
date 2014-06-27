Sphere-Guard
============

System monitoring api &amp; administrative panel


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

#### The result

```
{
    "cpuUsage": [
        {
            "value": "13.1"
        },
        {
            "unit": "%"
        },
        {
            "date": "2014-06-28 00:15:02"
        },
        {
            "hostID": "1"
        }
    ],
    "cpuTemp": [
        {
            "value": "53.0"
        },
        {
            "unit": "°C"
        },
        {
            "date": "2014-06-28 00:15:02"
        },
        {
            "hostID": "1"
        }
    ],
    "ramUsage": [
        {
            "value": "100"
        },
        {
            "unit": "%"
        },
        {
            "date": "2014-06-28 00:15:02"
        },
        {
            "hostID": "1"
        }
    ],
    "diskUsage": [
        {
            "value": "59"
        },
        {
            "unit": "%"
        },
        {
            "date": "2014-06-28 00:15:02"
        },
        {
            "hostID": "1"
        }
    ],
    "diskTemp": [
        {
            "value": "37"
        },
        {
            "unit": "°C"
        },
        {
            "date": "2014-06-28 00:15:02"
        },
        {
            "hostID": "1"
        }
    ]
}
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