<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$mths = Array( 
    "01" => "Января", 
    "02" => "Февраля", 
    "03" => "Марта", 
    "04" => "Апреля", 
    "05" => "Мая", 
    "06" => "Июня", 
    "07" => "Июля", 
    "08" => "Августа", 
    "09" => "Сентября", 
    "10" => "Октября", 
    "11" => "Ноября", 
    "12" => "Декабря"
);
$arData = explode(".", substr($arResult["DISPLAY_ACTIVE_FROM"], 0, 10));
$d = ($arData[0] < 10) ? substr($arData[0], 1) : $arData[0];
$date = $d . " " . $mths[$arData[1]] . " " . $arData[2];
?>
<div class="article">
    <?/*<div class="date"><?=$date?></div>*/?>
    <div class="text"><?=$arResult["DETAIL_TEXT"]?></div>
</div>