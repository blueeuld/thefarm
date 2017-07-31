<?php

class PropelLib {

    function __construct()
    {
        define('DS', DIRECTORY_SEPARATOR);

//        set_include_path(get_include_path().PATH_SEPARATOR.APPPATH.'models');

        require APPPATH.'vendor/propel/propel/src/Propel/Runtime/Propel.php';

        \Propel\Runtime\Propel::init(APPPATH.DS.'Data/generated-conf'.DS.'config.php');
    }

}