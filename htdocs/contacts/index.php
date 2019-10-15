<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
?>
<style>
	.js-info-bubble-close {
		display: none;
	}
</style>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);
    function init(){ 
        // Создание карты.    
        var myMap = new ymaps.Map("map-canvas", {
            // Координаты центра карты.
            // Порядок по умолчнию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [55.640661,37.352362],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 16
        }),
        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'ООО "Рус Интеллект Групп"',
            balloonContentHeader: "ООО 'Рус Интеллект Групп'",
            balloonContentBody: '<div><div class="maplogo"><img src="/bitrix/templates/rig/images/maps-logo.png" style="width: 172px; height: 74px;" /></div><div style="clear:both;"></div><div>119634, Москва, ул.Шолохова, 14, оф. 306<br /><br />Телефон:  8 499 409 1983<br />Факс: 8 495 732 1630<br /><br />E-mail: info@intelgroup.ru</div></div>',
           
            hintContent: "ООО 'Рус Интеллект Групп'"
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/bitrix/templates/rig/images/maps-icon.png',
            // Размеры метки.
            iconImageSize: [48, 48],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            
        });
        myMap.geoObjects.add(myPlacemark);
    }
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