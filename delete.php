<?php 
require "connect.php";
$id = $_GET["id"];
$sql = "DELETE FROM sanpham WHERE `sanpham`.`id` = $id";
$connect->exec($sql);
header("location:list.php");
?>