<?php
session_start();

// use php-gettext in case gettext is not already compiled in
include "php-gettext/gettext.inc";

$locale = (!empty($_GET['locale'])) ? $_GET['locale'] : "";

if ( !empty($locale)) {
    $_SESSION['locale'] = $locale;
}


if ( !empty($_SESSION['locale'])) {
    setlocale( LC_ALL, $_SESSION['locale']);
    putenv("LC_ALL=" . $_SESSION['locale']);
    bindtextdomain("messages", dirname(dirname(__FILE__)).'/locale');
    textdomain("messages");
    bind_textdomain_codeset("messages", 'UTF-8');
}


?>