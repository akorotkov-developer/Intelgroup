<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//IncludeTemplateLangFile(__FILE__);
$currentDir = $APPLICATION->GetCurDir();
$currentSite = $APPLICATION->GetSiteByDir($currentDir, $_SERVER["HTTP_HOST"]);
$currentSiteDir = $currentSite["DIR"];
$currentPage = $APPLICATION->GetCurPage();
$isHomePage = ($currentSiteDir == $currentDir) && (($currentPage == $currentDir) || ($currentPage == ($currentDir . 'index.php')));
$cls = '';
if($isHomePage) $cls = ' main';
if(substr($currentDir, 0, strlen('/contacts/')) == '/contacts/') $cls = ' contacts';

$isShowTitle = 1;
if($isHomePage) $isShowTitle = 0;

$notitle = Array(
    '/service/',
    '/portfolio/',
    '/contacts/',
    '/about/'
);

$yestitle = Array(
    '/\/service\/mobile\/projets_view\/([0-9]+)\//',
    '/\/about\/news\/([0-9]+)\//',
    '/\/about\/actions\/([0-9]+)\//'
);

foreach($notitle as $ppath) {
    if(substr($currentDir, 0, strlen($ppath)) == $ppath) $isShowTitle = 0;
}
foreach($yestitle as $ppath) {
    if(preg_match($ppath, $currentPage)) $isShowTitle = 1;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?$APPLICATION->ShowHead();?>
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.cfe.css" />
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/styles.css" />
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/mq.genie.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.cfe.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>
	<title><?$APPLICATION->ShowTitle(false)?></title>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="container-outer">
<div id="container-inner">
<header>
	<div class="header">
		<div class="wrapper">
			<div class="logo">
				<?if(!$isHomePage):?><a href="/"><?endif;?><img src="<?=SITE_TEMPLATE_PATH?>/images/rig.png" alt="Russian Intellectual Group" /><?if(!$isHomePage):?></a><?endif;?>
			</div>
			<nav>
                <div class="button"><span class="fix"></span><span class="text">Меню</span></div>
<?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
        "ROOT_MENU_TYPE" => "top", 
        "MAX_LEVEL" => "3", 
        "CHILD_MENU_TYPE" => "inner", 
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N", 
        "MENU_CACHE_TIME" => "3600", 
        "MENU_CACHE_USE_GROUPS" => "Y", 
        "MENU_CACHE_GET_VARS" => "" 
    )
);?>
            </nav>
		</div>
	</div>
	<div class="path<?=$cls?>">
		<div class="wrapper">
<?if($isHomePage):?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "slider", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "slider",
        "IBLOCK_ID" => "7",
        "NEWS_COUNT" => "100",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "FILTER_NAME" => "arrFilter",
        "FIELD_CODE" => Array("DETAIL_PICTURE"),
        "PROPERTY_CODE" => Array("LINK"),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
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
<?else:?>
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(
        "START_FROM" => "1", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);?>
<?endif;?>
        </div>
	</div>
<?$APPLICATION->IncludeComponent("bitrix:menu", "inner", Array(
        "ROOT_MENU_TYPE" => "inner", 
        "MAX_LEVEL" => "1", 
        "CHILD_MENU_TYPE" => "", 
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N", 
        "MENU_CACHE_TIME" => "3600", 
        "MENU_CACHE_USE_GROUPS" => "Y", 
        "MENU_CACHE_GET_VARS" => "" 
    )
);?>
</header>

<section>
	<div class="content<?=$cls?>">
		<div class="wrapper">
            <?if($isShowTitle == 1):?><h1><?$APPLICATION->ShowTitle()?></h1><?endif;?>