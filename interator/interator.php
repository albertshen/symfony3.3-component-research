<?php

 
function xrange($start, $limit, $step = 1) {  
    for ($i = $start; $i <= $limit; $i += $step) {  
        yield $i;  
    }  
}  
  
echo 'Single digit odd numbers: ';  
  
/* 注意保存在内存中的数组绝不会被创建或返回 */  
foreach (xrange(1, 9, 2) as $number) {  
    echo "$number ";  
}   

exit;
class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );  

    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    function current() {
        var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    function valid() {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}