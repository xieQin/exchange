<?php
if (!empty($_viewData)) {
//    foreach($_viewData as &$value) {
//        $title = $value->Title;
//        $createTime = $value->Time;
////    $content = $_viewData->Content;
//    }
    $list = $_viewData;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport"/>
<title>交易所列表</title>
<style>
    body, p, form, input, textarea, ul, li, h1, h2, h3, h4, dl, dt, dd, table, td, th {
	margin:0;
	padding:0;
}

table, td, th {
	border-collapse:collapse;
}

ul, li {
	list-style:none;
}

h1, h2, h3, h4 {
	font-size:100%;
}
img, input, textarea {
	vertical-align: middle;
	border:0;
}

body {
	font:12px/1.5 "Î¢ÈíÑÅºÚ","tahoma", Verdana, Geneva, sans-serif;
	position:relative;
	background:#222;
}

.clearfix:after{content:" "; display:block; height:0; clear:both; visibility:hidden;}

.clearfix{
	zoom:1;
}

.fl { float:left;}
.fr { float:right;}

/*.public*/
.main {
	margin:0 auto;
	/*width:980px;*/
	width:100%;
} 

a { blr:expression(this.onFocus=this.blur()) } /*Õë¶Ô IE*/
a { outline:none; } /*Õë¶ÔfirefoxµÈ*/

.main {
	padding:0;
	min-height:320px;
}


.history {
	background:url(/line04.gif) repeat-y 97px 0;
	overflow:hidden;
	position:relative;
        padding-top:20px;
}

.history-date {
	overflow:hidden;
}

.history-date ul {
	width:100%;
	margin:0;
	padding:0;
}

.history-date ul li {
	background:url(/icon07.gif) no-repeat 94px 0;
	padding-bottom:30px;
        padding-top:20px;
	zoom:1;
}

.history-date ul li.last {
	padding-bottom:0;
}

.history-date ul li:after{content:" "; display:block; height:0; clear:both; visibility:hidden;}

.history-date ul li h3 {
	float:left;
	width:/*168px*/20%;
	text-align:right;
	padding-right:19px;
	color:#bdbdae;
	font:normal 14px /*Arial*/Times New Roma;
	margin-top:-22px;
        padding-left:5px;
}

.history-date ul li dl {
	width:60%;
	float:left;
	padding-left:110px;
	margin-top:-20px;
	font-family:Î¢ÈíÑÅºÚ;
}

.history-date ul li dl dt {
	font:14px Î¢ÈíÑÅºÚ;
	color:#bdbdae;
	cursor: pointer;
}

</style>
<body>
 <div class="main">
  <div class="history">
    <div class="history-date">
        <ul>
            <?php
            foreach ($list as $item) {
                echo '<li>';
                echo "<h3>{$item->Time}</h3>";
                echo "<dl><dt>{$item->Title}</dt></dl></li>";
            }
            ?>
        </ul>
    </div>
  </div>
 </div>
</body>
</html>

