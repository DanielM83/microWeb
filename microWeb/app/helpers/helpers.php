<?php

function pre($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function flashMessage(string $name = '', string $message = '', string $class = 'alert alert-success') {
    if (!empty($name) && !empty($message) && empty($_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    } elseif (!empty($name) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
        echo '<div style="text-align: center;" class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
    }
}

