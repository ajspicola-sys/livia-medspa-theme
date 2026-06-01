<?php
/**
 * Template Name: Before After
 * LIVIA Med Spa — Before & After Gallery
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Before and after gallery">
        <div class="page-hero__inner">
            <span class="section__label">Real Results</span>
            <h1 class="page-hero__title">Before & After</h1>
            <p class="page-hero__desc">See the transformations our clients have experienced. All results shown are from actual LIVIA Med Spa patients.</p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="section__inner">

            <!-- Filter tabs -->
            <?php
            $terms = get_terms([
                'taxonomy'   => 'before_after_category',
                'hide_empty' => true,
                'orderby'    => 'name',
                'order'      => 'ASC',
            ]);
            ?>
            <div class="gallery-filters reveal" role="group" aria-label="Filter by treatment type">
                <button class="gallery-filter is-active" data-filter="all">All</button>
                <?php if ( $terms && !is_wp_error($terms) ) : ?>
                    <?php foreach ( $terms as $term ) : ?>
                        <button class="gallery-filter" data-filter="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></button>
                    <?php endforeach; ?>
                <?php else : ?>
                    <button class="gallery-filter" data-filter="botox">Botox</button>
                    <button class="gallery-filter" data-filter="fillers">Fillers</button>
                    <button class="gallery-filter" data-filter="laser">Laser</button>
                    <button class="gallery-filter" data-filter="peels">Peels</button>
                    <button class="gallery-filter" data-filter="microneedling">Microneedling</button>
                <?php endif; ?>
            </div>

            <div class="gallery-grid reveal">
                <?php
                $ba_query = new WP_Query([
                    'post_type'      => 'before_after',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ( $ba_query->have_posts() ) :
                    while ( $ba_query->have_posts() ) : $ba_query->the_post();
                        // Get before/after image IDs
                        $before_id = get_post_meta(get_the_ID(), '_before_image_id', true);
                        $after_id  = get_post_meta(get_the_ID(), '_after_image_id', true);

                        $before_url = $before_id ? wp_get_attachment_url($before_id) : '';
                        $after_url  = $after_id ? wp_get_attachment_url($after_id) : '';

                        // Get categories for filtering
                        $card_terms = get_the_terms(get_the_ID(), 'before_after_category');
                        $cat_slugs  = '';
                        if ( $card_terms && !is_wp_error($card_terms) ) {
                            $slugs     = wp_list_pluck($card_terms, 'slug');
                            $cat_slugs = implode(' ', $slugs);
                        }
                        ?>
                        <div class="gallery-card" data-category="<?php echo esc_attr($cat_slugs); ?>">
                            <div class="gallery-card__images before-after-slider">
                                <div class="gallery-card__before">
                                    <span class="gallery-card__label">Before</span>
                                    <?php if ( !empty($before_url) ) : ?>
                                        <img src="<?php echo esc_url($before_url); ?>" alt="<?php the_title_attribute(); ?> — Before" loading="lazy" decoding="async" class="gallery-card__img">
                                    <?php else : ?>
                                        <div class="gallery-card__placeholder">Before Photo</div>
                                    <?php endif; ?>
                                </div>
                                <div class="gallery-card__after">
                                    <span class="gallery-card__label gallery-card__label--after">After</span>
                                    <?php if ( !empty($after_url) ) : ?>
                                        <img src="<?php echo esc_url($after_url); ?>" alt="<?php the_title_attribute(); ?> — After" loading="lazy" decoding="async" class="gallery-card__img">
                                    <?php else : ?>
                                        <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                                    <?php endif; ?>
                                </div>
                                <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                                <div class="slider-handle" aria-hidden="true">
                                    <div class="slider-handle__line"></div>
                                    <div class="slider-handle__circle">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                    </div>
                                    <div class="slider-handle__line"></div>
                                </div>
                            </div>
                            <div class="gallery-card__info">
                                <h3 class="gallery-card__title"><?php the_title(); ?></h3>
                                <div class="gallery-card__desc"><?php the_content(); ?></div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback to static items if no CPT items exist yet
                    ?>
                    <!-- Botox -->
                    <div class="gallery-card" data-category="botox">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Botox — Forehead & Crow's Feet</h3>
                            <p class="gallery-card__desc">40 units of Botox to smooth forehead lines and crow's feet. Results shown at 2 weeks post-treatment.</p>
                        </div>
                    </div>

                    <!-- Fillers -->
                    <div class="gallery-card" data-category="fillers">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Lip Filler — Natural Enhancement</h3>
                            <p class="gallery-card__desc">1 syringe of Juvederm Ultra for subtle volume and definition. Results shown at 2 weeks.</p>
                        </div>
                    </div>

                    <!-- Laser -->
                    <div class="gallery-card" data-category="laser">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Laser Skin Rejuvenation</h3>
                            <p class="gallery-card__desc">3 sessions of laser resurfacing for sun damage and hyperpigmentation. Results at 6 weeks.</p>
                        </div>
                    </div>

                    <!-- Cheek & Jawline -->
                    <div class="gallery-card" data-category="fillers">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Cheek & Jawline Fillers</h3>
                            <p class="gallery-card__desc">2 syringes of Voluma for cheek augmentation and jawline contour. Results at 2 weeks.</p>
                        </div>
                    </div>

                    <!-- Microneedling -->
                    <div class="gallery-card" data-category="microneedling">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Microneedling — Acne Scarring</h3>
                            <p class="gallery-card__desc">4 sessions of microneedling with PRP for acne scar improvement. Results at 3 months.</p>
                        </div>
                    </div>

                    <!-- Peels -->
                    <div class="gallery-card" data-category="peels">
                        <div class="gallery-card__images before-after-slider">
                            <div class="gallery-card__before">
                                <span class="gallery-card__label">Before</span>
                                <div class="gallery-card__placeholder">Before Photo</div>
                            </div>
                            <div class="gallery-card__after">
                                <span class="gallery-card__label gallery-card__label--after">After</span>
                                <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                            </div>
                            <input type="range" min="0" max="100" value="50" class="slider-range" aria-label="Before and after comparison slider">
                            <div class="slider-handle" aria-hidden="true">
                                <div class="slider-handle__line"></div>
                                <div class="slider-handle__circle">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="8 17 3 12 8 7"/><polyline points="16 7 21 12 16 17"/></svg>
                                </div>
                                <div class="slider-handle__line"></div>
                            </div>
                        </div>
                        <div class="gallery-card__info">
                            <h3 class="gallery-card__title">Chemical Peel — Melasma</h3>
                            <p class="gallery-card__desc">Series of 3 VI Peels for melasma and uneven skin tone. Results at 8 weeks.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="gallery-disclaimer reveal">
                <p>* Individual results may vary. All photos are of actual LIVIA Med Spa patients and are unretouched.</p>
            </div>
        </div>
    </section>

    <section class="cta-section" aria-label="Book your transformation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Your Transformation Awaits</span>
            <h2 class="cta-section__title">Ready for Your<br>Before & After?</h2>
            <p class="cta-section__text">Book a consultation and start your journey to natural, beautiful results.</p>
            <div class="cta-section__actions">
                <a href="#book-now" class="btn btn--primary btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
