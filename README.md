# Castlegate IT WP CMB Downloads #

Simple downloads field using [Custom Meta Boxes](https://github.com/castlegateit/cgit-wp-custom-meta-boxes). Defines a field called `downloads`, which can be displayed with the `get_field()`, `the_field()`, or `get_post_meta()` functions:

    get_field('downloads', $post_id, FALSE);

The third argument must be `FALSE` to return an array of downloads. If it is not set, or it is set to `TRUE`, only the first item will be returned. The plugin also provides a shortcode:

    [downloads]

This generates a list of downloads:

    <div class="cgit-gallery">
        <ul>
            <li><a href="file.txt">Example</a></li>
            <li><a href="file.txt">Example</a></li>
        </ul>
    </div>

If no title is entered, the file name will be used instead. The default fields can be edited with the `cgit_download_fields` filter.