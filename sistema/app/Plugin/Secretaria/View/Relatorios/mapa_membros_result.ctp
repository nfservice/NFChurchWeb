<?php
  $UFList=array('11'=>'RO',
                '12'=>'AC',
                '13'=>'AM',
                '14'=>'RR',
                '15'=>'PA',
                '16'=>'AP',
                '17'=>'TO',
                '21'=>'MA',
                '22'=>'PI',
                '23'=>'CE',
                '24'=>'RN',
                '25'=>'PB',
                '26'=>'PE',
                '27'=>'AL',
                '28'=>'SE',
                '29'=>'BA',
                '31'=>'MG',
                '32'=>'ES',
                '33'=>'RJ',
                '35'=>'SP',
                '41'=>'PR',
                '42'=>'SC',
                '43'=>'RS',
                '50'=>'MS',
                '51'=>'MT',
                '52'=>'GO',
                '53'=>'DF',
                '91'=>'SVAN');
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<style>
  body{
    margin:0;
    padding:0;
    font-family: Arial;
    font-size: 14px;
  }
  .quadradinho{
    float: left;
    width:100px;
    height: 50px;    
    padding-left: 20px;
    padding-top: 25px;
    margin: 30px;
  }
  .quadradinho1{
    border-left: 70px solid #2d9903;
  }
  .quadradinho2{
    border-left: 70px solid #dd0000;
  }
  .quadradinho3{
    border-left: 70px solid #1a03ad;
  }
  html, body { height: 100%; }
</style>
<div id="map" style="width:100%;height:80%;"></div>
<div id="legenda" style="width:100%;height:20%;">
  <div class="quadradinho quadradinho1">
    Membro Ativo
  </div>
  <div class="quadradinho quadradinho2">
    Membro Inativo
  </div>
  <div class="quadradinho quadradinho3">
    Visitante
  </div>
</div>
<script type="text/javascript">
    //<![CDATA[    

    // delay between geocode requests - at the time of writing, 100 miliseconds seems to work well

    var cores = Array();
    cores['Membro-1'] = '2d9903';
    cores['Membro-0'] = 'dd0000';
    cores['Visitante-1'] = '1a03ad';

    var delay = 100;

    // ====== Create map objects ======
    var infowindow = new google.maps.InfoWindow();

    var latlng = new google.maps.LatLng(-14.235004,-51.925280);

    var mapOptions = 
    {
        zoom: 7,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var geo     = new google.maps.Geocoder(); 
    var map     = new google.maps.Map(document.getElementById("map"), mapOptions);
    var bounds  = new google.maps.LatLngBounds();

    // ====== Geocoding ======
    function getAddress(search, next) 
    {      
      search = search.split('||');
      color = search[0];
      nomefantasia = search[2];
      search = search[1];

      geo.geocode({address:search}, function (results,status)
      { 
            // If that was successful
            if (status == google.maps.GeocoderStatus.OK) 
            {
                // Lets assume that the first marker is the one we want
                var p   = results[0].geometry.location;
                var lat = p.lat();
                var lng = p.lng();

                // Output the data
                var msg = 'address="' + search + '" lat=' +lat+ ' lng=' +lng+ '(delay='+delay+'ms)<br>';
                //document.getElementById("messages").innerHTML += msg;
                // Create a marker

                createMarker(search,lat,lng, nomefantasia, color);
            }
            // ====== Decode the error status ======
            else 
            {
                // === if we were sending the requests to fast, try this one again and increase the delay
                if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) 
                {
                    nextAddress--;
                    delay++;
                } 
                else 
                {
                    var reason  =   "Code "+status;
                    var msg     = 'address="' + search + '" error=' +reason+ '(delay='+delay+'ms)<br>';
                    // document.getElementById("messages").innerHTML += msg;
                }   
            }
            next();
          }
        );
    } 

      // ======= Function to create a marker

      function createMarker(add,lat,lng, nomefantasia, color) 
      {
          var contentString   = add;  

          if (add=='EOF') 
          {
              stopLoadingGMap() ; 
          }
          var contentString = '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<div id="bodyContent" style="min-width: 200px; min-height: 100px;">'+nomefantasia+'</div>'+
          '</div>';

          var infowindow = new google.maps.InfoWindow({
              content: contentString
          });    

          var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(lat,lng)
          });

          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
          });

          marker.setIcon('https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'+cores[color]+'|000000');

          bounds.extend(marker.position);
      }

      // ======= An array of locations that we want to Geocode ========
      // use static or build dynamically
      // use as many markers as you need – I've test with over 100
      var addresses = new Array(""<?php foreach ($membros as $membro) {
            if(empty($membro['Membro']['latitude']) || empty($membro['Membro']['longitude'])){
              echo ',"'.$membro['Membro']['tipo'].'-'.$membro['Membro']['ativo'].'||'.$membro['Endereco']['logradouro'].', '.$membro['Endereco']['numero'].' - '.$membro['Endereco']['bairro'].' - '.$membro['Endereco']['cidade'].' - '.$UFList[$membro['Endereco']['estado_id']].'||'.$membro['Membro']['nome'].'"';
            }
        } ?>
        );
      addresses.shift();
      var addressesltlg = new Array(""<?php foreach ($membros as $membro) {
            if(!empty($membro['Membro']['latitude']) && !empty($membro['Membro']['longitude'])){
              echo ',new Array("'.$membro['Membro']['tipo'].'-'.$membro['Membro']['ativo'].'", "'.$membro['Membro']['latitude'].'", "'.$membro['Membro']['longitude'].'", "'.$membro['Membro']['nome'].'")';
            }
        } ?>
        );
      addressesltlg.shift();
      // ======= Global variable to remind us what to do next
      var nextAddress = 0;

      // ======= Function to call the next Geocode operation when the reply comes back
      function theNext() 
      {
          if (nextAddress < addresses.length) 
          {
            setTimeout('getAddress("'+addresses[nextAddress]+'",theNext)', delay);
            nextAddress++;
          } 
          else 
          {
            // We're done. Show map bounds
            map.fitBounds(bounds);
          }
      }

      function addressesLTLG(){
        for(var i in addressesltlg){
          address = addressesltlg[i];
          color = address[0];
          latitude = address[1];
          longitude = address[2];
          nomefantasia = address[3];       
          createMarker('eae',latitude,longitude, nomefantasia, color);
        }
      }

      // ======= Call that function for the first time =======
      addressesLTLG();
      theNext();

      // This Javascript is based on code provided by the
       // Community Church Javascript Team
       // http://www.bisphamchurch.org.uk/   
       // http://econym.org.uk/gmap/

          //]]>
</script>