<?php
namespace attempts\support;

trait singleton {
    private static $instance;
    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self;
        }
        return self::$instance;
    }
}