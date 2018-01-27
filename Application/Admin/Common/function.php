<?php

function getIP($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
} 

function is_phone($a) {
    return preg_match('/^1\\d{10}$/',$a)? true : false;
}

//验证银行卡号码
function checkBankCard($bankCardNo){
    $strlen = strlen($bankCardNo);
    if($strlen < 15 || $strlen > 19){
        return false;
    }
    if(!is_numeric($strlen)){
        return false;
    }
    return true;
}

//验证身份证号码
function is_idcards($vStr)
{
    $vCity = array(
        '11', '12', '13', '14', '15', '21', '22',
        '23', '31', '32', '33', '34', '35', '36',
        '37', '41', '42', '43', '44', '45', '46',
        '50', '51', '52', '53', '54', '61', '62',
        '63', '64', '65', '71', '81', '82', '91'
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
    $vLength = strlen($vStr);

    if ($vLength == 18) {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
    if ($vLength == 18) {
        $vSum = 0;

        for ($i = 17; $i >= 0; $i--) {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
        }

        if ($vSum % 11 != 1) return false;
    }
    return true;
}
//缓存操作
function saveOperationUrl($href){
    $starnum = strpos($href,"admin.php");
    if($starnum !== false) {
        $href = substr($href,$starnum + 9);
        $urlarr = explode("/", $href);

        //去除下划线
        $urlarr[0] = str_replace("_", "", $urlarr[0]);
        //去处.html
        $urlarr[1] = str_replace(".html", "", $urlarr[1]);
        //拼接
        $thisurl = $urlarr[0] . "/" . $urlarr[1];
    }else{
        $thisurl = $href;
    }
    $adminid = session('account_id');
    if($thisurl){
        $allurlarr = S('operation'.$adminid);
        if($allurlarr){
            if(!in_array($thisurl,$allurlarr)){
                $allurlarr[] = $thisurl;
            }
        }else{
            $allurlarr = array();
            $allurlarr[] = $thisurl;
        }
        S('operation'.$adminid,$allurlarr);
    }
}
function deep_in_array($value, $array) {
    foreach($array as $item) {
        if(!is_array($item)) {
            if (strcasecmp($item,$value) == 0) {
                return true;
            } else {
                continue;
            }
        }

        if(in_array($value, $item)) {
            return true;
        } else if(deep_in_array($value, $item)) {
            return true;
        }
    }
    return false;
}
?>