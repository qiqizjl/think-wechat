# thinkphp-wechat
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fqiqizjl%2Fthink-wechat.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fqiqizjl%2Fthink-wechat?ref=badge_shield)

微信SDK For ThinkPHP 5.1+ 基于[overtrue/wechat](https://github.com/overtrue/wechat)

## 框架要求
ThinkPHP5.1+(中间件要求支持ThinkPHP5.1.6+)

## 安装
~~~
composer require naixiaoxin/think-wechat 
~~~

## 配置
1. 修改配置文件
修改项目根目录下config/wechat.php中对应的参数

2. 每个模块基本都支持多账号，默认为 default。
  

## 使用
### 接受普通消息
新建一个Controller，我这边用的是Note
```php
<?php

namespace app\wechat\controller;


use think\Controller;

class Note extends Controller
{

    public function index()
    {
        //    先初始化微信
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return 'hello,world';
        });
        $app->server->serve()->send();
    }
}
```
### 获得SDK实例
#### 使用facade
```php
use Naixiaoxin\ThinkWechat\Facade;

$officialAccount = Facade::officialAccount();  // 公众号
$work = Facade::work(); // 企业微信
$payment = Facade::payment(); // 微信支付
$openPlatform = Facade::openPlatform(); // 开放平台
$miniProgram = Facade::miniProgram(); // 小程序  
```
以上均支持传入自定义账号:例如
```php
$officialAccount = Facade::officialAccount('test'); // 公众号
```

以上均支持传入自定义账号+配置(注:这里的config和配置文件中账号的格式相同):例如
```php
$officialAccount = Facade::officialAccount('',$config); // 公众号
```

### Oauth登录中间件(ThinkPHP5.1.6+)
使用中间件情况下，config的oauth.callback可以随便写~，反正是直接获取了当前URL
```php
\think\facade\Route::rule('user','usere')->middleware(\Naixiaoxin\ThinkWechat\Middleware\OauthMiddleware::class);
```

上面的路由定义了 /user 是需要微信授权的，那么在这条路由的回调 或 控制器对应的方法里， 你就可以从 session('wechat.oauth_user.default') 拿到已经授权的用户信息了。


关于ThinkPHP5.1的中间件使用方法不在叙述，详情可以查看[官方文档](https://www.kancloud.cn/manual/thinkphp5_1/564279)

#### 中间件参数说明
由于ThinkPHP中间件只支持一个参数，所以以`:`做分割

支持传入account账号别名以及scope类型

若不传入`account`，会使用`default`账号

若不传入`scope`，会使用配置文件中的`oauth.scope`

支持一下两种方式
```
default:snsapi_base
snsapi_base
```

### HOOK
> 你可以监听相应的事件，并对事件发生后执行相应的操作。
- OAuth授权 `wechat_oauth`

```php
// 该事件有以下属性
$params['user']; // 同 session('wechat.oauth_user.default') 一样
$params['is_new']; // 是不是新的会话（第一次创建 session 时为 true）
```
更多 SDK 的具体使用请参考：https://easywechat.com

## 参考项目
- [overtrue/laravel-wechat](https://raw.githubusercontent.com/overtrue/laravel-wechat)

## License

MIT

[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fqiqizjl%2Fthink-wechat.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fqiqizjl%2Fthink-wechat?ref=badge_large)