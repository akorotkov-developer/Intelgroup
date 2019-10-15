<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="recommendationslist">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="item" data-element="<?=$arItem["ID"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /><span class="about"><?=$arItem["NAME"]?></span><span class="description"><?=$arItem["PREVIEW_TEXT"]?></span></div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y'):?>
<?
$filter = Array(
    "IBLOCK_ID" => 10,
    "SECTION_ID" => $GLOBALS["arrFilter"]["SECTION_ID"],
    "DATE_FROM" => "",
    "DATE_TO" => "",
    "LIMIT" => $arParams["NEWS_COUNT"]
);
$APPLICATION->IncludeComponent("rig:custom.pagenavigation", "", $filter, false);
?>
<?endif;?>
