<?php
if (!empty($_viewData)) {
//    foreach($_viewData as &$value) {
//        $title = $value->Title;
//        $createTime = $value->Time;
////    $content = $_viewData->Content;
//    }
    $list = $_viewData['r'];
    $t = $_viewData['t'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport"/>
<title>交易所列表</title>
<link href="<?=U("public/css/style.css")?>" rel="stylesheet" />
<body>
 <div class="main">
  <div class="history">
    <div class="history-date">
        <ul>
            <?php
            foreach ($list as $item) {
                echo '<li>';
                echo "<h3>{$item->Time}</h3>";
                $url = UA("Notice/detail?t=".$t."&url=".urlencode($item->Url));
                echo "<dl><dt><a href='{$url}'>{$item->Title}</a></dt></dl></li>";
            }
            ?>
        </ul>
    </div>
  </div>
 </div>
</body>
</html>

