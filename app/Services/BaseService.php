<?php

namespace App\Services;

use PHPExcel;

class BaseService
{


    /**
     * [strFilter 给字符串去除特殊字符]
     * @author Guojf <guojiafeng@comteck.cn>
     * @date   2017-01-21
     * @param  [type]     $str [字符串]
     * @return [type]          [description]
     */
    public function strFilter($str)
    {
        $str = str_replace('`', '', $str);
        $str = str_replace('·', '', $str);    
        $str = str_replace('~', '', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('！', '', $str);
        $str = str_replace('@', '', $str);
        $str = str_replace('#', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('￥', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('……', '', $str);
        $str = str_replace('&', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('(', '', $str);
        $str = str_replace(')', '', $str);
        $str = str_replace('（', '', $str);
        $str = str_replace('）', '', $str);
        $str = str_replace('-', '', $str);
        $str = str_replace('_', '', $str);
        $str = str_replace('——', '', $str);
        $str = str_replace('+', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('【', '', $str);
        $str = str_replace('】', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('；', '', $str);
        $str = str_replace(':', '', $str);
        $str = str_replace('：', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('“', '', $str);
        $str = str_replace('”', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace('，', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('《', '', $str);
        $str = str_replace('》', '', $str);
        $str = str_replace('.', '', $str);
        $str = str_replace('。', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('、', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('？', '', $str);
        $str = str_replace(' ', '', $str);
        return trim($str);
    }

    /**
     * @author: 吴荣建
     * @date: $DATE ${TIME}
     * @param $message
     * @param bool $success
     * @param bool $code
     * @param string $data
     * @param null $total
     * @return array
     */
    public function build_result($message, $code = '10000', $data = NULL, $total = NULL, $log_params = NULL)
    {
        $res = ['msg' => $message, 'code' => $code];
        if ($data !== NULL) {
            $res['data'] = $data;
        }

        if ($total !== NULL) {
            $res['total'] = $total;
        }

        if ($log_params !== NULL)
        {

            try {
                Log::info(var_export($log_params, TRUE));
            } catch (\Exception $e) {

            }

        }
        return $res;
    }

    //获取客户端真实IP
    public function get_client_ip()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $client_ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $client_ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR')) {
            $client_ip = getenv('REMOTE_ADDR');
        } else {
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $client_ip;
    }

    ////获得访客浏览器类型
    function get_browser_ua()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            return $_SERVER['HTTP_USER_AGENT'];
        }
        return "";
    }


    ////获取访客操作系统
    function get_os()
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $OS = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/win/i', $OS)) {
                $OS = 'windows';
            } elseif (preg_match('/mac/i', $OS)) {
                $OS = 'mac';
            } elseif (preg_match('/linux/i', $OS)) {
                $OS = 'linux';
            } elseif (preg_match('/unix/i', $OS)) {
                $OS = 'unix';
            } elseif (preg_match('/bsd/i', $OS)) {
                $OS = 'bsd';
            } else {
                $OS = 'other';
            }
            return $OS;
        } else {
            return "获取访客操作系统信息失败！";
        }
    }

    /**
     * @author: 吴荣建
     * @date: 2017-07-11
     * @param $price
     * @return string
     */
    public function format_price($price)
    {
        return number_format(($price / 100), 2, '.', '');
    }

    /**
     * 验证数字和字符串的组合
     * @param $data
     * @param int $minLength
     * @param int $maxLength
     * @return bool
     */
    public function check_num_and_char($data, $minLength = 1, $maxLength = 20)
    {
        if (!preg_match("/^[0-9a-zA-Z]{" . $minLength . "," . $maxLength . "}$/", $data)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 手机号校验
     * @author: 吴荣建
     * @date: 2017-10-08
     * @param $mobole
     * @return bool
     */
    public function check_mobile_num($mobole)
    {
        if (!preg_match("/^1[34578]\d{9}$/", $mobole)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * 计算两个 日期之间的天数
     * @author  zhoucheng
     * @data    2017-11-20
     * @param $date_begin
     * @param $data_end
     * @return float
     */
    public function get_two_days_between($date_begin, $data_end)
    {
        //去掉时分秒的影响
        $date_begin_s = strtotime($date_begin);
        $date_begin = date('Y-m-d', $date_begin_s);

        $date_end_s = strtotime($data_end);
        $data_end = date('Y-m-d', $date_end_s);
        if ($data_end < $date_begin) {
            return false;
        }
        $date_begin_s = strtotime($date_begin);
        $date_end_s = strtotime($data_end);
        $days = ($date_end_s - $date_begin_s) / 3600 / 24;
        return $days + 1;

    }

    /**
     * @author: 吴荣建
     * @date: 2017-11-20
     * @param $date
     * @return array
     */
    function getNextMonthDays($date)
    {
        $timestamp = strtotime($date);
        $arr = getdate($timestamp);
        if ($arr['mon'] == 12) {
            $year = $arr['year'] + 1;
            $month = $arr['mon'] - 11;
            $firstday = $year . '-0' . $month . '-01';
            $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
        } else {
            $firstday = date('Y-m-01', strtotime(date('Y', $timestamp) . '-' . (date('m', $timestamp) + 1) . '-01'));
            $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
        }
        return array($firstday, $lastday);
    }


    /**
     * POST 请求
     * @param string $url
     * @param array $params
     * @param boolean $post_file 是否文件上传
     * @return string content
     */

    public function http_request($url, $params, $headers = NULL, $request_method = 'post', $post_file = false)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }

        //Log::info('请求报文：' . $strPOST);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        if ($request_method == 'post') {
            $strPOST = json_encode($params);
            curl_setopt($oCurl, CURLOPT_POST, true);
            curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        } else {
            $param_str = '?';

            foreach ($params as $key => $value) {
                $param_str .= $key . '=' . $value . '&';
            }
            $param_str = substr($param_str, 0, strlen($param_str) - 1);
            $url = $url . $param_str;
        }

        curl_setopt($oCurl, CURLOPT_URL, $url);
        if ($headers) {
            curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        }

        $sContent = curl_exec($oCurl);
        $this->save_log($url);
        $this->save_log($sContent);

        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        return json_decode($sContent, true);
    }

    /**
     * 获取输入日期是周几
     * @author  zhoucheng
     * @data    2017-10-25
     * @param $time
     * @return false|int|string
     */
    public function get_today_is_week($time)
    {
        $num = date('w', strtotime($time));
        if ($num == 0) {
            return 7;
        }
        return $num;
    }

    /**
     * @author  zhoucheng
     * @data    2017-12-01
     * @param $head
     * @param $content
     * @param $filename
     * @return bool
     */
    public function outExcel($head, $content, $filename)
    {
        header("Content-type:text/html;charset=utf-8");
        $excel_head = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        set_time_limit(0);
        if (!is_array($head)) {
            return false;
        }
        if (!is_array($content)) {
            return false;
        }
        $objPHPExcel = new \PHPExcel();
        //插入表头开始
        $head_length = count($head);
        $obj_head = $objPHPExcel->setActiveSheetIndex(0);
        for ($i = 0; $i < $head_length; $i++) {
            $obj_head = $obj_head->setCellValue($excel_head[$i] . '1', $head[$i]);
        }
        //插入内容开始
        $obj_content = $objPHPExcel->setActiveSheetIndex(0);
        $m = 2;
        foreach ($content as $item) {
            $item = array_values($item);
            for ($j = 0; $j < $head_length; $j++) {
                if (is_numeric($item[$j])) {
                    $obj_content = $obj_content->setCellValueExplicit($excel_head[$j] . $m, $item[$j], \PHPExcel_Cell_DataType::TYPE_STRING);;
                } else {
                    $obj_content = $obj_content->setCellValue($excel_head[$j] . $m, $item[$j]);
                }
            }
            $m++;
        }
        //导出开始
        $filename = $filename . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * 日志记录
     * @author  zhoucheng
     * @data    2017-12-06
     * @param $message
     * @param null $file_name
     * @param null $file_line
     * @param array $content
     */
    public function save_log($message , $file_name=null , $file_line=null , $content=[]){
        $message = '文件'.$file_name.' 第'.$file_line.'行'.' '.$message;
        Log::info($message , $content);
    }

    /**
     * 获取当前 毫秒
     * @author  zhoucheng
     * @data    2017-12-06
     * @return float
     */
    public function get_msectime($type =1 ) {
        list($msec, $sec) = explode(' ', microtime());
        $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

    /**
     * 创建文件夹
     * @author  zhoucheng
     * @data    2018-01-18
     * @param $dir
     * @return bool
     */
    public function createDir($dir){
        if(!$dir){
            return false;
        }
        if(!is_dir($dir)){
            $dir = dirname($dir);
        }
        if(file_exists($dir)){
            return true;
        }
        return @mkdir($dir, 0777 ,true);
    }

    /**
     * @author  zhoucheng
     * @data    2018-01-23
     * @param $url
     * @return bool
     */
    public function url_is_open($url){
        $result = @get_headers($url);
        if ($result) {
            if (strpos($result[0], '200')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



}