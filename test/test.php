<?php
    require_once("../PHPFuncParser.php");
    
    $content = file_get_contents("sourcefile.php");
    
    $parser = new PHPFuncParser($content);
    $result = $parser->process();
    
    print_r($result);
