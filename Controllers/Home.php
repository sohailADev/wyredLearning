<?php
/**
 * Created by PhpStorm.
 * Users: sohail
 * Date: 1/22/2018
 * Time: 2:46 PM
 */
class  Home extends BaseController
{
    public function __construct()
    {
//        $this->postModel = $this->model('post');
    }
    public function index()
    {
        if (isLogedIn())
        {
            redirect('Posts/index');
        }
       $this->view('Home/index', ['title' => 'Welcome']);
    }
    public function about()
    {
        $this->view('Home/about',['title' => ' About']);
    }
}