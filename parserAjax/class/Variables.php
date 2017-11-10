<?php
class Variables
{
    private static $m_instance = NULL;
    private $m_variables = array('pi' => M_PI);

    private function __construct()
    {
        if(isset($_SESSION['parser']['var']))
            $this->m_variables = $_SESSION['parser']['var'];
    }

    public function __destruct()
    {
        $_SESSION['parser']['var'] = $this->m_variables;
    }

    private static function getInstance()
    {
        if(!isset(self::$m_instance))
            self::$m_instance = new Variables;
        return self::$m_instance;
    }
    
    public static function get($name)
    {
        if(isset(self::getInstance()->m_variables[$name]))
        {
            return self::getInstance()->m_variables[$name];
        }
        throw new LogicException('Access to undefined variable ' . $name, 400);
    }
    
    public static function set($name, $value)
    {
        self::getInstance()->m_variables[$name]=$value;
    }

    public static function reset($name, $value)
    {
        self::$m_instance = NULL;
        unset($_SESSION['parser']['var']);
    }
}