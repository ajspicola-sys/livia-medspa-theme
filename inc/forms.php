<?php
/**
 * LIVIA Med Spa — Forms & Email
 * Contact and newsletter AJAX handlers, notification email template,
 * subscriber list page, and the LIVIA settings screen.
 *
 * Split out of functions.php; load order is defined there.
 */

// ── Contact Form: AJAX email handler ───────────────────────────────
function livia_handle_contact_form() {
    // Verify nonce
    if ( ! isset($_POST['livia_contact_nonce']) || ! wp_verify_nonce($_POST['livia_contact_nonce'], 'livia_contact_form') ) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh and try again.']);
    }

    // Sanitize inputs
    $first   = sanitize_text_field($_POST['first_name'] ?? '');
    $last    = sanitize_text_field($_POST['last_name']  ?? '');
    $email   = sanitize_email($_POST['email']           ?? '');
    $phone   = sanitize_text_field($_POST['phone']      ?? '');
    $service = sanitize_text_field($_POST['service']    ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if ( empty($first) || empty($email) || ! is_email($email) ) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // ── Build recipients list (supports multiple, comma-separated) ──
    $recipients_raw = get_option('livia_notification_emails', 'support@liviamedspa.com');
    $recipients = array_filter(array_map('trim', explode(',', $recipients_raw)), 'is_email');
    if ( empty($recipients) ) $recipients = ['support@liviamedspa.com'];
    $to = $recipients;

    $subject = 'New Message — LIVIA Med Spa Website';

    // ── Prepare substitution values ─────────────────────────────────
    $service_display = $service ? ucwords(str_replace('-', ' ', $service)) : 'Not specified';
    $phone_display   = $phone ?: 'Not provided';

    // ── Get custom or default template ─────────────────────────────
    $default_template = livia_default_email_template();
    $template = get_option('livia_email_template', '') ?: $default_template;

    // Replace {{placeholders}} with actual values
    $body = str_replace(
        ['{{name}}', '{{first_name}}', '{{last_name}}', '{{email}}', '{{phone}}', '{{service}}', '{{message}}'],
        [
            esc_html($first . ' ' . $last),
            esc_html($first),
            esc_html($last),
            esc_html($email),
            esc_html($phone_display),
            esc_html($service_display),
            nl2br(esc_html($message)),
        ],
        $template
    );


    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: {$first} {$last} <{$email}>",
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Message sent! We\'ll get back to you within 24 hours.']);
    } else {
        wp_send_json_error(['message' => 'Something went wrong. Please call us at (813) 230-2219.']);
    }
}
add_action('wp_ajax_livia_contact_submit',        'livia_handle_contact_form');
add_action('wp_ajax_nopriv_livia_contact_submit', 'livia_handle_contact_form');


// ── Newsletter signup (AJAX) ─────────────────────────────────────────
// Stores subscribers in the livia_newsletter_subscribers option and emails
// a notification to the same recipients as the contact form. Subscribers
// are viewable/exportable under Tools → Newsletter Subscribers.
function livia_handle_newsletter() {
    if ( ! isset($_POST['livia_newsletter_nonce']) || ! wp_verify_nonce($_POST['livia_newsletter_nonce'], 'livia_newsletter') ) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh the page and try again.']);
    }

    $email = sanitize_email($_POST['newsletter_email'] ?? '');
    if ( empty($email) || ! is_email($email) ) {
        wp_send_json_error(['message' => 'Please enter a valid email address.']);
    }

    $subscribers = get_option('livia_newsletter_subscribers', []);
    if ( ! is_array($subscribers) ) {
        $subscribers = [];
    }

    if ( isset($subscribers[$email]) ) {
        wp_send_json_success(['message' => 'You are already subscribed.']);
    }

    $subscribers[$email] = current_time('mysql');
    update_option('livia_newsletter_subscribers', $subscribers, false);

    $recipients_raw = get_option('livia_notification_emails', 'support@liviamedspa.com');
    $recipients = array_filter(array_map('trim', explode(',', $recipients_raw)), 'is_email');
    if ( ! empty($recipients) ) {
        wp_mail(
            $recipients,
            'New Newsletter Subscriber — LIVIA Med Spa',
            "New newsletter signup: {$email}\nTotal subscribers: " . count($subscribers),
            ['Content-Type: text/plain; charset=UTF-8']
        );
    }

    wp_send_json_success(['message' => 'Subscribed!']);
}
add_action('wp_ajax_livia_newsletter_submit',        'livia_handle_newsletter');
add_action('wp_ajax_nopriv_livia_newsletter_submit', 'livia_handle_newsletter');

// ── Newsletter subscriber list (Tools → Newsletter Subscribers) ──────
function livia_newsletter_admin_menu() {
    add_management_page(
        'Newsletter Subscribers',
        'Newsletter Subscribers',
        'manage_options',
        'livia-newsletter-subscribers',
        'livia_newsletter_admin_page'
    );
}
add_action('admin_menu', 'livia_newsletter_admin_menu');

