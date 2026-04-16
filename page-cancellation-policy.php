<?php
/**
 * Livia Med Spa — Cancellation & Financial Policy Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Cancellation & Financial Policy">
        <div class="page-hero__inner">
            <span class="section__label">Legal</span>
            <h1 class="page-hero__title">Cancellation &amp; Financial Policy</h1>
            <p class="page-hero__desc">Please read our policies carefully before booking your appointment.</p>
        </div>
    </section>

    <section class="legal-page">
        <div class="legal-page__inner">

            <div class="legal-page__intro cancellation-notice">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p><strong>PLEASE NOTE: WE DO NOT GIVE REFUNDS ON ANY SERVICE.</strong></p>
            </div>

            <div class="legal-page__body">

                <section id="payment-methods">
                    <h2>Payment Methods</h2>
                    <p>We accept <strong>Cash, AMEX, Visa, and MasterCard</strong>. A valid credit card is required to schedule an appointment, along with a <strong>20% deposit</strong> applied toward your service. Payment is due at the time of service.</p>
                    <p>All cards on file are added through a <strong>secure electronic process</strong> that ensures encryption and the highest level of protection.</p>
                </section>

                <section id="cancellation-policy">
                    <h2>Cancellation &amp; No-Show Policy</h2>
                    <p>To provide the best service for all guests, we strictly enforce our cancellation policy:</p>

                    <div class="cancellation-grid">
                        <div class="cancellation-card cancellation-card--warn">
                            <div class="cancellation-card__icon">⏰</div>
                            <div class="cancellation-card__body">
                                <h3>Cancellations within 24–48 hours</h3>
                                <p><strong>50% of the treatment cost</strong> will be charged.</p>
                            </div>
                        </div>
                        <div class="cancellation-card cancellation-card--danger">
                            <div class="cancellation-card__icon">🚫</div>
                            <div class="cancellation-card__body">
                                <h3>Cancellations within 24 hours or No-Shows</h3>
                                <p><strong>100% of the treatment cost</strong> will be charged.</p>
                            </div>
                        </div>
                        <div class="cancellation-card cancellation-card--info">
                            <div class="cancellation-card__icon">🔁</div>
                            <div class="cancellation-card__body">
                                <h3>Repeat Cancellations (within 48 hours, twice)</h3>
                                <p><strong>Prepayment</strong> will be required for your next treatment.</p>
                            </div>
                        </div>
                    </div>

                    <p>If you arrive late, we will make every effort to accommodate your full appointment; however, service time may be abbreviated to avoid delaying other guests and <strong>will be charged at full value</strong>. Appointments missed by <strong>10 minutes or more</strong> are subject to cancellation fees.</p>
                </section>

                <section id="beauty-bank-policy">
                    <h2>Beauty Bank Policy</h2>
                    <ul>
                        <li><strong>Minimum Commitment:</strong> Beauty Bank memberships require a <strong>minimum six (6) month commitment</strong>.</li>
                        <li><strong>Early Cancellation:</strong> If you cancel your Beauty Bank membership prior to completing the six-month commitment, you will be responsible for repaying <strong>any discounts or promotional pricing received</strong> during your membership.</li>
                    </ul>
                </section>

                <section id="exceptions">
                    <h2>Exceptions</h2>
                    <p>We understand that emergencies happen. Exceptions include:</p>
                    <ul>
                        <li>Medical emergencies</li>
                        <li>Contagious illness <em>(please stay home if you are sick to protect our staff and clients)</em></li>
                    </ul>
                    <p>You will not be penalized in these situations.</p>
                </section>

                <section id="declined-payments">
                    <h2>Declined Payments</h2>
                    <p>If your credit card payment is declined, the balance must be paid in full before booking another appointment. Unresolved balances may be sent to collections if not resolved within <strong>24 hours</strong>.</p>
                </section>

                <section id="limitations">
                    <h2>Limitations of Charges</h2>
                    <p>Charges under this agreement apply only to services provided on the stated date of service at our facility. They do not include charges from any other providers or facilities.</p>
                </section>

                <section id="additional-provisions">
                    <h2>Additional Provisions</h2>
                    <ol>
                        <li>If any portion of this Agreement is deemed invalid, the remaining terms shall remain in full effect.</li>
                        <li>Should a lawsuit be filed to collect fees or enforce this Agreement, the prevailing party will be entitled to reasonable costs and attorney's fees.</li>
                        <li>This Financial Policy and Agreement is the <strong>entire agreement</strong> between parties and supersedes all prior agreements, written or oral. Any changes must be made in writing and signed by all parties.</li>
                    </ol>
                </section>

                <section id="acknowledgement">
                    <h2>Acknowledgement</h2>
                    <p>We are committed to serving you with the highest quality care at an affordable cost. If you have questions regarding these policies, please reach out at any time. Thank you for your cooperation.</p>
                    <blockquote class="legal-quote">
                        <strong>I have read and understand this Financial Policy and Agreement.</strong><br><br>
                        I authorize <strong>Livia Med Spa / Angela Spicola, APRN</strong> to charge my credit card for no-show appointments, late cancellation fees, Beauty Bank early-cancellation penalties, and statement balances.
                    </blockquote>
                    <div style="margin-top:2rem;text-align:center;">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Questions? Contact Us</a>
                    </div>
                </section>

            </div><!-- .legal-page__body -->
        </div><!-- .legal-page__inner -->
    </section>

</main>

<?php get_footer(); ?>
