<?
$arSort = Array(
    "SORT" => "DESC",
    "DATE_CREATE" => "DESC"
);

$arSelect = Array(
    "ID",
    "PROPERTY_GALLERY",
    "PROPERTY_BG"
);

$arFilter = Array (
    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y"
);

$arFilter["SECTION_ID"] = $arResult["IBLOCK_SECTION_ID"];

$arNavParams = Array(
    "nPageSize" => 1,
    "nElementID" => $arResult["ID"]
);

$arItems = Array();

$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);

while($obElement = $rsElement->GetNextElement())
    $arItems[] = $obElement->GetFields();

if(count($arItems) == 3) {
    $arResult["PREV"] = Array("ID" => $arItems[0]["ID"], "GALLERY" => $arItems[0]["PROPERTY_GALLERY_VALUE"], "BG" => $arItems[0]["PROPERTY_BG_VALUE"]);
    $arResult["NEXT"] = Array("ID" => $arItems[2]["ID"], "GALLERY" => $arItems[2]["PROPERTY_GALLERY_VALUE"], "BG" => $arItems[2]["PROPERTY_BG_VALUE"]);
} elseif(count($arItems) == 2) {
    if($arItems[0]["ID"] != $arResult["ID"]) {
        $arResult["PREV"] = Array("ID" => $arItems[0]["ID"], "GALLERY" => $arItems[0]["PROPERTY_GALLERY_VALUE"], "BG" => $arItems[0]["PROPERTY_BG_VALUE"]);
    } else {
        $arResult["NEXT"] = Array("ID" => $arItems[1]["ID"], "GALLERY" => $arItems[1]["PROPERTY_GALLERY_VALUE"], "BG" => $arItems[1]["PROPERTY_BG_VALUE"]);
    }
}
