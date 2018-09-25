<?php
/**
 * php装饰器
 *
 * 目前有个很大的bug, 执行某个类的时候如果该类中有die var_dump 等语句则无法实现, 只能实现标准的 return
 *
 *
 */

class DecoratorException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if (php_sapi_name() != 'cli') {
            parent::__construct($message, $code, $previous);
        } else {
            exit($message . PHP_EOL);
        }
    }
}

/**
 * Decorator for php
 *
 * Author: Ricardo Cao
 *
 * Notes:
 *  1. base on Reflection
 *  2. Exception Type: Exception
 */
abstract class Decorator
{
    public $modules;

    public $name;

    public $arguments;

    /**
     * decorator constructor.
     * Construct Modules
     * @param $modules
     */
    public function __construct(string $modules)
    {
        $this->modules = $modules;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws DecoratorException
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this->modules, $name)) {
            throw new DecoratorException('Method No Exists!\n\r');
        }

        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * call method
     *
     * @throws DecoratorException
     */
    protected function call()
    {
        if (empty($this->modules)) {
            throw new DecoratorException("Empty Modules");
        }

        if (empty($this->name)) {
            throw new DecoratorException("Empty Name");
        }

        if (empty($this->arguments)) {
            throw new DecoratorException("Empty Arguments");
        }

        if (!method_exists($this->modules, $this->name)) {
            throw new DecoratorException("Method no exists");
        }

        $params = $this->getMethodParameter($this->modules, $this->name, $this->arguments);
        if (empty($params)) {
            throw new DecoratorException("Empty Params");
        }
        $this->arguments = $params;

        return call_user_func_array(array($this->modules, $this->name), $this->arguments);
    }

    /**
     * @param string $class
     * @param string $name
     * @param array $params
     * @return array
     */
    private function getMethodParameter(string $class, string $name, $params = []): array
    {
        if (!is_array($params)) {
            $params = [$params];
        }

        $depend = [];
        try {
            $reflection = new \ReflectionMethod($class, $name);

            foreach ($reflection->getParameters() as $value) {
                if (isset($params[$value->name])) {
                    $depend[] = $params[$value->name];
                } elseif ($value->isDefaultValueAvailable()) {
                    $depend[$value->name] = $value->getDefaultValue();
                }
            }
        } catch (ReflectionException $e) {

        }

        return $depend;
    }
}