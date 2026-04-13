<?php
/*
Template Name: Blog Category Page
Author: Sina Sotoudeh
Website: sinasotoudeh.ir
github: github.com/sinasotoudeh
*/

get_header(); 

// 1. کوئری برای 5 پست آخر (برای بخش هیرو)
$hero_args = array(
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => 1
);
$hero_query = new WP_Query($hero_args);

if ($hero_query->have_posts()) : 
    $posts = $hero_query->posts;
    $main_post = $posts[0]; // اولین پست برای نمایش بزرگ
    ?>

    <!-- شروع بخش هیرو (مشابه قبل با استایل Cuttlas) -->
    <div class="cuttlas-blog-hero-container">
        <div class="cuttlas-hero-wrapper">
            
            <!-- بخش اصلی (Main Stage) -->
            <div class="cuttlas-main-stage">
                <?php foreach ($posts as $index => $post) : 
                    setup_postdata($post);
                    $is_active = ($index === 0) ? 'active' : '';
                    $img_url = get_the_post_thumbnail_url($post->ID, 'large');
                    $category = get_the_category($post->ID);
                    $cat_name = !empty($category) ? $category[0]->name : '';
                    ?>
                    <div class="cuttlas-main-item <?php echo $is_active; ?>" data-index="<?php echo $index; ?>">
                        <div class="cuttlas-main-bg" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
                        <div class="cuttlas-main-content">
                            <span class="cuttlas-cat-badge"><?php echo esc_html($cat_name); ?></span>
                            <h2 class="cuttlas-main-title">
                                <a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                            </h2>
                            <div class="cuttlas-meta">
                                <span><?php echo get_the_date('d F Y', $post->ID); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>

            <!-- سایدبار (Navigation) -->
            <div class="cuttlas-sidebar-nav">
                <div class="cuttlas-nav-header">
                    <h3>تازه ترین‌ها</h3>
                </div>
                <div class="cuttlas-nav-list">
                    <?php foreach ($posts as $index => $post) : 
                        // پست اول را در لیست سایدبار نادیده نمی‌گیریم تا کاربر بتواند به آن برگردد
                        // اما اگر می‌خواهید پست اول در لیست نباشد، شرط بگذارید. اینجا همه را می‌گذاریم.
                        $is_active = ($index === 0) ? 'active' : '';
                        ?>
                        <div class="cuttlas-nav-item <?php echo $is_active; ?>" data-index="<?php echo $index; ?>">
                            <div class="cuttlas-nav-content">
                                <h4><?php echo get_the_title($post->ID); ?></h4>
                                <span class="cuttlas-nav-date"><?php echo get_the_date('d F Y', $post->ID); ?></span>
                            </div>
                            <div class="cuttlas-progress-bar"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
    <!-- پایان بخش هیرو -->

<?php endif; ?>

<!-- بخش نمایش سایر پست‌ها (اختیاری - زیر اسلایدر) -->
<div class="container" style="margin-top: 3rem;">
    <h2>سایر نوشته‌ها</h2>
    <div class="cuttlas-archive-grid">
        <?php
        // کوئری دوم: پست‌های بعد از 5 تای اول
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $archive_args = array(
            'posts_per_page' => 10,
            'paged'          => $paged,
            'offset'         => 5, // رد کردن 5 پست اول که در اسلایدر هستند
        );
        // نکته: استفاده از offset با pagination نیاز به اصلاحات دارد، 
        // اما برای سادگی فعلا لیست ساده را نمایش می‌دهیم.
        
        $archive_query = new WP_Query($archive_args);
        
        if ($archive_query->have_posts()) :
            while ($archive_query->have_posts()) : $archive_query->the_post();
                ?>
                <article class="cuttlas-post-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                        <h3><?php the_title(); ?></h3>
                    </a>
                    <?php the_excerpt(); ?>
                </article>
                <?php
            endwhile;
            
            // صفحه‌بندی (Pagination)
            echo paginate_links(array(
                'total' => $archive_query->max_num_pages
            ));
            
        else :
            echo '<p>نوشته دیگری وجود ندارد.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>
<!-- Animated Background -->
<div class="hero__bg">
        <div class="gradient-blob gradient-blob--1"></div>
        <div class="gradient-blob gradient-blob--2"></div>
        <div class="gradient-blob gradient-blob--3"></div>
        <div class="gradient-blob gradient-blob--4"></div>
    </div>
<?php get_footer(); ?>
