<?php
/**
 * The template for displaying all single posts
 * Sadrhub
 * Author: Sina Sotoudeh
 * Website: sinasotoudeh.ir
 * github: github.com/sinasotoudeh
*/
 */

get_header(); 

$content = get_post_field( 'post_content', $post->ID );
$word_count = str_word_count( strip_tags( $content ) );
$reading_time = ceil( $word_count / 200 );
?>

<!-- نوار پیشرفت مطالعه -->
<div id="cuttlas-scroll-progress"></div>

<!-- پس‌زمینه متحرک (ثابت در کل صفحه) -->
<div class="cuttlas-fixed-bg">
    <div class="gradient-blob gradient-blob--1"></div>
    <div class="gradient-blob gradient-blob--2"></div>
    <div class="gradient-blob gradient-blob--3"></div>
    <div class="gradient-blob gradient-blob--4"></div>
</div>

<main id="primary" class="cuttlas-single-wrapper">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="cuttlas-container">
            
            <!-- 1. تصویر شاخص (اولین المان) -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="cuttlas-hero-image">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </div>
            <?php endif; ?>

            <!-- لی‌آوت گرید: محتوا + سایدبار -->
            <div class="cuttlas-grid-layout">
                
                <!-- ستون سمت راست: محتوای اصلی -->
                <article class="cuttlas-main-column">
                    
                    <!-- کارت سفید محتوا -->
                    <div class="cuttlas-card cuttlas-article-card">
                        
                        <!-- هدر مقاله -->
                        <header class="cuttlas-post-header">
                            <div class="post-meta-badges">
                                <span class="meta-cat"><?php the_category(' '); ?></span>
                                <span class="meta-time"><i class="fa fa-clock-o"></i> <?php echo $reading_time; ?> دقیقه</span>
                            </div>
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            
                            <div class="post-author-row">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
                                <div class="author-details">
                                    <span class="byline">نوشته شده توسط <strong><?php the_author(); ?></strong></span>
                                    <span class="posted-on"><?php echo get_the_date('j F Y'); ?></span>
                                </div>
                            </div>
                        </header>

                        <!-- متن مقاله -->
                        <div class="cuttlas-entry-content" id="cuttlas-article-body">
                            <?php the_content(); ?>
                        </div>

                        <!-- فوتر مقاله (تگ‌ها و اشتراک‌گذاری) -->
                        <footer class="cuttlas-entry-footer">
                            <div class="tags-list">
                                <?php the_tags('<span class="tag-label">#</span>', '', ''); ?>
                            </div>
                        </footer>
                    </div>

                    <!-- کارت سفید درباره نویسنده -->
                    <div class="cuttlas-card cuttlas-author-box">
                        <div class="author-box-img">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
                        </div>
                        <div class="author-box-content">
                            <h4><?php the_author(); ?></h4>
                            <p><?php the_author_meta('description'); ?></p>
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="btn-text">مشاهده پروفایل <i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>

                    <!-- کارت سفید مطالب مرتبط -->
                    <div class="cuttlas-card cuttlas-related-section">
                        <h3 class="section-heading">شاید برایتان جالب باشد</h3>
                        <div class="related-grid">
                            <?php
                            $related = new WP_Query( array(
                                'category__in' => wp_get_post_categories($post->ID),
                                'posts_per_page' => 2, // دو تا کنار هم شکیل‌تر است
                                'post__not_in' => array($post->ID),
                                'orderby' => 'rand'
                            ) );

                            if( $related->have_posts() ) : 
                                while( $related->have_posts() ) : $related->the_post(); 
                            ?>
                                <a href="<?php the_permalink(); ?>" class="related-item">
                                    <div class="related-thumb">
                                        <?php if(has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                                    </div>
                                    <div class="related-info">
                                        <h4><?php the_title(); ?></h4>
                                        <span><?php echo get_the_date('j F Y'); ?></span>
                                    </div>
                                </a>
                            <?php 
                                endwhile; 
                                wp_reset_postdata();
                            endif; 
                            ?>
                        </div>
                    </div>

                    <!-- بخش نظرات (کارت سفید داخلی دارد) -->
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="cuttlas-card cuttlas-comments-wrapper">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>

                <!-- ستون سمت چپ: سایدبار -->
                <!-- <aside class="cuttlas-sidebar-column"> 
                    <div class="cuttlas-sticky-inner">-->
                        
                        <!-- ویجت فهرست مطالب 
                        <div class="cuttlas-card cuttlas-toc-widget">
                            <div class="widget-header">
                                <i class="fa fa-list-ul"></i>
                                <h3>فهرست مطالب</h3>
                            </div>
                            <ul id="cuttlas-toc-list"></ul>
                        </div>


                    </div>-->
                </aside>

            </div> <!-- End Grid -->
        </div> <!-- End Container -->

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
