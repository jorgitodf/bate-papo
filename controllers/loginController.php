<?php

class loginController extends Controller
{

    public function index()
    {
        $data = array();
        $this->loadView('login', $data);
    }

}