<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">

    var script = '<script type="text/javascript" src="http://google-maps-' + 'utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble';
    if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
    }
    script += '.js"><' + '/script>';
    document.write(script);
</script>
<script type="text/javascript">

    var map;
    var marker;
    var mapInfo;
    var mapPoint;

    function mapInfoBubbleClose() {
        mapInfo.close(map);
        marker.setVisible(true);
    }
    
    function mapInitialize() {
 
        var mapCanvas = document.getElementById('map-canvas');

        mapPoint = new google.maps.LatLng(55.640661,37.352362);

        var mapOptions = {
            zoom: 16,
            center: mapPoint,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
    
        map = new google.maps.Map(mapCanvas, mapOptions);

        marker = new google.maps.Marker({
		    position:  mapPoint,
			map: map,
			icon: '/bitrix/templates/rig/images/maps-icon.png'
		});

        var contentString = '<div class="mapbox"><div class="maplogo"><img src="/bitrix/templates/rig/images/maps-logo.png" style="width: 172px; height: 74px;" /></div><div style="float: right; width: 26px; height: 26px; cursor: pointer;"><img id="mapCloseButton" src="/bitrix/templates/rig/images/feedback-close.png" alt="" onmouseover="this.src=\'/bitrix/templates/rig/images/feedback-close-red.png\'" onmouseout="this.src=\'/bitrix/templates/rig/images/feedback-close.png\'" onclick="mapInfoBubbleClose()" /></div><div class="maptext">ООО "Рус Интеллект Групп"<br /><br />119634, Москва, ул.Шолохова, 14, оф. 306<br /><br />Телефон:  8 499 409 1983<br />Факс: 8 495 732 1630<br /><br />E-mail: info@intelgroup.ru</div></div>';

        mapInfo = new InfoBubble({
            content: contentString,
            borderRadius: 0,
            borderWidth: 5,
            borderColor: '#989898',
            position: mapPoint,
            maxWidth: 475,
            maxHeight: 170
		});

        google.maps.event.addListenerOnce(map, 'idle', function() {
            marker.setVisible(false);
            mapInfo.open(map);
        });

        google.maps.event.addListener(marker, 'click', function() {
            marker.setVisible(false);
            mapInfo.open(map);
		});

        google.maps.event.addDomListener(window, 'resize', function() {
            map.setCenter(mapPoint);
            var maxWidth = Math.round(90 * $(window).width() / 100);
            if(maxWidth < 200) { maxWidth = 200; }
            mapInfo.setMaxWidth(maxWidth);
        });

    }

    google.maps.event.addDomListener(window, 'load', mapInitialize);

</script>

<div id="map-canvas"></div>
<div class="contacts-info">
<img src="/contacts/contacts.jpg" alt="Схема проезда до ООО 'Рус Интеллект Групп'" title="Схема проезда до ООО 'Рус Интеллект Групп'" /><br />
ООО "Рус Интеллект Групп"<br />
119634, Москва, ул.Шолохова, 14, оф. 306<br />
Телефон: 8 499 409 1983<br />
Факс: 8 495 732 1630<br />
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>