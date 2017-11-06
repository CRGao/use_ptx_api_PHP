<?php
/**
 * Created by PhpStorm.
 * User: crgao
 * Date: 2017/11/6
 * Time: 上午12:38
 */
 class ptx{
     public static function getdata()
     {
         $app_id  = ''; //your app_id
         $app_key = ''; //your app_key

         //You can change to want to get the data URL
         $url ='http://ptx.transportdata.tw/MOTC/v2/Rail/TRA/DailyTimetable?$top=30&$format=JSON';

         //get gmt time
         $date = gmdate('D, d M Y H:i:s T', time());

         //signature
         $sign = base64_encode(hash_hmac("sha1",  'x-date: '.$date,$app_key,true));

         //set header
         $header = Array();
         $header[]='Accept: application/json';
         $header[]='Authorization: hmac username="'.$app_id.'", algorithm="hmac-sha1",headers="x-date",signature="'.$sign.'"';
         $header[]='x-Date: '.$date;

         //use curl
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
         $result = curl_exec($ch);
         curl_close($ch);

         //print data (chack result data)
         echo "<pre>".print_r($result)."</pre>";
     }

 }

//How to use
ptx::getdata();