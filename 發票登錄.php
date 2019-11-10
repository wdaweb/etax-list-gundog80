<?php
$dns="mysql:host=localhost;charset=utf8;dbname=發票對獎"
$pdo=new PDO(dns,'root','1234');

$發票號碼a=$_SESSION['發票號碼a'];
$發票號碼b=$_SESSION['發票號碼b'];
$期數=$_SESSION['期數'];
$消費日期=$_SESSION['消費日期'];
$消費金額=$_SESSION['消費金額'];
$標籤設定=$_SESSION['標籤設定'];
$其它=$_SESSION['其它'];

$發票號碼=$發票號碼a .$發票號碼b;
$sql="SELECT * From `發票` where `發票號碼`=$發票號碼"
$check=query($sql);  
if(!empty){
    echo "資料庫中已有ID為 $發票號碼 的資料，請確認是否輸入錯誤，或由 記帳表 功能中進行修改 "
}
?>