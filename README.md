Raspberry Pi Server Monitoring
==============================

(Single) Server Monitoring with the Raspberry Pi and a 7 inch touch screen

#### For the Installation instructions and dependencies, scroll down!

Intention
---------

There is really great and cool server monitoring software out there.
But I needed something small, compact but nevertheless with ALL important information on one single view without scrolling.
So I wrote this for a raspberry pi and its 7 inch touch display.

All numbers in the monitor screens are dynamically updated every few seconds with Ajax. They also have a warn and error value from when they then become orange or red.

Screenshots
-----------

![The main menu](https://github.com/alexloehner/raspberry-pi-server-monitor/raw/master/screenshots/image-01.jpg)

![The performance monitor](https://github.com/alexloehner/raspberry-pi-server-monitor/raw/master/screenshots/image-02.jpg)


Requirements
------------
#### On the Server
- 
- 
- 

#### On the Raspberry Pi
- 
- 
- 

Installation
------------
#### On the Server
/usr/bin/ifstat -n -z -q -b -i em1 2 >/tmp/netstat.log 2>/dev/null &


#### On the Raspberry Pi





























