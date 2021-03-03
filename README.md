# AssertHelper

### 使用方式
#### 1. AssertHelper::valudate($value)->empty('如果为空的异常信息')->throws();
    //throw Exception
#### 2. $result = AssertHelper::validate('1332233122x')->empty('如果为空的异常信息')->mobile('手机号格式不正确')->bool($msg);
   // $result = false
   // $msg = '手机号格式不正确'

### 可以使用的

#### 1.empty 验证空
#### 2.int 验证数字
#### 3.in 验证包含在数组中
#### 4.mobile 验证手机号
#### 5.length 验证长度
#### 6.mb_length 验证中文长度
#### 7.length_between 验证长度范围
#### 8.mb_length_between 验证中文长度范围
#### 9.email 验证邮箱
#### 10.float 验证小数
#### 11.ip 验证ip
#### 12.between 验证数字范围
#### 13.equal 验证等于的值
#### 14.greater 验证大于的值
#### 15.less 验证小于的值

### 结束使用

#### 1.throws throw一个异常
#### 2.bool 返回一个bool值
