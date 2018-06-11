<?php

class ajaxController extends Controller
{
    private $user;
    private $groups;

    public function __construct()
    {
        $this->user = new Users();
        $this->groups = new Groups();

        if (!$this->user->verifyLogin()) {
            $array = array('status'=>'0');
            echo json_encode($array);
            exit;
        }
    }

    public function index()
    {
    }

    public function getGroups()
    {
        $array = array('status'=>'1');
        $array['groups'] = $this->groups->getListGroups();
        echo json_encode($array);
        exit;
    }

}