<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->SetTitle($arResult["NAME"]);?>
        <div class="media"<?if($arResult["PROPERTIES"]["BG"]["VALUE"] != '') echo ' style="background-color: #' . $arResult["PROPERTIES"]["BG"]["VALUE"] . '"';?>>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "media", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "portfolio",
        "IBLOCK_ID" => "6",
        "NEWS_COUNT" => "1000",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "DATE_CREATE",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array(""),
        "PROPERTY_CODE" => Array("VIDEO"),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => $arResult["PROPERTIES"]["GALLERY"]["VALUE"],
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    )
);?>
<?
$code = 'f2f2f2';
if($arResult["PROPERTIES"]["BG"]["VALUE"] != '') $code = $arResult["PROPERTIES"]["BG"]["VALUE"];
if(isset($arResult["PREV"])) { $code .= ':' . $arResult["PREV"]["ID"];  } else { $code .= ':0'; }
if(isset($arResult["PREV"]["GALLERY"])) { $code .= ':' . $arResult["PREV"]["GALLERY"];  } else { $code .= ':0'; }
if(isset($arResult["PREV"]["BG"]) && ($arResult["PREV"]["BG"] != '')) { $code .= ':' . $arResult["PREV"]["BG"];  } else { $code .= ':'; }
if(isset($arResult["NEXT"])) { $code .= ':' . $arResult["NEXT"]["ID"];  } else { $code .= ':0'; }
if(isset($arResult["NEXT"]["GALLERY"])) { $code .= ':' . $arResult["NEXT"]["GALLERY"];  } else { $code .= ':0'; }
if(isset($arResult["NEXT"]["BG"]) && ($arResult["NEXT"]["BG"] != '')) { $code .= ':' . $arResult["NEXT"]["BG"];  } else { $code .= ':'; }
?>
        </div>
        <div class="vars"><?=$code?></div>
        <div class="navigation"></div>
        <div class="about"><div class="prev"></div><div class="next"></div><div class="fix"></div><p><span class="title"><span class="fix"></span><span class="text"><?=$arResult["NAME"]?></span></span><?if(isset($arResult["DETAIL_TEXT"]) && (strlen($arResult["DETAIL_TEXT"]) > 0)):?><span class="description"><?=$arResult["DETAIL_TEXT"]?></span><?endif;?></p></div>