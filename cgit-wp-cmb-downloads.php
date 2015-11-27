<?php

/*

Plugin Name: Castlegate IT WP CMB Downloads
Plugin URI: http://github.com/castlegateit/cgit-wp-cmb-downloads
Description: Simple downloads field using Custom Meta Boxes.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

/**
 * Add download fields
 */
function cgit_download_fields ($meta_boxes) {

    $subfields = array(
        array(
            'id'   => 'file',
            'name' => 'File',
            'type' => 'file',
        ),
        array(
            'id'   => 'title',
            'name' => 'Title',
            'type' => 'text',
        ),
    );

    $fields = array(
        array(
            'id'         => 'downloads',
            'name'       => 'Downloads',
            'type'       => 'group',
            'fields'     => $subfields,
            'repeatable' => TRUE,
            'sortable'   => TRUE,
        ),
    );

    $meta_box = array(
        'id'      => 'cgit-wp-cmb-downloads',
        'title'   => 'Downloads',
        'pages'   => array('post', 'page'),
        'context' => 'normal',
        'fields'  => $fields,
    );

    $meta_boxes[] = apply_filters('cgit_download_fields', $meta_box);

    return $meta_boxes;

}

add_filter('cmb_meta_boxes', 'cgit_download_fields');

/**
 * Add entry in user guide
 */
function cgit_downloads_user_guide($sections) {

    $file = dirname(__FILE__) . '/user-guide.php';
    $sections['cgit-wp-cmb-downloads'] = Cgit\UserGuide::getFile($file);

    return $sections;

}

add_filter('cgit_user_guide_sections', 'cgit_downloads_user_guide', 100);

/**
 * Add basic shortcode
 */
function cgit_downloads_shortcode () {

    if ( ! class_exists('CMB_Meta_Box') ) {
        return FALSE;
    }

    global $post;

    $downloads = get_post_meta($post->ID, 'downloads', FALSE);
    $output    = '';

    if ($downloads) {

        $output .= '<div class="cgit-downloads"><ul>';

        foreach ($downloads as $item) {

            $file  = wp_get_attachment_url($item['file']);
            $name  = basename($file);
            $title = $item['title'] ?: $name;

            $output .= "<li><a href='$file'>$title</a></li>";

        }

        $output .= '</ul></div>';

    }

    return $output;

}

add_shortcode('downloads', 'cgit_downloads_shortcode');
