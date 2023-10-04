<?php

session_start();

///*
unset($_SESSION['tokens']);
unset($_SESSION['target']);
//*/

if (!isset($_SESSION['tokens']) || !isset($_SESSION['target'])) {
    $_SESSION['tokens'] = [];
    $_SESSION['target'] = 'listContent.php';
    $_SESSION['backspace'] = [];
}

$template = $_SESSION['target'];
if (!file_exists("template/$template") || ($template == '')) {
    echo "<br>";
    echo "***** LA PAGE [$template] N'EXISTE PAS *****<br>";
    exit;
} else {
    if (count($_SESSION['backspace'])!=0) {
        if ($_SESSION['backspace'][count($_SESSION['backspace'])-1] != $template) {
            array_push($_SESSION['backspace'], $template);
        }
    } elseif ($template != 'listContent.php') {
        array_push($_SESSION['backspace'], $template);
    }
    require_once "template/$template";
}
