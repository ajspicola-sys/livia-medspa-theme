<?php
/**
 * Template Name: Products
 * Livia Med Spa — Products Page (Dynamic)
 * Pulls products from the product custom post type
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Our products">
        <div class="page-hero__inner">
            <span class="section__label">Curated Collection</span>
            <h1 class="page-hero__title">Our Products</h1>
            <p class="page-hero__desc">Physician-selected, medical-grade products to complement your treatments and elevate your daily routine.</p>
        </div>
    </section>

    <section class="products-showcase">
        <div class="section__inner">
            <div class="products-grid">

                <?php
                $products = new WP_Query([
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ]);

                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        $url      = get_post_meta(get_the_ID(), '_product_url', true);
                        $video    = get_post_meta(get_the_ID(), '_product_video_bg', true);
                        $price    = get_post_meta(get_the_ID(), '_product_price', true);
                        $btn_text = get_post_meta(get_the_ID(), '_product_btn_text', true) ?: 'Shop Now';
                        $has_video = !empty($video);
                ?>
                    <article class="product-card reveal<?php echo $has_video ? ' product-card--has-video' : ''; ?>">
                        <?php if ($has_video) : ?>
                            <div class="product-card__video-wrap" aria-hidden="true">
                                <video class="product-card__video" autoplay muted loop playsinline preload="metadata">
                                    <source src="<?php echo esc_url($video); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>

                        <div class="product-card__inner">
                            <div class="product-card__image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    ]); ?>
                                <?php else : ?>
                                    <div class="product-card__placeholder" aria-hidden="true">
                                        <span>🛍️</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="product-card__content">
                                <h2 class="product-card__name"><?php the_title(); ?></h2>

                                <?php if ($price) : ?>
                                    <span class="product-card__price"><?php echo esc_html($price); ?></span>
                                <?php endif; ?>

                                <?php if (get_the_content()) : ?>
                                    <div class="product-card__desc">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($url) : ?>
                                    <a href="<?php echo esc_url($url); ?>" class="btn btn--primary product-card__btn" target="_blank" rel="noopener noreferrer">
                                        <?php echo esc_html($btn_text); ?>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>

                <?php endwhile; wp_reset_postdata();
                else : ?>
                    <div style="text-align:center; padding:4rem 2rem; grid-column: 1/-1;">
                        <p style="color:#7a7a90; font-size:1.1rem;">Products coming soon! Add them in <strong>WordPress Admin → 🛍️ Products</strong>.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Consultation CTA -->
    <section class="cta-section" aria-label="Book with us">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Need Help Choosing?</span>
            <h2 class="cta-section__title">Get a Personalized<br>Product Recommendation</h2>
            <p class="cta-section__text">Our providers will analyze your skin and recommend the perfect products for your goals.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

    <!-- Client Portal Section -->
    <section class="portal-section" aria-label="Client portal">
        <div class="section__inner">
            <div class="portal-section__card reveal">
                <div class="portal-section__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M9 12l2 2 4-4"/></svg>
                </div>
                <h2 class="portal-section__title">Click. Book. Glow.</h2>
                <p class="portal-section__text">Access the Livia Med Spa Client Portal to easily manage your appointments, view your vouchers and memberships, and share referral links with friends. Enjoy a seamless, secure experience that puts all your spa benefits and perks right at your fingertips.</p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Client Portal →</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
