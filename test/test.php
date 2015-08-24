<?php
    require_once("../PHPFuncParser.php");
    
    $content = file_get_contents("sourcefile.php");
    
    try {
        $parser = new PHPFuncParser($content);
        $result = $parser->process();
        print_r($result);
    } catch(RuntimeException $e){
        print($e->getMessage());
        exit(1);
    }
