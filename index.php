<?php

session_start();

if (!isset($_SESSION['tokens'])) {
    $_SESSION['tokens'] = [];
}

require_once 'template/listContent.php';