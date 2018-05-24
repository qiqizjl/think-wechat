<?php
/**
 *
 *
 * @author 耐小心<i@naixiaoxin.com>
 * @copyright 2017-2018 耐小心
 */

namespace Naixiaoxin\ThinkWechat\Middleware;

use EasyWeChat\OfficialAccount\Application;
use think\facade\Hook;
use think\facade\Log;
use think\Request;
use think\facade\Session;

class OauthMiddleware
{
    /**
     * 执行中间件
     *
     * @param Request    $request
     * @param \Closure   $next
     * @param string     $name
     * @param null|array $scopes
     */
    public function handle(Request $request, \Closure $next, $name = "default", $scopes = null)
    {
        if ($name == null) {
            $name = 'default';
        }
        //定义session
        $session_key = 'wechat_oauth_user_' . $name;
        $session     = Session::get($session_key);
        /** @var Application $officialAccount */
        $officialAccount = app(\sprintf('wechat.official_account.%s', $name));
        Log::info(json_encode($session));
        if (!$session) {
            if ($request->get('code')) {
                $session = $officialAccount->oauth->user();
                Session::set($session_key, $session);
                Hook::listen('wechat_oauth', [
                    'user'   => $session,
                    'is_new' => true,
                ]);
                //跳转到登录
                Log::info($this->getTargetUrl($request));
                return redirect($this->getTargetUrl($request));
            }
            $url = $officialAccount->oauth->redirect($request->url(true))->getTargetUrl();
            return redirect($url);
        }
        Hook::listen('wechat_oauth', [
            'user'   => $session,
            'is_new' => false,
        ]);
        return $next($request);
    }

    /**
     * Build the target business url.
     *
     * @param Request $request
     *¬
     * @return string
     */
    protected function getTargetUrl($request)
    {
        $param = $request->get();
        if(isset($param['code'])){
            unset($param['code']);
        }
        if(isset($param['state'])){
            unset($param['state']);
        }
        return $request->baseUrl() . (empty($param) ? '' : '?' . http_build_query($param));
    }
}