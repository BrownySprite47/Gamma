<?php

function index() {
    if(empty($_SESSION)){
        require_once CORE_DIR . '/core/library/validation.php';
        $data = [];
        $errors = [];
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
                'email' => getSaveData(trim($_POST['email'])),
                'password' => getSaveData(trim($_POST['password'])),
                'password2' => getSaveData(trim($_POST['password2'])),
            ];

            $rules = [
                'login' => ['required', 'login'],
                'email' => ['required', 'email'],
                'password' => ['required', 'password'],
                'password2' => ['required', 'password2'],
            ];

            $messages = [
                'required' => "Поле обязательно для заполнения",
                'login' => "Логин может содержать только буквы и цифры от 5 до 30 символов",
                'email' => "Введите корректный email от 5 до 30 символов",
                'password' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
                'password2' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
                'equal' => "Пароли должны совпадать",
            ];

            $errors = validateForm($rules, $data);

            if (empty($errors)){
            $data['password'] = md5($data['password'] . KEY);
                $user = getUser($data);

                if ($user->num_rows === 0){
                    if (addNewUser($data) && addNewLeader($data)){
                        header('Location: /admin/auth/login?reg=success');
                    }else{
                        $messages['unique'] = 'Ошибка регистрации. Повторите попытку позже';
                    }
                }else{
                    $messages['unique'] = 'Данный пользователь уже существует';
                }
            }
        }
        $data['css'][] = 'admin/css/auth/style.css';

        $data['errors'] = $errors;
        $data['messages'] = $messages;
        renderView('admin/auth/registration/index/index', $data);
    }else{
        header('Location: /');
    }
}
