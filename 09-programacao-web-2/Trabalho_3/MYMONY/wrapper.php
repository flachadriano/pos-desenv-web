<<<<<<< Updated upstream
=======
<<<<<<< HEAD
<?php
include "include/global.php";

class wrapper {
    public function evaluate(){
        $data = json_decode(file_get_contents('php://input'));
        $class = $data->class;
        $method = $data->method;
        echo (new $class)->$method($data->params);
    }
}

wrapper::evaluate();
=======
>>>>>>> Stashed changes
<?php
include "include/global.php";

class wrapper {
    public function evaluate(){
        $data = json_decode(file_get_contents('php://input'));
        $class = $data->class;
        $method = $data->method;
        echo (new $class)->$method($data->params);
    }
}

wrapper::evaluate();
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
