<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $msg = '';
    $status = '0';

    $msgs = Array();

    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $msgs[] = 'введите правильный email';
    }
    
    if(($_POST["phone"] == '') || preg_match('/[^0-9\-\(\)\+ ]+/', $_POST["phone"])) {
        $msgs[] = 'введите правильный телефон';
    }

    if($_POST["subject"] == '') {
        $msgs[] = 'выберите тему заявки';
    }

    if($_POST["message"] == '') {
        $msgs[] = 'выберите текст заявки';
    }

    if($_POST["captcha_code"] != '') {
        if(!$APPLICATION->CaptchaCheckCode($_POST["captcha_code"], $_POST["captcha_sid"]) ) {
          $msgs[] = 'введите правильный код с картинки';
        }
    } else {
        $msgs[] = 'введите код с картинки';
    }

    if(count($msgs) == 0) {

        $status = '1';
        $msg = 'Ваша заявка отправлена.';

        $msubj = mb_convert_encoding("Обратная связь", "windows-1251", "utf-8");

        //$mmsg = mb_convert_encoding("<html><body><strong>E-mail: </strong>" . $_POST["email"] . "<br /><strong>Телефон: </strong>" . $_POST["phone"] . "<br /><strong>Тема:</strong><br />" . $_POST["subject"] . "<br /><strong>Сообщение:</strong><br />" . nl2br($_POST["message"], true) . "</body></html>", "windows-1251", "utf-8");
        $mmsg = "E-mail: " . $_POST["email"] . "\n Телефон: " . $_POST["phone"] . "\n Тема: " . $_POST["subject"] . "\n Сообщение: " . $_POST["message"] ;

        $mheaders  = "Content-type: text/html; charset=windows-1251\r\n";
        $mheaders .= "From: Robot <robot@intelgroup.ru>\r\n"; 

        //mail("ivanov_artem@mail.ru, info@intelgroup.ru, mcy59509@bcaoo.com", $msubj, $mmsg, $mheaders);
        mail("ivanov_artem@mail.ru, info@intelgroup.ru", "Сообщение с формы обратная связи", $mmsg);

    } else {

        $status = '0';
        $all = implode(", ", $msgs);

        $fc = mb_strtoupper(mb_substr($all, 0, 1));
        $msg = $fc . mb_substr($all, 1);

    }

    echo '{"status": "' . $status . '","msg":"' . $msg . '"}';
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>