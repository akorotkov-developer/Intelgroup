<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section id="content" class="text-2">
    <div class="main3">
        <ul class="list-3">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<li>
            	<figure>
            	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            	<?
            	
            	$image_resize = CFile::ResizeImageGet(intval($arItem["PREVIEW_PICTURE"]["ID"]), array('width'=>266, 'height'=>245), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            	?>
                	<a href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" class="thickbox" rel="photo" title="<?echo $arItem["NAME"]?>"><img src="<?=$image_resize["src"]?>" alt="<?echo $arItem["NAME"]?>"></a>
                	<?endif;?>
                    <strong><?echo $arItem["NAME"]?></strong>
                    <span><?echo $arItem["PREVIEW_TEXT"];?></span>
                </figure>
            </li>
<?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
 </div>
</section>
