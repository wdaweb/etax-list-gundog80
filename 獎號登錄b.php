<?php
include_once "dbConenction.php" ;
// 判斷執行動作&取得期別
if(!empty($_POST)){
	$action="write";
	// $期別 = $_POST['期別'];
	$期別=999;
}else{
    $action="select";
    if(empty($_GET)){
        // 以日期換算期別
    }else{
        $期別 = $_GET['期別'];
    }
}
//判斷是否已有資料
$hasRegist= check($期別,'lotteryAward','perviod');

//若為資料輸入，刪除舊資料=>寫入資料=>自動對獎=>中獎登錄至中獎發票資訊
if($action="write"){
    if($hasRegist){
        $sql="DELETE FROM `lotteryAward` WHERE `perviod`=$期別";
        $db->exec($sql);
    }
	// print_r($_POST);
    foreach($_POST as $key => $value){
        if($key!="期別"){
			$sql="INSERT INTO `lotteryaward` () VALUE ('','$期別','$key','$value')";
			// echo "<br>";
			// echo $sql;
			// echo "<br>";
			$db->exec($sql);
			// echo "登錄獎號" . $key . $value;
        }
    }
    // 自動對獎-1 取出某期別裡 發票資料表 中 發票號碼 與 開獎資料表 中 開獎號碼末3碼 有相等的所有資料
    $sql="SELECT `記帳表`.`ID` AS 'V_ID' ,`記帳表`.`V_number` ,`lotteryaward`.`ID` AS 'awardID' ,`lotteryaward`.`number` AS 'awardNumber',`lotteryaward`.`prize` FROM `記帳表` INNER JOIN `lotteryaward` WHERE `記帳表`.`periods`=`lotteryaward`.`perviod` AND `記帳表`.`V_number` like CONCAT('%',SUBSTRING(`lotteryaward`.`number`
	,LENGTH(`lotteryaward`.`number`),3)) AND `記帳表`.`periods`=$期別";
	// echo "<br>";
	// echo $sql;
	// echo "<br>";
	$hightProbablity=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	foreach($hightProbablity as $value){
		if(($value['prize']=="特別獎" || $value['prize']=="特獎") && $value['V_number']==$value['awardNumber']){
			$sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','" . $value['prize'] . "', 2000000 )";
			}elseif($value['prize']=="^增開六獎"  && $value['V_number']==$value['awardNumber']){
			$sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','增開六獎', 2000000 )";
			}elseif($value['prize']=="^頭獎"){
				$prize=[3=>'六獎',4=>'五獎',5=>'四獎',6=>'三獎',7=>'二獎',8=>'頭獎'];
				
				$chilck=1
				$i=3;
				while($chick=1){
					if(substr($value['awardNumber'],-$i,$i)==substr($value['awardNumber'],-$i,$i){
						$i++;
					}
					$i--;
					$sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','" . $prize[$i] . "', 2000000 )"
				}
			)
		}
	


}else{

    // 依來源判斷是要登錄或查詢
    // 登錄-來源為post
    // 取得期別
    // 登錄開獎號碼-期別 獎別 獎號  function(期別 array)
    // 自動對獎->登錄中獎發票至awardTicket function()
    
    // 查詢
    
    if($hasRegist){
        $temp="SELECT '獎別','獎號' FROM `lotteryAward` WHERE `期別`=$期別 ";
        $awardArray=$db->query($temp)->fetchAll();
        foreach($awardArray as $number){
            $_SESSION[$number[0]]=$number[1];
        }
        echo "<meta http-equiv='refresh' content='0; url=獎號登錄a.php?期別=$期別&register=1";
        echo "資料載入中，請稍侯";
    }else{
        echo "<meta http-equiv='refresh' content='0; url=獎號登錄a.php?期別=$期別&register=0";
        echo "資料載入中，請稍侯";
    }




}

?>