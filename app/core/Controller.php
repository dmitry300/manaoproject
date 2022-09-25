<?php

namespace app\core;

abstract class Controller
{
    public $route;
    public $view;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }
    public function loadModel($name) {
        $path = 'app\models\service\\'.ucfirst($name).'ServiceImpl';
        if (class_exists($path)) {
            return new $path;
        }else {
            return null;
        }
    }

}