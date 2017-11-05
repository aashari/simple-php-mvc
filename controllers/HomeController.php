<?php 

class HomeController extends Controller {

    private $users;

    public function __construct(){
        $this->users = load("models","Users");
    }

    public function index(){
        return view("home");
    }

}