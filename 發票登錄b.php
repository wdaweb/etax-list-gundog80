
<?php
include_once "invoiceBasic.php";
if(!empty($_GET) && ( $_GET['a']==999 || $_GET['a']==998 )){
	// 由標籤登錄回來，不重設session

}else{

	
	unset($_SESSION['發票號碼a']);
	unset($_SESSION['發票號碼b']);
	unset($_SESSION['期數']);
	unset($_SESSION['消費日期']);
	unset($_SESSION['消費金額']);
	unset($_SESSION['其它']);

	
	$_SESSION['發票號碼a']=strtoupper(trim($_POST['發票號碼a']));
	$_SESSION['發票號碼b']=trim($_POST['發票號碼b']);
	$_SESSION['期數']=trim($_POST['期數']);
	$_SESSION['消費日期']=trim($_POST['消費日期']);
	$_SESSION['消費金額']=trim($_POST['消費金額']);
	$_SESSION['標籤設定']=trim($_POST['標籤設定']);
	$_SESSION['其它']=trim($_POST['其它']);

	
}
$發票號碼a=$_SESSION['發票號碼a'];
$發票號碼b=$_SESSION['發票號碼b'];
$期數=$_SESSION['期數'];
$消費日期=$_SESSION['消費日期'];
$消費金額=$_SESSION['消費金額'];
$標籤設定=$_SESSION['標籤設定'];
$其它=$_SESSION['其它'];

$發票號碼= $發票號碼a . $發票號碼b;
$temp=check($發票號碼,"記帳表","V_number");

if($temp[0]!=0){
	echo "<br>";
	echo "資料庫中已有發票號碼為 $發票號碼 的資料，請確認是否輸入錯誤，或由 記帳表 功能中進行修改 ";
	echo "<br>";
	echo "<a href='發票登錄a.php?a=1'>回發票登錄頁面</a>";
	echo "<br>";
	exit;
}else{
	// echo "通過重覆號碼檢驗 <br>";
}
echo $標籤設定;
$target=explode("#",$標籤設定);
// print_r($target);
echo "<br>";
for($i=1;$i<=sizeof($target);$i++){
	$temp=check($target[$i],"標籤集","targetName");
	if($temp[0]==0){
		if(!empty($_GET) && $_GET['a']==998){
			// echo "newTarget=" . $target[$i];
			$temp=$target[$i];
			$sql="INSERT INTO `標籤集` () values ('','$temp')";
			$insert=$db->exec($sql);
			if($insert==1){
				echo "登錄標籤" . $target[$i] . "成功";
			}else{
				echo "登錄標籤" . $target[$i] . "失敗";
			}
			header("location:發票登錄b.php?a=999");
			exit;
		}

		echo "發現新標籤" . $target[$i] . "，是否登錄新標籤?";
		echo "<br>";
		echo "<a href='發票登錄b.php?a=998'>是，請登錄新標籤</a>";
		echo "&ensp; &ensp; &ensp;";
		echo "<a href='發票登錄a.php?a=1&'>否，讓我重填</a>";
		exit;
	}else{
	}
}
		$sql="INSERT INTO `記帳表` () VALUES ('','$發票號碼','$期數','$消費日期','$消費金額','$標籤設定','$其它')";
		// echo $sql;
		// exit;


		$insert=$db->exec($sql);
		if($insert){
			header("location:發票登錄a.php?a=2&b=$發票號碼");
		}
		// $sql="INSERT INTO `記帳表` () VALUES ('','$發票號碼','$期數','$消費金額','$消費日期','$標籤設定','$其它')";
		// $insert=$db->exec($sql);
		// echo $sql;


?>

