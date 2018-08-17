<?php
/**
 * getting information about the link
 * @param string $checked
 * @param null $edit
 * @param null $limit
 * @return array
 */
function links_getById($id)
{
    $link = getData(dbQuery("SELECT * FROM leaders_links WHERE id = " . $id));

    array_pop($link);

    if(empty($link)){
        $link = getData(dbQuery("SELECT * FROM projects_links WHERE id = " . $id));
    }

    return $link;
}




/**
 * retrieving user links
 * @param $id_lid
 * @return mixed
 */
function links_getUserLinks($id_lid)
{
    $links['leaders'] = main_clean(getData(dbQuery('SELECT * FROM leaders_links WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));

    foreach ($links['leaders'] as $key => $link) {
        $links['leaders'][$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM links_comments WHERE link_id = {$link['id']}"));
    }

    $links['projects'] = main_clean(getData(dbQuery('SELECT * FROM projects_links WHERE id_lid = "'.$id_lid.'" AND deleted IS NULL')));

    foreach ($links['projects'] as $key => $link) {
        $links['projects'][$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM links_comments WHERE link_id = {$link['id']}"));
    }

    return $links;
}

/**
 * retrieving project links
 * @param $id_proj
 * @return mixed
 */
function links_getProjectLinks($id_proj)
{
    $links = main_clean(getData(dbQuery('SELECT * FROM projects_links WHERE deleted IS NULL AND id_proj = "'.$id_proj.'"')));

    foreach ($links as $key => $link) {
        $links[$key]['count'] = getData(dbQuery("SELECT COUNT(*) as comments_count FROM files_comments WHERE file_id = {$link['id']}"));
    }

    return $links;
}
