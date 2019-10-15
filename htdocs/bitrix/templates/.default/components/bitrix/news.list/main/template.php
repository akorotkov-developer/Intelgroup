<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <dl class="padtop3 dl2">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<dt><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></a></dt>
	 <dd><?echo $arItem["NAME"];?></dd>
                    
<?endforeach;?>

 </dl>