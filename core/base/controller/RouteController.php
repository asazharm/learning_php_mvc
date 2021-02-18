<?php /** @noinspection ALL */


namespace core\base\controller;


use core\base\exceptions\RouteException;
use core\base\settings\Settings;
use core\base\settings\ShopSettings;


class RouteController
{
    static private $_instance;

    protected $routes;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parametrs;

    private function __clone(){}

    static public function getInstance(){
        if (self::$_instance instanceof self){
            return self::$_instance;
        }
        return self::$_instance = new self;
    }

    private function __construct(){
        $address_str = $_SERVER['REQUEST_URI'];

        if(strrpos($address_str, '/') === strlen($address_str) - 1 && strrpos($address_str, '/') !== 0){
            $this->redirect(rtrim($address_str, '/'), 301);
        }
        $path = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], 'index.php'));

        if($path === PATH){

            $this->routes = Settings::get('routes');

            if(!$this->routes) throw new RouteException('The site is under maintenance');

            if(strrpos($address_str, $this->routes['admin']['alias']) === strlen(PATH)){

            }else{
                $url = explode('/', substr($address_str, strlen(PATH)));
                $hrUrl = $this->routes['routes']['hrUrl'];
                $this->controller = $this->routes['user']['path'];
                $route = 'user';
            }

            $this->createRoute($route, $url);
            exit();

        }else{
            try {
                throw new \Exception('Incorrect site directory ');
            }catch (\Exception $e){
                exit($e ->getMessage());
            }
        }
    }
    private function createRoute($var, $arr){
        $route = [];

        if (!empty($arr[0])){
            if ($this->routes[$var]['routes'][$arr[0]]){
                $route = explode('/',);

            }
        }
    }
}