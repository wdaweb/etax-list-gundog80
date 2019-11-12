<?php session_start(); 
if(!empty($_GET)&&$_GET['a']=999){
	echo "理論上session存在，會繼續執行發票登錄";
}else{
	session_destroy();
}
$dns="mysql:host=localhost;charset=utf8;dbname=invoice";
$db=new PDO($dns,'root','');

$_SESSION['0']=$_POST['發票號碼a'];
$_SESSION['1']=$_POST['發票號碼b'];
$_SESSION['2']=$_POST['期數'];
$_SESSION['3']=$_POST['消費日期'];
$_SESSION['4']=$_POST['消費金額'];
$_SESSION['5']=$_POST['標籤設定'];
$_SESSION['6']=$_POST['其它'];

$發票號碼a=$_POST['發票號碼a'];
$發票號碼b=$_POST['發票號碼b'];
$期數=$_POST['期數'];
$消費日期=$_POST['消費日期'];
$消費金額=$_POST['消費金額'];
$標籤設定=$_POST['標籤設定'];
$其它=$_POST['其它'];
// $_SESSION[0]=$發票號碼a;
// $_SESSION[1]=$_POST['發票號碼b'];
// $_SESSION[2]=$_POST['期數'];
// $_SESSION['消費日期']=$_POST['消費日期'];
// $_SESSION['消費金額']=$_POST['消費金額'];
// $_SESSION['標籤設定']=$_POST['標籤設定'];
// $_SESSION['其它']=$_POST['其它'];



$發票號碼=$發票號碼a .$發票號碼b;
Function check($vaule,$table,$cell){
	global $db;
	$sql="SELECT count(*) From `$table` where `$cell`='$vaule'";
	$temp=$db->query($sql)->fetch();  
	return $temp;
}
$temp=check($發票號碼,"記帳表","V_number");
print_r($temp);
if($temp[0]!=0){
// if(!empty($temp)){
	// print_r($temp) ;
	echo "<br>";
		echo "資料庫中已有發票號碼為 $發票號碼 的資料，請確認是否輸入錯誤，或由 記帳表 功能中進行修改 ";
		echo "<br>";
		echo "<a href='發票登錄a.php?a=1'>回發票登錄頁面</a>";
		echo "<br>";
		echo "34-";
		// print_r($_SESSION);
		// header("location:發票登錄a.php?aaa=aaaaa",11);
		exit;
}else{
	echo "通過重覆號碼檢驗 <br>";
}

$target=explode("#",$標籤設定);
print_r($target);
echo "<br>";
echo sizeof($target);
for($i=0;$i<sizeof($target);$i++){
	$temp=check($target[$i],"標籤集","targetName");
	if($temp[0]==0){
		echo "發現新標籤" . $target[$i] . "，是否登錄新標籤?";
		echo "<br>";
		echo "<a href='標籤登錄.php?name=$targetName'>是，請登錄新標籤</a>";
		echo "&ensp; &ensp; &ensp;";
		echo "<a href='發票登錄a.php?a=1&b=$發票號碼'>否，讓我重填</a>";
		exit;
	}else{
	}
}

		$sql="INSERT INTO `記帳表` () VALUES ('','$發票號碼','$期數','$消費金額','$消費日期','$標籤設定','$其它')";
		$insert=$db->exec($sql);
		if($insert){
			header("location:發票登錄a.php?a=2&b=$發票號碼  ");
		}
		// $sql="INSERT INTO `記帳表` () VALUES ('','$發票號碼','$期數','$消費金額','$消費日期','$標籤設定','$其它')";
		// $insert=$db->exec($sql);
		// echo $sql;


?>

