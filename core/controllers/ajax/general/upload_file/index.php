<?php

function index()
{
    if (!empty($_FILES['file']['name'])) {
        $req = false;
        ob_start();

        function getExtension($str)
        {
            $i = strrpos($str, ".");
            if (!$i) {
                return "";
            }
            $l = strlen($str) - $i;
            $ext = substr($str, $i + 1, $l);
            return $ext;
        }

        $filename = stripslashes($_FILES['file']['name']);

        $id = $_POST['id'];
        $ext = getExtension($filename);
        $ext = strtolower($ext);

        // Проверяем размер файла и если он превышает заданный размер
        // завершаем выполнение скрипта и выводим ошибку
        if ($_FILES['file']['size'] > 100 * MB) {
            echo "Превышен максимально допустимый размер файла (100 МБ).";
        } else {
            $size = $_FILES['file']['size'];
            $valid_formats = array("pdf", "png", "jpg", "jpeg", "doc", "txt", "docx");
            if (in_array($ext, $valid_formats)) {
                $name = time();
                $newname = 'uploads/files/' . $name . '.' . $ext;
                $filename = $name . '.' . $ext;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $newname)) {
                    //загрузили новый файл EVENT 10
                    //userLogs($_SESSION['id_lid'], '10', '', '', '', '');
                    echo "<input id='preview_file_$id' class='form-control' type='text' name='file[$id][filename]' value='$filename'>
                        <input id='preview_file_size_$id' class='form-control' type='text' name='file[$id][size]' value='$size'>
                        <input id='preview_file_ext_$id' class='form-control' type='text' name='file[$id][ext]' value='$ext'>";
                } else {
                    echo "Произошла ошибка загрузки! Повторите попытку позднее.";
                }
            } else {
                echo "Неверный формат файла!";
            }
        }

        $req = ob_get_contents();
        ob_end_clean();
        echo json_encode($req);
    }
}
