<?php

class Menu {
    private static $menuPool = [];

    public static function add($controller, $function, $name, $params = '', $position = 0) {
        $menuItem = [
            'route' => URLROOT . $controller . '/' . $function . '/' . $params,
            'name' => $name,
        ];

        if (count(self::$menuPool) < 1 || $position >= count(self::$menuPool)) {
            array_push(self::$menuPool, $menuItem);
        } else {
            array_splice(self::$menuPool, $position, 0, [$menuItem]);
        }
    }

    public static function get() {
        return self::$menuPool;
    }
}
