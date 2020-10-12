<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

<html>
  <body>
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(13.066386, 80.251302),
          zoom: 4
        });
        var infoWindow = new google.maps.InfoWindow;
        var locations = <?php print_r(json_encode($location)) ?>;

          // Change this depending on the name of your PHP or XML file
            Array.prototype.forEach.call(locations, function(value, index) {
              var point = new google.maps.LatLng(
                  parseFloat(value.loclat),
                  parseFloat(value.loclong));

              var infowincontent = document.createElement('div');
              var text = document.createElement('text');
              text.textContent = value.locname
              infowincontent.appendChild(text);
              var marker = new google.maps.Marker({
                map: map,
                position: point,
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
        }


    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3iLkHhKKeCPJ-Qq8tD750rbCrEHYtJww&callback=initMap">
    </script>
  </body>
</html>