<?php 
/*
Sadrhub
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/
get_header(); ?>

<!-- یک فاصله از بالا می‌دهیم که محتوا زیر هدر نرود -->
<main class="container page-container" style="padding-top: 120px; padding-bottom: 60px; min-height: 60vh;">
    
    <?php
    // شروع حلقه وردپرس برای نمایش محتوای برگه
    while ( have_posts() ) : the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- نمایش عنوان برگه (اختیاری - اگر نمی‌خواهید حذف کنید) -->
            <header class="entry-header mb-4">
                <h1 class="entry-title text-center"><?php the_title(); ?></h1>
            </header>

            <!-- نمایش محتوای اصلی (چیزی که در ادیتور وردپرس می‌نویسید) -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>

        <?php
    endwhile; // پایان حلقه
    ?>

</main>

<?php get_footer(); ?>
