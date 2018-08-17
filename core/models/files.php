<?php

/**
 * getting information about the file
 * @param string $checked
 * @param null $edit
 * @param null $limit
 * @return array
 */
function files_getById($id)
{
    $file = getData(dbQuery("SELECT * FROM leaders_uploads WHERE id = " . $id));

    array_pop($file);

    if(empty($file)){
        $file = getData(dbQuery("SELECT * FROM projects_uploads WHERE id = " . $id));
    }

    return $file;
}

/**
 * retrieving user files
 * @param $id_lid
 * @return mixed
 */
function files_getUserFiles($id_lid)
{
    $files['leaders'] = main_clean(getData(dbQuery('SELECT * FROM leaders_uploads WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));


    foreach ($files['leaders'] as $key => $file) {
        $files['leaders'][$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM files_comments WHERE file_id = {$file['id']}"));
    }

    $files['projects'] = main_clean(getData(dbQuery('SELECT * FROM projects_uploads WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));


    foreach ($files['projects'] as $key => $file) {
        $files['projects'][$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM files_comments WHERE file_id = {$file['id']}"));
    }

    return $files;
}

/**
 * retrieving project files
 * @param $id_proj
 * @return mixed
 */
function files_getProjectFiles($id_proj)
{
    $files = main_clean(getData(dbQuery('SELECT * FROM projects_uploads WHERE deleted IS NULL AND id_proj = "'.$id_proj.'"')));

    foreach ($files as $key => $file) {
        $files[$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM files_comments WHERE file_id = {$file['id']}"));
    }

    return $files;
}

