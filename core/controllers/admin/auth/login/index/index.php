<?php

/**
 * Page /admin/auth/login
 */
function index()
{
    /**
     * Delete filter session
     */

    unset($_SESSION["save_data_leaders_redirect"]);
    unset($_SESSION["save_data_projects_redirect"]);

    if(empty($_SESSION)) {
        /**
         * Require validation
         */
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
                $user = admin_getAdminLogin($data);

                if (!isset($user[0]['id'])) {
                    $messages['not_unique'] = 'Неверный логин или пароль';
                } else {
                    $_SESSION = $user[0];
                    $tmp = user_getById($_SESSION['id']);

                    $_SESSION['status'] = $tmp[0]["status"];
                    $_SESSION['id_lid'] = $tmp[0]["id_lid"];

                    if($_SESSION['role'] == 'admin'){
                        $_SESSION['status'] = '3';
                    }
                    unset($_SESSION['password']);
                    unset($_SESSION['email']);

//                    header("Location: /");

                    view($_SESSION);
                }
            }
        }
        /**
         * Require css and js files for page
         */
        $data['css'][] = 'admin/css/auth/index/style.css';
        $data['css'][] = 'admin/css/auth/index/media.css';

        /**
         * Page title
         */
        $data['title'] = 'Админ - Вход';
        $data['errors'] = $errors;
        $data['messages'] = $messages;

        /**
         * Require view
         */
        renderView('admin/auth/login/index/index', $data);
    } else {
        header('Location: /');
    }
}
/**
 * Page title
 */
