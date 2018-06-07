<?php

class loginController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function index()
    {
        $data = array();
        $this->loadView('login', $data);
    }

    public function signin() 
    {
        $data = array('msg'=>'');
        if (!empty($_POST['username']) || !empty($_POST['password'])) {
            $username = strtolower($_POST['username']);
            $password = $_POST['password'];
            if ($this->user->validateUser($username, $password)) {
                header("Location: ".BASE_URL);
                exit;
            } else {
                header("Location: ".BASE_URL."login");
                exit;
            }
        } else { 
            header("Location: ".BASE_URL."login");
            exit;
        }
    }

    public function signup()
    {
        $data = array('msg'=>'');
        if (!empty($_POST['username']) || !empty($_POST['password'])) {
            $username = strtolower($_POST['username']);
            $password = $_POST['password'];
            if ($this->user->validateUsername($username)) {
                if (!$this->user->userExists($username)) {
                    $this->user->registerUser($username, $password);
                    header("Location: ".BASE_URL."login");
                } else {
                    $data['msg'] = "Usuário já existente!";
                }
            } else {
                $data['msg'] = 'Usuário não válido (Digite apenas letras e números)!';
            }
        }
        $this->loadView('signup', $data);
    }

}