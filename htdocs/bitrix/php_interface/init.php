<?
/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
	//code
}
*/
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error(){
 if (defined('ERROR_404') && ERROR_404 == 'Y') {
 global $APPLICATION;
 $APPLICATION->RestartBuffer();
 include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
 include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
 include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
 }
}
?>