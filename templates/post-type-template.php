<?php
get_header();

// $search;
// if (isset($_POST['search'])) {
//     $search = $_POST['search'];
// }


$query = array(
    'post_type' => 'movie-arch',
    'posts_per_page' => 7,
    'author' => the_author_meta('id'),
    'ignore_sticky_posts' => true,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    "s" => isset($_POST['search'])

);

$loop = new WP_Query($query);

if ($loop->have_posts()) :


?>
    <div class="container">
        <div class="row">
            <div class="s130 col-sm-12">
                <form action="" method="get">

                    <input autocomplete="on" type="text" class="form-control" placeholder="Search freelancers or jobs" name="search" id="" value="">

                    <div class="input-field second-wrap">
                        <button type="submit" class="btn-search">Search</button>
                    </div>
                </form>
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
