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
            $ext = substr($str, $i+1, $l);
            return $ext;
        }

        $filename = stripslashes($_FILES['file']['name']);
        $ext = getExtension($filename);
        $ext = strtolower($ext);

        // Проверяем размер файла и если он превышает заданный размер
        // завершаем выполнение скрипта и выводим ошибку

        if ($_FILES['file']['size'] > 5*MB) {
            echo "<span class='image_name' style='background-image: url(" . CORE_IMG_PATH . 'img_not_found.png' . ")'></span><p class='errors_image'>Превышен максимально допустимый размер файла (5 МБ).</p>";
        } else {
            $valid_formats = array("jpg", "png", "svg","jpeg");
            if (in_array($ext, $valid_formats)) {
                $name = time();
                $newname = 'uploads/images/'.$name.'.'.$ext;
                $filename = $name.'.'.$ext;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $newname)) {
                    echo "<span class='image_name' style='background-image: url(" . CORE_IMG_PATH . $filename . ")'></span> <input style='display: none' value='".$filename."' id=\"image_name\" type=\"text\" name=\"image_name\" />";
                } else {
                    echo "<span class='image_name' style='background-image: url(" . CORE_IMG_PATH . 'img_not_found.png' . ")'></span><p class='errors_image'>Произошла ошибка загрузки изображения! Повторите попытку позднее.</p>";
                }
            } else {
                echo "<span class='image_name' style='background-image: url(" . CORE_IMG_PATH . 'img_not_found.png' . ")'></span><p class='errors_image'>Неверный формат изображения!<br> Поддерживаемые форматы : <br> 'jpg', 'png', 'svg', 'jpeg'</p>";
            }
        }
        $req = ob_get_contents();
        ob_end_clean();
        echo json_encode($req);
    }
}
