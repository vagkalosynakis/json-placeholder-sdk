<?php

namespace Vkal;

class Config {
    public static $items = array();

    public static function load(): void
    {
        static::$items = include('Config/Settings.php');
    }
    
    public static function get(?string $key = null): mixed
    {
        static::load();
        $keys = explode('.', $key);
        $value = static::$items;

        foreach ($keys as $nestedKey) {
            if (isset($value[$nestedKey])) {
                $value = $value[$nestedKey];
            } else {
                return null;
            }
        }

        return $value;
    }

}
