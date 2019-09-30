<?php
  session_start();
  unset($_SESSION['LOGIN']);
  unset($_SESSION['msgsuccess']);
  unset($_SESSION['who']);
  header('Location:index.php');
  return;
?>
