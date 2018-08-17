<?php
/**
 * Page /ajax/index/check/unique/fio
 */
function index()
{
    if (isset($_POST['fio_lid'])) {
        return main_uniqueFio($_POST);
    }
}
