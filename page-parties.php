<?php
/**
 * Template Name: Parties
 * Livia Med Spa — Botox & Glo2Facial Parties
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero page-hero--parties" aria-label="Beauty parties">
        <div class="page-hero__inner">
            <span class="section__label"><span aria-hidden="true">🥂</span> Beauty & Wellness Parties</span>
            <h1 class="page-hero__title">Host a Glamorous Event<br>with <em>Livia Med Spa</em></h1>
            <p class="page-hero__desc">Whether it's a girls' night, birthday bash, bridal event, or corporate wellness day — our parties combine luxury, laughter, and expert care in one unforgettable experience.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book a Party →</a>
                <a href="#party-types" class="btn btn--outline btn--lg">Explore Parties</a>
            </div>
        </div>
    </section>

    <!-- Party Types -->
    <section class="party-types" id="party-types">
        <div class="section__inner">

            <!-- Botox Party -->
            <div class="party-block reveal">
                <div class="party-block__header">
                    <span class="party-block__emoji">💉</span>
                    <div>
                        <span class="section__label">Party Type 01</span>
                        <h2 class="section__title">Botox Party</h2>
                    </div>
                </div>
                <div class="party-block__grid">
                    <div class="party-block__content">
                        <h3 class="party-block__subtitle">The Glow-Down on Botox Parties</h3>
                        <p class="party-block__text">A Botox party is a social, relaxing event where you and your guests receive professional Botox treatments in a private group setting. Our skilled injectors provide safe, FDA-approved Botox in a fun and laid-back environment.</p>
                        <p class="party-block__text">Whether you host at our med spa or prefer your home, office, or private venue, we bring the expertise — and the glow!</p>
                        <div class="party-block__features">
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">✅</div>
                                <h4 class="party-feature-card__title">FDA-Approved Treatments</h4>
                                <p class="party-feature-card__text">We only use safe, clinically tested products like Botox® Cosmetic, approved by the FDA for reducing fine lines and wrinkles. You can trust you're receiving the highest quality in every dose.</p>
                            </div>
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">👩‍⚕️</div>
                                <h4 class="party-feature-card__title">Certified Medical Professionals</h4>
                                <p class="party-feature-card__text">Your party will be staffed by our trained injectors — licensed, experienced, and passionate about natural-looking results. Every treatment is performed with expert precision.</p>
                            </div>
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">🎉</div>
                                <h4 class="party-feature-card__title">Comfortable & Fun Atmosphere</h4>
                                <p class="party-feature-card__text">Whether at our med spa or in the comfort of your home, we create a stylish, relaxed space where you and your guests can unwind, enjoy refreshments, and feel pampered.</p>
                            </div>
                        </div>
                    </div>
                    <div class="party-block__visual">
                        <div class="party-block__video-wrapper">
                            <iframe
                                srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 .5em black}</style><a href='https://www.youtube.com/embed/cXLYHldxOy8?autoplay=1'><img src='https://img.youtube.com/vi/cXLYHldxOy8/hqdefault.jpg' alt='Livia Botox Party Video'><span>&#x25B6;</span></a>"
                                title="Livia Botox Party"
                                frameborder="0"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg" style="width:100%;margin-top:1.5rem;">Book a Botox Party →</a>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="party-divider reveal">
                <div class="party-divider__line"></div>
                <span class="party-divider__text">or</span>
                <div class="party-divider__line"></div>
            </div>

            <!-- Glo2Facial Party -->
            <div class="party-block reveal">
                <div class="party-block__header">
                    <span class="party-block__emoji">✨</span>
                    <div>
                        <span class="section__label">Party Type 02</span>
                        <h2 class="section__title">Glo2Facial Party</h2>
                    </div>
                </div>
                <div class="party-block__grid party-block__grid--reverse">
                    <div class="party-block__content">
                        <h3 class="party-block__subtitle">Glow Together, Shine All Day</h3>
                        <p class="party-block__text">Gather your besties and get ready for the ultimate skin-refreshing celebration. A Glo2Facial Party is a group self-care experience where everyone receives our signature three-in-one facial in a social, relaxed setting.</p>
                        <p class="party-block__text">Whether you're prepping for an event or just want to glow up with your girls, this is skincare with a side of fun. We bring the beauty to you — or host at our luxurious med spa in Tampa!</p>
                        <div class="party-block__features">
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">🌟</div>
                                <h4 class="party-feature-card__title">Instantly Glowing Skin</h4>
                                <p class="party-feature-card__text">Each facial deeply exfoliates, oxygenates, and infuses nutrients — leaving your skin smooth, dewy, and red-carpet ready with zero downtime.</p>
                            </div>
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">🫧</div>
                                <h4 class="party-feature-card__title">Boosts Oxygen from Within</h4>
                                <p class="party-feature-card__text">Unlike traditional facials, this treatment stimulates natural oxygenation from inside your skin, promoting better absorption of active ingredients and a lasting glow.</p>
                            </div>
                            <div class="party-feature-card">
                                <div class="party-feature-card__icon">📸</div>
                                <h4 class="party-feature-card__title">Event-Ready in One Session</h4>
                                <p class="party-feature-card__text">There's no redness or peeling, just radiant results. Snap selfies with confidence — your skin will be glowing the same day.</p>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg" style="margin-top:1.5rem;">Book a Glo2Facial Party →</a>
                    </div>
                    <div class="party-block__visual">
                        <div class="party-block__image-placeholder">
                            <span>✨</span>
                            <p>Glo2Facial Experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="party-how-it-works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Planning Your Party is Easy</h2>
            </div>
            <div class="party-steps reveal">
                <div class="party-step">
                    <div class="party-step__number">01</div>
                    <h3 class="party-step__title">Choose Your Party</h3>
                    <p class="party-step__text">Pick between a Botox Party, Glo2Facial Party, or combine both for the ultimate glow-up experience.</p>
                </div>
                <div class="party-step__arrow">→</div>
                <div class="party-step">
                    <div class="party-step__number">02</div>
                    <h3 class="party-step__title">Pick a Date & Location</h3>
                    <p class="party-step__text">Host at our luxurious med spa, your home, office, or any private venue in the Greater Tampa Bay area.</p>
                </div>
                <div class="party-step__arrow">→</div>
                <div class="party-step">
                    <div class="party-step__number">03</div>
                    <h3 class="party-step__title">Invite Your Crew</h3>
                    <p class="party-step__text">Gather 4+ friends and get ready for an unforgettable beauty experience with expert-level treatments.</p>
                </div>
                <div class="party-step__arrow">→</div>
                <div class="party-step">
                    <div class="party-step__number">04</div>
                    <h3 class="party-step__title">Glow Together!</h3>
                    <p class="party-step__text">Enjoy refreshments, expert treatments, and leave looking and feeling absolutely radiant.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="party-faq">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Questions?</span>
                <h2 class="section__title">Party FAQ</h2>
            </div>
            <div class="faq-list reveal">
                <details class="faq-item">
                    <summary class="faq-item__question">Is Botox safe to get in a party setting?</summary>
                    <div class="faq-item__answer">
                        <p>Yes! All Botox treatments are administered by our licensed medical professionals in a clean, controlled environment. We follow all safety protocols — just like we would during a private appointment.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Do you travel outside of Tampa?</summary>
                    <div class="faq-item__answer">
                        <p>We serve the greater Tampa Bay area, including St. Pete, Clearwater, Wesley Chapel, and surrounding cities. If you're outside this zone, let us know — travel may still be possible!</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">What's included in a Glo2Facial party?</summary>
                    <div class="faq-item__answer">
                        <p>Each guest receives a customized Glo2Facial — a relaxing treatment that oxygenates, exfoliates, and infuses skin with nutrients. It's safe, gentle, and delivers an instant glow with no downtime.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">How many guests can attend?</summary>
                    <div class="faq-item__answer">
                        <p>We recommend a minimum of 4 guests and can accommodate up to 15 depending on the venue and treatments chosen. Contact us for larger groups — we'll make it work!</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Can I combine Botox and Glo2Facial at one party?</summary>
                    <div class="faq-item__answer">
                        <p>Absolutely! Many hosts choose to offer both options so guests can pick their treatment. It makes for an even more luxurious experience.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>
    <!-- Party Testimonials -->
    <section class="testimonials-section" aria-label="Party testimonials">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">What Hosts Are Saying</span>
                <h2 class="section__title">Party Reviews</h2>
            </div>
            <div class="testimonials-grid reveal">
                <div class="testimonial-card">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"Best girls' night EVER! The team was so professional and made everyone feel comfortable. We're already planning our next one!"</p>
                    <div class="testimonial-card__author">
                        <strong>Sarah M.</strong>
                        <span>Botox Party Host</span>
                    </div>
                </div>
                <div class="testimonial-card testimonial-card--featured">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"I hosted a bridal party glow-up and it was absolutely perfect. Every guest left glowing — literally. The Glo2Facial was a hit!"</p>
                    <div class="testimonial-card__author">
                        <strong>Jessica L.</strong>
                        <span>Bridal Party Host</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-card__stars" aria-label="5 out of 5 stars">★★★★★</div>
                    <p class="testimonial-card__text">"We did a corporate wellness day with Livia. The team brought everything to our office and the employees loved it. Huge morale boost!"</p>
                    <div class="testimonial-card__author">
                        <strong>Amanda K.</strong>
                        <span>Corporate Wellness Event</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Celebrate?</span>
            <h2 class="cta-section__title">Book Your<br>Glow-Up Party</h2>
            <p class="cta-section__text">Contact us to plan the ultimate beauty experience for you and your friends.</p>
            <p class="cta-section__urgency">⚡ Limited weekend spots available — book early!</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book a Party</a>
                <a href="tel:8132302219" class="btn btn--outline btn--lg">Call (813) 230-2219</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
