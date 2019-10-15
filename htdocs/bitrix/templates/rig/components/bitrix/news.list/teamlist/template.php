<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="teamlist">
<?
$n = round(count($arResult["ITEMS"]) / 2);
$i = 1;
?>
    <div class="col">
<?
foreach($arResult["ITEMS"] as $arItem):
?>
        <div class="item"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /><span class="person"><?=$arItem["NAME"]?></span><span class="about"><?=$arItem["PREVIEW_TEXT"]?></span></div>
<?if($i == $n):?>
    </div>
    <div class="col">
<?endif;?>
<?
$i++;
endforeach;
?>
    </div>
</div>