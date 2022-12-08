<?php
get_header();

$search = $_GET['search'];




$query = array(
    'post_type' => 'movie-dir',
    'posts_per_page' => 7,
    'author' => the_author_meta('id'),
    'ignore_sticky_posts' => true,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    "s" => $search,

);




$loop = new WP_Query($query);

if ($loop->have_posts()) :


?>
    <div class="container">
        <div class="row">
            <div class="s130 col-sm-12">
                <form action="" method="get">
                    <div class="inner-form">
                        <div class="input-field first-wrap">
                            <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                </svg>
                            </div>
                            <input autocomplete="off" type="text" class="form-control" placeholder="Search freelancers or jobs" name="search" id="" value="">
                        </div>
                        <div class="input-field second-wrap">
                            <button type="submit" class="btn-search">Search</button>
                        </div>
                    </div>
            </div>
            <div class="row">

                <?php while ($loop->have_posts()) : $loop->the_post();

                    $content_texts = get_the_content();

                    $sliceContent = mb_strimwidth($content_texts, 0, 100, '...');


                ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php

                                                            $thumbnail_check = get_the_post_thumbnail_url();

                                                            if ($thumbnail_check == true) {
                                                                echo get_the_post_thumbnail_url();
                                                            } else {
                                                                echo 'https://cdn.wpbeginner.com/wp-content/uploads/2013/07/get-the-post-thumbnail-url-in-wordpress-og.png';
                                                            }
                                                            ?>" alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <!-- <p class="card-text"><?php //echo $sliceContent; 
                                                            ?></p> -->
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>

                    </div>
                <?php endwhile;


                $big = 9999;
                the_posts_pagination(array(
                    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $loop->max_num_pages
                ));


                wp_reset_postdata();
                ?>
            </div>
        </div>


        <!-- show pagination here -->


    <?php else : ?>
        <!-- show 404 error here -->
    <?php endif; ?>

    <?php

    get_footer();
