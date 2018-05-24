# thinkphp-wechat
微信SDK For ThinkPHP 5.1+ 基于[overtrue/wechat](https://github.com/overtrue/wechat)

## 框架要求
ThinkPHP5.1+(中间件要求支持ThinkPHP5.1.6+)

## 安装
~~~
composer require naixiaoxin/think-wechat 
~~~

## 配置
1. 发送配置文件
~~~
php think  wechat:config
~~~

2. 修改配置文件
修改项目根目录下config/wechat.php中对应的参数

3. 每个模块基本都支持多账号，默认为 default。
  
