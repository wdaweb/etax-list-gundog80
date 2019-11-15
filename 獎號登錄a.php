<?php 
include_once "invoiceBasic.php";
// 狀態-需求:
// 由獎號登錄b進入 由get取得期別和regist，若regist=0為可寫入狀態，若regist=1則鎖閉
// 可以修正資料按鍵開放寫入(以js修改)
$期別=$_GET['期別'];
$nextPeriod=nextPeriod($期別);
$prePeriod=prePeriod($期別);

if($_GET['regist']==1){
    $readonly="readonly";
    $disabled="disabled";
}else{
    $readonly="";
    $disabled="";
}

// // echo $_SESSION;
// print_r($_SESSION);

?>


<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>發票登錄</title>
    <style>
    .發票登錄{
        margin: 0 auto;
        width:500px;

    }
	.增開六獎1{
		width:5;
	}
    </style>
</head>
<body>
    
    <div name="發票登錄">
        獎號登錄
        <form action="獎號登錄b.php" method="post">
            第<span id="No."><?php echo $期別; ?></span>期 統一發票開獎號碼：
            <br>
            特別獎：
            <input type="text" value="<?php echo $_SESSION['特別獎'] ; ?> " <?php echo $readonly ?>  name="特別獎" id="">
            <br>
            特獎：
            <input type="text" value="<?php echo $_SESSION['特獎'] ; ?> " <?php echo $readonly ?> name="特獎" id="">
            <br>
            頭獎：
            <br>
            <input type="text" value="<?php echo $_SESSION['頭獎1'] ; ?> " <?php echo $readonly ?> name="頭獎1" id="">
            <br>
            <input type="text" value="<?php echo $_SESSION['頭獎2'] ; ?> " <?php echo $readonly ?> name="頭獎2" id="">
            <br>
            <input type="text" value="<?php echo $_SESSION['頭獎3'] ; ?> " <?php echo $readonly ?> name="頭獎3" id="">
            <br>
            增開六獎:
			<br>
			<div>
				<input  id="addNumBtn" type="button" value="添加增開六獎獎號" <?php echo $disabled; ?> onclick="addNumber()" >

            </div>
            <input type="hidden" name="period" value="<?php echo $期別; ?>" <?php echo $disabled; ?>>
            
            <br>
            <input type="submit" value="登錄獎號" <?php echo $disabled; ?>>
            <input type="reset" value="清除資料" <?php echo $disabled; ?>>
          
            
            
            
            <?php
                if($_GET['regist']==1){
                    // echo "<input type='reset' value='修正資料'>";
                    echo "<input type='reset' value='修正資料' onclick='cancleLock()'>";
        
                }

        ?>
        </form>
        <a href="獎號登錄b.php?期別=<?php echo $prePeriod ?>">上一期</a> 
        &ensp;&ensp;&ensp;&ensp;
        <a href="獎號登錄b.php?期別=<?php echo $nextPeriod ?>">下一期</a> 

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