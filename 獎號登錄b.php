<?php
// 狀態-需求:
// 1．由首頁進入，取得當前期別，查詢並設定session，並依是否已登錄開獎獎號設定頁面為查詢或登入
// 2．由獎號登入a 以翻頁連結(GET)進入，由get讀取期別，查詢並設定session，並依是否已登錄開獎獎號設定頁面為查詢或登入
// 3．由獎號登入a以POST進入，判定是否已有舊資料(有則刪除)，登錄資料後自動對獎，將得獎資料寫入winInvoice資料表，以查詢狀態返回獎號登入a頁面
// 4．中獎核定完成返回，同2
include_once "invoiceBasic.php" ;
// 判斷執行動作&取得期別

if(!empty($_POST)){
	$action="write";
	$期別 = $_POST['period'];
}else{
    $action="select";
    if(empty($_GET)){
        $期別=getNowPeriod();
    }else{
        $期別 = $_GET['期別'];
    }
}
//判斷是否已有資料
$hasRegist= check($期別,'lotteryAward','period');
// echo "action=" . $action . "<br>";
// echo "hasRegist=" . $hasRegist . "<br>";

if($action=="write"){
    //若為資料輸入(由post進入取得)，刪除舊資料=>寫入資料=>自動對獎=>中獎登錄至中獎發票資訊
    if($hasRegist){
        $sql="DELETE FROM `lotteryAward` WHERE `period`=$期別";
        $db->exec($sql);
        $sql="DELETE FROM `winInvoice` WHERE `period`=$期別";
        $db->exec($sql);
    }
	// print_r($_POST);
    foreach($_POST as $key => $value){
        if($key!="期別"){
            $value=trim($value);
			$sql="INSERT INTO `lotteryaward` () VALUE ('','$期別','$key','$value')";
			// echo "<br>";
			// echo $sql;
			// echo "<br>";
			$db->exec($sql);
			// echo "登錄獎號" . $key . $value;
        }
    }
    echo "已登錄第 $期別 期中獎獎號，進行對獎程序中 <br>";
    // 自動對獎-1 取出某期別裡 發票資料表 中 發票號碼 與 開獎資料表 中 開獎號碼末3碼 有相等的所有資料
    $sql="SELECT `記帳表`.`ID` AS 'V_ID' ,`記帳表`.`V_number` ,`lotteryaward`.`ID` AS 'awardID' ,`lotteryaward`.`number` AS 'awardNumber',`lotteryaward`.`prize` FROM `記帳表` INNER JOIN `lotteryaward` WHERE `記帳表`.`period`=`lotteryaward`.`period` AND `記帳表`.`V_number` like CONCAT('%',SUBSTRING(`lotteryaward`.`number`
	,LENGTH(`lotteryaward`.`number`)-2,3)) AND `記帳表`.`period`=$期別";
    echo $sql . "<br>";

    $hightProbablity=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    print_r($hightProbablity);
    // print_r($hightProbablity);
    function chick000($arr){
        global $db;
        global $期別;
        echo "try01";
        if(($arr['prize']=="特別獎" || $arr['prize']=="特獎") && substr($arr['V_number'],-8,8)==substr($arr['awardNumber'],-8,8)){
            $sql="INSERT INTO `winInvoice` () VALUE ('','" . $arr['V_ID'] . "','" . $arr['awardID'] . "','" . $arr['V_number'] . "','" . $arr['prize'] . "','$期別') ";
            // echo $sql;
            $db->exec($sql);
            echo "try02";
        }
    }
    function chick001($arr){
        global $db;
        global $期別;
        echo "try03";
        if(substr($arr['prize'],0,12)=="增開六獎"){
            $sql="INSERT INTO `winInvoice` () VALUE ('','" . $arr['V_ID'] . "','" . $arr['awardID'] . "','" . $arr['V_number'] . "','增開六獎','$期別') ";
            $db->exec($sql);
            echo "try04";
        }
    }
    function chick002($arr){
        global $db;
        global $期別;
        echo "try05";
        if(substr($arr['prize'],0,6)=="頭獎"){
            $prize=[3=>'六獎',4=>'五獎',5=>'四獎',6=>'三獎',7=>'二獎',8=>'頭獎'];
            
            $chick=1;
            $i=3;
            while($chick==1){
            $temp1=substr($arr['V_number'],0-$i,$i);
            $temp2=substr($arr['awardNumber'],0-$i,$i);
                if( $temp1==$temp2){
                    $i++;

                // echo "你好，我在這";
                }else{
                    $chick=0;
                    $i--;
                    $sql="INSERT INTO `winInvoice` () VALUE ('','" . $arr['V_ID'] . "','" . $arr['awardID'] . "','" . $arr['V_number'] . "','" . $prize[$i] . "','" . $期別 ."') ";
                    // echo $sql;
                    $db->exec($sql);
                }
            }
        }
    }
    if(empty($hightProbablity)){
        header("location:獎號登錄b.php?期別=$期別");
    }else{
        foreach($hightProbablity as $value){
            
            chick000($value);
            echo "try01";
            chick001($value);
            echo "try02";
            chick002($value);
            echo "try03";
            header("location:獎號登錄b.php?期別=$期別");
            echo "try04";
    
            
           
            // if(($value['prize']=="特別獎" || $value['prize']=="特獎") && substr($value['V_number'],-8,8)==substr($value['awardNumber'],-8,8)){
            // 	$sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','" . $value['prize'] . "','$期別') ";
            //     // echo $sql;
            //     $db->exec($sql);
    
            // }elseif(substr($value['prize'],0,12)=="增開六獎"){
            //     $sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','增開六獎','$期別') ";
            //     $db->exec($sql);
                
            // }elseif(substr($value['prize'],0,6)=="頭獎"){
            //     $prize=[3=>'六獎',4=>'五獎',5=>'四獎',6=>'三獎',7=>'二獎',8=>'頭獎'];
                
            //     $chick=1;
            //     $i=3;
            //     while($chick==1){
            //         $temp1=substr($value['V_number'],0-$i,$i);
            //         $temp2=substr($value['awardNumber'],0-$i,$i);
            //         if( $temp1==$temp2){
            //             $i++;
                        
            //         // echo "你好，我在這";
            //         }else{
            //             $chick=0;
            //             $i--;
            //             $sql="INSERT INTO `winInvoice` () VALUE ('','" . $value['V_ID'] . "','" . $value['awardID'] . "','" . $value['V_number'] . "','" . $prize[$i] . "','" . $期別 ."') ";
            //             // echo $sql;
            //             $db->exec($sql);
            //         }
            //     }
            // }
            // header("location:獎號登錄b.php?期別=$期別");      
        }

    }
}else{
    // 無資料更新需求，查詢資料庫，設定session，設定回傳狀態
    // 登錄開獎號碼-期別 獎別 獎號  function(期別 array)
    // 自動對獎->登錄中獎發票至awardTicket function()
    
    // 查詢
    $_SESSION['特別獎']="";
    $_SESSION['特獎']="";
    $_SESSION['頭獎1']="";
    $_SESSION['頭獎2']="";
    $_SESSION['頭獎3']="";
    $_SESSION['增開六獎1']="";
    $_SESSION['增開六獎2']="";
    $_SESSION['增開六獎3']="";
    $_SESSION['增開六獎4']="";
    $_SESSION['增開六獎5']="";
    
    if(!empty($hasRegist)&&$hasRegist['count(*)']!=0){
        $temp="SELECT `prize`,`number` FROM `lotteryAward` WHERE `period`=$期別 ";
        $awardArray=$db->query($temp)->fetchAll(PDO::FETCH_NUM);
        // print_r($awardArray);
        // echo "<br>";
        // echo $awardArray . "<br>";
 
        foreach($awardArray as $number){
            
            $_SESSION[$number[0]]=$number[1];
        }
        // print_r($_SESSION);
        // echo "<meta http-equiv='refresh' content='0; url=獎號登錄a.php?期別=$期別&regist=1";
        header("location:獎號登錄a.php?期別=$期別&regist=1>");
        echo "資料載入中，請稍侯";
    }else{
        header("location:獎號登錄a.php?期別=$期別&regist=0>");
        // echo "<header location:獎號登錄a.php?期別=$期別&regist=0>";
        echo "資料載入中，請稍侯";
    
    }




}

?>

