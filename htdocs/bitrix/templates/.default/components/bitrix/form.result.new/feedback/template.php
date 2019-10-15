<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y") 
{
?>
<?=$arResult["FORM_HEADER"]?>


<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") 
{ 
?>
	<?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"]) 
{
?>
	
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		
	<? 
} // endif 
	?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
 <fieldset>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	?>
	
	<label class="name">
                            <span class="formtext"><?=$arQuestion["CAPTION"]?>:</span>
                            <?=$arQuestion["HTML_CODE"]?>
                            
                        </label>
	
		
	<? 
	} //endwhile 
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
	<p><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></p>
		<p><input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" />
		</p>
		<p><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></p>
			<p><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></p>
<?
} // isUseCaptcha
?>
	
<div class="buttons"><span>
<input type="submit" class="button" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>"/> 

</span></div>

				
				<?if ($arResult["F_RIGHT"] >= 15):?>
				<input type="hidden" name="web_form_apply" value="Y" />
				<?endif;?>
				
				
				
			 </fieldset>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>