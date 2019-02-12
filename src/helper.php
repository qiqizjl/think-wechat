<?php
/**
 * @author 耐小心<i@naixiaoxin.com>
 * @copyright 2017-2018 耐小心
 */

//加入Hook
\think\facade\Hook::add('app_init', \Naixiaoxin\ThinkWechat\Behavior\AppInit::class);