function livia_newsletter_admin_page() {
    $subscribers = get_option('livia_newsletter_subscribers', []);
    if ( ! is_array($subscribers) ) {
        $subscribers = [];
    }
    ksort($subscribers);
    echo '<div class="wrap"><h1>Newsletter Subscribers</h1>';
    echo '<p>' . count($subscribers) . ' subscriber(s). Copy the list below into your email platform (Mailchimp, Klaviyo, etc.).</p>';
    echo '<textarea readonly rows="10" style="width:100%;max-width:640px;font-family:monospace;" onclick="this.select()">'
        . esc_textarea(implode("\n", array_keys($subscribers)))
        . '</textarea>';
    if ( $subscribers ) {
        echo '<table class="widefat striped" style="max-width:640px;margin-top:1rem;"><thead><tr><th>Email</th><th>Subscribed</th></tr></thead><tbody>';
        foreach ( $subscribers as $sub_email => $sub_date ) {
            echo '<tr><td>' . esc_html($sub_email) . '</td><td>' . esc_html($sub_date) . '</td></tr>';
        }
        echo '</tbody></table>';
    }
    echo '</div>';
}


// ── Default email template (used when no custom template is saved) ──
function livia_default_email_template() {
    return '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>New Message</title></head>
<body style="margin:0;padding:0;background:#f4f0f8;font-family:\'Helvetica Neue\',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f0f8;padding:40px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;border-radius:16px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,0.12);">
        <tr>
          <td style="background:linear-gradient(135deg,#0f0720 0%,#1a0a35 60%,#2d0d5e 100%);padding:40px 40px 32px;text-align:center;">
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,169,110,0.9);">LIVIA Med Spa</p>
            <h1 style="margin:0;font-size:26px;font-weight:300;color:#f0ebe3;letter-spacing:1px;">New Website Message</h1>
            <div style="width:40px;height:2px;background:linear-gradient(90deg,#AC13F9,#C9A96E);margin:16px auto 0;border-radius:2px;"></div>
          </td>
        </tr>
        <tr>
          <td style="background:#ffffff;padding:40px;">
            <p style="margin:0 0 28px;font-size:15px;color:#555;line-height:1.6;">You have a new inquiry from your website contact form. Reply directly to this email to respond to {{first_name}}.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:0 8px 16px 0;width:50%;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #AC13F9;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Name</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{name}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;width:50%;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #AC13F9;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Email</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;"><a href="mailto:{{email}}" style="color:#AC13F9;text-decoration:none;">{{email}}</a></p>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding:0 8px 16px 0;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Phone</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{phone}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;vertical-align:top;">
                  <div style="background:#f9f6ff;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Service Interest</p>
                    <p style="margin:0;font-size:15px;color:#1a0a35;font-weight:500;">{{service}}</p>
                  </div>
                </td>
              </tr>
            </table>
            <div style="background:#f9f6ff;border-radius:10px;padding:20px 22px;margin-top:4px;border-left:3px solid #AC13F9;">
              <p style="margin:0 0 8px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#AC13F9;font-weight:600;">Message</p>
              <p style="margin:0;font-size:15px;color:#333;line-height:1.7;">{{message}}</p>
            </div>
            <div style="text-align:center;margin-top:32px;">
              <a href="mailto:{{email}}" style="display:inline-block;background:linear-gradient(135deg,#AC13F9,#8a0fd4);color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:50px;font-size:14px;font-weight:600;letter-spacing:0.5px;">Reply to {{first_name}} →</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="background:#0f0720;padding:24px 40px;text-align:center;">
            <p style="margin:0;font-size:11px;color:rgba(240,235,227,0.4);letter-spacing:1px;">LIVIA Med Spa &middot; Tampa, FL &middot; <a href="https://liviamedspa.com" style="color:rgba(172,19,249,0.7);text-decoration:none;">liviamedspa.com</a></p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';
}


