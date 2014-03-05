<?
require 'vendor/autoload.php';

if (isset($_GET['q'])) {
    $q = $_GET['q'];
} elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
    $q = $_SERVER['HTTP_X_REAL_IP'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $q = $_SERVER['REMOTE_ADDR'];
} else {
    $q = '';
}

if (!empty($q)) {
    $reader = new \GeoIp2\Database\Reader('MaxMindDB/GeoLite2-City.mmdb');
    try {
        $record = $reader->city($q);
        $lat = $record->location->latitude;
        $lan = $record->location->longitude;
    } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
        $lat = 0;
        $lan = 0;
    }
} else {
    $lat = 0;
    $lan = 0;
}

if (isset($_GET['l'])) {
    $l = $_GET['l'];
} else {
    $l = 'en';
} ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name = "viewport" content = "user-scalable=no, width=device-width">

    <title>GeoIP Fullsize GoogleMaps - powered by mail.de</title>

    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
            border: 0;
            font-weight: inherit;
            font-style: inherit;
            font-size: 100%;
            font-family: inherit;
            vertical-align: baseline;
        }
        body {
            line-height: 1.5;
            font-family: Helvetica Neue, Arial, Helvetica, sans-serif;
            color: #333333;
            font-size: 75%;
            text-align: center;
        }
        #map {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        form {
            position: absolute;
            z-index: 1;
            left: 50%;
            width: 330px;
            margin-left: -165px; }
        form fieldset {
            border: none;
        }
        form fieldset #q {
            width: 270px;
        }

        .project_by {
            position: absolute;
            bottom: 0;
            left: 80px;
            z-index: 1000001;
            width: 100px;
            font-size: 10px;
            color: #444;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto,Arial,sans-serif;
            background-color: #FFF;
            opacity: 0.7;
            padding-left: 8px;
        }
    </style>
</head>
<body>
    <form action="/" method="GET">
        <fieldset id="ip_address" class="">
            <input name="q" value="<?=$q ?>" id="q" placeholder="Hostname/IP" type="search" autosave="geoip.mail.de" results="10"><input type="submit" value="Go">
        </fieldset>
    </form>
    <div id="map"></div>
    <div class="project_by">A project by <a href="https://mail.de" target="_blank" style="color: #010101;">mail.de</a></div>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=<?=$l ?>&key=AIzaSyBjvpNQ4YZtp2ATNU4pHIZXt5S9MUuSTDE"></script>
    <script type="text/javascript" charset="utf-8">
        var map;
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?=$lat ?>, <?=$lan ?>);

            var mapOptions = {
                zoom: 8,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: '<?=$q ?>'
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>
</html>