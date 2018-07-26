<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace Naixiaoxin\ThinkWechat\Command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Config extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('wechat:config')
            ->setDescription('send wechat config to config dir');
    }

    protected function execute(Input $input, Output $output)
    {
        if (file_exists(env('config_path') . 'wechat.php')) {
            $output->error('file is exist');
            return;
        }
        $fileContent = file_get_contents(env('vendor_path') . 'naixiaoxin/think-wechat/src/config.php');
        file_put_contents(env('config_path') . 'wechat.php', $fileContent);
        $output->info('send success');
        return;
    }
}
