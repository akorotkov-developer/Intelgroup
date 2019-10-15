<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

	if ($arResult["ITEMS"][0]["IBLOCK_SECTION_ID"]) {
		$arFilter = array('IBLOCK_ID' => 5, 'ID' => $arResult["ITEMS"][0]["IBLOCK_SECTION_ID"]);
		$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
		while ($arSection = $rsSections->Fetch())
		{
			$section_name = $arSection['NAME'];
		}
	}

	$arResult["SECTION_NAME"] = $section_name;
	
		
	$page = $APPLICATION->GetCurPage();
	$pos = strpos($page, "magazines");
	
	
	if (!$pos and $arResult["SECTION_NAME"] == "Электронные версии изданий") {} else {
		$APPLICATION->SetTitle($section_name);	
	}

	
