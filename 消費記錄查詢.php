<?php 
include_once "invoiceBasic.php";
// 狀態-需求:
// 作業臨時業面，僅提供依月份翻找查詢消費記錄，前後台集中於一頁
// 僅由首頁及翻頁方式進入
// 未完成事項--一般查詢功能．標籤查詢功能．消費記錄修改功能
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

$timeOfNextMonth=strtotime("+1 month",$time);
$timeOfpreMonth=strtotime("-1 month",$time);

echo "$year 年 $month 月 消費明細 ";
?>
&ensp;&ensp;
<a href="消費記錄查詢.php?time=<?php echo $timeOfpreMonth ?>">上一期</a> 
&ensp;&ensp;&ensp;&ensp;
<a href="消費記錄查詢.php?time=<?php echo $timeOfNextMonth ?>">下一期</a>   
<br>
<?php
$sql="SELECT `V_number` as '發票號碼',`date` as '消費日期',`money` as '消費金額',`target`as '自訂標籤',`other` as '備註事項' 
FROM `記帳表` 
WHERE (`記帳表`.`date` BETWEEN '$monthStr' AND '$monthEnd') ";
// echo $sql;
$history=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(empty($history)){
    echo "本月無消費記錄";
}else{
    showTable($history);
}


?>

   

    </div>
	
	
	
</body>
</html>