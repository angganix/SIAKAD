<?php
session_name("siakad");
session_start();


if(!isset($_SESSION['username'])){
	header("location:index.php");
}else{
	session_destroy();
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['fullname']);
	unset($_SESSION['akses_role']);
	header("location:index.php");
}