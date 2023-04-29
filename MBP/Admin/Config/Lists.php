<?php
require_once('Api.php');
function lists_status(){
    $option = [
        1 => 'Active',
        0 => 'Inactive'
    ];

    return $option;
}

function lists_faculty(){
    $faculty = [
        'FAFB' => 'Faculty Of Accountancy, Finance AND Business',
        'FOAS' => 'Faculty of Applied Science',
        'FCCI' => 'Faculty of Communication And Creative Industries',
        'FOBE' => 'Faculty of Business Environment',
        'FOCS' => 'Faculty of Computing and Information Technology',
        'FOET' => 'Faculty of Engineering and Technology',
        'FSSH' => 'Faculty of Social Science And Humanities'
    ];

    return $faculty;
}

function lists_gender()
{
    $arr = [
        1 => 'Male',
        0 => 'Female',
    ];
    return $arr;
}

function list_status()
{
    $arr = [
        1 => 'Active',
        0 => 'Inactive',
    ];
    return $arr;
}

function filterDailyRegistration()
{
    $arr = [
        'CurrentYear' => 'Current Year',
        'LastYear' => 'Last Year',
        'Last2Year' => 'Last 2 Year',
        'Last3Year' => 'Last 3 Year',
    ];
    return $arr;
}
function statusIcon($val)
{
    if ($val == 1) {
        return '<i class="fas fa-check" value="1" title="Active" style="color:#41E47A"  ></i>';
    }
    return '<i class="fas fa-x" title="Not Active" value="0" style="color:#ff0101"  ></i>';
}

function genderIcon($gender)
{
    if($gender == 1)
    {
        return "<i class='fas fa-male' value='1' title='Male' style='color:#2196f3'></i>";
    }
    return "<i class='fas fa-female' value='0' title='Female' style='color:#ea098f'></i>";
}
function checkEmpty($val)
{
    if ($val == '' || empty($val) || $val == null) {
        return '-';
    }
    return $val;
}

function returnMonthWithSingleQuote($v)
{
    if($v == 01)
    {
        return "'Jan'";
    }
    elseif($v == 02)
    {
        return "'Feb'";
    }
    elseif($v == 03)
    {
        return "'Mar'";
    }
    elseif($v == 04)
    {
        return "'Apr'";
    }
    elseif($v == 05)
    {
        return "'May'";
    }
    elseif($v == 06)
    {
        return "'Jun'";
    }
    elseif($v == 07)
    {
        return "'Jul'";
    }
    elseif($v == '08')
    {
        return "'Aug'";
    }
    elseif($v == '09')
    {
        return "'Sep'";
    }
    elseif($v == 10)
    {
        return "'Oct'";
    }
    elseif($v == 11)
    {
        return "'Nov'";
    }

    return "'Dec'";
}
function returnMonth($v)
{
    if($v == 01)
    {
        return "Jan";
    }
    elseif($v == 02)
    {
        return "Feb";
    }
    elseif($v == 03)
    {
        return "Mar";
    }
    elseif($v == 04)
    {
        return "Apr";
    }
    elseif($v == 05)
    {
        return "May";
    }
    elseif($v == 06)
    {
        return "Jun";
    }
    elseif($v == 07)
    {
        return "Jul";
    }
    elseif($v == '08')
    {
        return "Aug";
    }
    elseif($v == '09')
    {
        return "Sep";
    }
    elseif($v == 10)
    {
        return "Oct";
    }
    elseif($v == 11)
    {
        return "Nov";
    }

    return "Dec";
}

function lists_salutation()
{
    // $data = [
    //     'Mr' => 'Mr',
    //     'Ms' => 'Ms',
    //     'Mrs' => 'Mrs',
    //     'Dr' => 'Dr',
    //     'Mdm' => 'Mdm'
    // ];

    // if (isModuleChurchEnabled()) {
        $data = [
            "Rt. Rev. Dr.",
            "The Rt. Rev",
            "The Very Rev",
            "Canon",
            "Rev",
            "Dr",
            "Ven.",
            "Tan Sri",
            "Puan Sri",
            "Datuk",
            "Datin",
            "Mr.",
            "Mrs.",
            "Mdm",
            "Ms.",
        ];
    // }

    return array_combine($data, $data);
}

function list_nationality()
{
    $arr = [
        1 => 'Uzbekistani',
        2 => 'Malaysian'
    ];

    return $arr;
}

function martial_status()
{
    $arr = [
        "Single",
        "Married",
        "Meparated",
        "Divorced",
        "Widowed",
        "Annulled"
    ];

    return array_combine($arr, $arr);
}