<?php

class Session
{
    protected static $id = null;

    public static function start ()
    {
        session_cache_limiter(false);
        session_start();
        static::$id = session_id();
    }

    public static function regenerate ($deleteOldSession = false)
    {
        session_regenerate_id($deleteOldSession);
        static::$id = session_id();
    }

    public static function destroy ()
    {
        $_SESSION = array();
        session_destroy();
        static::$id = null;
    }

    public static function write ($key, $value = null)
    {
        if ($value === null) $value = true;
        $_SESSION[$key] = $value;
    }

    public static function read ($key)
    {
        if (! static::check([$key])) return null;
        return $_SESSION[$key];
    }

    public static function check ($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function delete ($key)
    {
        if (static::check($key)) unset($_SESSION[$key]);
    }

    public static function id ()
    {
        return static::$id;
    }
}