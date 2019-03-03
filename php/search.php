<?php
session_start();
$search = $_POST['search'] ?? '1'; //PHP 7.0
$_SESSION['search'] = $search;
header('Location: searchResult.php');
