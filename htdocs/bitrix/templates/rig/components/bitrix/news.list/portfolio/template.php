<?/*if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
			<div class="portfolio-outer">
				<div class="portfolio-inner">
					<ul class="portfolio">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
						<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>" data-element="<?=$arItem['ID']?>">
				    		    <figure>
			    				    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" />
		    					    <span class="title"><span class="fix"></span><span class="text"><?=$arItem["NAME"]?></span></span>
	    						    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?><span class="description"><?=$arItem["PREVIEW_TEXT"]?></span><?endif;?>
    						    </figure>
                            </a>
						</li>
<?endforeach;?>
					</ul>
				</div>
			</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y'):?>
<?
$filter = Array(
    "IBLOCK_ID" => 5,
    "SECTION_CODE" => $GLOBALS["arrFilter"]["SECTION_CODE"],
    "DATE_FROM" => "",
    "DATE_TO" => "",
    "LIMIT" => $arParams["NEWS_COUNT"]
);
$APPLICATION->IncludeComponent("rig:custom.pagenavigation", "", $filter, false);
?>
<?endif;?>

<?
$arSelect = Array('NAME', 'ID', 'DESCRIPTION', DESCRIPTION_TYPE);
$arFilter = Array('IBLOCK_ID'=>'5', 'ACTIVE'=>'Y', 'ID' => $arResult["ITEMS"]["0"]["IBLOCK_SECTION_ID"]);
$res = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect, false); 
while($ar_res = $res->GetNext())
{?>  
	<?if ($ar_res['DESCRIPTION']) {?>
		<section>
			<div class="wrapper">
				<div class="development portfolio_div">
					<?echo $ar_res['DESCRIPTION'];?>
				</div>
			</div>
		</section>
	<?}?>
<?}*/?>

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
			<div class="portfolio-outer">
				<div class="portfolio-inner">
					<ul class="portfolio news-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
						<li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="news-item">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>" data-element="<?=$arItem['ID']?>">
				    		    <figure>
			    				    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" />
		    					    <span class="title"><span class="fix"></span><span class="text"><?=$arItem["NAME"]?></span></span>
	    						    <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?><span class="description"><?=$arItem["PREVIEW_TEXT"]?></span><?endif;?>
    						    </figure>
                            </a>
						</li>
<?endforeach;?>
					</ul>
				</div>
			</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y'):?>
<?
	print $arResult['NAV_STRING'];
?>
<?endif;?>

<?
	if (strpos($_SERVER['REQUEST_URI'],'?')) {
		$requesturl = substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'?'));
	} else {
		$requesturl = $_SERVER['REQUEST_URI'];
	}
?>


<?
if (strlen($requesturl) > 12) {

	$arSelect = Array('NAME', 'ID', 'DESCRIPTION', DESCRIPTION_TYPE);
	$arFilter = Array('IBLOCK_ID'=>'5', 'ACTIVE'=>'Y', 'ID' => $arResult["ITEMS"]["0"]["IBLOCK_SECTION_ID"]);
	$res = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect, false); 
	while($ar_res = $res->GetNext())
	{?>  
		<?if ($ar_res['DESCRIPTION']) {?>
			<section>
				<div class="wrapper">
					<div class="development portfolio_div">
						<?echo $ar_res['DESCRIPTION'];?>
					</div>
				</div>
			</section>
		<?}?>
	<?}?>
	
<?}?>


