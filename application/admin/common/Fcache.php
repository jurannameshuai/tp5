<?php
class fcache{
    private $options =[
            'type'  =>  'File',
            'expire'=>  0,
            'prefix'=>  'think',
            'path'  =>  'runtime/cache/',
        ];
//Cache::connect($options);

}