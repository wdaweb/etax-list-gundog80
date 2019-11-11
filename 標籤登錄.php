<?php 
session_start(); 
$dns= "mysql:host=localhost;charset=utf8;dbname=invoice";

$db=new PDO($dns,'root','1234');
$temp=$_GET['name'];

$sql="INSERT INTO `標籤集` () values ('','$temp')";
$insert=$db->exec($sql);
header("location:發票登錄b.php?a=999");

?>