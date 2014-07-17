<?php
$list = $_viewData;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" href="images/favicon.ico" type="/x-icon"/>
        <title>sns后台管理服务的接口说明</title>
        <link href="" rel="stylesheet" type="text/css" />
        <style>
            body {
                font-family: Verdana, Arial, '宋体';
                font-size: 12px;
                text-align: center;
            }
            .wrap{      
                width: 900px;
                margin: 10px auto 10px auto;
                text-align: left;
            }
            a:hover {
                text-decoration: underline;
                color: #ff0000;
                background: transparent;
            }
            a:link, a:visited {
                text-decoration: underline;
                color: #900b09;
                background: transparent;
            }
            table.dataintable {
                margin-top: 10px;
                border-collapse: collapse;
                border: 1px solid #aaa;
                width: 100%;
            }
            table.dataintable th {
                vertical-align: baseline;
                padding: 5px 15px 5px 5px;
                background-color: #d5d5d5;
                border: 1px solid #aaa;
                text-align: left;
            }
            table.dataintable td {
                vertical-align: text-top;
                padding: 5px 15px 5px 5px;
                background-color: #efefef;
                border: 1px solid #aaa;
            }

        </style>

    </head>
    <body>
        <div class="wrap">
            <h4>sns后台管理服务的接口说明</h4>
            <table class="dataintable">
                <tr>
                    <th style="width:200px;">名称</th>
                    <th>说明</th>
                    <th>接口测试</th>
                </tr>
                <?php
                foreach ($list as $key => $item) {
                    echo "<tr>";
                    echo "<td>{$key}</td>";
                    echo "<td><a href='?tag=" . $key . "' target='_blank'>" . $item["name"] . "</a></td>";
                    echo "<td><a href='?tag=" . $key . "&type=test' target='_blank'>" . $item["name"] . "测试</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>
    </body>
</html>