<?php
/**
 * LIVIA Med Spa — Content Seeding & Migration
 * One-time creation of pages, starter posts, services, and gallery
 * items, the demo importer, and the service data migrator.
 *
 * Split out of functions.php; load order is defined there.
 */

// ── Auto-create All Pages ──────────────────────────────────────────
function livia_create_pages() {
    if (get_option('livia_pages_created_v5')) return;

    $pages = [
        'Home'           => '',
        'About'          => '',
        'Team'           => '',
        'Values'         => '',
        'Contact'        => '',
        'Before After'   => '',
        'Careers'        => '',
        'Parties'        => '',
        'Memberships'    => '',
        'Blog'           => '',
        'Financing'      => '',
    ];

    foreach ($pages as $title => $content) {
        // Skip if page already exists
        $existing = get_page_by_title($title, OBJECT, 'page');
        if ($existing) continue;

        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);

        // Set Home as static front page
        if ($title === 'Home' && $page_id && !is_wp_error($page_id)) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $page_id);
        }

        // Set Blog as posts page
        if ($title === 'Blog' && $page_id && !is_wp_error($page_id)) {
            update_option('page_for_posts', $page_id);
        }
    }

    update_option('livia_pages_created_v5', true);
}
add_action('after_switch_theme', 'livia_create_pages');


// ── Fix Reading Settings (one-time) ───────────────────────────────
function livia_fix_reading_settings() {
    if (get_option('livia_reading_fixed_v2')) return;

    // Find the Blog page and set it as posts page
    $blog_page = get_page_by_title('Blog', OBJECT, 'page');
    if ($blog_page) {
        update_option('show_on_front', 'page');
        update_option('page_for_posts', $blog_page->ID);
    }

    // Find the Home page and set it as front page
    $home_page = get_page_by_title('Home', OBJECT, 'page');
    if ($home_page) {
        update_option('page_on_front', $home_page->ID);
    }

    // Auto-create Financing page if it doesn't exist
    $financing = get_page_by_title('Financing', OBJECT, 'page');
    if (!$financing) {
        wp_insert_post([
            'post_title'  => 'Financing',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]);
    }

    update_option('livia_reading_fixed_v2', true);
}
add_action('init', 'livia_fix_reading_settings');


// ── Shared helper: check if a page with a given slug exists (any status) ──
function livia_page_slug_exists( $slug ) {
    $q = new WP_Query([
        'post_type'              => 'page',
        'name'                   => $slug,
        'post_status'            => 'any',
        'posts_per_page'         => 1,
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ]);
    return $q->have_posts();
}


