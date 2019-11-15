<?php
session_start();
$dns="mysql:host=localhost;charset=utf8;dbname=invoice";
$db=new PDO($dns,'root','1234');

Function check($vaule,$table,$cell){
	global $db;
	$sql="SELECT count(*) From `$table` where `$cell`='$vaule'";
	$temp=$db->query($sql)->fetch();  
	return $temp;
}
Function showTable($arr){
	$m=sizeof($arr);
	echo "<table>";
	echo "<tr>";
	foreach($arr[0] as $key =>$value){
		echo "<td>";
		echo $key;
		echo "</td>";
	}
	foreach($arr as $key => $value){
		echo "<tr>";
		foreach($value as $value2){
			echo "<td>";
			// peint_r($value);
			echo $value2;
			echo "</td>";
		} 
		echo "</tr>";
	}
	echo "</table>";
}
Function getPeriod($time){
	$Fperiod=date("Y",$time)-1911;
	$Lperiod=(date("m",$time)+1)/2;
	return $Fperiod . "0" . $Lperiod; 
}
Function getNowPeriod(){
	$Fperiod=date("Y")-1911;
	$Lperiod=(date("m")+1)/2;
	return $Fperiod . "0" . $Lperiod; 
}
Function nextPeriod($period){
	$temp=$period+1;
	if($temp%10==7){
		$temp=$temp+94;
	}
	return $temp;
}
Function prePeriod($period){
	$temp=$period-1;
	if($temp%10==0){
		$temp=$temp-94;
	}
	return $temp;
}

?>
