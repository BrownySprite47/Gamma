<?php

function index() {
    unset($_SESSION["save_data_leaders_redirect"]);
    unset($_SESSION["save_data_projects_redirect"]);
    if(empty($_SESSION)){
        require_once CORE_DIR . '/core/library/validation.php';
        $data = [];
        $messages = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => getSaveData(trim($_POST['email'])),
                'password' => getSaveData(trim(md5($_POST['password'] . KEY))),
            ];

            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required', 'password'],
            ];

            $messages = [
                'required' => "Поле обязательно для заполнения",
                'email' => "Введите корректный email от 5 до 30 символов",
                'password' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
            ];

            $errors = validateForm($rules, $data);

            if (empty($errors)) {
                $user = getUserLogin($data);

                if ($user->num_rows === 0) {
                    $messages['not_unique'] = 'Неверный логин или пароль';
                } else {
                    $_SESSION = mysqli_fetch_assoc($user);
                    $tmp = mysqli_fetch_assoc(getUserDataFromId($_SESSION['id']));
                    
                    $_SESSION['status'] = $tmp["status"];
                    $_SESSION['id_lid'] = $tmp["id_lid"];
                    unset($_SESSION['password']);
                    unset($_SESSION['email']);

                    header("Location: /");
                }
            }
        }
        $data['css'][] = 'admin/css/auth/style.css';

        $data['errors'] = $errors;
        $data['messages'] = $messages;
        renderView('admin/auth/login/index/index', $data);
    }else{
        header('Location: /');
    }
}

// function success() {
//     $data['status'] = 'success';
//     renderView('auth/registration', $data);
// }