// ── Auto-create Privacy Policy page ───────────────────────────────────
function livia_create_privacy_page() {
    if ( get_option('livia_privacy_page_created_v2') ) return; // v2: force re-check for missing page
    if ( ! livia_page_slug_exists('privacy-policy') ) {
        wp_insert_post([
            'post_title'   => 'Privacy Policy',
            'post_name'    => 'privacy-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_privacy_page_created_v2', true);
}
add_action('init', 'livia_create_privacy_page');

// ── Auto-create Cancellation Policy page ──────────────────────────────
function livia_create_cancellation_page() {
    if ( get_option('livia_cancellation_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('cancellation-policy') ) {
        wp_insert_post([
            'post_title'   => 'Cancellation Policy',
            'post_name'    => 'cancellation-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_cancellation_page_created_v1', true);
}
add_action('init', 'livia_create_cancellation_page');

// ── Auto-create Refund Policy page ────────────────────────────────────
function livia_create_refund_page() {
    if ( get_option('livia_refund_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('refund-policy') ) {
        wp_insert_post([
            'post_title'   => 'Refund Policy',
            'post_name'    => 'refund-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_refund_page_created_v1', true);
}
add_action('init', 'livia_create_refund_page');

// ── Auto-create Beauty Bank page ──────────────────────────────────────
function livia_create_beauty_bank_page() {
    if ( get_option('livia_beauty_bank_page_created_v1') ) return;
    if ( ! livia_page_slug_exists('beauty-bank') ) {
        wp_insert_post([
            'post_title'   => 'Beauty Bank Membership',
            'post_name'    => 'beauty-bank',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('livia_beauty_bank_page_created_v1', true);
}
add_action('init', 'livia_create_beauty_bank_page');


// ── Auto-create Starter Blog Posts ─────────────────────────────────
function livia_create_blog_posts() {
    if (get_option('livia_blog_created_v1')) return;

    // Create blog categories
    $categories = ['Skincare', 'Injectables', 'Wellness', 'Treatments', 'Beauty Tips'];
    $cat_ids = [];
    foreach ($categories as $cat) {
        $existing = term_exists($cat, 'category');
        if ($existing) {
            $cat_ids[$cat] = $existing['term_id'];
        } else {
            $term = wp_insert_term($cat, 'category');
            if (!is_wp_error($term)) {
                $cat_ids[$cat] = $term['term_id'];
            }
        }
    }

    $posts = [
        [
            'title'    => 'Botox vs. Fillers: Which Is Right for You?',
            'category' => 'Injectables',
            'excerpt'  => 'Understanding the difference between neuromodulators and dermal fillers is key to choosing the right treatment for your aesthetic goals.',
            'content'  => '<h2>Understanding the Difference</h2>
<p>One of the most common questions we hear at LIVIA Med Spa is: "Should I get Botox or fillers?" While both are injectable treatments that can help you look younger, they work in fundamentally different ways.</p>

<h3>Botox: The Wrinkle Relaxer</h3>
<p>Botox (and similar neuromodulators like Dysport and Jeuveau) works by temporarily relaxing the muscles that cause dynamic wrinkles — think forehead lines, crow\'s feet, and frown lines between the brows. It\'s ideal for wrinkles that appear when you make facial expressions.</p>

<h3>Dermal Fillers: The Volume Restorer</h3>
<p>Fillers, on the other hand, work by adding volume beneath the skin\'s surface. They\'re perfect for plumping lips, restoring lost cheek volume, smoothing nasolabial folds, and enhancing facial contours. Popular brands include Juvéderm and Restylane.</p>

<h3>Which Should You Choose?</h3>
<p>The answer depends on your specific concerns. Many of our clients at LIVIA Med Spa benefit from a combination of both treatments — what we call a "liquid facelift." During your complimentary consultation, our expert injectors will create a customized treatment plan tailored to your unique facial anatomy and goals.</p>

<p><strong>Ready to find out which treatment is right for you?</strong> Book a free consultation at LIVIA Med Spa today.</p>',
        ],
        [
            'title'    => 'The Ultimate Guide to Medical-Grade Skincare',
            'category' => 'Skincare',
            'excerpt'  => 'Why medical-grade products outperform drugstore brands and how to build a results-driven skincare routine.',
            'content'  => '<h2>Why Medical-Grade Matters</h2>
<p>Not all skincare is created equal. While drugstore products can provide basic hydration and sun protection, medical-grade skincare is formulated with higher concentrations of active ingredients that penetrate deeper into the skin for visible, lasting results.</p>

<h3>Key Differences</h3>
<p>Medical-grade products, like those from ZO Skin Health (which we carry at LIVIA Med Spa), are backed by clinical research and contain pharmaceutical-grade ingredients. They\'re designed to target specific skin concerns at the cellular level — something over-the-counter products simply can\'t match.</p>

<h3>Building Your Routine</h3>
<p>A solid medical-grade skincare routine includes four essential steps:</p>
<ul>
<li><strong>Cleanser</strong> — Remove impurities without stripping your skin</li>
<li><strong>Active Treatment</strong> — Target specific concerns (retinol, vitamin C, etc.)</li>
<li><strong>Moisturizer</strong> — Lock in hydration and protect the skin barrier</li>
<li><strong>Sunscreen</strong> — The single most important anti-aging product you can use</li>
</ul>

<p>Our providers at LIVIA Med Spa can analyze your skin and recommend the exact products you need. No guesswork, no wasted money on products that don\'t work.</p>',
        ],
        [
            'title'    => 'What to Expect at Your First Med Spa Visit',
            'category' => 'Treatments',
            'excerpt'  => 'A complete walkthrough of your consultation, treatment, and aftercare at LIVIA Med Spa — so you know exactly what to expect.',
            'content'  => '<h2>Your First Visit, Demystified</h2>
<p>If you\'ve never been to a med spa before, it\'s completely normal to feel a mix of excitement and nervousness. At LIVIA Med Spa, we\'ve designed every step of the experience to make you feel comfortable, informed, and cared for.</p>

<h3>Step 1: The Consultation</h3>
<p>Every journey starts with a free, no-pressure consultation. You\'ll meet with one of our expert providers to discuss your goals, concerns, and medical history. We\'ll examine your skin and recommend treatments that align with your budget and expectations.</p>

<h3>Step 2: Your Treatment</h3>
<p>On treatment day, you\'ll be welcomed into our luxury treatment suite. Depending on the procedure, the process can take anywhere from 15 minutes (for Botox) to 60 minutes (for a Glo2Facial or microneedling). Most treatments are minimally invasive with little to no downtime.</p>

<h3>Step 3: Aftercare</h3>
<p>We\'ll provide clear aftercare instructions and schedule any follow-up appointments. Our team is always available by phone or text if you have questions during your recovery.</p>

<p><strong>Ready to take the first step?</strong> Book your complimentary consultation at LIVIA Med Spa today.</p>',
        ],
        [
            'title'    => '5 Anti-Aging Treatments That Actually Work',
            'category' => 'Beauty Tips',
            'excerpt'  => 'Cut through the noise — these are the five proven anti-aging treatments our providers recommend most.',
            'content'  => '<h2>Evidence-Based Anti-Aging</h2>
<p>The beauty industry is full of promises, but only a handful of treatments deliver scientifically proven results. Here are the five anti-aging treatments we recommend most at LIVIA Med Spa.</p>

<h3>1. Botox & Neuromodulators</h3>
<p>The gold standard for preventing and treating dynamic wrinkles. Regular treatments can actually slow the formation of new lines over time.</p>

<h3>2. Microneedling with PRP</h3>
<p>By creating micro-injuries in the skin and applying platelet-rich plasma, this treatment stimulates your body\'s natural collagen production for firmer, more youthful skin.</p>

<h3>3. Chemical Peels</h3>
<p>Medical-grade peels remove damaged outer layers to reveal fresh, even-toned skin underneath. They\'re excellent for hyperpigmentation, fine lines, and overall texture improvement.</p>

<h3>4. Laser Skin Resurfacing</h3>
<p>Our Helix CO2 laser delivers dramatic results for deep wrinkles, scars, and sun damage by stimulating new collagen growth at the deepest layers of skin.</p>

<h3>5. Medical-Grade Retinol</h3>
<p>Prescription-strength retinol is the most well-researched anti-aging ingredient in skincare. It accelerates cell turnover, boosts collagen, and fades discoloration.</p>

<p><strong>Want a personalized anti-aging plan?</strong> Our experts will create a custom treatment roadmap during your free consultation.</p>',
        ],
        [
            'title'    => 'The Benefits of IV Therapy for Skin Health',
            'category' => 'Wellness',
            'excerpt'  => 'Discover how IV vitamin infusions can transform your skin from the inside out — boosting hydration, glow, and cellular repair.',
            'content'  => '<h2>Beauty From the Inside Out</h2>
<p>While topical treatments and procedures work on the surface, true skin health starts from within. That\'s where IV therapy comes in — delivering essential vitamins, minerals, and antioxidants directly to your bloodstream for maximum absorption.</p>

<h3>How IV Therapy Helps Your Skin</h3>
<p>Our custom IV drips at LIVIA Med Spa are formulated with skin-boosting nutrients including:</p>
<ul>
<li><strong>Vitamin C</strong> — A powerful antioxidant that brightens skin and supports collagen production</li>
<li><strong>Glutathione</strong> — The "master antioxidant" that detoxifies and promotes an even, luminous complexion</li>
<li><strong>B-Complex Vitamins</strong> — Essential for cellular repair and energy production</li>
<li><strong>Zinc</strong> — Supports skin healing and reduces inflammation</li>
</ul>

<h3>Beyond Skin Benefits</h3>
<p>IV therapy also boosts energy, strengthens immunity, and helps with recovery after intense workouts or travel. Many of our clients schedule regular drips as part of their overall wellness routine.</p>

<p><strong>Try it yourself.</strong> Book an IV therapy session at LIVIA Med Spa and feel the difference within hours.</p>',
        ],
        [
            'title'    => 'Glo2Facial: Why Tampa\'s It-Girls Are Obsessed',
            'category' => 'Treatments',
            'excerpt'  => 'The Glo2Facial is the hottest facial treatment in Tampa right now — here\'s why everyone is booking one.',
            'content'  => '<h2>The Facial That Changed Everything</h2>
<p>If you\'ve been on Instagram lately, you\'ve probably seen the Glo2Facial everywhere. This innovative three-in-one treatment has taken Tampa by storm — and for good reason.</p>

<h3>What Makes It Special?</h3>
<p>Unlike traditional facials, the Glo2Facial uses a proprietary OxyPods technology that triggers a natural oxygenation process from within your skin. This means nutrients are absorbed more effectively, leading to better, longer-lasting results.</p>

<h3>The Three-Step Process</h3>
<ol>
<li><strong>Exfoliate</strong> — Gentle resurfacing removes dead skin cells and prepares the skin</li>
<li><strong>Oxygenate</strong> — The OxyPods reaction floods skin with oxygen from within</li>
<li><strong>Infuse</strong> — Nutrient-rich serums are pushed deeper into the skin for maximum absorption</li>
</ol>

<h3>Why We Love It</h3>
<p>The Glo2Facial delivers instant, visible results with absolutely zero downtime. You can literally get one on your lunch break and return to work glowing. It\'s safe for all skin types and can be customized for specific concerns like hydration, brightening, or anti-aging.</p>

<p><strong>Want that Tampa glow?</strong> Book your Glo2Facial at LIVIA Med Spa — or host a Glo2Facial Party with your friends!</p>',
        ],
    ];

    foreach ($posts as $post_data) {
        $existing = get_page_by_title($post_data['title'], OBJECT, 'post');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_title'   => $post_data['title'],
            'post_excerpt' => $post_data['excerpt'],
            'post_content' => $post_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days')),
        ]);

        if ($post_id && !is_wp_error($post_id) && isset($cat_ids[$post_data['category']])) {
            wp_set_post_categories($post_id, [$cat_ids[$post_data['category']]]);
        }
    }

    update_option('livia_blog_created_v1', true);
}
add_action('after_switch_theme', 'livia_create_blog_posts');
add_action('init', 'livia_create_blog_posts');


// ── Auto-create All Services ───────────────────────────────────────
function livia_create_services() {
    if (get_option('livia_services_created_v2')) return;

    // 3 broad categories that fit the mega menu grid perfectly
    $categories = [
        'Injectables'       => 'Premium injectable treatments including Botox, fillers, and neuromodulators for facial rejuvenation.',
        'Skin & Facials'    => 'Advanced skin treatments from chemical peels and microneedling to laser resurfacing and facials.',
        'Body & Wellness'   => 'Body contouring, hair restoration, IV therapy, and wellness treatments for total transformation.',
    ];

    $cat_ids = [];
    foreach ($categories as $name => $desc) {
        $existing = term_exists($name, 'service_category');
        if ($existing) {
            $cat_ids[$name] = $existing['term_id'];
        } else {
            $term = wp_insert_term($name, 'service_category', ['description' => $desc]);
            if (!is_wp_error($term)) {
                $cat_ids[$name] = $term['term_id'];
            }
        }
    }

    // Define all 18 services across 3 categories
    $services = [
        // ── Injectables (3 services) ──────────────────────────────
        [
            'title'    => 'Botox',
            'icon'     => '💉',
            'category' => 'Injectables',
            'excerpt'  => 'Smooth away fine lines and wrinkles with the world\'s most trusted neuromodulator, expertly administered for natural-looking results.',
        ],
        [
            'title'    => 'Jeuveau',
            'icon'     => '✨',
            'category' => 'Injectables',
            'excerpt'  => 'The modern alternative to Botox — Jeuveau delivers smooth, wrinkle-free results with a formula designed specifically for aesthetics.',
        ],
        [
            'title'    => 'Dermal Fillers',
            'icon'     => '💎',
            'category' => 'Injectables',
            'excerpt'  => 'Restore volume, enhance contours, and achieve a refreshed, youthful appearance with premium hyaluronic acid fillers.',
        ],

        // ── Skin & Facials (6 services) ───────────────────────────
        [
            'title'    => 'Chemical Peels',
            'icon'     => '🧴',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Reveal fresh, radiant skin by removing damaged outer layers with customized chemical peel treatments.',
        ],
        [
            'title'    => 'Microneedling',
            'icon'     => '🔬',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Stimulate your skin\'s natural collagen production to improve texture, tone, and firmness with precision microneedling.',
        ],
        [
            'title'    => 'Secret RF Microneedling',
            'icon'     => '⚡',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Combine radiofrequency energy with microneedling for deeper skin tightening and dramatic rejuvenation results.',
        ],
        [
            'title'    => 'PRP Facial',
            'icon'     => '🌟',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Harness your body\'s own growth factors for natural skin renewal, improved texture, and a radiant glow.',
        ],
        [
            'title'    => 'Glo2Facial',
            'icon'     => '✦',
            'category' => 'Skin & Facials',
            'excerpt'  => 'A next-generation facial that combines exfoliation, oxygenation, and infusion for an instant, healthy glow.',
        ],
        [
            'title'    => 'Cellis Derma PRP',
            'icon'     => '🧬',
            'category' => 'Skin & Facials',
            'excerpt'  => 'Advanced PRP therapy combined with cutting-edge Cellis technology for superior skin rejuvenation and healing.',
        ],

        // ── Body & Wellness (9 services) ──────────────────────────
        [
            'title'    => 'Helix CO2 Laser',
            'icon'     => '🔆',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Fractional CO2 laser resurfacing to dramatically reduce scars, wrinkles, and sun damage with precision technology.',
        ],
        [
            'title'    => 'Laser Treatments',
            'icon'     => '💡',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A range of advanced laser therapies for hair removal, skin tightening, pigmentation correction, and more.',
        ],
        [
            'title'    => 'Butt Lift',
            'icon'     => '🍑',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Non-surgical butt enhancement to lift, firm, and sculpt for a naturally contoured silhouette.',
        ],
        [
            'title'    => 'Sclerotherapy',
            'icon'     => '🩺',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Eliminate spider veins and varicose veins with this safe, proven injection-based treatment.',
        ],
        [
            'title'    => 'Weight Loss',
            'icon'     => '⚖️',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Medically supervised weight loss programs tailored to your goals with proven treatments and ongoing support.',
        ],
        [
            'title'    => 'Hair Restoration',
            'icon'     => '💆',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Advanced hair restoration treatments to combat thinning and stimulate natural hair growth for fuller, healthier hair.',
        ],
        [
            'title'    => 'IV Therapy',
            'icon'     => '💧',
            'category' => 'Body & Wellness',
            'excerpt'  => 'Boost hydration, energy, and immunity with custom IV vitamin infusions delivered directly to your bloodstream.',
        ],
        [
            'title'    => 'Vaginal PRP',
            'icon'     => '🌸',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A confidential, non-surgical treatment using platelet-rich plasma to enhance intimate wellness and rejuvenation.',
        ],
        [
            'title'    => 'Penile PRP',
            'icon'     => '🔬',
            'category' => 'Body & Wellness',
            'excerpt'  => 'A discreet, non-surgical PRP treatment designed to improve intimate health, sensitivity, and confidence.',
        ],
    ];

    foreach ($services as $service) {
        // Check if service already exists
        $existing = get_page_by_title($service['title'], OBJECT, 'service');
        if ($existing) {
            // Update category on existing services
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($existing->ID, (int) $cat_ids[$service['category']], 'service_category');
            }
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'   => $service['title'],
            'post_excerpt' => $service['excerpt'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_service_icon', $service['icon']);
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($post_id, (int) $cat_ids[$service['category']], 'service_category');
            }
        }
    }

    update_option('livia_services_created_v2', true);
}
add_action('after_switch_theme', 'livia_create_services');


// =============================================================================
// LIVIA DEMO CONTENT IMPORTER
// Bundles /demo-content/content.xml and provides a one-click admin importer.
// Fires automatically on theme activation; can also be re-run any time from
// the WP admin notice or directly via: ?livia_run_import=1 (admin only).
// =============================================================================

// -- Flag theme activation so we can show the notice on next page load --------
add_action( 'after_switch_theme', 'livia_importer_set_activation_flag' );
function livia_importer_set_activation_flag() {
    set_transient( 'livia_just_activated', true, 300 );
}

// -- Admin notice with Import button ------------------------------------------
add_action( 'admin_notices', 'livia_importer_admin_notice' );
function livia_importer_admin_notice() {
    // Only show to admins
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Already imported? Never show again.
    if ( get_option( 'livia_demo_imported' ) ) return;

    // Only show right after activation OR when the user revisits the notice
    if ( ! get_transient( 'livia_just_activated' ) && ! isset( $_GET['livia_import_notice'] ) ) return;

    $import_url = wp_nonce_url(
        add_query_arg( 'livia_run_import', '1', admin_url() ),
        'livia_import_nonce'
    );
    $dismiss_url = add_query_arg( 'livia_dismiss_import', '1', admin_url() );

    echo '<div class="notice notice-info" style="padding:1rem 1.25rem;display:flex;align-items:center;gap:1.5rem;">';
    echo '<div>';
    echo '<strong>?? LIVIA Med Spa Theme</strong> � ';
    echo 'Import all services, posts, categories, and custom fields from the bundled demo content?';
    echo '</div>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary" style="white-space:nowrap;">Import Content Now</a>';
    echo '<a href="' . esc_url( add_query_arg( [ 'livia_dismiss_import' => '1', '_wpnonce' => wp_create_nonce('livia_dismiss') ], admin_url() ) ) . '" class="button" style="white-space:nowrap;">Dismiss</a>';
    echo '</div>';
}

// -- Dismiss handler ----------------------------------------------------------
add_action( 'admin_init', 'livia_importer_handle_dismiss' );
function livia_importer_handle_dismiss() {
    if ( ! isset( $_GET['livia_dismiss_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'livia_dismiss' );
    update_option( 'livia_demo_imported', 'dismissed' );
    delete_transient( 'livia_just_activated' );
    wp_safe_redirect( admin_url() );
    exit;
}

// -- Main importer ------------------------------------------------------------
add_action( 'admin_init', 'livia_run_demo_import' );
function livia_run_demo_import() {
    if ( ! isset( $_GET['livia_run_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'livia_import_nonce' );

    $xml_file = get_stylesheet_directory() . '/demo-content/content.xml';
    if ( ! file_exists( $xml_file ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>LIVIA Importer:</strong> demo-content/content.xml not found.</p></div>';
        });
        return;
    }

    // Make sure the WordPress importer is available
    if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
        define( 'WP_LOAD_IMPORTERS', true );
    }

    $importer_file = ABSPATH . 'wp-admin/includes/import.php';
    if ( file_exists( $importer_file ) ) {
        require_once $importer_file;
    }

    // Try to use the WordPress Importer plugin if active
    $wp_importer = WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
    if ( ! class_exists( 'WP_Import' ) && file_exists( $wp_importer ) ) {
        require_once $wp_importer;
    }

    if ( class_exists( 'WP_Import' ) ) {
        // Full import via WordPress Importer plugin
        $importer = new WP_Import();
        $importer->fetch_attachments = true; // pull remote images
        ob_start();
        $importer->import( $xml_file );
        ob_end_clean();

        update_option( 'livia_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'livia_just_activated' );

        wp_safe_redirect( add_query_arg( 'livia_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;

    } else {
        // WordPress Importer plugin not active � fall back to lightweight WXR parser
        livia_lightweight_wxr_import( $xml_file );
        update_option( 'livia_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'livia_just_activated' );
        wp_safe_redirect( add_query_arg( 'livia_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;
    }
}

// -- Lightweight WXR parser (fallback when WordPress Importer plugin is absent)
// Handles: posts, pages, custom post types, taxonomies, postmeta.
// Does NOT handle authors or media re-attachment (use the plugin for that).
function livia_lightweight_wxr_import( $xml_file ) {
    $xml = simplexml_load_file( $xml_file, 'SimpleXMLElement', LIBXML_NOCDATA );
    if ( ! $xml ) return;

    $namespaces = $xml->getNamespaces( true );
    $wp_ns  = isset( $namespaces['wp'] )      ? $namespaces['wp']      : 'http://wordpress.org/export/1.2/';
    $dc_ns  = isset( $namespaces['dc'] )      ? $namespaces['dc']      : 'http://purl.org/dc/elements/1.1/';
    $ex_ns  = isset( $namespaces['excerpt'] ) ? $namespaces['excerpt'] : 'http://wordpress.org/export/1.2/excerpt/';
    $con_ns = isset( $namespaces['content'] ) ? $namespaces['content'] : 'http://purl.org/rss/1.0/modules/content/';

    // First pass: register all terms / taxonomies
    foreach ( $xml->channel->children( $wp_ns )->term as $term ) {
        $taxonomy    = (string) $term->children( $wp_ns )->term_taxonomy;
        $slug        = (string) $term->children( $wp_ns )->term_slug;
        $name        = (string) $term->children( $wp_ns )->term_name;
        $description = (string) $term->children( $wp_ns )->term_description;
        if ( $taxonomy && $slug && $name ) {
            if ( ! term_exists( $slug, $taxonomy ) ) {
                wp_insert_term( $name, $taxonomy, [
                    'slug'        => $slug,
                    'description' => $description,
                ] );
            }
        }
    }

    // Second pass: import items (posts, pages, CPTs)
    $post_mapping = []; // old ID ? new ID

    foreach ( $xml->channel->item as $item ) {
        $wp = $item->children( $wp_ns );

        $post_type   = (string) $wp->post_type;
        $post_status = (string) $wp->post_status;
        $post_date   = (string) $wp->post_date;
        $post_name   = (string) $wp->post_name;
        $old_id      = (int)    $wp->post_id;
        $menu_order  = (int)    $wp->menu_order;

        // Skip attachments and nav menu items for now
        if ( in_array( $post_type, [ 'attachment', 'nav_menu_item' ], true ) ) continue;

        // Skip if already exists (by slug + post type)
        $existing = get_page_by_path( $post_name, OBJECT, $post_type );
        if ( $existing ) {
            $post_mapping[ $old_id ] = $existing->ID;
            continue;
        }

        $content = '';
        foreach ( $item->children( $con_ns ) as $c ) {
            $content = (string) $c;
        }
        $excerpt = '';
        foreach ( $item->children( $ex_ns ) as $e ) {
            $excerpt = (string) $e;
        }
        $author = '';
        foreach ( $item->children( $dc_ns ) as $d ) {
            $author = (string) $d;
        }
        $author_obj = get_user_by( 'login', $author );
        $author_id  = $author_obj ? $author_obj->ID : get_current_user_id();

        $new_id = wp_insert_post( [
            'post_title'    => (string) $item->title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_status'   => in_array( $post_status, [ 'publish', 'draft', 'private' ], true ) ? $post_status : 'publish',
            'post_type'     => $post_type,
            'post_name'     => $post_name,
            'post_date'     => $post_date,
            'post_author'   => $author_id,
            'menu_order'    => $menu_order,
        ], true );

        if ( is_wp_error( $new_id ) || ! $new_id ) continue;

        $post_mapping[ $old_id ] = $new_id;

        // Postmeta
        foreach ( $wp->postmeta as $meta ) {
            $key   = (string) $meta->meta_key;
            $value = (string) $meta->meta_value;
            if ( substr( $key, 0, 1 ) !== '_' || in_array( $key, [
                '_service_icon', '_service_price', '_service_duration',
                '_service_video', '_service_benefits', '_product_url',
            ], true ) ) {
                update_post_meta( $new_id, $key, $value );
            }
        }

        // Taxonomy terms
        foreach ( $item->children( $wp_ns )->category as $cat ) {
            $domain = (string) $cat->attributes()->domain;
            $slug   = (string) $cat->attributes()->nicename;
            if ( $domain && $slug ) {
                $term = get_term_by( 'slug', $slug, $domain );
                if ( $term ) {
                    wp_set_object_terms( $new_id, $term->term_id, $domain, true );
                }
            }
        }
    }
}

// -- Success notice after import ----------------------------------------------
add_action( 'admin_notices', 'livia_import_success_notice' );
function livia_import_success_notice() {
    if ( ! isset( $_GET['livia_imported'] ) ) return;
    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '? <strong>LIVIA Demo Content imported successfully!</strong> ';
    echo 'Your services, posts, and categories have been restored. ';
    echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=service' ) ) . '">View Services ?</a>';
    echo '</p></div>';
}

// -- Helper: re-run importer at any time from the importer page ---------------
// Visit: WP Admin ? Appearance ? Import Demo Content
add_action( 'admin_menu', 'livia_importer_menu' );
function livia_importer_menu() {
    add_theme_page(
        'Import Demo Content',
        'Import Demo Content',
        'manage_options',
        'livia-importer',
        'livia_importer_page'
    );
}
function livia_importer_page() {
    $already   = get_option( 'livia_demo_imported' );
    $import_url = wp_nonce_url(
        add_query_arg( 'livia_run_import', '1', admin_url() ),
        'livia_import_nonce'
    );
    echo '<div class="wrap">';
    echo '<h1>?? LIVIA Demo Content Importer</h1>';
    if ( $already && $already !== 'dismissed' ) {
        echo '<p>Content was last imported on <strong>' . esc_html( $already ) . '</strong>.</p>';
        echo '<p>You can re-import at any time � existing posts with the same slug will be skipped.</p>';
    }
    echo '<p>This will import all services, pages, blog posts, categories, and custom field data from the bundled <code>demo-content/content.xml</code> file.</p>';
    echo '<p><strong>Note:</strong> Images won\'t be re-uploaded automatically unless the WordPress Importer plugin is active and the original URLs are reachable.</p>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary button-large">Run Import Now</a>';
    // Allow re-import
    echo '<script>document.querySelector(".button-primary").addEventListener("click",function(){';
    echo 'if(!confirm("This will import all demo content. Continue?"))event.preventDefault();';
    echo '});</script>';
    // Reset flag so importer can run again
    delete_option( 'livia_demo_imported' );
    echo '</div>';
}



// ── Before & After Auto Seeder ──────────────────────────────────────
function livia_create_before_after_items() {
    if (get_option('livia_before_after_created_v2')) return;

    $categories = [
        'Botox'         => 'botox',
        'Fillers'       => 'fillers',
        'Laser'         => 'laser',
        'Peels'         => 'peels',
        'Microneedling' => 'microneedling',
    ];

    $cat_ids = [];
    foreach ($categories as $name => $slug) {
        $existing = term_exists($name, 'before_after_category');
        if ($existing) {
            $cat_ids[$slug] = $existing['term_id'];
        } else {
            $term = wp_insert_term($name, 'before_after_category', ['slug' => $slug]);
            if (!is_wp_error($term)) {
                $cat_ids[$slug] = $term['term_id'];
            }
        }
    }

    $gallery_items = [
        [
            'title'       => 'Botox — Forehead & Crow\'s Feet',
            'category'    => 'botox',
            'description' => '40 units of Botox to smooth forehead lines and crow\'s feet. Results shown at 2 weeks post-treatment.',
        ],
        [
            'title'       => 'Lip Filler — Natural Enhancement',
            'category'    => 'fillers',
            'description' => '1 syringe of Juvederm Ultra for subtle volume and definition. Results shown at 2 weeks.',
        ],
        [
            'title'       => 'Laser Skin Rejuvenation',
            'category'    => 'laser',
            'description' => '3 sessions of laser resurfacing for sun damage and hyperpigmentation. Results at 6 weeks.',
        ],
        [
            'title'       => 'Cheek & Jawline Fillers',
            'category'    => 'fillers',
            'description' => '2 syringes of Voluma for cheek augmentation and jawline contour. Results at 2 weeks.',
        ],
        [
            'title'       => 'Microneedling — Acne Scarring',
            'category'    => 'microneedling',
            'description' => '4 sessions of microneedling with PRP for acne scar improvement. Results at 3 months.',
        ],
        [
            'title'       => 'Chemical Peel — Melasma',
            'category'    => 'peels',
            'description' => 'Series of 3 VI Peels for melasma and uneven skin tone. Results at 8 weeks.',
        ],
    ];

    foreach ($gallery_items as $item) {
        $existing = get_page_by_title($item['title'], OBJECT, 'before_after');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_title'   => $item['title'],
            'post_content' => $item['description'],
            'post_status'  => 'publish',
            'post_type'    => 'before_after',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            if (isset($cat_ids[$item['category']])) {
                wp_set_object_terms($post_id, (int) $cat_ids[$item['category']], 'before_after_category');
            }
        }
    }

    update_option('livia_before_after_created_v2', true);
}
add_action('after_switch_theme', 'livia_create_before_after_items');
add_action('init', 'livia_create_before_after_items', 15);


// ── One-Time Content Migrator to Custom Fields ──────────────────────
function livia_migrate_service_data() {
    if (get_option('livia_services_migrated_v3')) {
        return;
    }

    $services = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    ]);

    foreach ($services as $service) {
        $post_id = $service->ID;
        $slug = $service->post_name;
        $raw_content = $service->post_content;

        if (empty($raw_content)) {
            continue;
        }

        // 1. Resolve stock image attachment IDs
        $img_mapping = [
            'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
            'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
            'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
            'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
        ];

        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_376407063-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_396759557-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_538904225-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/06/AdobeStock_446213685-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_374628525-scaled.jpeg'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $img_mapping = [
                'areas_treated' => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_260345614-1-scaled.jpeg',
                'how_works'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_474297401-1-scaled.jpeg',
                'expect_bg'     => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_107647945-scaled.jpeg',
                'plan'          => 'https://liviamedspa.com/wp-content/uploads/2025/04/AdobeStock_520811401-scaled.jpeg'
            ];
        }

        if (has_post_thumbnail($post_id)) {
            $thumb_id = get_post_thumbnail_id($post_id);
        } else {
            $thumb_id = attachment_url_to_postid($img_mapping['areas_treated']);
        }
        $how_works_id = attachment_url_to_postid($img_mapping['how_works']);
        $expect_bg_id = attachment_url_to_postid($img_mapping['expect_bg']);
        
        $bottom_photo_id = get_post_meta($post_id, '_service_bottom_photo_id', true);
        $plan_image_id = $bottom_photo_id ? $bottom_photo_id : attachment_url_to_postid($img_mapping['plan']);

        // 2. Parse the content
        $parts = preg_split('/<h2[^>]*>(.*?)<\/h2>/is', $raw_content, -1, PREG_SPLIT_DELIM_CAPTURE);
        $sections = [];
        for ($i = 1; $i < count($parts); $i += 2) {
            if (empty($parts[$i])) continue;
            $sections[] = [
                'heading' => trim(strip_tags($parts[$i])),
                'content' => isset($parts[$i+1]) ? trim($parts[$i+1]) : '',
            ];
        }

        $what_is_sec = null;
        $treat_sec = null;
        $expect_sec = null;
        $aftercare_sec = null;
        $plan_sec = null;
        $faq_sec = null;

        foreach ($sections as $sec) {
            $h = strtolower($sec['heading']);
            if (strpos($h, 'what is') !== false) {
                $what_is_sec = $sec;
            } elseif (strpos($h, 'treat') !== false || strpos($h, 'areas') !== false) {
                $treat_sec = $sec;
            } elseif (strpos($h, 'process') !== false || strpos($h, 'expect') !== false || strpos($h, 'works') !== false) {
                $expect_sec = $sec;
            } elseif (strpos($h, 'aftercare') !== false || strpos($h, 'preparation') !== false) {
                $aftercare_sec = $sec;
            } elseif (strpos($h, 'cost') !== false || strpos($h, 'price') !== false || strpos($h, 'choose') !== false || strpos($h, 'plan') !== false) {
                $plan_sec = $sec;
            } elseif (strpos($h, 'faq') !== false || strpos($h, 'frequently') !== false || strpos($h, 'question') !== false) {
                $faq_sec = $sec;
            }
        }

        $get_list_text = function($html) {
            if (preg_match('/<ul[^>]*>(.*?)<\/ul>/is', $html, $m)) {
                preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $m[1], $matches);
                if (!empty($matches[1])) {
                    return implode("\n", array_map('trim', array_map('strip_tags', $matches[1])));
                }
            }
            return '';
        };

        $strip_list = function($html) {
            return trim(preg_replace('/<ul[^>]*>.*?<\/ul>/is', '', $html));
        };

        // Section A
        if ($treat_sec) {
            update_post_meta($post_id, '_service_sec_a_title', esc_html($treat_sec['heading']));
            update_post_meta($post_id, '_service_sec_a_desc', $strip_list($treat_sec['content']));
            update_post_meta($post_id, '_service_sec_a_checklist', $get_list_text($treat_sec['content']));
            if ($thumb_id) {
                update_post_meta($post_id, '_service_sec_a_image_id', $thumb_id);
            }
        }

        // Section B
        if ($what_is_sec) {
            update_post_meta($post_id, '_service_sec_b_title', esc_html($what_is_sec['heading']));
            update_post_meta($post_id, '_service_sec_b_desc', $what_is_sec['content']);
            if ($how_works_id) {
                update_post_meta($post_id, '_service_sec_b_image_id', $how_works_id);
            }
        }

        // Section C
        if ($expect_sec) {
            update_post_meta($post_id, '_service_sec_c_title', esc_html($expect_sec['heading']));
            update_post_meta($post_id, '_service_sec_c_desc', $expect_sec['content']);
            if ($expect_bg_id) {
                update_post_meta($post_id, '_service_sec_c_bg_image_id', $expect_bg_id);
            }
        }

        // Section D
        $prep_items = [];
        $after_items = [];
        if (strpos($slug, 'laser') !== false || strpos($slug, 'hair') !== false || strpos($slug, 'candela') !== false || strpos($slug, 'lhr') !== false) {
            $prep_items = [
                'Shave the treatment area completely 24 hours prior to your session.',
                'Avoid plucking, waxing, or tweezing hair in the target area for 4 weeks.',
                'Avoid direct sun exposure and tanning beds for at least 2 weeks.',
                'Ensure skin is completely free of self-tanner, lotions, oils, and makeup on the day of treatment.'
            ];
            $after_items = [
                'Avoid direct sun exposure on the treated areas and apply broad-spectrum SPF 30+ daily.',
                'Avoid hot tubs, saunas, steam rooms, and hot showers for 24–48 hours.',
                'Postpone strenuous exercise and excessive sweating for 24 hours.',
                'Do not pluck, wax, or tweeze between sessions; shaving is the only permitted hair removal method.'
            ];
        } elseif (strpos($slug, 'botox') !== false || strpos($slug, 'xeomin') !== false || strpos($slug, 'jeuveau') !== false || strpos($slug, 'dysport') !== false) {
            $prep_items = [
                'Avoid alcohol and blood-thinning supplements for 24-48 hours before treatment.',
                'Arrive with a clean, makeup-free face if possible.',
                'Reschedule if you have an active skin rash, cold sore, or infection in the treatment area.'
            ];
            $after_items = [
                'Keep your head elevated and avoid lying down for 4 hours after treatment.',
                'Avoid rubbing, massaging, or placing pressure on the treated areas for 24 hours.',
                'Postpone strenuous exercise and heavy sweating for 24 hours.',
                'Avoid facials, chemical peels, and microdermabrasion for 2 weeks.'
            ];
        } elseif (strpos($slug, 'filler') !== false || strpos($slug, 'radiesse') !== false || strpos($slug, 'sculptra') !== false) {
            $prep_items = [
                'Avoid blood-thinning medications and supplements (like aspirin, fish oil) for 1 week prior.',
                'Avoid alcohol intake for 24-48 hours prior to your appointment to minimize bruising.',
                'Plan your treatment at least 2 weeks before any major social events.'
            ];
            $after_items = [
                'Apply cold packs gently to the treated areas for 15-20 minutes at a time to reduce swelling.',
                'Avoid touching, rubbing, or massaging the injection sites (except Sculptra 5-5-5 rule).',
                'Avoid sleeping face-down; sleep on your back with head elevated on pillows for 2-3 nights.',
                'Avoid strenuous exercise, saunas, and hot tubs for 24-48 hours.'
            ];
        } else {
            $prep_items = [
                'Avoid facial treatments, chemical peels, or laser procedures for 2 weeks prior.',
                'Arrive with clean skin, free of heavy makeup, lotions, or perfumes.',
                'Stay well-hydrated and follow any specific pre-treatment advice.'
            ];
            $after_list = '';
            if ($aftercare_sec) {
                $after_list = $get_list_text($aftercare_sec['content']);
            }
            if (!empty($after_list)) {
                $after_items = explode("\n", $after_list);
            } else {
                $after_items = [
                    'Follow all specific post-treatment instructions provided by your practitioner.',
                    'Keep the treated area clean and hydrated with recommended skincare products.',
                    'Apply broad-spectrum sunscreen daily and avoid direct sun exposure.'
                ];
            }
        }
        update_post_meta($post_id, '_service_sec_d_prep', implode("\n", $prep_items));
        update_post_meta($post_id, '_service_sec_d_after', implode("\n", $after_items));

        // Section E
        if ($plan_sec) {
            update_post_meta($post_id, '_service_sec_e_title', esc_html($plan_sec['heading']));
            update_post_meta($post_id, '_service_sec_e_desc', $plan_sec['content']);
            if ($plan_image_id) {
                update_post_meta($post_id, '_service_sec_e_image_id', $plan_image_id);
            }
        }

        // Section F
        if ($faq_sec) {
            $faq_parts = preg_split('/<h3[^>]*>(.*?)<\/h3>/is', $faq_sec['content'], -1, PREG_SPLIT_DELIM_CAPTURE);
            $q_idx = 1;
            for ($j = 1; $j < count($faq_parts); $j += 2) {
                if ($q_idx > 6) break;
                $q = trim(strip_tags($faq_parts[$j]));
                $a = isset($faq_parts[$j+1]) ? trim($faq_parts[$j+1]) : '';
                if (empty($q)) continue;
                
                update_post_meta($post_id, '_service_faq_q' . $q_idx, $q);
                update_post_meta($post_id, '_service_faq_a' . $q_idx, $a);
                $q_idx++;
            }
        }
    }

    update_option('livia_services_migrated_v3', true);
}
add_action('admin_init', 'livia_migrate_service_data');


