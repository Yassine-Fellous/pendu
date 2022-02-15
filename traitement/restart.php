<?php
session_start();
unset($_SESSION['mot']);
unset($_SESSION['true']);
unset($_SESSION['false']);
unset($_SESSION['played']);
header('Location:../index.php?etat=jouer');
?>