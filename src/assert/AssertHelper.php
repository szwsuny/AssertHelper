<?php
/**
 *   Copyright (C) 2020 All rights reserved.
 *
 *   FileName      ：AssertHelper.php
 *   Author        ：sunzhiwei
 *   Email         ：xue5521@qq.com
 *   Date          ：2020年09月25日
 *   Description   ：
 *   Tool          ：vim 8.2
 */

namespace SzwSuny\assert;

class AssertHelper
{
    protected $value = null;
    protected $isbool = true;
    protected $msg = '';

    protected function __construct($value)
    {
        $this->value = trim($value);
    }

    public static function validate($value):AssertHelper
    {
        return new AssertHelper($value);
    }

    protected function validatefunc($call)
    {
        if($this->isbool)
        {
            $call();
        }

        return $this;
    }

    public function empty(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(empty($this->value))
            {
                $this->isbool = false;
                $this->msg = $msg ?? '值不能为空';
            }
        });
    }

    public function int(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(false === filter_var($this->value,FILTER_VALIDATE_INT)){
                $this->isbool = false;
                $this->msg = $msg ?? '值只能为整数';
            }
        });
    }

    public function in(array $array,?string $msg = null)
    {
        return $this->validatefunc(function() use ($array,$msg){
            if(!isset(array_flip($array)[$this->value])){
                $this->isbool = false;
                $this->msg = $msg ?? '值不在要求范围内';
            }
        });
    }

    public function mobile(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(!preg_match("/^1[35678]\d{9}$/",$this->value)){
                $this->isbool = false;
                $this->msg = $msg ?? '手机号格式不正确';
            }
        });
    }

    public function length(int $length,?string $msg = null)
    {
        return $this->validatefunc(function() use ($length,$msg){
            if(strlen($this->value) != $length){
                $this->isbool = false;
                $this->msg = $msg ?? '文字长度必须为'.$length;
            }
        });
    }

    public function length_between(int $max,int $min,?string $msg = null)
    {
        return $this->validate(function() use ($max,$min,$msg) {
            $strlen = strlen($this->value);
            if($strlen < $min || $strlen > $max){
                $this->isbool = false;
                $this->msg = $msg ?? '文字长度范围只能为'.$min.'到'.$max.'之间';
            }
        });
    }

    public function mb_length(int $length,?string $msg = null)
    {
        return $this->validatefunc(function() use ($length,$msg){
            if(mb_strlen($this->value) != $length){
                $this->isbool = false;
                $this->msg = $msg ?? '文字长度必须为'.$length;
            }
        });
    }

    public function mb_length_between(int $max,int $min,?string $msg = null)
    {
        return $this->validate(function() use ($max,$min,$msg) {
            $strlen = mb_strlen($this->value);
            if($strlen < $min || $strlen > $max){
                $this->isbool = false;
                $this->msg = $msg ?? '文字长度范围只能为'.$min.'到'.$max.'之间';
            }
        });
    }

    public function email(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(!filter_var($this->value,FILTER_VALIDATE_EMAIL)){
                $this->isbool = false;
                $this->msg = $msg ?? 'email格式不正确';
            }
        });
    }

    public function float(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(!filter_var($this->value,FILTER_VALIDATE_FLOAT)){
                $this->isbool = false;
                $this->msg = $msg ?? '值必须为小数';
            }
        });
    }

    public function ip(?string $msg = null)
    {
        return $this->validatefunc(function() use ($msg){
            if(!filter_var($this->value,FILTER_VALIDATE_IP)){
                $this->isbool = false;
                $this->msg = $msg ?? 'ip格式不正确';
            }
        });
    }


    public function between(int $min,int $max,?string $msg= null)
    {
        return $this->validatefunc(function() use ($min,$max,$msg){
            if($this->value < $min || $this->value > $max)
            {
                $this->isbool = false;
                $this->msg = $msg ?? '值的范围只能为'.$min.'到'.$max.'之间';
            }
        });
    }

    public function bool(?string &$msg = null):bool
    {
        $msg = $this->msg;
        return $this->isbool;
    }

    public function throws()
    {
        if(!$this->isbool)
        {
            throw new \Exception($this->msg,19880516);
        }
    }
}
