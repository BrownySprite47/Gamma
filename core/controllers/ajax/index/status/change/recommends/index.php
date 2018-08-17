<?php
/**
 * Page /ajax/index/status/change/recommends
 */
function index()
{
    if (isset($_POST['id_lid_recom']) && $_POST['id_lid_recom'] != '') {
        if (isset($_POST['exist'])) {
            dbQuery("UPDATE recommend_leaders SET checked = '" . main_checkChars($_POST['checked']) . "' WHERE id_lid = '" . main_checkChars($_POST['id_lid_recom']) . "' AND user_id = '" . main_checkChars($_POST['user_id']) . "'");
        }
    }
}