// ── LIVIA Settings Page (Admin Dashboard) ──────────────────────────
function livia_settings_page_html() {
    if ( ! current_user_can('manage_options') ) return;

    if ( isset($_POST['livia_settings_nonce']) && wp_verify_nonce($_POST['livia_settings_nonce'], 'livia_save_settings') ) {
        // Multiple emails — stored as comma-separated string
        $emails_raw = sanitize_text_field($_POST['livia_notification_emails'] ?? 'support@liviamedspa.com');
        $emails_clean = implode(', ', array_filter(array_map('sanitize_email', array_map('trim', explode(',', $emails_raw))), 'is_email'));
        update_option('livia_notification_emails', $emails_clean ?: 'support@liviamedspa.com');

        // Email template — allow HTML
        $template = wp_unslash($_POST['livia_email_template'] ?? '');
        update_option('livia_email_template', $template);

        echo '<div class="notice notice-success is-dismissible"><p><strong>Settings saved!</strong></p></div>';
    }

    $current_emails  = get_option('livia_notification_emails', 'support@liviamedspa.com');
    $current_template = get_option('livia_email_template', '') ?: livia_default_email_template();
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
            LIVIA Med Spa — Settings
        </h1>

        <form method="post">
            <?php wp_nonce_field('livia_save_settings', 'livia_settings_nonce'); ?>

            <!-- Section: Recipients -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">Notification Recipients</h2>
                <p style="margin:0 0 20px;color:#666;font-size:13px;">Separate multiple email addresses with commas. All recipients receive every submission.</p>
                <label for="livia_notification_emails" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">Email Address(es)</label>
                <input type="text" id="livia_notification_emails" name="livia_notification_emails"
                       value="<?php echo esc_attr($current_emails); ?>"
                       style="width:100%;max-width:600px;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;"
                       placeholder="support@liviamedspa.com, manager@liviamedspa.com">
                <p style="margin:8px 0 0;font-size:12px;color:#888;">Example: <code>support@liviamedspa.com, angie@liviamedspa.com</code></p>
            </div>

            <!-- Section: Email Template -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">Email Template (HTML)</h2>
                <p style="margin:0 0 16px;color:#666;font-size:13px;">Customize the HTML email that gets sent to your inbox. Use the tags below to insert form data — they'll be replaced automatically.</p>

                <!-- Placeholder Tags Reference -->
                <div style="background:#f9f6ff;border:1px solid #e8d8ff;border-radius:8px;padding:16px 20px;margin-bottom:16px;">
                    <p style="margin:0 0 10px;font-size:12px;font-weight:700;color:#AC13F9;letter-spacing:1px;text-transform:uppercase;">Available Placeholder Tags</p>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        <?php
                        $tags = [
                            '{{name}}'       => 'Full name',
                            '{{first_name}}' => 'First name only',
                            '{{last_name}}'  => 'Last name only',
                            '{{email}}'      => 'Email address',
                            '{{phone}}'      => 'Phone number',
                            '{{service}}'    => 'Service of interest',
                            '{{message}}'    => 'Their message',
                        ];
                        foreach ($tags as $tag => $desc) : ?>
                            <span style="background:#fff;border:1px solid #d8b4ff;border-radius:5px;padding:4px 10px;font-size:12px;cursor:pointer;"
                                  title="<?php echo esc_attr($desc); ?>"
                                  onclick="insertTag('<?php echo esc_js($tag); ?>')"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <p style="margin:10px 0 0;font-size:11px;color:#888;">Click a tag to insert it at your cursor position in the editor below.</p>
                </div>

                <label for="livia_email_template" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">HTML Template</label>
                <textarea id="livia_email_template" name="livia_email_template"
                          rows="24"
                          style="width:100%;font-family:'Courier New',monospace;font-size:12px;line-height:1.6;padding:14px;border:1px solid #ddd;border-radius:6px;resize:vertical;background:#1a1a2e;color:#e8e8f0;"><?php echo esc_textarea($current_template); ?></textarea>
                <p style="margin:8px 0 0;font-size:12px;color:#888;">Click "Reset to Default" to restore the original branded template.</p>
            </div>

            <div style="max-width:800px;display:flex;gap:12px;align-items:center;">
                <?php submit_button('Save Settings', 'primary', 'submit', false, ['style' => 'margin:0;']); ?>
                <button type="submit" name="livia_reset_template" value="1"
                        style="background:none;border:1px solid #ddd;border-radius:6px;padding:8px 18px;font-size:13px;cursor:pointer;color:#555;"
                        onclick="if(!confirm('Reset template to default? This cannot be undone.')) return false;">
                    Reset to Default
                </button>
            </div>
        </form>
    </div>

    <script>
    function insertTag(tag) {
        var ta = document.getElementById('livia_email_template');
        if (!ta) return;
        var start = ta.selectionStart, end = ta.selectionEnd;
        ta.value = ta.value.substring(0, start) + tag + ta.value.substring(end);
        ta.selectionStart = ta.selectionEnd = start + tag.length;
        ta.focus();
    }
    </script>
    <?php

    // Handle reset separately
    if ( isset($_POST['livia_reset_template']) && isset($_POST['livia_settings_nonce']) && wp_verify_nonce($_POST['livia_settings_nonce'], 'livia_save_settings') ) {
        update_option('livia_email_template', '');
    }
}

function livia_add_settings_menu() {
    add_options_page(
        'LIVIA Med Spa Settings',
        'LIVIA Settings',
        'manage_options',
        'livia-settings',
        'livia_settings_page_html'
    );
}
add_action('admin_menu', 'livia_add_settings_menu');

