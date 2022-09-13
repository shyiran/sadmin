<?php

namespace app;

use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Response;
use Throwable;
use app\common\model\system\SystemLog;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        if (saenv('system_exception') && !empty($e->getMessage())) {

            $exception = [
                'module'        => app()->http->getName(),
                'controller'    => request()->controller(true),
                'action'        => request()->action(true),
                'params'        => serialize(request()->param()),
                'method'        => request()->method(),
                'url'           => request()->baseUrl(),
                'ip'            => request()->ip(),
                'name'          => session('AdminLogin.name'),
            ];

            if (empty($exception['name'])) {
                $exception['name'] = 'system';
            }

            $exception['type'] = 1;
            $exception['file'] = $e->getFile();
            $exception['line'] = $e->getLine();
            $exception['error'] = $e->getMessage();
            SystemLog::write($exception);
        }

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}
