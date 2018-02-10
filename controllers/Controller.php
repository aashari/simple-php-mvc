<?php 

class Controller {

    public $twig;

    function __construct(){
        $viewLoader = new Twig_Loader_Filesystem("../views");
        $this->twig = new Twig_Environment($viewLoader,[
            'cache' => '../cache',
            'debug' => true
        ]);
    }

    protected function view($file,$data){
        $template = $this->twig->load($file);
        return $template->render($data);
    }

}