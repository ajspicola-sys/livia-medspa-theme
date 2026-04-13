<?php
/**
 * Single Blog Post Template
 *
 * @package LiviaMedSpa
 * @since   1.0.0
 */

get_header();

while (have_posts()) : the_post();
?>

<!-- Post Hero -->
<section class="post-hero">
    <div class="post-hero__bg">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('livia-hero', ['class' => 'post-hero__image']); ?>
        <?php endif; ?>
        <div class="post-hero__overlay"></div>
    </div>
    <div class="post-hero__content container">
        <div class="post-hero__meta">
            <?php
            $cats = get_the_category();
            if ($cats) :
            ?>
            <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="post-hero__category"><?php echo esc_html($cats[0]->name); ?></a>
            <?php endif; ?>
            <span class="post-hero__date"><?php echo get_the_date('F j, Y'); ?></span>
            <span class="post-hero__read-time"><?php echo ceil(str_word_count(get_the_content()) / 200); ?> min read</span>
        </div>
        <h1 class="post-hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<!-- Post Content -->
<section class="section">
    <div class="container container--narrow">
        <article class="post-article" id="post-<?php the_ID(); ?>">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
            <div class="post-tags">
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge badge--gold"><?php echo esc_html($tag->name); ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Share -->
            <div class="post-share">
                <span class="post-share__label">Share this article</span>
                <div class="post-share__links">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="post-share__link">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="post-share__link">Twitter</a>
                    <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="post-share__link">Email</a>
                </div>
            </div>
        </article>

        <!-- Author Bio -->
        <div class="post-author animate-on-scroll">
            <div class="post-author__avatar">
                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
            </div>
            <div class="post-author__info">
                <span class="post-author__label">Written by</span>
                <strong class="post-author__name"><?php the_author(); ?></strong>
                <p class="post-author__bio"><?php echo get_the_author_meta('description'); ?></p>
            </div>
        </div>

        <!-- Related Posts -->
        <?php
        $related = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => [get_the_ID()],
            'category__in'   => wp_get_post_categories(get_the_ID()),
            'orderby'        => 'rand',
        ]);

        if ($related->have_posts()) :
        ?>
        <div class="related-posts animate-on-scroll">
            <h3 class="related-posts__title">You Might Also Like</h3>
            <hr class="section-divider">
            <div class="related-posts__grid">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="related-post-card">
                    <div class="related-post-card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('livia-card', ['loading' => 'lazy']); ?>
                        <?php endif; ?>
                    </div>
                    <div class="related-post-card__body">
                        <time><?php echo get_the_date('M j, Y'); ?></time>
                        <h4><?php the_title(); ?></h4>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
