<?php
get_header();


$query = array(
    'post_type' => 'movie-dir',
    'posts_per_page' => 2,
    'author' => the_author_meta('id'),
    'ignore_sticky_posts' => true,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
);
$loop = new WP_Query($query);

if ($loop->have_posts()) :
    while ($loop->have_posts()) : $loop->the_post();
        //postcode
        echo get_the_title() . "<br>";
    endwhile;
endif;

$big = 9999; // need an unlikely integer
// echo paginate_links(array(
//     'base' => str_replace($big, '%#%', get_pagenum_link($big)),
//     'format' => '?paged=%#%',
//     'current' => max(1, get_query_var('paged')),
//     'total' => $loop->max_num_pages
// ));

the_posts_pagination(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $loop->max_num_pages
));


get_footer();
