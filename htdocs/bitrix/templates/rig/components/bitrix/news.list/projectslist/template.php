<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="projectslist">
<?foreach($arResult["ITEMS"] as $arItem):
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
$arData = explode(".", substr($arItem["DISPLAY_ACTIVE_FROM"], 0, 10));
$d = ($arData[0] < 10) ? substr($arData[0], 1) : $arData[0];
$date = $d . " " . $mths[$arData[1]] . " " . $arData[2];
?>
    <div class="item"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /></a><span class="about"><span class="date"><?=$date?></span><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span></div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y'):?>
<?
$filter = Array(
    "IBLOCK_ID" => 11,
    "SECTION_ID" => $GLOBALS["arrFilter"]["SECTION_ID"],
    "DATE_FROM" => "",
    "DATE_TO" => "",
    "LIMIT" => $arParams["NEWS_COUNT"]
);
$APPLICATION->IncludeComponent("rig:custom.pagenavigation", "", $filter, false);
?>
<?endif;?>
