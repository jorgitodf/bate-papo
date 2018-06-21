<?php

class ajaxController extends Controller
{
    private $user;
    private $groups;
    private $messages;

    public function __construct()
    {
        $this->user = new Users();
        $this->groups = new Groups();
        $this->messages = new Messages();

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

    public function addGroup()
    {
        $array = array('status'=>'1', 'error'=> '0');
        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $this->groups->add($name);
        } else {
            $array['error'] = '1';
            $array['errorMsg'] = 'Falta o Nome do Grupo!';
        }
        echo json_encode($array);
        exit;
    }

    public function addMessage()
    {
        $array = array('status'=>'1', 'error'=> '0');

        if (!empty($_POST['msg']) && !empty($_POST['id_group'])) {
            $msg = $_POST['msg'];
            $idGroup = $_POST['id_group'];
            $uid = $this->user->getUserId();
            $this->messages->add($uid, $idGroup, $msg);
        } else {
            $array['error'] = '1';
            $array['errorMsg'] = 'Mensagem Vazia!';
        }
        echo json_encode($array);
        exit;
    }

    public function getMessages()
    {
        $array = array('status'=>'1', 'msgs'=>array());
        set_time_limit(60);

        $ultMsg = date('Y-m-d H:i:s');

        if (!empty($_GET['last_time'])) {
            $ultMsg = $_GET['last_time'];
        }

        $groups = array();

        if (!empty($_GET['groups']) && is_array($_GET['groups'])) {
            $groups = $_GET['groups'];
        }

        while (true) {
            $msgs = $this->messages->get($ultMsg, $groups);
            if (count($msgs) > 0) {
                $array['msgs'] = $msgs;
                break;
            } else {
                sleep(2);
                continue;
            }
        }
        
        echo json_encode($array);
        exit;
    }

}