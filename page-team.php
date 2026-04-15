<?php
/**
 * Template Name: Team
 * Livia Med Spa — Meet the Team Page
 */
get_header(); ?>

<main class="site-main">

    <section class="page-hero">
        <div class="page-hero__inner">
            <span class="section__label">Our Experts</span>
            <h1 class="page-hero__title">Meet the Team</h1>
            <p class="page-hero__desc">Board-certified providers with decades of combined experience delivering natural, beautiful results.</p>
        </div>
    </section>

    <section class="team-full">
        <div class="section__inner">
            <div class="team-full__grid">

                <!-- Team Member 1 -->
                <div class="team-member reveal">
                    <div class="team-member__image">
                        <div class="team-card__placeholder team-card__placeholder--lg">DR</div>
                    </div>
                    <div class="team-member__info">
                        <h2 class="team-member__name">Dr. Rachel Torres</h2>
                        <span class="team-member__role">Medical Director, MD</span>
                        <div class="team-member__credentials">
                            <span class="team-member__badge">Board Certified</span>
                            <span class="team-member__badge">12+ Years</span>
                            <span class="team-member__badge">AAAM Member</span>
                        </div>
                        <p class="team-member__bio">Dr. Torres founded Livia Med Spa with a vision to bring medical-grade aesthetic treatments to Tampa in a warm, personalized environment. With over 12 years of experience in aesthetic medicine, she has performed thousands of injectable procedures and has become one of Tampa's most sought-after providers.</p>
                        <p class="team-member__bio">Her philosophy centers on celebrating each patient's unique features while subtly enhancing their natural beauty. She holds advanced certifications in neurotoxins, dermal fillers, and regenerative medicine.</p>
                        <div class="team-member__specialties">
                            <span class="team-member__specialty">Botox & Dysport</span>
                            <span class="team-member__specialty">Dermal Fillers</span>
                            <span class="team-member__specialty">PRP Therapy</span>
                            <span class="team-member__specialty">Facial Sculpting</span>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-member team-member--reverse reveal">
                    <div class="team-member__image">
                        <div class="team-card__placeholder team-card__placeholder--lg">SM</div>
                    </div>
                    <div class="team-member__info">
                        <h2 class="team-member__name">Sarah Mitchell, PA-C</h2>
                        <span class="team-member__role">Lead Injector, Physician Assistant</span>
                        <div class="team-member__credentials">
                            <span class="team-member__badge">NCCPA Certified</span>
                            <span class="team-member__badge">8+ Years</span>
                        </div>
                        <p class="team-member__bio">Sarah brings an artistic eye and meticulous technique to every treatment. With specialized training from the Allergan Medical Institute, she is recognized for her ability to create natural, balanced results that enhance each patient's individual features.</p>
                        <p class="team-member__bio">Patients love Sarah's warm bedside manner and her talent for making first-time clients feel completely at ease. She believes that great aesthetics starts with listening.</p>
                        <div class="team-member__specialties">
                            <span class="team-member__specialty">Advanced Fillers</span>
                            <span class="team-member__specialty">Lip Augmentation</span>
                            <span class="team-member__specialty">Neurotoxins</span>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-member reveal">
                    <div class="team-member__image">
                        <div class="team-card__placeholder team-card__placeholder--lg">JC</div>
                    </div>
                    <div class="team-member__info">
                        <h2 class="team-member__name">Jennifer Chen, RN, BSN</h2>
                        <span class="team-member__role">Aesthetic Nurse Specialist</span>
                        <div class="team-member__credentials">
                            <span class="team-member__badge">RN Licensed</span>
                            <span class="team-member__badge">6+ Years</span>
                            <span class="team-member__badge">Laser Certified</span>
                        </div>
                        <p class="team-member__bio">Jennifer is our laser and skin rejuvenation expert. With specialized training in advanced laser systems and chemical peels, she helps patients achieve their best skin through customized treatment protocols.</p>
                        <p class="team-member__bio">Her passion for patient education means you'll always leave understanding your treatment, your expected results, and how to maintain them at home.</p>
                        <div class="team-member__specialties">
                            <span class="team-member__specialty">Laser Treatments</span>
                            <span class="team-member__specialty">Chemical Peels</span>
                            <span class="team-member__specialty">Microneedling</span>
                            <span class="team-member__specialty">Skin Analysis</span>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-member team-member--reverse reveal">
                    <div class="team-member__image">
                        <div class="team-card__placeholder team-card__placeholder--lg">AL</div>
                    </div>
                    <div class="team-member__info">
                        <h2 class="team-member__name">Amanda Lopez</h2>
                        <span class="team-member__role">Patient Experience Coordinator</span>
                        <div class="team-member__credentials">
                            <span class="team-member__badge">5+ Years in Aesthetics</span>
                        </div>
                        <p class="team-member__bio">Amanda is the heart of the Livia experience. From your very first phone call to post-treatment follow-up, she ensures every interaction is warm, professional, and stress-free.</p>
                        <p class="team-member__bio">She manages scheduling, treatment plans, and membership programs, and is always available to answer questions or help you find the perfect treatment for your goals.</p>
                        <div class="team-member__specialties">
                            <span class="team-member__specialty">Patient Care</span>
                            <span class="team-member__specialty">Treatment Planning</span>
                            <span class="team-member__specialty">Memberships</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Book With Us</span>
            <h2 class="cta-section__title">Ready to Meet<br>Your Provider?</h2>
            <p class="cta-section__text">Schedule a complimentary consultation and let our experts create your personalized treatment plan.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Book Consultation</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
