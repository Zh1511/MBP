<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once('../Config/Api.php');
require_once('../Config/Lists.php');
// INPUT FUNCTION 
function htmlSelect($name, $items, $class, $selectedValue = '', $default = '')
{
    printf('<select name="%s" class="%s" id="%s">', $name, $class, $name);
    
    if ($default != null) {
        printf('<option value="">%s</option>', $default);
    }
    

    foreach($items as $value => $text)
    {
        printf('<option value="%s" %s>%s</option>',
                $value,
                $value == $selectedValue ? 'selected' : '',
                 $text
        );
    }

    echo "</select>";
}

function secondHtmlSelect($name, $items, $class, $selectedValue = '', $default = '')
{
    printf('<select name="%s" class="%s" id="%s">', $name, $class, $name);
    
    if ($default != null) {
        printf('<option value="">%s</option>', $default);
    }
    

    foreach($items as $value => $text)
    {
        printf('<option value="%s" %s>%s</option>',
                $value,
                $value === $selectedValue ? 'selected' : '',
                 $text
        );
    }

    echo "</select>";
}

function htmlInputType($type, $name, $placeholder, $value = '', $class, $maxlength = '')
{
    printf('<input type="%s" name="%s" id="%s" placeholder = "%s" class="%s" value="%s" maxlength="%s" >',
            $type, $name, $name, $placeholder, $class, $value, $maxlength);
}

function htmlCheckBox2($name, $value, $placeholder)
{
    printf('<input type="checkbox" id="%s" name="%s" value="1" %s>
            <label for="%s">
                %s
            </label>
    ',$name, $name, $value == '1' ? 'checked' : '', $name, $placeholder);
}
function htmlCheckbox($name, $value)
{
    printf('<input class="form-check-input" type="checkbox" id="%s" name="%s" value="1" %s>',$name, $name, $value == '1' ? 'checked' : '');
}

function htmlTextarea($name, $placeholder, $class, $text = '')
{
    printf('<textarea name="%s" id="%s" placeholder="%s" class="%s" rows="4" cols="50">%s</textarea>', $name, $name, $placeholder, $class, $text);
}

function htmlFormStart($action, $method, $id)
{
    printf('<form action="%s" method="%s" id="%s">', $action, $method, $id);
}

function htmlFormEnd()
{
    printf('</form>');
}
function htmlLabel($for, $class, $label)
{
    printf('<label for="%s" class="%s">
                %s
            </label>', $for, $class, $label);
}

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
    role_id IN (SELECT role_id from user_role WHERE user_id = '".$_SESSION['adminid']."')";

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




?>