<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$captcha_sid = $APPLICATION->CaptchaGetCode();
$captcha_img = '/bitrix/tools/captcha.php?captcha_sid=' . $captcha_sid;

echo '<form action="" id="form-feedback" method="post">
<div class="cols">
<div class="col">

    <div class="field">
        <div class="label">Тема заявки</div>
	    <div class="data">
			<select id="feedbacksubject" name="subject">
				<option value="">Выберите тему заявки</option>
				<option value="Запрос коммерческого предложения">Запрос коммерческого предложения на услуги</option>
				<option value="Разработка мобильных приложений">Разработка мобильных приложений</option>
				<option value="Графический дизайн, иллюстрирование">Графический дизайн, иллюстрирование</option>
				<option value="Разработка и продвижение сайтов">Разработка и продвижение сайтов</option>
				<option value="Другое">Другое</option>
			</select>
		</div>
    </div>

    <div class="field">
        <div class="label">Текст заявки</div>
        <div class="data">
            <textarea id="feedbackmessage" name="message" rows="8"></textarea>
        </div>
    </div>

    <div class="field">
		<div class="data agree">
			<input id="feedbackagree"  name="agree" type="checkbox" value="1" checked="checked" />
            <span>Согласен(на) с обработкой моих персональных данных</span>
		</div>
    </div>

</div>
<div class="col">

    <div class="field">
        <div class="label">Ваш email</div>
        <div class="data">
            <input type="text" id="feedbackemail" name="email" value="" />
        </div>
    </div>

    <div class="field">
        <div class="label">Ваш контактный телефон</div>
        <div class="data">
            <input type="text" id="feedbackphone" name="phone" value="" />
        </div>
    </div>

    <div class="field">
        <div class="label">Введите символы с картинки</div>
        <div class="data captcha">
            <input type="text" id="feedbackcaptcha" name="captcha_code" value="" maxlength="5" />
            <div class="clr"><img id="feedbackcaptchaimage" src="' . $captcha_img . '" alt="CAPTCHA" /><img id="feedbackcaptchaimagerefresh" src="/bitrix/templates/rig/images/feedback-captcharefresh.png" title="Обновить картинку" alt="" /></div>
            <input type="hidden" id="feedbackcaptchasid" name="captcha_sid" value="' . $captcha_sid . '" />
        </div>
    </div>

    <div class="field">
    	<div class="data submit">
            <input type="submit" name="submit" value="Отправить" />
		    <input type="hidden" name="action" value="feedback" />
    		' . bitrix_sessid_post() . '
            <div id="submitwait"></div>
	    </div>
    </div>

</div>
<div id="feedbackstatus"></div>
</div>
</form>';
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>