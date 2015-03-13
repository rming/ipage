<?php
/**
 * 随机生成字符串
 * @param integer $len 字符串长度
 * @return string 生成的字符串
 */
if ( ! function_exists('rand_string')) {
    function rand_string($len = 6)
    {
        $str = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
        $str_len = strlen($str);

        srand(time());

        $res = '';
        for ($i = 1; $i <= $len; $i++) {
            $res .= $str[rand(0, $str_len - 1)];
        }

        return $res;
    }
}
