<?php 

class HomeController extends Controller {

    private $users;

    public function __construct(){
        parent::__construct();
        //$this->users = load("models","Users");
    }

    public function index(){
        return $this->view('index.html',[
            'name' => 'Andi Muqsith Ashari'
        ]);
    }

}