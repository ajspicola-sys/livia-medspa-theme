<?php
/**
 * Template Name: Before After
 * Livia Med Spa — Before & After Gallery
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Before and after gallery">
        <div class="page-hero__inner">
            <span class="section__label">Real Results</span>
            <h1 class="page-hero__title">Before & After</h1>
            <p class="page-hero__desc">See the transformations our clients have experienced. All results shown are from actual Livia Med Spa patients.</p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="section__inner">

            <!-- Filter tabs -->
            <div class="gallery-filters reveal" role="group" aria-label="Filter by treatment type">
                <button class="gallery-filter is-active" data-filter="all">All</button>
                <button class="gallery-filter" data-filter="botox">Botox</button>
                <button class="gallery-filter" data-filter="fillers">Fillers</button>
                <button class="gallery-filter" data-filter="laser">Laser</button>
                <button class="gallery-filter" data-filter="peels">Peels</button>
                <button class="gallery-filter" data-filter="microneedling">Microneedling</button>
            </div>

            <div class="gallery-grid reveal">
                <div class="gallery-card" data-category="botox">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Botox — Forehead & Crow's Feet</h3>
                        <p class="gallery-card__desc">40 units of Botox to smooth forehead lines and crow's feet. Results shown at 2 weeks post-treatment.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="fillers">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Lip Filler — Natural Enhancement</h3>
                        <p class="gallery-card__desc">1 syringe of Juvederm Ultra for subtle volume and definition. Results shown at 2 weeks.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="laser">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Laser Skin Rejuvenation</h3>
                        <p class="gallery-card__desc">3 sessions of laser resurfacing for sun damage and hyperpigmentation. Results at 6 weeks.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="fillers">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Cheek & Jawline Fillers</h3>
                        <p class="gallery-card__desc">2 syringes of Voluma for cheek augmentation and jawline contour. Results at 2 weeks.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="microneedling">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Microneedling — Acne Scarring</h3>
                        <p class="gallery-card__desc">4 sessions of microneedling with PRP for acne scar improvement. Results at 3 months.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="peels">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Chemical Peel — Melasma</h3>
                        <p class="gallery-card__desc">Series of 3 VI Peels for melasma and uneven skin tone. Results at 8 weeks.</p>
                    </div>
                </div>
            </div>

            <div class="gallery-disclaimer reveal">
                <p>* Individual results may vary. All photos are of actual Livia Med Spa patients and are unretouched.</p>
            </div>
        </div>
    </section>

    <section class="cta-section" aria-label="Book your transformation">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Your Transformation Awaits</span>
            <h2 class="cta-section__title">Ready for Your<br>Before & After?</h2>
            <p class="cta-section__text">Book a consultation and start your journey to natural, beautiful results.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
