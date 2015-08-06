<h3>Downloads</h3>

<p>The Downloads field allows you to add one or more files to a page that will appear in a list of downloads. Click &ldquo;Add New Group&rdquo; to add a new file to the list. The title field is optional. If no title is entered, the name of the file will be used instead. Downloads are available on <?php

    $types = cgit_download_fields(array())[0]['pages'];
    $names = array();
    $list = '';

    if (is_string($types)) {
        $types = array($types);
    }

    foreach ($types as $type) {
        $names[] = get_post_type_object($type)->label;
    }

    switch (count($names)) {
        case 1:
            $list = array_pop($names);
            break;
        case 2:
            $list = implode(' and ', $names);
            break;
        default:
            $last = array_pop($names);
            $list = implode(', ', $names) . ', and ' . $last;
            break;
    }

    echo $list;

?>.</p>
