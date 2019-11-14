<?php
include_once("dbCnoenction.php") ;
// 判斷執行動作&取得期別
if(!empty($_POST)){
    $action="write";
}else{
    $action="select";
    if(empty($_GET)){
        // 以日期換算期別
    }else{
        $期別 = $_GET['期別'];
    }
}
//判斷是否已有資料
$hasRegist= check($期別,'lotteryAward','期別');

//若為資料輸入，刪除舊資料=>寫入資料=>自動對獎=>中獎登錄至中獎發票資訊
if($action="write"){
    if($hasRegist){
        $sql="DELETE FROM `lotteryAward` WHERE `期別`=$期別";
        $db->exec($sql);
    }

    foreach($_POST as $key => $value){
        if($key!="期別"){
            $sql="INSERT INTO `lotteryAward` () VALUE ('',$key,$value)";
            $db->exec($sql);
        }
    }
    // 自動對獎-1 取出某期別裡 發票資料表 中 發票號碼 與 開獎資料表 中 開獎號碼末3碼 有相等的所有資料
    $sql="SELECT * FROM `` INNER JOIN `` WHERE `V_number` like CONCAT('%',SUBSTRING(,LENGTH,))"

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