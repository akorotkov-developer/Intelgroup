<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$currentDir = $APPLICATION->GetCurDir();
$currentSite = $APPLICATION->GetSiteByDir($currentDir, $_SERVER["HTTP_HOST"]);
$currentSiteDir = $currentSite["DIR"];
$currentPage = $APPLICATION->GetCurPage();
$isHomePage = ($currentSiteDir == $currentDir) && (($currentPage == $currentDir) || ($currentPage == ($currentDir . 'index.php')));
?>
</div>
	</div>
</section>

<?if($isHomePage):?>
<section>
	<div class="more">
		<div class="wrapper">
            <div class="clr">
<?$APPLICATION->IncludeComponent("bitrix:news.list", "news", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "1",
        "NEWS_COUNT" => "3",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "FILTER_NAME" => "arrFilter",
        "FIELD_CODE" => Array(""),
        "PROPERTY_CODE" => Array(""),
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
<?$APPLICATION->IncludeComponent("bitrix:news.list", "team", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "team",
        "IBLOCK_ID" => "9",
        "NEWS_COUNT" => "100",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arrFilter",
        "FIELD_CODE" => Array(""),
        "PROPERTY_CODE" => Array(""),
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
            </div>
        </div>
    </div>
</section>


<section>
	
		<div class="more">
			<div class="wrapper">
				<div class="development">
					<h1>Разработка сайтов на 1с-Битрикс</h1>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/development.php",
						"EDIT_TEMPLATE" => ""
							), false
					);?>
					 <div class="sub sub_index">
						<div class="wrapper">
							<nav>
								<ul class="submenu">
									<li><a onClick="$('#sendus').trigger('click');" style="cursor: pointer;"><span class="fix"></span><span class="text">Заказать сайт</span></a></li>
									
									<li><a href="/service/support/technical/"><span class="fix"></span><span class="text">Техническая поддержка сайта</span></a></li>
									
									<li><a onClick="$('#sendus').trigger('click');" style="cursor: pointer;"><span class="fix"></span><span class="text">Купить Битрикс</span></a></li>       
								</ul>
							</nav>
						</div>
					 </div>
				</div>
			</div>
		</div>
    
</section>

<?endif;?>

<footer>
	<div class="footer">
		<div class="wrapper">
			<ul class="tooltips">
				<li>
					<a href="http://www.facebook.com/rusintelgroup"><span class="facebook"></span><span>Наша страница на Facebook</span></a>
				</li>
				<li>
					<a href="http://www.intelgroup.ru/bitrix/rss.php"><span class="rss"></span><span>RSS-лента</span></a>
				</li>
				<!-- <li>
					<a href=""><span class="english"></span><span>English version</span></a>
				</li> -->
			</ul>
			<div class="copyright">Intelgroup © 2005-<?php echo date("Y"); ?></div>
		</div>
	</div>
</footer>
</div>
</div>
<?
$class = '';
if(isset($_REQUEST["SHADOW"]) && ($_REQUEST["SHADOW"] != '')) { $class = ' class="' . $_REQUEST["SHADOW"] . '"'; }
?>
<div id="shadow"<?=$class?>>
    <div id="popup">
<?if($_REQUEST["SHADOW"] == 'portfolio'):?>
        <div class="area">
<?$APPLICATION->IncludeComponent("bitrix:news.detail", "portfolio", Array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "portfolio",
        "IBLOCK_ID" => "5",
        "ELEMENT_ID" => $_REQUEST["ELEMENT"],
        "ELEMENT_CODE" => "",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => Array(""),
        "PROPERTY_CODE" => Array("GALLERY", "BG"),
        "IBLOCK_URL" => "",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
    )
);?>
        </div>
<?endif;?>
    </div>
    <div class="close"></div>
    <div id="loading" class="loading"></div>
</div>

<div id="sendus">Обратная связь</div>

<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter23076178 = new Ya.Metrika({id:23076178, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/23076178" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-45879768-1', 'intelgroup.ru');
  ga('send', 'pageview');
</script>

</body>
</html>
