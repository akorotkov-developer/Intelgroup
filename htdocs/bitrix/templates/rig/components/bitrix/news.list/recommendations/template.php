<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$media = 1;
if(isset($_REQUEST["ELEMENT"]) && ($_REQUEST["ELEMENT"] != '')) {
    $media = (int)$_REQUEST["ELEMENT"];
}
$i = 0;
$p = 0;
$prev = 0;
$next = 0;
$item = '';
foreach($arResult["ITEMS"] as $arItem) {
    $i++;
    if(($item != '') && ($next == 0)) $next = $arItem["ID"];
    if($arItem["ID"] == $media) {
       $item = '<div class="aleft"><span class="fix"></span><span class="prev"></span></div><div class="aright"><span class="fix"></span><span class="next"></span></div><div class="main"><span class="fix"></span><img src="' . $arItem["DETAIL_PICTURE"]["SRC"] . '" alt="" /></div>';
       $prev = $p;
    }
    $p = $arItem["ID"];
}
$item .= '<div class="vars">' . $prev . ':' . $next . '</div>';
echo $item;
?>