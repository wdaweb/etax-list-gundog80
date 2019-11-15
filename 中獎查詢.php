<?php 
include_once "invoiceBasic.php";
// 狀態-需求:
// 作業臨時業面，僅提供依月份翻找查詢中獎發票及統計資料，前後台集中於一頁
// 由首頁及翻頁方式進入
// 未完成事項：已領獎註記
if (empty($_GET)){
    $time=strtotime("now");
    $year=date("Y");
    $month=date("m");
    $monthStr=date("Y-m-01");
    $monthEnd=date("Y-m-t");
}else{
    $time=$_GET['time'];
    $year=date("Y",$time);
    $month=date("m",$time);
    $monthStr=date("Y-m-01",$time);
    $monthEnd=date("Y-m-t",$time);
}

$sql="SELECT count(*) as 'number',sum(`money`) as 'total' FROM `記帳表`  WHERE (`記帳表`.`date` BETWEEN '$monthStr' AND '$monthEnd') ";
// echo $sql;
$pay=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
// print_r($pay);
$sql="SELECT count(*) as 'number',sum(`awardmoney`.`money`) as 'total' FROM `wininvoice` INNER JOIN `記帳表` INNER JOIN `awardmoney` WHERE `wininvoice`.`獎別`=`awardmoney`.`獎別` AND `記帳表`.`id`=`wininvoice`.`V_ID` AND(`記帳表`.`date` BETWEEN '$monthStr' AND '$monthEnd')";
// echo $sql;
$win=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
// print_r($win);
$sql="SELECT `記帳表`.`V_number` as '發票號碼' ,`記帳表`.`date` as '消費日期',
    `記帳表`.`money`as '消費金額',`wininvoice`.`獎別` as '中獎名目',`awardmoney`.`money` as '中獎金額' 
    FROM `wininvoice` INNER JOIN `記帳表` INNER JOIN `awardmoney` 
    WHERE `wininvoice`.`獎別`=`awardmoney`.`獎別` 
    AND `記帳表`.`id`=`wininvoice`.`V_ID` 
    AND(`記帳表`.`date` BETWEEN '$monthStr' AND '$monthEnd')";
// $sql="SELECT *  FROM `wininvoice` INNER JOIN `awardmoney` WHERE `wininvoice`.`獎別`=`awardmoney`.`獎別` ";
$temp=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
echo "$year 年 $month 月 ，總計消費發票 " . $pay['number'] . "張，共$" . $pay['total'] ."元 <br>";
echo "中獎發票總計" . $win['number'] . "張，共$" . $win['total'] ."元 <br>";
echo "中獎明細 <br>";
if(empty($temp)){
    echo "本月無發票中獎";
}else{
    showTable($temp);
}

$timeOfNextMonth=strtotime("+1 month",$time);
$timeOfpreMonth=strtotime("-1 month",$time);
?>

        <a href="中獎查詢.php?time=<?php echo $timeOfpreMonth ?>">上一期</a> 
        &ensp;&ensp;&ensp;&ensp;
        <a href="中獎查詢.php?time=<?php echo $timeOfNextMonth ?>">下一期</a> 

    </div>
	
	
	
    <script>
// 增開六獎添加功能
let addNBtn=document.getElementById("addNumBtn");
console.log(addNBtn);

let addNumber = () => {
	temp=addNBtn.parentElement.getElementsByTagName("input").length;
	console.log(temp);
// addStr="<input type='text' value='' name='增開六獎'>";
	addStr="<input type='text' value='' name='增開六獎"+temp+"'> <br>";
	 addNBtn.insertAdjacentHTML("beforeBegin",addStr);
// //  addNBtn.insertAdjacentHTML("beforeBegin","<input type='text' value='' name='增開六獎'>");
}
let cancleLock = ()=>{
    tempDocs=document.getElementsByTagName("input");
        console.log(tempDocs);
    for(let input of tempDocs){
    // tempDocs.forEach((v,i)=>{
        // console.log(v);
  
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    }
    //     $readonly="";
    // $disabled=""
    
}



// addNBtn.onclick();

// console.log(addNBtn);
// console.log(addNBtn);

// 解鎖欄位鎖定

    </script>
</body>
</html>