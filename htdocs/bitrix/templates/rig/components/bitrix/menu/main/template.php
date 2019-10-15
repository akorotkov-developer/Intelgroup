<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<ul class="menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):
?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
    <?
    $class = '';
    if ($arItem["SELECTED"]) {
        $class = ' class="active"';
    }
    ?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li<?=$class?>>
							<span class="icon"></span><span class="fix"></span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <div class="up"></div>
                            <ul>
    	<?else:?>
                        <li<?=$class?>>
							<span class="icon"></span><span class="fix"></span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <ul>
        <?endif;?>
	<?else:?>
                        <li<?=$class?>>
							<span class="fix"></span><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        </li>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul>
<?endif?>