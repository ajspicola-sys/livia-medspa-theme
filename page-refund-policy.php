<?php
/**
 * LIVIA Med Spa — Refund Policy Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Refund Policy">
        <div class="page-hero__inner">
            <span class="section__label">Legal</span>
            <h1 class="page-hero__title">Refund Policy</h1>
            <p class="page-hero__desc">Our commitment to transparency and fairness for every client.</p>
        </div>
    </section>

    <section class="legal-page">
        <div class="legal-page__inner">

            <div class="legal-page__intro cancellation-notice">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p><strong>WE DO NOT GIVE REFUNDS ON ANY SERVICE.</strong></p>
            </div>

            <div class="legal-page__body">

                <section id="products">
                    <h2>Products</h2>
                    <p>At LIVIA Med Spa, <strong>all product sales are final.</strong> However, if you experience a skin reaction to one of our products, it may be returned within <strong>7 days</strong> for <strong>in-store product credit only</strong>.</p>
                </section>

                <section id="services">
                    <h2>Services</h2>
                    <p>At LIVIA Med Spa, we strive to ensure every client has the best possible treatment experience. Before services are performed, we review treatment objectives, expected outcomes, benefits, and risks to help you make informed decisions.</p>

                    <div class="refund-policy-cards">
                        <div class="refund-policy-card">
                            <div class="refund-policy-card__icon">🚫</div>
                            <h3>No Refunds on Services</h3>
                            <p>Once services are purchased, they are <strong>non-refundable</strong>.</p>
                        </div>
                        <div class="refund-policy-card refund-policy-card--positive">
                            <div class="refund-policy-card__icon">✅</div>
                            <h3>Unused Service Values</h3>
                            <p>Any unused service value (the credit equivalent of the remaining amount in a treatment package) may be <strong>applied toward any other service</strong> at LIVIA Med Spa.</p>
                        </div>
                    </div>
                </section>

                <section id="injectables">
                    <h2>Injectables</h2>
                    <p>All injectable treatment sales — including but not limited to <strong>Botox, Jeuveau, and dermal fillers</strong> — are <strong>final</strong>.</p>
                    <p>Once a treatment is completed, refunds or credits cannot be issued.</p>
                </section>

                <section id="commitment">
                    <h2>Our Commitment</h2>
                    <p>This policy is designed to ensure transparency and fairness while upholding the highest standard of care for all our clients.</p>
                    <p>If you have any questions about our refund policy or your treatment, our team is always here to help.</p>
                    <div style="margin-top:2rem;text-align:center;">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Speak With Our Team</a>
                    </div>
                </section>

            </div><!-- .legal-page__body -->
        </div><!-- .legal-page__inner -->
    </section>

</main>

<?php get_footer(); ?>
