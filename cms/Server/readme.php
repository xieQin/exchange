<?php

/*
 * 掌金服务模块架(Server)构说明：
 * 
 * 
 * 目录：
 *   0.Common： 共用资源目录；
 *   1.Action： 控制器目录，是Server的访问入口；
 *              其WebService服务分两种：Service和Controller；
 *              Service：请求结果是标准的 {"s":"状态","d":数据} 的json格式，并用DES加密输出；
 *              ServiceAction.class.php为Service问访问入口， 目录"1.Action\_Service"为具体Service保存目录；
 *              Controller: 请求结果不做特殊处理（比如DES加密），也可以是web页面；
 *              ControllerAction.class.php为Controller问访问入口， 目录"1.Action\_Controller"为具体Controller保存目录；
 *              其他的Action文件保存在"1.Action\_Action"目录下；
 *              每个Service方法创建一个Service的Class文件（同文件中包含请求参数Class定义），class以命名以“Service”结尾，并继承ZBaseService类，在act方法中调用具体业务逻辑现实（Business）功能；
 *              （Controller说明和上述类似）
 * 
 *   2.Business: 业务逻辑实现目录， 同一对象的业务实现放在同一class中，class建议命名规范建议加“B”前缀；
 *   3.DataServer：数据操作模块，为每张数据表实现一个操作class, 并继承 DSBase 类，命名规范建议加“D”前缀；
 *                 DSBase中，实现了增、删、改、查的基本功能并加了Cache机制，在具体的数据操作class中，只需要实现一些简单的逻辑和特殊的操作需求方法；
 *   
 *              
 * 
 * 数据操作：
 * 
 * 业务逻辑实现：
 * 
 * 访问入口Action：
 *     请求参数：
 * 
 * 安全说明：
 * 
 * 接口文档：
 * 
 * 开发思路：
 * 
 */

