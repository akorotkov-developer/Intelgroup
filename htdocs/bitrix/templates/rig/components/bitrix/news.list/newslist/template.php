<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="newslist">
<?
foreach($arResult["ITEMS"] as $arItem):
$date = str_replace('.', '/', substr($arItem["DISPLAY_ACTIVE_FROM"], 0, 10));
?>
        <div class="item"><span class="square"></span><span class="info"><span class="date"><?=$date?></span><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span><?if($arItem["PREVIEW_TEXT"]):?><span class="preview"><?=$arItem["PREVIEW_TEXT"]?></span><?endif;?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="read">Подробнее</a></div>
<?
endforeach;
?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y'):?>
<?
$filter = Array(
    "IBLOCK_ID" => 1,
    "SECTION_ID" => $GLOBALS["arrFilter"]["SECTION_ID"],
    "DATE_FROM" => "",
    "DATE_TO" => "",
    "LIMIT" => $arParams["NEWS_COUNT"]
);
$APPLICATION->IncludeComponent("rig:custom.pagenavigation", "", $filter, false);
?>
<?endif;?>
