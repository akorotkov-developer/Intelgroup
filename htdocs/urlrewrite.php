<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/service/mobile/projets_view/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "EID=\$1&\$2",
		"PATH" => "/service/mobile/projets_view/detail.php",
	),
	array(
		"CONDITION" => "#^/portfolio/([0-9a-z]+)/page/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "SECTION=\$1&PAGEN_1=\$2&\$3",
		"PATH" => "/portfolio/index.php",
	),
	array(
		"CONDITION" => "#^/portfolio/([0-9a-z]+)/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "SECTION=\$1&ELEMENT=\$2&SHADOW=portfolio&\$3",
		"PATH" => "/portfolio/index.php",
	),
	array(
		"CONDITION" => "#^/portfolio/page/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "PAGEN_1=\$1&\$2",
		"PATH" => "/portfolio/index.php",
	),
	array(
		"CONDITION" => "#^/about/actions/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "EID=\$1&\$2",
		"PATH" => "/about/actions/detail.php",
	),
	array(
		"CONDITION" => "#^/portfolio/([0-9a-z]+)/?\\??(.*)\$#",
		"RULE" => "SECTION=\$1&\$2",
		"PATH" => "/portfolio/index.php",
	),
	array(
		"CONDITION" => "#^/about/news/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "EID=\$1&\$2",
		"PATH" => "/about/news/detail.php",
	),
	array(
		"CONDITION" => "#^(.*)/page/([0-9]+)/?\\??(.*)\$#",
		"RULE" => "PAGEN_1=\$2&\$3",
		"PATH" => "\$1/index.php",
	),
	array(
		"CONDITION" => "#^/request/?\\??(.*)\$#",
		"RULE" => "SHADOW=request&\$1",
		"PATH" => "/index.php",
	),
);

?>