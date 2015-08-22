<?php

function getVal($key) {
    print $_POST[$key];
    if (isset($_GET[$key])) {
        return trim(strip_tags($_GET[$key]));
    } else {
        if (isset($_POST[$key])) {
            return trim(strip_tags($_POST[$key]));
        } else
            return null;
    }
}

class wrapper {
    public function evaluate(){       
        $class = getVal('cliente');
        $method = getVal('method');
    }
}

(new wrapper())->evaluate();