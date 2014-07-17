<?php
if (!empty($_viewData)) {
    $title = $_viewData->Title;
    $createTime = $_viewData->Time;
    $content = $_viewData->Content;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />    <!--未隐藏URL栏-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />  <!-- 已隐藏URL栏 -->
        <title>掌上贵金属</title>
    </head>

    <style>
        body {
/*                font-family:Arial, Helvetica, sans-serif,normal Verdana, Arial, Helvetica, sans-serif,"黑体" ;
                font-size:14px;*/
                /* width:320px;   */
                background-color:#fff;
        }
        /**详情页面**/

        .details{
            width:100%;
            margin: 0 auto;
        }

        .details dl{
            width:96%;
            margin:0 auto;
            padding:0;
        }

        .details dt{
            width:100%;
            line-height:24px;
            font-size:16px;
            color:#000;
            border-bottom:1px solid #787878;
            margin:5px 0 5px 0;
        }

        .details dt em{
            width:100%;
            height:24px;
            line-height:24px;
            font-size:12px;
            font-style:normal;
            color:#9d9e9e;
        }

        .details dd{
            
            line-height:20px;
            font-size:13px;
            font-style:normal;
            color:#000;
            text-align:justify;
        }

    </style>
    <body>


        <div class="details">
            <dl>
                <dt><?= $title ?> <br /><em><?= $createTime ?></em></dt>
                <dd>
                    <?= $content ?>
                </dd>
            </dl>
        </div>

    </body>
</html>
