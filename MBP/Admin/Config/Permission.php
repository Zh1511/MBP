<?php
session_start();
    require_once('../Config/Api.php');

function appSetting($v)
{
    $sql = "SELECT * FROM settings WHERE setting_name = '$v'";
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $conn->query($sql);
    $settingValue = '';
    if ($row = $result->fetch_object()){
        $settingValue = $row->setting_value;
    }
    else {
        $settingValue = null;
    }
    return $settingValue;

}

function isModuleMemberEnabled()
{
    $enable = appSetting('ENABLE_MODULE_MEMBER');
    if($enable == 1)
    return $enable == 1 ? true : false;
}

function isEnabled($v)
{
    $enable = appSetting($v);
    return $enable == 1 ? true : false;
}

function can($permission_code)
{
    $sql = "SELECT * FROM role_permission WHERE
    permission_code = '$permission_code' AND    
    status = '1' AND
    role_id IN (SELECT role_id from user_role WHERE user_id = '".$_SESSION['id']."')";

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $conn->query($sql);
    $id = '';
    if ($row = $result->fetch_object()){
        return true;
    }
    else{
        return false;
    }
}