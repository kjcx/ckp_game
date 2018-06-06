<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/6
 * Time: 下午6:19
 */

namespace App\HttpController;
    use EasySwoole\Config;
    use EasySwoole\Core\Http\AbstractInterface\Controller;
    use EasySwoole\Core\Http\Request;
    use EasySwoole\Core\Http\Response;
    /**
     * 视图控制器
     * Class ViewController
     * @author  : evalor <master@evalor.cn>
     * @package App
     */
abstract class SmartViewController extends Controller
{
    protected $view;

    /**
     * 初始化模板引擎
     * ViewController constructor.
     * @param string   $actionName
     * @param Request  $request
     * @param Response $response
     */
    function __construct(string $actionName, Request $request, Response $response)
    {
        $this->view = new \Smarty();
        $tempPath   = Config::getInstance()->getConf('TEMP_DIR');    # 临时文件目录
        $this->view->setCompileDir("{$tempPath}/templates_c/");      # 模板编译目录
        $this->view->setCacheDir("{$tempPath}/cache/");              # 模板缓存目录
        $this->view->setTemplateDir(EASYSWOOLE_ROOT . '/Views/');    # 模板文件目录
        $this->view->setCaching(false);

        parent::__construct($actionName, $request, $response);
    }

    /**
     * 输出模板到页面
     * @param  string|null $template 模板文件
     * @author : evalor <master@evalor.cn>
     * @throws \Exception
     * @throws \SmartyException
     */
    function fetch($template = null)
    {
        $content = $this->view->fetch($template);
        $this->response()->write($content);
        $this->view->clearAllAssign();
        $this->view->clearAllCache();
    }

    /**
     * 添加模板变量
     * @param array|string $tpl_var 变量名
     * @param mixed        $value   变量值
     * @param boolean      $nocache 不缓存变量
     * @author : evalor <master@evalor.cn>
     */
    function assign($tpl_var, $value = null, $nocache = false)
    {
        $this->view->assign($tpl_var, $value, $nocache);
    }
}
