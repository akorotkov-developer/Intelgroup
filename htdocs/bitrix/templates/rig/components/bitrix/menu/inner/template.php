<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult)):?>
    <div class="sub">
		<div class="wrapper">
			<nav>
                <ul class="submenu">
<?
foreach($arResult as $arItem) {
    if($arItem["SELECTED"]) {
        echo '<li class="active"><a href="' . $arItem["LINK"] . '"><span class="fix"></span><span class="text">' . $arItem["TEXT"] . '</span></a></li>';
    } else {
        echo '<li><a href="' . $arItem["LINK"] . '"><span class="fix"></span><span class="text">' . $arItem["TEXT"] . '</span></a></li>';
    }
}
?>
                </ul>
			</nav>
		</div>
	</div>
<?endif;?>