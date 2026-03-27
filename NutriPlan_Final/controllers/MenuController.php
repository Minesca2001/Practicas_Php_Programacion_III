<?php
session_start();
require_once "../config/auth.php";
// Redirect to the menu view directly (menu is now loaded via JS/API)
header("Location: ../views/menu.php");
exit();
