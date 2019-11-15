<?php include_once "invoiceBasic.php" ?>
<?php

Function createOneV_number () {
	global $dns;
	global $db;
	$V_numberA=['AA','BB','CC','DD','EE'];
	$target=["#d","#a#b","#a#c","#a#b#d",""];
	$temp=random_int(0,4);
	$發票號碼a=$V_numberA[$temp];
	$temp=random_int(00000001,99999999);
	$發票號碼b=$temp;
	$today=strtotime("now");
	$strday=strtotime("-6 month",$today);
	$randomTime=random_int($strday,$today);
	$temp=date('Y-m-d',$randomTime);
	$消費日期=$temp;	
	$temp=getPeriod($randomTime);
	$期數=$temp;
	$temp=random_int(20,500);
	$消費金額=$temp;
	$temp=random_int(0,4);
	$標籤設定=$target[$temp];
	$其它="";

	$發票號碼=$發票號碼a . $發票號碼b;
	$sql="INSERT INTO `記帳表` () VALUES ('','$發票號碼','$期數','$消費日期','$消費金額','$標籤設定','$其它')";
	// echo $sql;
	// echo $dns;
	$db->exec($sql);
}


?>

<form action="發票產生器.php" method="get">
產生<input width="3" type="text" name="a" id="">組發票
<br>
<input type="submit" value="產生發票">
</form>
<?php
if (!empty($_GET) && !empty($_GET['a'])){
	for($i=0;$i<$_GET['a'];$i++){
		createOneV_number();
	}
	echo "已產生" . $_GET['a'] . "組發票";

}

?>



