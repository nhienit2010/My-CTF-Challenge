<?php

require_once 'config.php';

class Color {
    public $str;
    public $color;

    public function __construct($str, $color) {
        $this->str = $str;
        $this->color = $color;
    }

    public function __toString() {
        return "<p><span style=\"color:$this->color;\">$this->str</span></p>";

    }
}


class Red extends Color {
    public $str;
    public $color;

    public function __construct($str) {
        $this->str = $str;
        $this->color = "red";
    }
}   


class Green extends Color {
    public $str;
    public $color;

    public function __construct($str) {
        $this->str = $str;
        $this->color = "green";
    }
}   
class Blue extends Color {
    public $str;
    public $color;

    public function __construct($str) {
        $this->str = $str;
        $this->color = "blue";
    }
}


?>