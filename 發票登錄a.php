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
    </style>
</head>
<body>
	<?php
	if(empty($_GET)||$_GET['a']=2){
		if($_GET['a']=2){
			$temp=$_GET['b'];
			echo "已登錄發票 $temp";
		}
        $發票號碼a="";
        $發票號碼b="";
        $期數="";
        $消費日期="";
        $消費日期="";
        $消費日期="";
        $消費日期="";
    }else{
		echo "session傳不回來，不明錯誤，待研究";
		print_r($_SESSION);

        $發票號碼a=$_SESSION['0'];
        $發票號碼b=$_SESSION['1'];
        $期數=$_SESSION['2'];
        $消費日期=$_SESSION['3'];
        $消費金額=$_SESSION['4'];
        $標籤設定=$_SESSION['5'];
        $其它=$_SESSION['6'];
	}
    ?>
    
    <div name="發票登錄">
        發票登錄
        <form action="發票登錄b.php" method="post">
            發票號碼：
            <input type="text" value="<?php $發票號碼a ?> "  name="發票號碼a" id="">
            <input type="text" value="<?php $發票號碼b; ?>" name="發票號碼b" id="">
            <br>
            <!-- 需以選單處理，可選期數為當下日期往前7期，並預設為當下期數 -->
            期數：<input type="search" value="<?php $期數?>" name="期數" id="">
            <br>
            消費日期：<input type="date" value="<?=$消費日期?>" name="消費日期" id="">
            <br>
            消費金額：<input type="number" value="<?php $消費金額?>" name="消費金額">元
			<br>
			<!-- 增加表單於右側，可選擇所有已存在標籤，並用js監控，變動時即在valu值尾端新增 -->
            標籤設定：<input type="text" value="<?php $標籤設定?>" placeholder="#標籤1#標籤2" name="標籤設定">
            <br>
            其它：<input type="text" value="<?php $其它?>" name="其它" id="" height="30 px" >
            <br>
            <input type="submit" value="登錄發票">
            <input type="reset" value="清除資料">
        </form>
    </div>
	
	
	
    <script>
    /*
        取得時間
        頁面載入完成後，更新發票的期數為當下月份所在期數
    */
			// <!-- 需以選單處理，可選期數為當下日期往前7期，並預設為當下期數 -->
			// <!-- 增加表單於右側，可選擇所有已存在標籤，並用js監控，變動時即在valu值尾端新增 -->
    </script>
</body>
</html>