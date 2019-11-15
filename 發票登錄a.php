    <!-- 狀態-需求:
    1．由首頁進入 無get
    2．由後台登錄完成後返回 get a=2 ，需顯示完成登錄之發票號碼，及前次期數保留(手動發票登錄習慣，常會是同一期的)
    3．由後台登錄失敗(有重覆登錄或tag要重設) get a=1 ，需保留所有前次輸入內容 -->
    <!-- 未完成事項：
    標籤輸入輔助選單
    JS輸入檢查功能，特別需判斷日期與期數是否吻合，可在輸入日期後，即閉鎖期數欄位，由後台判斷期數  -->

<?php include_once "invoiceBasic.php" ?>
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
        width:12em;
    }
    .發票號碼a{
        width:2em;
    }
    .發票號碼b{
        width:6em;
    }
    .other{
        height:3em;
        width:15em;
        text-align:left ;
    }
    </style>
</head>
<body>

	<?php
	if(empty($_GET) || $_GET['a']==2){
        $發票號碼a="";
        $發票號碼b="";
        $期數=getNowPeriod();
        $消費日期="";
        $消費金額="";
        $標籤設定="";
        $其它="";
        if(!empty($_GET) && $_GET['a']==2){
            $temp=$_SESSION['發票號碼a'].$_SESSION['發票號碼b'];
            echo "已登錄發票 $temp";
            $期數=$_SESSION['期數'];
        }
    }else{
	    print_r($_SESSION);
        echo $_SESSION['發票號碼a'];
        $發票號碼a=$_SESSION['發票號碼a'];
        $發票號碼b=$_SESSION['發票號碼b'];
        $期數=$_SESSION['期數'];
        $消費日期=$_SESSION['消費日期'];
        $消費金額=$_SESSION['消費金額'];
        $標籤設定=$_SESSION['標籤設定'];
        $其它=$_SESSION['其它'];
	}
    ?>
    
    <div name="發票登錄">
        <h3>
            發票登錄
        </h3>
        <form action="發票登錄b.php" method="post">
            發票號碼：
            <input class="發票號碼a" type="text" value="<?php echo $發票號碼a; ?> "  name="發票號碼a" id="">
            -
            <input class="發票號碼b" type="text" value="<?php echo $發票號碼b; ?>" name="發票號碼b" id="">
            <br>
            <!-- 需以選單處理，可選期數為當下日期往前7期，並預設為當下期數 -->
            期數：<input type="search" value="<?php echo $期數;?>" name="期數" id="">
            <br>
            消費日期：<input type="date" value="<?php echo $消費日期 ; ?>" name="消費日期" id="">
            <br>
            消費金額：<input type="number" value="<?php echo $消費金額; ?>" name="消費金額">元
			<br>
			<!-- 增加表單於右側，可選擇所有已存在標籤，並用js監控，變動時即在valu值尾端新增 -->
            標籤設定：<input type="text" value="<?php echo $標籤設定; ?>" placeholder="#標籤1#標籤2" name="標籤設定">
            <br>
            其它：
            <br>
            <textarea class="other"  name="其它" id=""  >
            <?php 
                echo $其它 ;
            ?>
            </textarea>
            <br>
            <input type="submit" value="登錄發票">
            <input type="reset" value="清除資料">
        </form>
    </div>
	
	
	
    <script>

			// <!-- 需以選單處理，可選期數為當下日期往前7期，並預設為當下期數 -->
			// <!-- 增加表單於右側，可選擇所有已存在標籤，並用js監控，變動時即在valu值尾端新增 -->
    </script>
</body>
</html>