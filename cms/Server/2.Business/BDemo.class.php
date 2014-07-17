<?php

/**
 * Demo的业务处理Server, 在这里实现具体业务处理代码
 * 具体业务逻辑处理方法。
 * 参数： 根据需要，参数可以是具体的变量，也可以是 Array 和 RequestData 对象；
 * 返回:  1. 返回正常的操作结果；
 *        2. 可以用 false 表示失败或异常（返回状态为400）；用1和0表示判断方法“是”和“非”结果(返回状态为200）。
 *        3. 用抛出异常的方式，返回错误结果和代码。
 * @author zq
 */
class BDemo {

    /**
     * 具体业务逻辑处理方法。
     * 参数： 根据需要，参数可以是具体的变量，也可以是 Array 和 RequestData 对象；
     * 返回:  1. 返回正常的操作结果；
     *        2. 可以用 false 表示失败或异常（返回状态为400）；用1和0表示判断方法“是”和“非”结果(返回状态为200）。
     *        3. 用抛出异常的方式，返回错误结果和代码。
     * 
     * @param int $age
     * @param string $name
     * @return string
     */
    static function act1($age, $name) {

        if (!$name) {
            //返回错误信息
            ErrorCode::throwError(ErrorCode::用户名不能为空);
        }

        return "Hello {$name}, you were {$age} years old?";
    }

    /**
     * 判断是不是成年人
     * @param int $age
     */
    static function isAdult($age) {

        if (is_int($age)) {
            //是成年人
            if ($age >= 18) {
                return 1;
            }
            //不是成年人
            else if ($age > 0) {
                return 0;
            }
        }

        //判断失败（比如：判断数据有误）
        return false;
    }

    static function getEntityById($id) {
        return DRestDemo::share()->getById($id);
    }

}
