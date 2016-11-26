<?php

namespace Core;

use Model\UsersModel;
use Model\SessionModel;

class Users
{
	
	public static $instance;
    private $mUsers;
    private $token;
    private $mSession;

    public static function Instance()
    {
        if (self::$instance == null){
            self::$instance = new ArticleModel();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->mUsers = UsersModel::Instance();
        $this->mSession = SessionModel::Instance();
    }

    public function Login($login, $password, $remember = true)
    {

        $user = $this->mUsers->GetByLogin($login);

        if (!$user){
            return false;
        }

        $id_user = $user['id_user'];

        if ($user['password'] != $this->GetHash($password)){
            return false;
        }

        if ($remember){
            $expire = time() + 3600 * 24 * 7;
            setcookie('login', $login, $expire);
            setcookie('password', $password, $expire);
        }

        $this->token = $this->OpenSession($id_user);
        return true;
    }
 
    private function Get()
    {
        $id_user = $this->GetUId();

        if ($id_user == null){
            return null;
        }

        return $this->mUsers->get($id_user);
    }

    private function GetUId()
    {
        if ($this->token != null){
            return $this->token;
        }

        $token = $this->GetToken();

        if ($token == null){
            return null;
        }

        $result = $this->mSession->get($token);

        if ($result == null){
            return null;

        $this->uid = $result['id_user'];
        return $this->uid;    

        }
    }

    private function GetToken()
    {
        if ($this->token != null){
            return $this->token;
        }

        $token = $_SESSION['token'];

        if ($token != null){
            $rows = $this->mSession->edit($token, ['last_activity' => $now]);
            if (!$rows && $this->mSession->get($token) == null){
                $token == null;
            }
        }

        if ($token == null && isset($_COOKIE['login'])){
            $user = $this->mUsers->GetByLogin($_COOKIE['login']);

            if ($user != null && $user['password'] == $_COOKIE['password']){
                $token = $this->OpenSession($user['id_user']);
            }
        }

        if ($token != null){
            $this->token = $token;
        }

        return $token
    }

    private function OpenSession($id_user)
    {
        $token = $this->GenerateStr(10);

        $now = date('Y-m-d H:i:s');
        $session = [];
        $session['id_user'] = $id_user; 
        $session['token'] = $token; 
        $session['time_start'] = $now; 
        $session['last_activity'] = $now; 
        $this->mSession->add($session);

        $_SESSION['token'] = $token;

        return $token;
    }


    private function GenerateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length){
            $code .= $chars[mt_rand(0,$clen)];
        }

        return $code;      
    }

    public function GetHash($srt){
        $i = 0;
        while($i++ < 4 )
            $str = md5(md5(md5(HASH_KEY . $str)) . $str);
        return $str;
    }

        // Проверка авторизации
    public static function IsAuth()
    {
       
        if (!isset($_SESSION['auth'])){
            
            if (isset($_COOKIE['login']) && isset ($_COOKIE['password']){
                $user = $this->mUsers->GetByLogin($_COOKIE['login']);

                if ($user && $_COOKIE['password'] ==$user['password']
            } 


                && $_COOKIE['login'] == 'admin' && $_COOKIE['password'] == md5('qwerty')){
                $_SESSION['auth'] = true;
                }

            else {
                return false;
                }
            }
        return true;
    }
}
	







