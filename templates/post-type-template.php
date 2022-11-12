<?php
get_header();


$movie_args = array(
    'post_type' => 'movie-dir',
    'posts_per_page' => -1,
);

$movie_query = new WP_Query($movie_args);



if ($movie_query->have_posts()) :


?>



    <div class="container">
        <div class="row">

            <?php while ($movie_query->have_posts()) : $movie_query->the_post();

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
                            <p class="card-text"><?php echo $sliceContent; ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>


    <!-- show pagination here -->
<?php else : ?>
    <!-- show 404 error here -->
<?php endif; ?>





<?php








get_footer();
