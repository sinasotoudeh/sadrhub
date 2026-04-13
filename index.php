<?php get_header(); ?>

<main class="container default-page-container" style="padding: 120px 0 60px;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <hr>
            <?php
        endwhile;
        
        // صفحه بندی (Pagination)
        the_posts_navigation();

    else :
        echo '<p>مطلبی یافت نشد.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
