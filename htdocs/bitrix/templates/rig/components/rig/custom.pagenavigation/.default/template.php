<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo '<div class="pager">';

for($i = 0; $i < count($arResult); $i++) {
    if($arResult[$i]['PREV'] == 1) {
        echo '<a href="' . $arResult[$i]['LINK'] . '" class="pagerarrow pageraleft"></a>';
    }
    elseif($arResult[$i]['NEXT'] == 1) {
        echo '<a href="' . $arResult[$i]['LINK'] . '" class="pagerarrow pageraright"></a>';
    }
    elseif($arResult[$i]['LINK'] != '') {
        echo '<a href="' . $arResult[$i]['LINK'] . '">' . $arResult[$i]['TEXT'] . '</a>';
    }
    else {
        echo '<span class="current">' . $arResult[$i]['TEXT'] . '</span>';
    }
}

echo '</div>';

?>