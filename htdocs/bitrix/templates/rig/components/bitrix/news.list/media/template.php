<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"] as $arItem) {
    if(isset($arItem["PROPERTIES"]["VIDEO"]["VALUE"]) && ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != '')) {
        $file = CFile::GetPath($arItem["PROPERTIES"]["VIDEO"]["VALUE"]);
?>
<div class="item"><div class="video">
<?$APPLICATION->IncludeComponent("bitrix:player","",Array(
    "PLAYER_TYPE" => "auto",
    "USE_PLAYLIST" => "N",
    "PATH" => $file,
    "PLAYLIST_DIALOG" => "",
    "PROVIDER" => "video",
    "STREAMER" => "",
    "WIDTH" => "480",
    "HEIGHT" => "400",
    "PREVIEW" => $arItem["PREVIEW_PICTURE"]["SRC"],
    "FILE_TITLE" => $arItem['NAME'],
    "FILE_DURATION" => "",
    "FILE_AUTHOR" => "",
    "FILE_DATE" => "",
    "FILE_DESCRIPTION" => "",
    "SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
    "SKIN" => "bitrix.swf",
    "CONTROLBAR" => "bottom",
    "WMODE" => "transparent",
    "PLAYLIST" => "right",
    "PLAYLIST_SIZE" => "180",
    "LOGO" => "",
    "LOGO_LINK" => "",
    "LOGO_POSITION" => "bottom-left",
    "PLUGINS" => array("tweetit-1", "fbit-1"),
    "PLUGINS_TWEETIT-1" => "tweetit.link=",
    "PLUGINS_FBIT-1" => "fbit.link=",
    "ADDITIONAL_FLASHVARS" => "",
    "WMODE_WMV" => "window",
    "SHOW_CONTROLS" => "Y",
    "PLAYLIST_TYPE" => "xspf",
    "PLAYLIST_PREVIEW_WIDTH" => "64",
    "PLAYLIST_PREVIEW_HEIGHT" => "48",
    "SHOW_DIGITS" => "Y",
    "CONTROLS_BGCOLOR" => "FFFFFF",
    "CONTROLS_COLOR" => "000000",
    "CONTROLS_OVER_COLOR" => "000000",
    "SCREEN_COLOR" => "000000",
    "AUTOSTART" => "N",
    "REPEAT" => "none",
    "VOLUME" => "90",
    "MUTE" => "N",
    "HIGH_QUALITY" => "Y",
    "SHUFFLE" => "N",
    "START_ITEM" => "1",
    "ADVANCED_MODE_SETTINGS" => "Y",
    "PLAYER_ID" => "",
    "BUFFER_LENGTH" => "10",
    "DOWNLOAD_LINK" => $file,
    "DOWNLOAD_LINK_TARGET" => "_self",
    "ADDITIONAL_WMVVARS" => "",
    "ALLOW_SWF" => "Y",
  	)
);?>
<span class="fix"></span></div></div>
<?
    } else {
        echo '<div class="item loading"><img src="' . $arItem["PREVIEW_PICTURE"]["SRC"] . '" alt="" /><span class="fix"></span></div>';
    }
}
?>