<?php
session_start();
include'classes/class.login.php';
include'classes/class.VerifyLoggedIn.php';
include'classes/func.logout.php';
include'classes/class.changepass.php';
logout();
onlineChecker();
ob_start();
?>
<!DOCTYPE html><html class="animations fluid top-full menuh-top"><head><title>Gledco Administrator</title><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" /><link rel="stylesheet" href="../assets/css/pages/module.admin.page.index.min.css" /></head>