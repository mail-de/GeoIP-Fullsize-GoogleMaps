GeoIP-Fullsize-GoogleMaps
=========================

Website showing full size Google Maps to geolocate IP addresses

* Copyright (c) 2014, [https://mail.de](https://mail.de)
* Author: Michael Kliewe, [@PHPGangsta](http://twitter.com/PHPGangsta)
* Licenced under MIT

IPv6-ready!

Online demo here: https://geoip.mail.de

This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com

Usage:
------

You can use the online version on https://geoip.mail.de or install it on your server.

Upload this code to your server, install Composer dependencies via "composer install", then use it.

You should update the GeoLite2-City database to get best results!
http://dev.maxmind.com/geoip/geoip2/geolite2/

If you have IP-addresses in your application, open a popup or create an iframe, and add
the IP address as GET-parameter q, for example:

https://geoip.mail.de/?q=1.2.3.4

ToDo:
-----
- ??? What do you need?

Notes:
------
If you like this script or have some features to add: contact us, fork this project, send pull requests, you know how it works.