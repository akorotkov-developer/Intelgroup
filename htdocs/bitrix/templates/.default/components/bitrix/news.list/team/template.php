<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="box2 text-2">
<?foreach($arResult["ITEMS"] as $arItem):?>

	<article class="wrapper">
                    	<div class="fleft">
                    	<?
if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])){
$image_resize = CFile::ResizeImageGet(intval($arItem["PREVIEW_PICTURE"]["ID"]), array('width'=>63, 'height'=>63), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>
<img src="<?=$image_resize["src"]?>" alt="<?echo $arItem["NAME"]?>">
<?
}
?>
                    	</div>
                        <!--<a href="#" class="link1"><strong><?echo $arItem["NAME"]?></strong></a>-->
<strong><?echo $arItem["NAME"]?></strong>                       
						<p class="extra-wrap"><?echo $arItem["PREVIEW_TEXT"];?></p>
                    </article>
<?endforeach;?>
</div>