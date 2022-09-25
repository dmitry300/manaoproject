<?php

namespace app\controllers;

use app\core\Controller;
use app\models\entity\User;

class UserController extends Controller
{
    public function logoutAction()
    {
        if (isset($_SESSION['userName'])) {
            unset($_SESSION['userName']);
            session_destroy();
        }
        $this->view->redirect('/manaoproject');
    }

    public function loginAction()
    {
        $this->view->render('Login');
    }

    public function loginedAction()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                foreach ($decoded as $name => $value) {
                    $decoded[$name] = trim(filter_var($value, FILTER_SANITIZE_STRING));
                }
                $login = $decoded['login'];
                $password = $decoded['password'];
                $error = $this->model->validateLogin($login, $password);
                if (!isset($error)) {
                    $_SESSION['userName'] = $this->model->findUserByLogin($login)['name'];
                    $this->view->redirect('/manaoproject');
                } else {
                    $this->view->message(404, $error);
                }
            }
        }
    }

    public function registerAction()
    {
        $this->view->render('Register');
    }

    public function registeredAction()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                foreach ($decoded as $name => $value) {
                    $decoded[$name] = trim(filter_var($value, FILTER_SANITIZE_STRING));
                }
                $login = $decoded['login'];
                $password = $decoded['password'];
                $confirm_password = $decoded['confirm_password'];
                $email = $decoded['email'];
                $name = $decoded['name'];
                $user = new User($login, $name, $email, $password);
                $error = $this->model->validateRegister($login, $password, $confirm_password, $email, $name);
                if (!isset($error)) {
                    $this->model->createUser($user);
                    $this->view->redirect('/manaoproject/user/login');
                } else {
                    $this->view->message(404, $error);
                }
            }
        }
    }

}