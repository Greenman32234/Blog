<?php
class Route
{
    /**
     * @var array|string[]
     */
    public static array $param;
    public static function uri (string $url, string $ClassMethod)
    {

        self::$param = explode('@', $ClassMethod);
        if (count(self::$param) > 1) {
            self::error404();
        } else {
            $file = "App/". self::$param[0] . ".php";
            include $file;
        }

        if ($_SERVER['REQUEST_URI'] == $url) {
        self::query_class();
        } else self::error404();

    }
    public static function query_class ()
    {
        $class = self::$param[0];
        if (! class_exists($class)) {
            $class = new $class();
            var_dump($class);
            self::query_method($class);
        } else self::error404();

    }
    public static function query_method (object $class)
    {
        $method = self::$param[1];
        if (method_exists($class, $method)){
            $class->$method();
        }

    }
    public static function error404 ()
    {
        header("HTTP/1.1 404 Not Found");
    }
}