<?php
/**
 * LIVIA Med Spa — SEO & Structured Data
 * Title tags, meta, legacy redirects, analytics, and every JSON-LD
 * schema block (business, FAQ, reviews, articles, breadcrumbs).
 *
 * Split out of functions.php; load order is defined there.
 */

// ── SEO: Keyword-rich title tags (fixes "Home - liviamedspa.com" issue) ─────
function livia_seo_title( $title_parts ) {
    if ( is_front_page() ) {
        $title_parts['title']   = 'Med Spa Tampa, FL | Botox, Fillers & Laser | LIVIA Med Spa';
        unset( $title_parts['tagline'] );
        unset( $title_parts['site'] );
    } elseif ( is_singular('service') ) {
        $title_parts['title'] = get_the_title() . ' in Tampa, FL | LIVIA Med Spa';
        unset( $title_parts['site'] );
    } elseif ( is_singular('product') ) {
        $title_parts['title'] = get_the_title() . ' | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_singular('post') ) {
        // Keep blog-post titles from overflowing ~60 chars: drop the tagline and
        // use a short brand suffix instead of the default long site name.
        $title_parts['site'] = 'LIVIA Med Spa';
        unset( $title_parts['tagline'] );
    } elseif ( is_post_type_archive('service') ) {
        $title_parts['title'] = 'All Treatments | Tampa Med Spa Services | LIVIA';
        unset( $title_parts['site'] );
    } elseif ( is_page('about') ) {
        $title_parts['title'] = 'About LIVIA Med Spa | Angela Spicola, APRN — Tampa, FL';
        unset( $title_parts['site'] );
    } elseif ( is_page('contact') ) {
        $title_parts['title'] = 'Book a Consultation | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page('memberships') ) {
        $title_parts['title'] = 'Beauty Bank Memberships | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page('before-after') ) {
        $title_parts['title'] = 'Before & After Results | LIVIA Med Spa Tampa';
        unset( $title_parts['site'] );
    } elseif ( is_page() ) {
        $title_parts['site'] = 'LIVIA Med Spa Tampa';
    } elseif ( is_home() || is_archive() ) {
        $title_parts['site'] = 'LIVIA Med Spa Tampa';
    } elseif ( is_404() ) {
        $title_parts['title'] = 'Page Not Found | LIVIA Med Spa';
        unset( $title_parts['site'] );
    }
    return $title_parts;
}
add_filter( 'document_title_parts', 'livia_seo_title', 20 );


// ── SEO: Favicon fallback (if no WP site icon is set) ───────────────────────
function livia_favicon_fallback() {
    // wp_site_icon() handles favicon if set via WP Customizer.
    // This adds a PNG fallback pointing to the brand logo for browsers
    // that don't receive a site icon from WordPress.
    if ( ! has_site_icon() ) {
        $logo_url = 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png';
        echo '<link rel="icon" type="image/png" href="' . esc_url( $logo_url ) . '">' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url( $logo_url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'livia_favicon_fallback', 2 );


// NOTE: A separate "voice search" LocalBusiness + FAQPage schema used to be
// output here. It duplicated livia_schema_markup() with conflicting geo
// coordinates and added a second FAQPage (Google allows only one per page),
// so it was removed. All business data lives in livia_schema_markup() below.


// ── Article Schema — blog posts only ─────────────────────────────────────────
// Signals authorship + publish date to Google. Uses only safe WP functions.
// No content parsing — zero risk of errors.
function livia_article_schema() {
    if ( ! is_singular( 'post' ) ) return;

    $id       = get_the_ID();
    if ( ! $id ) return;

    $thumb = get_the_post_thumbnail_url( $id, 'large' );
    if ( ! $thumb ) {
        $thumb = 'https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png';
    }

    $data = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        'headline'         => get_the_title( $id ),
        'image'            => $thumb,
        'datePublished'    => get_the_date( 'c', $id ),
        'dateModified'     => get_the_modified_date( 'c', $id ),
        'url'              => get_permalink( $id ),
        'inLanguage'       => 'en-US',
        'author'           => array(
            '@type'    => 'Person',
            'name'     => 'Angela Spicola',
            'jobTitle' => 'APRN, Founder & Lead Aesthetic Provider',
            'url'      => 'https://liviamedspa.com/about/',
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => 'LIVIA Med Spa',
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            ),
        ),
        'mainEntityOfPage' => get_permalink( $id ),
    );

    echo '<script type="application/ld+json">'
        . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}
