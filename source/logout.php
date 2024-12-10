<?php
ob_start();
session_start();
unset($_SESSION['login_id']);
unset($_SESSION['name']);
unset($_SESSION['role']);
echo '<script type="text/javascript">window.location="/home"; </script>';


?>