<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 07/03/2018
 * Time: 14:25
 */
require "2FA4Users.php";

$date = $_SESSION[SESSION_ARRAY_USER_INFO]['connection_date'];
echo "Utilisateur actuellement connecté : ".$_SESSION[SESSION_ARRAY_USER_INFO]['user_id']."\n";
echo "<br />";
echo "Adresse ip utilisée : ".$_SESSION[SESSION_ARRAY_USER_INFO]['ipv4']."\n";
echo "<br />";
echo "Vous vous etes connecté le ".date('d-m-Y', $date) . ", a ". date('G:i', $date ) ."\n";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="dist/milligram">
    <style type="text/css">
           a{font-weight: bold; color: #9b4dca}
    </style>
    <title>Tableau de bord</title>
    <a href="index.php?change_password">Changer mot de passe</a>
    <a href="index.php?disconnect">Deconnexion</a>

</head>
</html>