add_action( 'wp_head', 'livia_article_schema', 6 );


// ── BreadcrumbList Schema — pages, posts, and services ───────────────────────
// Enables "Home > Services > Botox" path display in Google search results.
// Uses only safe WP conditional functions — no content access.
function livia_breadcrumb_schema() {
    if ( is_front_page() || is_home() ) return;
    if ( ! is_singular() && ! is_post_type_archive( 'service' ) ) return;

    $home = array(
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Home',
        'item'     => home_url( '/' ),
    );

    $items = array( $home );

    if ( is_singular( 'service' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Services',
            'item'     => home_url( '/services/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_singular( 'post' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Blog',
            'item'     => home_url( '/blog/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 3,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_page() ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    } elseif ( is_post_type_archive( 'service' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Services',
            'item'     => home_url( '/services/' ),
        );
    }

    if ( count( $items ) < 2 ) return;

    $data = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">'
        . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
        . '</script>' . "\n";
}
add_action( 'wp_head', 'livia_breadcrumb_schema', 7 );


// ── Analytics: Google Analytics 4 ───────────────────────────────────────────
// TODO: Replace YOUR_GA4_ID with your actual Measurement ID (format: G-XXXXXXXXXX)
// Get it from: analytics.google.com → Admin → Data Streams → your stream → Measurement ID
function livia_ga4_tracking() {
    $ga4_id = get_option( 'livia_ga4_id', '' ); // Set via WP Admin or replace '' with 'G-XXXXXXXXXX'
    if ( empty( $ga4_id ) || is_admin() ) return;
    ?>
    <!-- Google Analytics 4 | LIVIA Med Spa -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4_id ); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo esc_js( $ga4_id ); ?>', {
        page_path: window.location.pathname,
      });
    </script>
    <?php
}
add_action( 'wp_head', 'livia_ga4_tracking', 99 );

// ── Analytics: GA4 ID setting in WP Admin (Settings > General) ──────────────
function livia_register_ga4_setting() {
    register_setting( 'general', 'livia_ga4_id', [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ]);
    add_settings_field(
        'livia_ga4_id',
        'Google Analytics 4 ID',
        function() {
            $val = get_option( 'livia_ga4_id', '' );
            echo '<input type="text" name="livia_ga4_id" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="G-XXXXXXXXXX">';
            echo '<p class="description">Enter your GA4 Measurement ID. Find it in Google Analytics → Admin → Data Streams.</p>';
        },
        'general',
        'default',
        [ 'label_for' => 'livia_ga4_id' ]
    );
}
add_action( 'admin_init', 'livia_register_ga4_setting' );


