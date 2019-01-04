<?php
/**
 * 正则表达式匹配
 *
 * Created by PhpStorm.
 * User: caoting
 * Date: 2018/11/28
 * Time: 上午11:04
 */

class Regex
{
    public function __call($name, $arguments)
    {
        if (isset(self::$config[$name]) && !empty($arguments[0])) {
            return (bool)preg_match(self::$config[$name], $arguments[0]);
        }

        return false;
    }

    public static function getConfig()
    {
        return array_keys(self::$config);
    }

    private static $config = [
        /**
         * 手机号码: 1开头, 第二位是34578, 总位数是11位的纯数字
         */
        'phoneNumber'       =>          '/^1[34578]\d{9}$/',

        /**
         * 邮箱:
         *      1. @前面只能由字符和数字开头, 由字母数字和下划线(_),点(.), 横杠(-)组成
         *      2. @到最后一个点(.) 之间只能由字符数字, 点(.),和减号(-)组成, 且点(.)不能挨着最后一个点(.)
         *      3. 点(.)后只能由字母数字组成, 且长度为2到6
         */
        'email'             =>          '/^[A-Za-z0-9][a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[A-Za-z0-9-]+)*.[a-zA-Z0-9]{2,6}$/',

        /**
         * 账号:
         *      1. 开头只能是字母和数字
         *      2. 可以由字母数字和下划线(_), 横杠(-)组成
         *      3. 长度在8到16
         */
        'account'           =>          '/^[a-zA-Z0-9][a-zA-Z0-9_-]{7,16}$/',

        /**
         * 密码:
         *      1. 必须包含一个大写字母
         *      2. 必须包含字母数字 可以存在特殊符号(!@#$%^&*?,._)
         *      3. 长度在8到16位
         */
        'password'          =>          '/^[A-Z]*$/',
    ];
}

Regex::getConfig();