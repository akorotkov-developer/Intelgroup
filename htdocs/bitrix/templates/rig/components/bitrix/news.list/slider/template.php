<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$pics = '';
$icons = '';
$i = 1;
$class = ' class="active"';
foreach($arResult["ITEMS"] as $arItem) {
    if($i == 2) $class = ' class="off"';
    if(isset($arItem["PROPERTIES"]["LINK"]["VALUE"]) && ($arItem["PROPERTIES"]["LINK"]["VALUE"] != '')) {
        $pics .= '<li' . $class . '><a href=""><img src="' . $arItem["DETAIL_PICTURE"]["SRC"] . '" alt="" /></a></li>';
    } else {
        $pics .= '<li' . $class . '><img src="' . $arItem["DETAIL_PICTURE"]["SRC"] . '" alt="" /></li>';
    }
    $icons .= '<li' . $class . '><div class="arrow"></div><div class="icon"><img src="' . $arItem["PREVIEW_PICTURE"]["SRC"] . '" alt="" /><span class="block"><span class="fix"></span><span class="text">' . $arItem["NAME"] . '</span></span></div></li>';
    $i++;
}
?>
<div class="slider">
    <ul class="pics"><?=$pics?></ul>
    <ul class="icons"><?=$icons?></ul>
</div>