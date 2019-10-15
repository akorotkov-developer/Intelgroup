<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news">
 <ul>
<?foreach($arResult["ITEMS"] as $arItem):?>

<li>
							<div class="news_data_title">
								<div class="news_data">
									<?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
								</div>
								<div class="news_one_title">
									<?echo $arItem["NAME"];?>
								</div>
							</div>
							<div class="news_text">
								<p>
									<?echo $arItem["PREVIEW_TEXT"];?>
								</p>
							</div>
							<a class="pod" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">ондпнамее</a>
						</li>




	
<?endforeach;?>

 </ul>
 </div>
 <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>