<?php session_start(); ?>


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
        width:60em;

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
            第  <span id="No.">xxx</span>  統一發票開獎號碼：
            <br>
            特別獎：
            <input type="text" value="<?php echo $特別獎 ; ?> "  name="特別獎" id="">
            <br>
            特獎：
            <input type="text" value="<?php echo $特獎 ; ?> "  name="特獎" id="">
            <br>
            頭獎：
            <br>
            <input type="text" value="<?php echo $頭獎[0] ; ?> "  name="頭獎1" id="">
            <input type="text" value="<?php echo $頭獎[1] ; ?> "  name="頭獎2" id="">
            <input type="text" value="<?php echo $頭獎[2] ; ?> "  name="頭獎3" id="">
            <br>
            增開六獎:
			<br>
			<div>
				<input  id="addNumBtn" type="button" value="添加增開六獎獎號" onclick="addNumber()">

			</div>
            
            <br>
            <input type="submit" value="登錄獎號">
            <input type="reset" value="清除資料">
        <?php
        if(true){
            echo "<input type='reset' value='修正資料'>";
        }
        ?>
        </form>
    </div>
	
	
	
    <script>
// 增開六獎添加功能
let addNBtn=document.getElementById("addNumBtn");
console.log(addNBtn);

let addNumber = () => {
	temp=addNBtn.parentElement.getElementsByTagName("input").length;
	console.log(temp);
// addStr="<input type='text' value='' name='增開六獎'>";
	addStr="<input type='text' value='' name='增開六獎"+temp+"'>";
	 addNBtn.insertAdjacentHTML("beforeBegin",addStr);
// //  addNBtn.insertAdjacentHTML("beforeBegin","<input type='text' value='' name='增開六獎'>");
}



// addNBtn.onclick();

// console.log(addNBtn);
// console.log(addNBtn);

// 解鎖欄位鎖定

    </script>
</body>
</html>