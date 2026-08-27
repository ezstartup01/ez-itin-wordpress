<?php
/**
 * EZ-ITIN Block Theme bootstrap and homepage SEO integration.
 */

declare(strict_types=1);

const EZ_ITIN_THEME_VERSION = '0.2.0';
const EZ_ITIN_HOME_TITLE = 'ITIN Application Assistance | Certifying Acceptance Agent';
const EZ_ITIN_HOME_DESCRIPTION = 'Get ITIN application assistance from an IRS Certifying Acceptance Agent. Form W-7 preparation, passport verification, and guided submission worldwide.';

add_action('wp_enqueue_scripts', static function (): void {
    $stylesheet = get_theme_file_path('assets/css/design-system.css');
    $version = is_file($stylesheet) ? (string) filemtime($stylesheet) : EZ_ITIN_THEME_VERSION;

    wp_enqueue_style(
        'ez-itin-design-system',
        get_theme_file_uri('assets/css/design-system.css'),
        [],
        $version
    );
});

add_action('after_setup_theme', static function (): void {
    add_theme_support('editor-styles');
    add_editor_style('assets/css/design-system.css');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('title-tag');
});

add_action('init', static function (): void {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
});

/**
 * Keep the homepage title concise and front-load the primary keyphrase.
 *
 * @param mixed $title Existing title.
 * @return mixed
 */
function ez_itin_home_title($title)
{
    return is_front_page() ? EZ_ITIN_HOME_TITLE : $title;
}

/**
 * Supply one consistent homepage description to supported SEO plugins.
 *
 * @param mixed $description Existing description.
 * @return mixed
 */
function ez_itin_home_description($description)
{
    return is_front_page() ? EZ_ITIN_HOME_DESCRIPTION : $description;
}

add_filter('pre_get_document_title', 'ez_itin_home_title', 20);
add_filter('rank_math/frontend/title', 'ez_itin_home_title', 20);
add_filter('rank_math/frontend/description', 'ez_itin_home_description', 20);
add_filter('wpseo_title', 'ez_itin_home_title', 20);
add_filter('wpseo_metadesc', 'ez_itin_home_description', 20);

/**
 * FAQ entities shared by Rank Math schema and the no-plugin fallback.
 *
 * @return array<int, array<string, mixed>>
 */
function ez_itin_home_faq_entities(): array
{
    $faqs = [
        'What is an ITIN?' => 'An Individual Taxpayer Identification Number is a nine-digit tax-processing number issued by the IRS to certain people who need a U.S. taxpayer number but are not eligible for a Social Security number. It does not provide immigration status, employment authorization, or Social Security benefits.',
        'Who should request ITIN application assistance?' => 'A person may need assistance when a valid federal tax purpose requires Form W-7, such as filing a nonresident return, addressing U.S. withholding, reporting a U.S. investment, or meeting certain foreign-owned business tax obligations.',
        'What does an IRS Certifying Acceptance Agent do?' => 'A Certifying Acceptance Agent helps prepare Form W-7, reviews the application, verifies qualifying identity and foreign-status documents, and submits a Certificate of Accuracy when applicable. The IRS makes the final decision.',
        'Do I have to mail my original passport to the IRS?' => 'Many eligible applicants using a CAA can avoid mailing their original passport to the IRS because the agent verifies the document and submits the appropriate certification. Special rules can apply to dependents, certain documents, and unusual cases.',
        'Can I apply for an ITIN while living outside the United States?' => 'Yes. A qualifying federal tax need can exist while the applicant lives abroad. EZ-ITIN coordinates application preparation and document review for international clients in more than 50 countries.',
        'Does every Form W-7 require a federal tax return?' => 'Most first-time ITIN applications are submitted with a federal tax return. The IRS permits limited exceptions supported by specific documentation, so the filing route must be reviewed before submission.',
        'How long does the IRS take to issue an ITIN?' => 'IRS processing time varies with filing season, application volume, location, and whether additional information is requested. EZ-ITIN does not guarantee an approval date or processing time.',
        'What is the difference between an ITIN, EIN, and SSN?' => 'An ITIN identifies an individual for permitted federal tax purposes. An EIN identifies a business or other entity. An SSN is issued by the Social Security Administration to eligible individuals.',
        'Can a Certifying Acceptance Agent guarantee approval?' => 'No. A CAA can improve preparation, document review, and submission consistency, but only the IRS decides whether an applicant qualifies and whether the evidence is sufficient.',
    ];

    $entities = [];
    foreach ($faqs as $question => $answer) {
        $entities[] = [
            '@type' => 'Question',
            'name' => $question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $answer,
            ],
        ];
    }

    return $entities;
}

/**
 * Add Service and FAQPage entities to Rank Math's existing @graph.
 *
 * @param mixed $data Existing Rank Math graph.
 * @return mixed
 */
function ez_itin_rank_math_schema($data)
{
    if (!is_front_page() || !is_array($data)) {
        return $data;
    }

    $home = home_url('/');
    $data['itin-application-service'] = [
        '@type' => 'Service',
        '@id' => $home . '#itin-application-assistance',
        'name' => 'ITIN Application Assistance',
        'serviceType' => 'IRS Certifying Acceptance Agent ITIN application assistance',
        'description' => EZ_ITIN_HOME_DESCRIPTION,
        'url' => $home,
        'areaServed' => 'Worldwide',
        'provider' => [
            '@type' => 'Organization',
            '@id' => $home . '#organization',
            'name' => 'EZ-ITIN',
            'url' => $home,
        ],
        'availableChannel' => [
            '@type' => 'ServiceChannel',
            'serviceUrl' => home_url('/start-application/'),
            'availableLanguage' => 'English',
        ],
    ];
    $data['itin-home-faq'] = [
        '@type' => 'FAQPage',
        '@id' => $home . '#faq',
        'url' => $home . '#faq',
        'mainEntity' => ez_itin_home_faq_entities(),
    ];

    return $data;
}
add_filter('rank_math/json_ld', 'ez_itin_rank_math_schema', 99);

/**
 * Provide metadata only when neither Rank Math nor Yoast is responsible for it.
 */
add_action('wp_head', static function (): void {
    if (!is_front_page() || defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION')) {
        return;
    }

    $canonical = home_url('/');
    echo '<meta name="description" content="' . esc_attr(EZ_ITIN_HOME_DESCRIPTION) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr(EZ_ITIN_HOME_TITLE) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr(EZ_ITIN_HOME_DESCRIPTION) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary">' . "\n";
}, 2);

/**
 * Output schema when no supported SEO plugin is active.
 */
add_action('wp_head', static function (): void {
    if (!is_front_page() || defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION')) {
        return;
    }

    $home = home_url('/');
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $home . '#organization',
                'name' => 'EZ-ITIN',
                'url' => $home,
            ],
            [
                '@type' => 'Service',
                '@id' => $home . '#itin-application-assistance',
                'name' => 'ITIN Application Assistance',
                'serviceType' => 'IRS Certifying Acceptance Agent ITIN application assistance',
                'description' => EZ_ITIN_HOME_DESCRIPTION,
                'url' => $home,
                'areaServed' => 'Worldwide',
                'provider' => ['@id' => $home . '#organization'],
            ],
            [
                '@type' => 'FAQPage',
                '@id' => $home . '#faq',
                'mainEntity' => ez_itin_home_faq_entities(),
            ],
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 30);
