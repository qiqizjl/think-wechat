<?php
/**
 * 配置文件
 *
 * @author 耐小心<i@naixiaoxin.com>
 * @copyright 2017-2018 耐小心
 */

return [
    'default'          => [
        //是否使用ThinkPHPCache
        'use_tp_cache' => true,
    ],
    'official_account' => [
        'default' => [
            'app_id'  => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'your-app-id'),         // AppID
            'secret'  => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'your-app-secret'),    // AppSecret
            'token'   => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'your-token'),           // Token
            'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey¬
        ],
    ],
];
