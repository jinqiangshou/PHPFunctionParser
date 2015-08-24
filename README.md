# PHPFunctionParser
本项目中提供了一个PHP类，用于静态解析PHP源代码文件，将源代码中所定义的所有函数或类方法解析出来，以数组的形式输出。解析出的内容包括函数名（方法名），起始行号，终止行号。可以很方便的运用在项目中。

## 使用方法

在test目录下的`test.php`脚本中给出了使用的例子。该类可能会抛出`RuntimeException`，所以使用时记得将其包含在`try catch`语句中。

本例中，`test.php`内容如下

    <?php
        require_once("../PHPFuncParser.php");

        $content = file_get_contents("sourcefile.php");
        
        try {
            $parser = new PHPFuncParser($content);
            $result = $parser -> process();
            print_r($result);
        } catch (RuntimeException $e) {
            print($e->getMessage());
            exit(1);
        }

运行`test.php`可以得到如下结果

    Array
    (
        [A::__construct] => Array
            (
                [0] => 9
                [1] => 9
            )

        [A::func1] => Array
            (
                [0] => 11
                [1] => 13
            )

        [A::func2] => Array
            (
                [0] => 15
                [1] => 19
            )

        [add] => Array
            (
                [0] => 25
                [1] => 27
            )
    )

如果是全局函数，则直接显示为函数名，如果定义在类中，则显示为 `类名::函数名` 的格式。 注意，`interface`和`abstract function`不计算为函数定义，因为其只有声明，没有函数实现。

## 原理

利用PHP `tokenizer` 将源代码转为token数组，并依次读取每一个token。借鉴有限状态机的原理实现函数识别。读取token过程中根据条件实时转换状态。状态共有7种：

 - 初始状态 (init)
 - 碰到函数定义 (meet function)
 - 在函数内部 (in function)
 - 碰到类定义 (meet class)
 - 在类内部 (in class)
 - 碰到类方法定义 (meet method)
 - 在类方法内部 (in method)

本项目中的PHP类主要实现了这一状态机，并通过状态转变来判断函数（方法）定义和函数（方法）位置。

## 注意事项

 - 目前暂不支持`namespace`，默认在全局命名空间下。
 - 本工具只负责解析源代码中定义的函数，但不负责语法检查。使用前需保证待检查的源代码是没有语法错误的，否则可能会抛出`RuntimeException`或其他错误。
