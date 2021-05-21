<?php
/**
 * Created by PhpStorm.
 * User: yinhuakeji
 * Date: 2/3/17
 * Time: 7:19 PM
 */
namespace bootstrap;

class Route
{
    protected $pattern = '/\/{\w+}/';

    public function get($uri, $action)
    {
        $instance = new static();
        return $instance->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute(['POST'], $uri, $action);
    }

    protected function addRoute($methods, $uri, $action)
    {
        $controller = $this->resolveController($action);
        $action = $this->resolveAction($action);
        if ($this->parseRouteUri($uri) === $this->parseHttpUri()) {
            return call_user_func_array([$controller, $action], $this->resolveHttpParams($uri));
        }
    }

    protected function resolveController($action)
    {
        return "\\Controllers\\" . substr($action, 0, strpos($action, '@'));
    }

    protected function resolveAction($action)
    {
        return substr($action, strpos($action, '@') + 1, strlen($action));
    }

    protected function parseRouteUri($uri)
    {
        return preg_replace($this->pattern, null, $uri);
    }

    protected function parseHttpUri()
    {
        preg_match_all('/\/\w*/', $_SERVER['REQUEST_URI'], $result);
        return $result[0][0];
    }

    protected function resolveHttpParams($uri)
    {
        $httpParams = [];
        preg_match_all('/\/{(.*?)}/', $uri, $routeParamResult);
        $routeParams = $routeParamResult[1];
        preg_match_all('/\/\w*/', $_SERVER['REQUEST_URI'], $result);
        $params = $result[0];
        for ($i = 1; $i < count($result[0]); $i++) {
            $httpParams[$routeParams[$i - 1]] = str_replace('/', null, $params[$i]);
        }
        return $httpParams;
    }

}