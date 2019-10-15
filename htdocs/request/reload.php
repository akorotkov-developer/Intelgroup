<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$captcha_sid = $APPLICATION->CaptchaGetCode();
$captcha_img = '/bitrix/tools/captcha.php?captcha_sid=' . $captcha_sid;
echo '{"sid": "' . $captcha_sid . '","img": "' . $captcha_img . '"}';
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>