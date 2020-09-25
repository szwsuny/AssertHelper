<?php
/**
 *   Copyright (C) 2020 All rights reserved.
 *
 *   FileName      ：index.php
 *   Author        ：sunzhiwei
 *   Email         ：xue5521@qq.com
 *   Date          ：2020年09月25日
 *   Description   ：
 *   Tool          ：vim 8.2
 */

use SzwSuny\assert\AssertHelper;

require __DIR__ . '/../vendor/autoload.php';

$bool = AssertHelper::validate('15610113211x')->empty('电话号码不能为空')->mobile('电话号格式不正确')->bool($msg);
//return false
//msg = '电话号格式不正确'

echo $msg;

try 
{
    AssertHelper::validate(null)->email('邮件格式不正确')->throws();
    //throw Exception
} catch(\Exception $e)
{
    var_dump($e);
}