// ── Legacy 301 Redirects — fixes Ahrefs-flagged 404s ──────────────────────
// Maps old/broken URLs (from previous site version or backlinks) to the
// closest relevant live page. Uses 301 (permanent) so link equity transfers.
function livia_legacy_redirects() {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );

    // Old service-type URLs → Services archive
    $to_services = [
        'iv-therapy-2',
        'service/micorneedling',        // typo slug from old site
        'service/microneedling',
        'service/prp-facial-2',
        'service/neurotoxins',
        'service/botox-2',
        'service/dermal-fillers-2',
        'cellenis-derma-prp',
        'face-prp-near-me-tampa',
    ];

    // Old blog/content URLs → Blog index (or closest service)
    $to_blog = [
        'med-spa-tampa-treatments-that-work',
        'microneedling-recovery-time-guide',
        'benefits-of-botox-treatments-in-tampa',
    ];

    if ( in_array( $path, $to_services, true ) ) {
        wp_redirect( home_url( '/services/' ), 301 );
        exit;
    }

    if ( in_array( $path, $to_blog, true ) ) {
        wp_redirect( home_url( '/blog/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'livia_legacy_redirects', 1 );


// ============================================================
// AI SEARCH VISIBILITY & STRUCTURED DATA — LIVIA MED SPA
// Comprehensive JSON-LD schema for Google AI Overviews,
// ChatGPT, Perplexity, Bing Copilot, and all AEO signals.
// ============================================================

// ── availableService list — built from real service posts ────────────────────
// Every published service gets a MedicalTherapy entry pointing at its own page,
// so high-revenue treatments (GLP-1, Helix CO2, hormone therapy, PRP, etc.) are
// individually visible to Google and AI crawlers. Falls back to a static list
// if no services exist yet.
function livia_schema_available_services() {
    $service_posts = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ]);

    if ( $service_posts ) {
        $available = [];
        foreach ( $service_posts as $sp ) {
            $available[] = [
                '@type' => 'MedicalTherapy',
                'name'  => get_the_title( $sp ),
                'url'   => get_permalink( $sp ),
            ];
        }
        return $available;
    }

    $fallback = [
        'Botox & Neuromodulators', 'Dermal Fillers', 'RF Microneedling',
        'Helix CO2 Laser', 'Laser Skin Resurfacing', 'Medical-Grade Facials',
        'IV Therapy', 'GLP-1 Weight Loss', 'Hormone Therapy',
    ];
    return array_map( function( $name ) {
        return [ '@type' => 'MedicalTherapy', 'name' => $name, 'url' => esc_url( home_url('/services/') ) ];
    }, $fallback );
}


// ── 1. MedicalBusiness + WebSite + Person (Angela) ── every page ─────────────
function livia_schema_markup() {

    // Named provider: Angela Spicola APRN
    $provider = [
        '@type'       => 'Person',
        '@id'         => esc_url(home_url('/')) . '#angela-spicola',
        'name'        => 'Angela Spicola',
        'jobTitle'    => 'Founder & Lead Aesthetic Provider',
        'honorificPrefix' => 'APRN',
        'description' => 'Board-certified Advanced Practice Registered Nurse and founder of LIVIA Med Spa in Tampa, FL. Specializes in Botox, dermal fillers, laser treatments, and medical aesthetics.',
        'worksFor'    => [ '@type' => 'MedicalBusiness', 'name' => 'LIVIA Med Spa' ],
        'sameAs'      => [ 'https://www.instagram.com/liviamedspa/' ],
    ];

    // Full MedicalBusiness entity
    $business = [
        '@context'         => 'https://schema.org',
        '@type'            => ['MedicalBusiness', 'MedicalClinic', 'HealthAndBeautyBusiness', 'LocalBusiness'],
        '@id'              => esc_url(home_url('/')) . '#livia-med-spa',
        'name'             => 'LIVIA Med Spa',
        'legalName'        => 'Livia Med Spa LLC',
        'alternateName'    => 'Livia Medical Spa',
        'description'      => "Tampa's premier medical spa offering Botox, dermal fillers, RF microneedling, laser treatments, facials, IV therapy, and medical-grade skincare. Led by Angela Spicola, APRN — board-certified aesthetic provider.",
        'url'              => esc_url(home_url('/')),
        'telephone'        => '+18132302219',
        'email'            => 'support@liviamedspa.com',
        'foundingDate'     => '2024',
        'address'          => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '10043 N Dale Mabry Hwy',
            'addressLocality' => 'Tampa',
            'addressRegion'   => 'FL',
            'postalCode'      => '33618',
            'addressCountry'  => 'US',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 28.0678,
            'longitude' => -82.5054,
        ],
        'hasMap'           => 'https://maps.google.com/?q=10043+N+Dale+Mabry+Hwy+Tampa+FL+33618',
        'openingHoursSpecification' => [
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday'], 'opens' => '09:00', 'closes' => '19:00' ],
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Thursday','Friday','Saturday'],  'opens' => '09:00', 'closes' => '16:00' ],
        ],
        'priceRange'       => '$$-$$$',
        'currenciesAccepted' => 'USD',
        'paymentAccepted'  => 'Cash, Credit Card, Financing via Cherry',
        'image'            => [
            'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            'https://liviamedspa.com/wp-content/uploads/2026/04/Hero-Apirl4.png',
        ],
        'logo'             => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
        'sameAs'           => [
            'https://www.facebook.com/p/Livia-Med-Spa-61561610168278/',
            'https://www.instagram.com/liviamedspa/',
            'https://www.google.com/maps/place/LIVIA+Med+Spa',
        ],
        'aggregateRating'  => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'bestRating'  => '5',
            'worstRating' => '1',
            'reviewCount' => '75', // Keep in sync with the "75+ reviews" claims in page content
        ],
        'employee'         => [ $provider ],
        'founder'          => $provider,
        'medicalSpecialty' => 'Dermatology',
        'availableService' => livia_schema_available_services(),
        'areaServed'       => [
            [ '@type' => 'City', 'name' => 'Tampa',          'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Carrollwood',    'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Westchase',      'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Lutz',           'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Odessa',         'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Land O Lakes',   'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Brandon',        'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Wesley Chapel',  'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Clearwater',     'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'St. Petersburg', 'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Riverview',      'containedIn' => 'Florida' ],
        ],
        'hasOfferCatalog'  => [
            '@type' => 'OfferCatalog',
            'name'  => 'LIVIA Med Spa Services',
            'url'   => esc_url(home_url('/services/')),
        ],
        'makesOffer' => [
            [
                '@type'       => 'Offer',
                'name'        => 'Free Consultation',
                'description' => 'Complimentary aesthetic consultation with our board-certified provider.',
                'price'       => '0',
                'priceCurrency' => 'USD',
                'url'         => esc_url(home_url('/contact/')),
            ],
            [
                '@type'       => 'Offer',
                'name'        => 'New Client Special — $50 Off First Visit',
                'description' => '$50 off your first treatment at LIVIA Med Spa for new clients.',
                'url'         => esc_url(home_url('/contact/')),
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($business, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";

    // WebSite schema with SiteLinksSearchBox signal
    $website = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => esc_url(home_url('/')) . '#website',
        'name'            => 'LIVIA Med Spa',
        'url'             => esc_url(home_url('/')),
        'description'     => "Tampa's premier medical spa — Botox, fillers, laser treatments, RF microneedling, and medical-grade skincare.",
        'inLanguage'      => 'en-US',
        'publisher'       => [ '@id' => esc_url(home_url('/')) . '#livia-med-spa' ],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => esc_url(home_url('/')) . '?s={search_term_string}' ],
            'query-input' => 'required name=search_term_string',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // ── Enhanced Service schema — singular service pages only ─────────────────
    if (is_singular('service')) {
        $post_id   = get_the_ID();
        $price     = get_post_meta($post_id, '_service_price', true);
        $duration  = get_post_meta($post_id, '_service_duration', true);
        $cats      = get_the_terms($post_id, 'service_category');
        $cat_name  = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Aesthetic Treatment';
        $excerpt   = wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' treatment at LIVIA Med Spa in Tampa, FL.');

        $service_schema = [
            '@context'    => 'https://schema.org',
            '@type'       => ['Service', 'MedicalProcedure'],
            '@id'         => get_permalink($post_id) . '#service',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' treatment at LIVIA Med Spa in Tampa, FL.'),
            'provider'    => [
                '@type' => 'MedicalBusiness',
                'name'  => 'LIVIA Med Spa',
            ],
            'areaServed'  => 'Tampa, FL',
            'url'         => get_permalink($post_id),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'livia_schema_markup', 5);


// ── FAQ Schema for Memberships Page ────────────────────────────────
function livia_faq_schema() {
    if (!is_page('memberships')) return;

    $faqs = [
        ['q' => 'Is there a minimum commitment?', 'a' => 'We ask for a minimum 6-month commitment to get the most out of your Beauty Bank membership. After that, you can continue month-to-month or cancel anytime.'],
        ['q' => 'Do my credits expire?', 'a' => 'No! Your banked credits never expire as long as your membership is active. If you cancel, unused credits remain available for 90 days.'],
        ['q' => 'What can I use my credits on?', 'a' => 'Your Beauty Bank credits can be used on any service or product we offer — Botox, fillers, facials, laser treatments, IV therapy, skincare products, and more.'],
        ['q' => 'Can I share my credits with friends or family?', 'a' => 'Absolutely! You can gift your credits to friends and family members.'],
        ['q' => 'How much should I set as my monthly deposit?', 'a' => 'Most of our members choose between $100-$300/month. During your complimentary consultation, we\'ll help you find the perfect amount.'],
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [],
    ];

    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'livia_faq_schema', 6);


// =============================================================================
// AI SEARCH VISIBILITY — HOMEPAGE FAQ SCHEMA
// These Q&As directly feed Google AI Overviews, ChatGPT, and Perplexity
// when users ask questions about med spas in Tampa.
// =============================================================================
// Shared Q&A source — used by BOTH the FAQPage schema below and the visible
// FAQ section on front-page.php. Google requires FAQ structured data to match
// content that is actually visible on the page, so keep them fed from here.
function livia_homepage_faqs() {
    return [
        [
            'q' => 'What services does LIVIA Med Spa offer in Tampa?',
            'a' => 'LIVIA Med Spa in Tampa, FL offers Botox and neuromodulators, dermal fillers (Juvederm, Restylane), RF microneedling, Helix CO2 laser skin resurfacing, medical-grade facials, chemical peels, Kybella, IV therapy, GLP-1 weight loss programs, hormone therapy, PRP treatments, and a curated selection of medical-grade skincare products.',
        ],
        [
            'q' => 'Does LIVIA Med Spa offer GLP-1 weight loss treatments?',
            'a' => 'Yes. LIVIA Med Spa offers medically supervised GLP-1 weight loss programs, including microdosing protocols, tailored to your health history and goals. Every program is overseen by Angela Spicola, APRN, and begins with a complimentary consultation to determine candidacy.',
        ],
        [
            'q' => 'What is the Helix CO2 laser and why is it unique in Tampa?',
            'a' => 'The Helix CO2 laser is an advanced fractional skin-resurfacing laser that treats deep wrinkles, acne scars, and sun damage by stimulating collagen at the deepest layers of the skin — and LIVIA Med Spa is the only med spa in Tampa offering it. Most patients see dramatic improvement in skin texture and tone after a single session.',
        ],
        [
            'q' => 'Who is the provider at LIVIA Med Spa?',
            'a' => 'LIVIA Med Spa is founded and led by Angela Spicola, APRN — a board-certified Advanced Practice Registered Nurse specializing in aesthetic medicine. Angela brings years of clinical experience delivering natural, results-driven outcomes for clients throughout Tampa and the surrounding areas.',
        ],
        [
            'q' => 'Where is LIVIA Med Spa located?',
            'a' => 'LIVIA Med Spa is located at 10043 N Dale Mabry Hwy, Tampa, FL 33618 — conveniently serving Carrollwood, Westchase, Lutz, Land O Lakes, and the greater Tampa Bay area. Call (813) 230-2219 to book.',
        ],
        [
            'q' => 'How much does Botox cost at LIVIA Med Spa?',
            'a' => 'Botox pricing at LIVIA Med Spa varies based on the number of units and treatment areas. We offer complimentary consultations so you can get an accurate, personalized quote. Beauty Bank memberships also provide monthly credit savings on all treatments including Botox.',
        ],
        [
            'q' => 'Does LIVIA Med Spa offer free consultations?',
            'a' => 'Yes! LIVIA Med Spa offers complimentary consultations with Angela Spicola, APRN. During your consultation, she will assess your aesthetic goals and create a personalized treatment plan tailored to your needs. Book online or call (813) 230-2219.',
        ],
        [
            'q' => 'What are LIVIA Med Spa\'s hours?',
            'a' => 'LIVIA Med Spa is open Monday through Wednesday from 9:00 AM to 7:00 PM, and Thursday through Saturday from 9:00 AM to 4:00 PM. They are closed on Sundays.',
        ],
        [
            'q' => 'What is the Beauty Bank membership at LIVIA Med Spa?',
            'a' => 'The Beauty Bank is LIVIA Med Spa\'s monthly savings membership. Members set a custom monthly deposit (starting at $50/month) that accumulates as credits redeemable for any service or product. Credits never expire while your membership is active, and members receive exclusive pricing and priority booking.',
        ],
        [
            'q' => 'Is LIVIA Med Spa good for first-time med spa clients?',
            'a' => 'Absolutely. LIVIA Med Spa specializes in natural-looking results and welcomes first-time clients. Angela Spicola, APRN, takes a thorough, educational approach to every consultation, ensuring you understand every treatment option before making any decisions. They offer a $50 off first-visit special for new clients.',
        ],
        [
            'q' => 'Does LIVIA Med Spa offer financing?',
            'a' => 'Yes, LIVIA Med Spa offers payment plan financing through Cherry — a healthcare financing platform that lets you split your treatment costs into manageable monthly payments with easy online approval.',
        ],
        [
            'q' => 'What makes LIVIA Med Spa different from other Tampa med spas?',
            'a' => 'LIVIA Med Spa stands out for its board-certified APRN provider Angela Spicola, Tampa\'s only Helix CO2 laser, its commitment to natural, personalized results, transparent pricing, and its unique Beauty Bank membership program. They use only FDA-approved products and advanced techniques to deliver safe, effective outcomes.',
        ],
    ];
}

function livia_homepage_faq_schema() {
    if ( ! is_front_page() ) return;

    $faqs = livia_homepage_faqs();

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'livia_homepage_faq_schema', 6);



// =============================================================================
// AI SEARCH VISIBILITY — SERVICE PAGE FAQ SCHEMA
// Auto-generates a FAQPage schema on every service page from common
// treatment-specific questions. Helps AI tools cite specific services.
// =============================================================================
function livia_service_faq_schema() {
    if ( ! is_singular('service') ) return;

    $service_name = get_the_title();
    $price        = get_post_meta(get_the_ID(), '_service_price', true);
    $duration     = get_post_meta(get_the_ID(), '_service_duration', true);

    $faqs = [
        [
            'q' => 'How much does ' . $service_name . ' cost at LIVIA Med Spa?',
            'a' => $price
                ? $service_name . ' at LIVIA Med Spa starts at ' . esc_html($price) . '. We offer complimentary consultations for a personalized quote. Beauty Bank members receive exclusive savings.'
                : $service_name . ' pricing at LIVIA Med Spa is customized to your treatment goals. Book a complimentary consultation with Angela Spicola, APRN to get an accurate quote.',
        ],
        [
            'q' => 'How long does ' . $service_name . ' take at LIVIA Med Spa?',
            'a' => $duration
                ? $service_name . ' appointments at LIVIA Med Spa typically take ' . esc_html($duration) . '. Times may vary based on your individual treatment plan.'
                : $service_name . ' treatment times vary by client. Contact LIVIA Med Spa at (813) 230-2219 for details.',
        ],
        [
            'q' => 'Is ' . $service_name . ' safe?',
            'a' => $service_name . ' at LIVIA Med Spa is performed by Angela Spicola, a board-certified APRN with extensive aesthetic medicine experience. All treatments use FDA-approved products and protocols for your safety.',
        ],
        [
            'q' => 'Where can I get ' . $service_name . ' in Tampa, FL?',
            'a' => 'LIVIA Med Spa offers ' . $service_name . ' in Tampa, FL at 10043 N Dale Mabry Hwy, Tampa, FL 33618. Call (813) 230-2219 or book online to schedule your complimentary consultation.',
        ],
    ];

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'livia_service_faq_schema', 7);



// =============================================================================
// AI SEARCH VISIBILITY — ALLOW AI CRAWLERS IN ROBOTS.TXT
// Explicitly permits GPTBot (ChatGPT), PerplexityBot, ClaudeBot (Anthropic),
// Applebot-Extended (Apple Intelligence), and Google-Extended (Bard/Gemini).
// Without this, AI tools may not index the site for their training data.
// =============================================================================
add_filter('robots_txt', 'livia_allow_ai_crawlers', 10, 2);
function livia_allow_ai_crawlers($output, $public) {
    $ai_rules  = "\n# ── AI Search Crawlers — explicitly allowed for AI search visibility ──\n";
    $ai_rules .= "User-agent: GPTBot\nAllow: /\n\n";          // ChatGPT / OpenAI
    $ai_rules .= "User-agent: ChatGPT-User\nAllow: /\n\n";    // ChatGPT browsing
    $ai_rules .= "User-agent: OAI-SearchBot\nAllow: /\n\n";   // OpenAI SearchGPT
    $ai_rules .= "User-agent: PerplexityBot\nAllow: /\n\n";   // Perplexity AI
    $ai_rules .= "User-agent: ClaudeBot\nAllow: /\n\n";        // Anthropic Claude
    $ai_rules .= "User-agent: Claude-Web\nAllow: /\n\n";       // Claude browsing
    $ai_rules .= "User-agent: Google-Extended\nAllow: /\n\n";  // Google Gemini/Bard
    $ai_rules .= "User-agent: Applebot-Extended\nAllow: /\n\n"; // Apple Intelligence
    $ai_rules .= "User-agent: Bytespider\nAllow: /\n\n";       // ByteDance AI
    $ai_rules .= "User-agent: Meta-ExternalAgent\nAllow: /\n\n"; // Meta AI
    $ai_rules .= "User-agent: YouBot\nAllow: /\n\n";           // You.com AI search
    $ai_rules .= "User-agent: cohere-ai\nAllow: /\n\n";        // Cohere AI
    return $output . $ai_rules;
}



// =============================================================================
// HOMEPAGE REVIEW SCHEMA
// Mirrors the three real Google reviews displayed in the testimonials section
// of front-page.php. Structured data must reflect visible page content —
// keep these in sync if the testimonials section changes.
// =============================================================================
function livia_review_schema() {
    if ( ! is_front_page() ) return;

    $reviews = [
        [
            'author' => 'Lindsay S.',
            'rating' => 5,
            'body'   => 'I have been getting Botox for about 5 years now and I can say hands-down this has been the best treatment I have ever had! Angie was extremely professional. Her equipment was top notch and like nothing I\'ve ever seen before.',
        ],
        [
            'author' => 'Luna',
            'rating' => 5,
            'body'   => 'Angie is the best! I\'ve been coming to her for over a year now. I do my Botox and my microneedling and she never fails me. She\'s also really nice, makes you feel comfortable and so welcoming.',
        ],
        [
            'author' => 'Sydney M.',
            'rating' => 5,
            'body'   => 'I can\'t say enough great things about Angie. She has been so helpful and kind as I start my journey. She has been there every step of the way if I have questions or concerns. I would 1000/10 recommend Angie!',
        ],
    ];

    $schema_reviews = [];
    foreach ($reviews as $r) {
        $schema_reviews[] = [
            '@context'     => 'https://schema.org',
            '@type'        => 'Review',
            'author'       => [ '@type' => 'Person', 'name' => $r['author'] ],
            'reviewRating' => [ '@type' => 'Rating', 'ratingValue' => $r['rating'], 'bestRating' => 5 ],
            'reviewBody'   => $r['body'],
            'itemReviewed' => [
                '@type' => 'MedicalBusiness',
                'name'  => 'LIVIA Med Spa',
                'image' => 'https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema_reviews, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'livia_review_schema', 8);

