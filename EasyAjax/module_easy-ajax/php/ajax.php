<?php
	require "../../config.php";

	/** @var $CONF_NAMES  */
	/** @var $CONF_EMAILS */

	$id = $_POST["id"];

	foreach ($CONF_NAMES[$id] as $field) {
		if ( $field == "id" ) {
			print( "============= ID ${id} =============<br>" );
		}
		else {
			print($field.": ".$_POST[$field]."<br>");
		}
	}

	print( "================================<br>" );


	$headers = <<<HEADERS
	MIME-Version: 1.0
	Content-type: text/html; charset=utf-8
	From: Pixel <info@pixel27.ru>
	X-Mailer: PHP/7.4.14
	HEADERS;


	$variables = [];

	$variables['title']       = "Codeoon Automatic Email";
	$variables['preheader']   = "Штатное техническое сообщение | ";
	$variables['message']     = "Новый заказ однако прибыл наверное";
	$variables['footer_from'] = "Sincerely from Develop";
	$variables['footer_by']   = "Created by Codeoon";


	$template = file_get_contents("template.html");

	foreach($variables as $key => $value) {
		$template = str_replace('{{ '.$key.' }}', $value, $template);
	}


	foreach ($CONF_EMAILS as $email) {
		echo mail( $email, "Pixel Info | Тестовое", $template, $headers );
	}
