<?php
/**
 * 以POST方式发送CURL请求
 * @param string $url       请求URL
 * @param string $data      发送的POST数据
 * @param string $useragent UserAgent
 * @return mixed    成功则返回获取的数据,失败则返回NULL
 */
if ( ! function_exists('curl_post')) {
    function curl_post($url, $data = '', $useragent = '')
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            return NULL;
        }

        curl_close($curl);
        return $result;
    }
}
