<?php
declare (strict_types=1);

namespace app\index\middleware;

class Template
{
    /**
     * 处理请求
     *
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        /**
         * 处理前端模板
         */
        if (saenv('site_state')) {

            try {
                $site_mobile = saenv('site_mobile');
                $template = root_path('app/mobile/view');
                if (!empty($site_mobile) && !saenv('site_type')) {
                    $domain = parse_url($site_mobile, PHP_URL_HOST);
                    if ($domain === request()->header()['host']) {
                        app()->view->config(['view_path' => $template]);
                    }

                } else if (request()->isMobile() && saenv('site_type')) {
                    app()->view->config(['view_path' => $template]);
                }
            } catch (\Exception $e) {
            }
        }

        return $next($request);
    }
}
