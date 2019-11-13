<?php
// 依來源判斷是要登錄或查詢
// 登錄-來源為post
// 取得期別
// 登錄開獎號碼-期別 獎別 獎號  function(期別 array)
// 自動對獎->登錄中獎發票至awardTicket function()

// 查詢

include_once("dbCnoenction.php") ;
if(!empty($_GET)){
    以日期換算期別
}else{
    $期別 = $_GET['期別'];
}

$hasRegist= check($期別,'lotteryAward','期別');
if($hasRegist){
    $temp="SELECT '獎別','獎號' FROM `lotteryAward` WHERE `期別`=$期別 ";
    $awardArray=$db->query($temp)->fetchAll();
    foreach($awardArray as $number){
        $_SESSION[$number[0]]=$number[1];
    }
    echo "<meta http-equiv='refresh' content='0; url=獎號登錄a.php?期別= <?php $期別 ?>&register=1";
    echo 資料載入中，請稍侯
}else{
    echo "<meta http-equiv='refresh' content='0; url=獎號登錄a.php?期別= <?php $期別 ?>&register=0";
    echo 資料載入中，請稍侯
}

?>
