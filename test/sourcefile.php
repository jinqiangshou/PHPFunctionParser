<?php
    
    abstract class A {
    
        protected $t1;
        public $t2;
        private $t3;
        
        public function __construct(){}
        
        private function func1($param) {
            echo "func1: This is for test.";
        }
        
        public function func2($param1, $param2) {
            echo "func2: This is for test.";
        }
        
        protected abstract function func3();
        
    }
    
    function add($param1, $param2){
        return $param1 + $param2;
    }
    
    interface Shop {
        public function buy($goods);
        public function sell($goods);
    }
    
