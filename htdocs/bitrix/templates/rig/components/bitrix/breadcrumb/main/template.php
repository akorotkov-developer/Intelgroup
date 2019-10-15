<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult))
	return "";

if($arResult[0]["LINK"] == '/portfolio/') {
    unset($arResult[1]);
    unset($arResult[2]);
    unset($arResult[3]);
    unset($arResult[4]);
    $arResult = array_values($arResult);
};	

$num_items = count($arResult);
$prev = '';
$link = '';
$flag = 0;
$active = 0;



for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++) {
        if($arResult[$index]["LINK"] != $link) { $flag = 1; } else { $flag = 0; };

        if($flag == 1) { $strReturn .= $prev; $active = 0; } else { $active = 1; }

	    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

        $link = $arResult[$index]["LINK"];

    	if(($arResult[$index]["LINK"] <> "") && ($index != ($itemSize - 1))) {
	    	$prev = '<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '">' . $title . '</a> »';
        } else {
            if(isset($_REQUEST["SECTION"]) && ($_REQUEST["SECTION"] != '')) {
                $prev = '<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '">' . $title . '</a> »';
                CModule::IncludeModule("iblock");
                $sectionID = CIBlockFindTools::GetSectionID(false, $_REQUEST["SECTION"], array("IBLOCK_ID" => 5));
                $res = CIBlockSection::GetByID($sectionID);
                if($ar_res = $res->GetNext()) {
                    if($active == 1) {
                        $prev .= '<h2><a href="' . $arResult[$index]["LINK"] . '" title="' . $ar_res['NAME'] . '">' . $ar_res['NAME'] . '</a></h2>';
                    } else {
                        $prev .= '<h2>' . $ar_res['NAME'] . '</h2>';
                    }
                }

            } else {
                if($active == 1) {
        	    	$prev = '<h2><a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '">' . $title . '</a></h2>';
                } else {
            		$prev = '<h2>' . $title . '</h2>';
                }
            }
        }
}
$strReturn .= $prev;

$strReturn = '<a href="/" title="Главная">Главная</a> »' . $strReturn;

return $strReturn;
?>