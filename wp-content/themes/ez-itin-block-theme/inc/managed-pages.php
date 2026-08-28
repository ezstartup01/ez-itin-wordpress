<?php
/**
 * Code-managed SEO landing pages for the EZ-ITIN block theme.
 *
 * These pages are intentionally provisioned from versioned theme data so the
 * staging deployment is reproducible and does not depend on a manual WP Admin
 * import. The IRS makes every eligibility and issuance decision.
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

const EZ_ITIN_MANAGED_PAGES_VERSION = '1.1.1';

/**
 * Convert a question/answer map to FAQ schema entities.
 *
 * @param array<string,string> $faqs
 * @return array<int,array<string,mixed>>
 */
function ez_itin_faq_entities(array $faqs): array
{
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
 * Render visible FAQs from the same source used for FAQPage schema.
 *
 * @param array<string,string> $faqs
 */
function ez_itin_render_faqs(array $faqs): string
{
    $html = '';
    foreach ($faqs as $question => $answer) {
        $html .= '<details><summary>' . esc_html($question) . '</summary><p>' . esc_html($answer) . '</p></details>';
    }
    return $html;
}

/**
 * Wrap trusted theme markup in one WordPress Custom HTML block.
 */
function ez_itin_html_block(string $html): string
{
    return "<!-- wp:html -->\n" . $html . "\n<!-- /wp:html -->";
}

/**
 * Shared country-page data. Narrative fields are deliberately country-specific
 * to prevent thin location-page duplication.
 *
 * @return array<string,array<string,mixed>>
 */
function ez_itin_country_pages(): array
{
    static $countries = null;
    if (is_array($countries)) {
        return $countries;
    }
    $countries = [
        'canada' => [
            'country' => 'Canada',
            'demonym' => 'Canadian',
            'rank' => 1,
            'count' => '56,700',
            'title' => 'ITIN Application from Canada | CAA Assistance',
            'description' => 'Apply for an ITIN from Canada with an IRS Certifying Acceptance Agent. Get Form W-7 preparation, passport review, and guided U.S. tax filing support.',
            'focus' => 'ITIN application from Canada',
            'hero' => 'Get an ITIN application from Canada prepared around the U.S. tax reason that actually supports Form W-7. Our Certifying Acceptance Agent reviews the application, qualifying identity evidence, and coordinated federal tax filing before submission.',
            'intro_title' => 'Cross-border ITIN help for Canadian residents',
            'intro' => [
                'Canadian residents often encounter an ITIN requirement through U.S. rental property, a U.S. partnership Schedule K-1, investment withholding, a federal return, or an allowable tax-treaty position. An ITIN is a federal tax-processing number—not work authorization, immigration status, or a general-purpose banking credential.',
                'A strong Canadian ITIN application begins with the federal tax purpose. We connect that purpose to the correct Form W-7 reason, review how the applicant’s legal name and foreign address appear across the file, and identify whether a tax return or a documented IRS exception belongs in the package.',
            ],
            'scenarios' => [
                ['U.S. rental property', 'A Canadian owner reporting U.S. rental income may need an ITIN for Form 1040-NR and related elections. The property facts, filing year, and return must stay consistent with Form W-7.'],
                ['Partnership or LLC income', 'A Schedule K-1 from a U.S. partnership or LLC can create an individual U.S. filing need. We check the entity documents, tax year, and applicant details before the ITIN package is assembled.'],
                ['Withholding and refunds', 'Canadian investors can face U.S. withholding on property, securities, pensions, or other income. An ITIN may be needed to file a return and calculate the correct federal result.'],
                ['Spouse or dependent filings', 'Canada is specifically relevant to certain IRS dependent-residency rules, but a dependent still needs a permitted tax purpose and the required evidence. Each family application is reviewed separately.'],
            ],
            'country_note_title' => 'Canada–U.S. treaty and cross-border timing',
            'country_note' => 'The United States and Canada have a comprehensive income tax treaty, but the treaty does not automatically create ITIN eligibility or eliminate a return. The income category, residency position, treaty article, and requested benefit must align. Canada and the United States also use different forms and may treat the same item differently, so we avoid copying Canadian return descriptions into Form W-7 without checking the U.S. filing.',
            'documents' => [
                'A valid Canadian passport can be the sole stand-alone identity and foreign-status document when it satisfies IRS requirements.',
                'If a passport is not used, the IRS generally requires an acceptable combination of current documents, including evidence with a photograph.',
                'The Canadian address, legal name, birth information, and foreign tax identifying number—when applicable—should be consistent across Form W-7 and the supporting filing.',
                'Original documents or copies certified by the issuing agency are required unless an authorized acceptance-agent procedure applies; a routine notarized copy is not the same as an issuing-agency certified copy.',
            ],
            'faqs' => [
                'Can I apply for an ITIN while living in Canada?' => 'Yes. A Canadian resident can apply from Canada when a permitted U.S. federal tax purpose supports Form W-7 and the required return or exception evidence is included.',
                'Does the Canada–U.S. tax treaty mean I automatically qualify?' => 'No. A treaty article may support a tax position, but ITIN eligibility depends on the specific federal tax need and a complete application package.',
                'Can a Canadian passport be verified by a Certifying Acceptance Agent?' => 'A CAA can generally verify an eligible original passport and submit the required certification, subject to IRS rules and special restrictions for some dependent applications.',
                'Do I need an ITIN to buy U.S. real estate from Canada?' => 'Buying property alone does not always require an ITIN. Rental reporting, a sale, withholding, or another federal filing event may create the tax need.',
                'Can my Canadian SIN replace an ITIN on a U.S. return?' => 'No. A Canadian SIN and a U.S. ITIN serve different systems. The foreign number may be requested on Form W-7, but it does not replace a required U.S. taxpayer identification number.',
            ],
        ],
        'israel' => [
            'country' => 'Israel',
            'demonym' => 'Israeli',
            'rank' => 2,
            'count' => '19,239',
            'title' => 'ITIN Application from Israel | CAA Assistance',
            'description' => 'Apply for an ITIN from Israel with Certifying Acceptance Agent support. Form W-7, passport verification, treaty review, and U.S. tax filing guidance.',
            'focus' => 'ITIN application from Israel',
            'hero' => 'Complete an ITIN application from Israel with coordinated Form W-7, identity-document review, and U.S. federal tax support. Our Certifying Acceptance Agent checks the submission logic before the package goes to the IRS.',
            'intro_title' => 'Purpose-led ITIN assistance for Israeli applicants',
            'intro' => [
                'Israeli founders, investors, property owners, partners, students, and family members can encounter U.S. tax forms long before they live in the United States. Common triggers include U.S. partnership income, real-estate activity, reportable investment income, or a treaty-related filing. The trigger—not nationality by itself—determines whether Form W-7 belongs in the case.',
                'Names may appear in Hebrew, English, or more than one transliteration. Before filing, we compare the passport machine-readable zone, the English spelling used by the withholding agent or entity, the foreign address, and the federal return. This reduces avoidable mismatches that can separate the ITIN application from its supporting documents.',
            ],
            'scenarios' => [
                ['Technology and venture interests', 'An Israeli founder or investor receiving a U.S. partnership K-1 may need an individual filing even when the underlying business already has an EIN. The individual and entity tax numbers are not interchangeable.'],
                ['U.S. real-estate income', 'Rental operations, property sales, and withholding can lead to Form 1040-NR or another filing. We connect the transaction records to the ITIN reason instead of treating ownership alone as eligibility.'],
                ['Portfolio withholding', 'U.S.-source dividends, interest, royalties, or other payments can produce withholding forms. The correct income classification determines whether a return, treaty disclosure, or supported exception is appropriate.'],
                ['Academic or family filings', 'Students, researchers, spouses, and dependents may qualify under distinct rules. Visa details and the actual federal filing position must be reviewed rather than assumed.'],
            ],
            'country_note_title' => 'U.S.–Israel treaty positions need exact facts',
            'country_note' => 'The U.S.–Israel income tax treaty can affect specified categories of income, but it does not make every Israeli applicant eligible for an ITIN. We identify the relevant payer, income type, tax year, and treaty position, then determine whether the application belongs with a return or within a documented exception. Treaty treatment should never be inferred solely from an Israeli address.',
            'documents' => [
                'A current Israeli passport is generally the cleanest stand-alone evidence of identity and foreign status when it meets IRS standards.',
                'English transliteration should be consistent across the passport, Form W-7, federal return, and U.S. payer or partnership records.',
                'An Israeli residential address should be presented as a deliverable foreign address; we review line order and postal information for clarity.',
                'When a CAA procedure is available, eligible applicants can often avoid mailing the original passport to the IRS; the IRS retains final authority over document sufficiency.',
            ],
            'faqs' => [
                'Can an Israeli citizen apply for an ITIN without traveling to the United States?' => 'Yes. The application can be prepared from Israel when a qualifying federal tax purpose, the correct supporting filing, and acceptable identity evidence are present.',
                'Will an ITIN give me permission to work in the United States?' => 'No. An ITIN is for federal tax processing and does not provide employment authorization, immigration status, or Social Security benefits.',
                'How should Hebrew and English names appear on Form W-7?' => 'The legal name should follow the passport and supporting records. Transliteration differences should be resolved before submission so the application and tax filing match.',
                'Does my U.S. company EIN remove the need for a personal ITIN?' => 'No. An EIN identifies an entity. An owner or partner may separately need an ITIN for an individual federal return or other permitted tax purpose.',
                'Does the U.S.–Israel treaty eliminate all withholding?' => 'No. Results depend on the income category, eligibility, documentation, and treaty article. Some income remains taxable or reportable in the United States.',
            ],
        ],
        'united-kingdom' => [
            'country' => 'United Kingdom',
            'phrase_country' => 'the United Kingdom',
            'demonym' => 'UK',
            'rank' => 3,
            'count' => '15,085',
            'title' => 'ITIN Application from the UK | CAA Assistance',
            'description' => 'Apply for an ITIN from the United Kingdom with CAA help. Get Form W-7 preparation, UK passport verification, treaty review, and U.S. tax support.',
            'focus' => 'ITIN application from the United Kingdom',
            'hero' => 'Prepare an ITIN application from the United Kingdom with a Certifying Acceptance Agent who coordinates Form W-7, UK identity records, and the underlying U.S. federal tax filing.',
            'intro_title' => 'U.S. ITIN support designed for UK residents',
            'intro' => [
                'UK residents may receive U.S. rental income, partnership allocations, royalties, pension distributions, or investment payments that create a federal filing question. An ITIN is issued for a valid U.S. tax purpose; it is not a substitute for a National Insurance number, Unique Taxpayer Reference, visa, or Social Security number.',
                'The UK tax year and the U.S. calendar tax year do not end together. That difference can affect which statements are available when Form W-7 is filed. We identify the U.S. filing year first, then match income and entity documents to that period so the application is supported by coherent records.',
            ],
            'scenarios' => [
                ['American property income', 'A UK owner of U.S. rental property may need to file Form 1040-NR and make property-related tax elections. The ITIN package should reflect the property activity and correct U.S. year.'],
                ['U.S. partnership allocations', 'A K-1 from a partnership, fund, or LLC can produce a personal filing need even if no cash was distributed. We review the tax form rather than relying only on payment history.'],
                ['Royalties and creative income', 'Authors, software developers, licensors, and creators can receive U.S.-source royalties. Treaty rates and reporting depend on the contract, rights, payer documentation, and income type.'],
                ['Withholding reconciliation', 'When U.S. tax was withheld, an ITIN may be required to file the return that calculates the final liability or refund. The withholding form must match the applicant and tax year.'],
            ],
            'country_note_title' => 'Coordinate the U.S.–UK treaty with two tax calendars',
            'country_note' => 'The U.S.–UK income tax treaty may affect specific income, but treaty access is fact-dependent. The UK fiscal year does not replace the U.S. calendar-year reporting period, and an HMRC filing does not by itself satisfy the IRS. We map the treaty position, U.S. form, and year before selecting the Form W-7 category.',
            'documents' => [
                'A valid UK passport can serve as the sole stand-alone document when it meets the IRS identity and foreign-status requirements.',
                'Names, middle names, and prior names should be reconciled across the passport, U.S. withholding forms, Companies House or partnership records, and the federal return.',
                'A National Insurance number or UTR does not replace an ITIN, although Form W-7 may request a foreign tax identifying number when one has been issued.',
                'Digital scans are useful for the pre-filing review, but the final IRS evidence must follow original, issuing-agency certification, or authorized CAA procedures.',
            ],
            'faqs' => [
                'Can I submit Form W-7 from the United Kingdom?' => 'Yes. A UK resident can apply from abroad when the application is tied to an allowable U.S. federal tax purpose and includes the correct evidence.',
                'Is a UK National Insurance number the same as an ITIN?' => 'No. A National Insurance number belongs to the UK system. An ITIN is a U.S. federal tax-processing number.',
                'Can a CAA verify my British passport remotely?' => 'Document review can begin remotely, but the CAA must follow IRS procedures for examining eligible original documents before issuing any certification.',
                'Which tax year applies to my U.S. ITIN filing?' => 'The supporting U.S. return generally follows the U.S. tax year. UK tax-year records may need to be allocated or reconciled to that period.',
                'Do all UK owners of U.S. LLCs need an ITIN?' => 'No. The entity classification, ownership, income, transactions, and individual filing obligations determine whether a personal ITIN is needed.',
            ],
        ],
        'china' => [
            'country' => 'China',
            'demonym' => 'Chinese',
            'rank' => 4,
            'count' => '12,687',
            'title' => 'ITIN Application from China | CAA Assistance',
            'description' => 'Apply for an ITIN from China with Certifying Acceptance Agent support. Form W-7 preparation, passport review, treaty analysis, and U.S. tax guidance.',
            'focus' => 'ITIN application from China',
            'hero' => 'Prepare an ITIN application from China with Form W-7 assistance, passport review, and coordinated U.S. tax filing support from an IRS Certifying Acceptance Agent.',
            'intro_title' => 'Accurate ITIN preparation for applicants in mainland China',
            'intro' => [
                'Chinese investors, property owners, partners, students, researchers, and family members can have a U.S. tax filing need while remaining abroad. The ITIN application must identify that federal purpose clearly. Forming a U.S. company, opening an account, or making a purchase by itself is not always a sufficient reason for the IRS to issue an ITIN.',
                'Chinese and Romanized names can be ordered or spaced differently across passports, school records, bank statements, and U.S. tax forms. We use the passport and relevant U.S. records to establish a consistent filing identity. A mismatch in name order or birth information can create avoidable IRS correspondence.',
            ],
            'scenarios' => [
                ['Student and researcher filings', 'Certain scholarship, fellowship, employment, or treaty situations can create a federal return or supported exception. Visa category, presence, payer forms, and treaty facts must be examined together.'],
                ['U.S. property transactions', 'Rental income, property sales, and federal withholding may require an ITIN-supported Form 1040-NR. Ownership alone is not the same as a completed tax purpose.'],
                ['Partnership and fund investments', 'A K-1 from a U.S. fund, partnership, or LLC can carry income and withholding to the individual. We check the entity tax package and filing deadline before preparing Form W-7.'],
                ['Refund or reporting returns', 'A Chinese resident may need an ITIN to report U.S.-source income, reconcile withholding, or claim a permitted refund. The return and information statements must identify the same person.'],
            ],
            'country_note_title' => 'Treaty geography matters for China applications',
            'country_note' => 'The U.S.–China income tax treaty can apply to qualifying residents of the People’s Republic of China, but Hong Kong and Macau require separate analysis and should not be treated as automatically covered by the same provisions. We verify residency, income type, visa facts when relevant, and the exact treaty article before connecting a treaty position to Form W-7.',
            'documents' => [
                'A current PRC passport is generally the most efficient stand-alone identity and foreign-status document when it satisfies IRS rules.',
                'Pinyin spelling, name order, date of birth, and passport number should be identical across Form W-7 and the supporting U.S. return or exception records.',
                'A complete foreign address should include the province, city, district, postal code, and a Romanized format suitable for international delivery.',
                'A standard notarization is not automatically an IRS-certified copy; the final submission must use an accepted document route or eligible CAA certification.',
            ],
            'faqs' => [
                'Can I apply for an ITIN from mainland China?' => 'Yes. You can apply from China when you have a permitted U.S. federal tax purpose and submit Form W-7 with the required filing and identity evidence.',
                'Can I get an ITIN only to open a U.S. bank account?' => 'Generally, an account-opening goal alone does not establish the federal tax purpose the IRS requires. The actual tax filing or documented exception must be identified.',
                'How should my Chinese name appear on Form W-7?' => 'The English or Romanized legal name should follow the passport and remain consistent throughout the federal tax package.',
                'Does the U.S.–China treaty automatically apply to Hong Kong?' => 'No. Hong Kong treaty treatment is distinct and must be evaluated separately rather than assumed from the mainland China treaty.',
                'Can a Certifying Acceptance Agent help me avoid mailing my passport?' => 'For many eligible applicants, a CAA can examine the original passport and submit a certification. Specific dependent and document rules can limit that option.',
            ],
        ],
        'germany' => [
            'country' => 'Germany',
            'demonym' => 'German',
            'rank' => 5,
            'count' => '5,840',
            'title' => 'ITIN Application from Germany | CAA Assistance',
            'description' => 'Apply for an ITIN from Germany with an IRS Certifying Acceptance Agent. Form W-7 preparation, passport verification, treaty review, and tax support.',
            'focus' => 'ITIN application from Germany',
            'hero' => 'Build an ITIN application from Germany around the correct federal tax purpose, with Form W-7 preparation, German passport review, and coordinated U.S. filing support.',
            'intro_title' => 'German-to-U.S. ITIN application assistance',
            'intro' => [
                'German residents can need a U.S. taxpayer number after receiving partnership income, buying income-producing American property, selling a U.S. asset, or receiving payments subject to federal withholding. The ITIN is limited to tax administration and does not provide immigration or employment rights.',
                'German records can include umlauts, compound surnames, academic titles, and address formats that do not map neatly onto a U.S. tax form. We normalize only what the form requires while keeping the legal identity traceable to the passport. This is especially important when the U.S. payer or partnership already created records using a simplified spelling.',
            ],
            'scenarios' => [
                ['U.S. rental and sale reporting', 'A German owner may need an ITIN for rental elections, Form 1040-NR, or withholding reconciliation after a property sale. We connect the real-estate documents to the proper filing year.'],
                ['Business and partnership income', 'A German partner can receive a K-1 and have a U.S. return requirement even without a distribution. The partnership EIN does not identify the individual partner.'],
                ['Pensions, royalties, and investments', 'The U.S.–Germany treaty may affect certain payments, but income classification and documentation control the result. An ITIN may support a return or specific treaty process.'],
                ['Dependent or spouse needs', 'A spouse or dependent is not automatically eligible because the primary taxpayer files. The claimed tax benefit and individual documentation must meet current IRS rules.'],
            ],
            'country_note_title' => 'Treaty analysis beyond a German address',
            'country_note' => 'The U.S.–Germany income tax treaty addresses multiple types of income, yet residency in Germany does not by itself select a treaty rate. We review beneficial ownership, the source and character of income, the U.S. form involved, and any limitation provisions relevant to the position. The Form W-7 reason must agree with that analysis.',
            'documents' => [
                'A valid German Reisepass can be the sole stand-alone document for identity and foreign status when it meets IRS requirements.',
                'Umlauts and characters such as ß should be reconciled with the passport machine-readable spelling and the name already used on U.S. tax records.',
                'The German Steueridentifikationsnummer may be relevant as a foreign tax number, but it does not replace a U.S. ITIN.',
                'German certified or notarized copies must still satisfy the IRS issuing-agency standard; local certification terminology should not be assumed equivalent.',
            ],
            'faqs' => [
                'Can a resident of Germany apply for an ITIN remotely?' => 'The application can be prepared from Germany. Identity-document examination must still follow the IRS route selected for the case.',
                'Will my German tax ID work on a U.S. return?' => 'No. A German tax identification number may be disclosed as a foreign number, but it does not replace a required ITIN on a U.S. federal return.',
                'How are umlauts handled on Form W-7?' => 'The spelling should be consistent with the passport and supporting U.S. records. We reconcile the printed and machine-readable passport formats before filing.',
                'Does the U.S.–Germany treaty mean no U.S. return is required?' => 'Not necessarily. A treaty can change taxation, but a return or disclosure may still be required to claim or report the position.',
                'Do I need an ITIN when my German company owns the U.S. investment?' => 'It depends on entity classification, ownership, and personal filing obligations. A company’s EIN does not automatically create or eliminate an individual ITIN need.',
            ],
        ],
        'japan' => [
            'country' => 'Japan',
            'demonym' => 'Japanese',
            'rank' => 6,
            'count' => '5,149',
            'title' => 'ITIN Application from Japan | CAA Assistance',
            'description' => 'Apply for an ITIN from Japan with CAA support. Get Form W-7 preparation, Japanese passport review, treaty analysis, and coordinated U.S. tax help.',
            'focus' => 'ITIN application from Japan',
            'hero' => 'Prepare an ITIN application from Japan with a Certifying Acceptance Agent who reviews Form W-7, Japanese identity records, and the supporting U.S. tax position as one file.',
            'intro_title' => 'Precise U.S. tax-number support for Japan residents',
            'intro' => [
                'Japanese residents may encounter an ITIN through U.S. real estate, partnerships, investments, royalties, research, or family tax filings. A U.S. entity’s EIN and Japan’s My Number system serve different purposes; neither automatically establishes the individual federal tax need required for Form W-7.',
                'Japanese names and addresses may appear in kanji, kana, and Roman characters, with family and given names ordered differently. We compare the passport, payer records, entity statements, and federal return to choose one consistent legal identity. Clear Romanized delivery information also matters because the IRS sends notices by post.',
            ],
            'scenarios' => [
                ['American real-estate activity', 'Rental income, a property sale, or U.S. withholding can create a filing need for a Japanese owner. The ITIN application should be timed with the correct return or exception evidence.'],
                ['Partnership and private-fund interests', 'A Schedule K-1 can allocate U.S. income or withholding to a Japanese partner. We review the form, entity classification, and individual filing year before selecting the W-7 reason.'],
                ['Licensing and royalty income', 'Technology, media, patents, and creative rights can produce U.S.-source royalties. Treaty analysis depends on the legal rights and payment classification—not simply the payer’s label.'],
                ['Academic and research payments', 'Students and researchers may have wage, scholarship, fellowship, or treaty facts requiring distinct treatment. Visa and presence records can be central to the tax filing.'],
            ],
            'country_note_title' => 'Use the U.S.–Japan treaty with the correct income class',
            'country_note' => 'The U.S.–Japan income tax treaty can modify tax on qualifying income, but each article has its own conditions. A payment described as a fee in Japan may be classified differently for U.S. purposes. We identify the source, beneficial owner, residency evidence, and reporting form before treating the treaty as support for an ITIN filing.',
            'documents' => [
                'A current Japanese passport may be used as the sole stand-alone identity and foreign-status document when it satisfies IRS standards.',
                'The Romanized passport name, name order, date of birth, and U.S. information returns must align throughout the application.',
                'A Japanese My Number is not an ITIN; when Form W-7 requests a foreign tax number, the disclosure should be reviewed for the individual facts.',
                'The foreign address should be formatted in Roman characters with prefecture, postal code, and delivery details that remain intelligible outside Japan.',
            ],
            'faqs' => [
                'Can I complete an ITIN application while living in Japan?' => 'Yes. A Japan-based applicant can file when a valid federal tax purpose and the required supporting documents are present.',
                'Is My Number accepted instead of an ITIN?' => 'No. Japan’s My Number and a U.S. ITIN belong to different tax systems and are not interchangeable.',
                'Which name order should I use on Form W-7?' => 'Use the legal name consistently with the passport and the supporting U.S. filing. Existing payer records should be reconciled before submission.',
                'Can treaty benefits be claimed without a U.S. tax return?' => 'Some limited exception procedures exist, but many ITIN applications are submitted with a federal return. The correct route depends on the specific treaty and payment facts.',
                'Can a CAA certify a Japanese passport?' => 'A CAA can generally examine an eligible original passport and certify the document under IRS procedures, subject to special-case restrictions.',
            ],
        ],
        'brazil' => [
            'country' => 'Brazil',
            'demonym' => 'Brazilian',
            'rank' => 7,
            'count' => '3,288',
            'title' => 'ITIN Application from Brazil | CAA Assistance',
            'description' => 'Apply for an ITIN from Brazil with a Certifying Acceptance Agent. Get Form W-7 help, Brazilian passport review, and U.S. tax filing support.',
            'focus' => 'ITIN application from Brazil',
            'hero' => 'Prepare an ITIN application from Brazil with Form W-7 assistance, Brazilian passport review, and a U.S. federal tax filing strategy checked by a Certifying Acceptance Agent.',
            'intro_title' => 'ITIN help for Brazilian investors and families',
            'intro' => [
                'Brazilian residents frequently encounter U.S. tax-number questions through Florida and other U.S. real estate, LLC or partnership interests, securities, consulting income, and family filings. The reason for acquiring an asset or company is not automatically the federal tax purpose the IRS requires, so we begin with the reporting event and tax form.',
                'Brazilian names can include multiple family names, particles, accents, and married-name changes. We compare the passport, CPF record, U.S. closing or entity documents, withholding forms, and federal return. The goal is one traceable identity across the ITIN application rather than abbreviations that create a second version of the applicant.',
            ],
            'scenarios' => [
                ['U.S. property ownership', 'Rental income can require Form 1040-NR, while a sale may produce FIRPTA withholding and a later reconciliation return. The ITIN timing depends on the actual transaction and filing route.'],
                ['LLC or partnership interests', 'A U.S. LLC may have an EIN, yet a Brazilian member can separately need an ITIN for a personal return, K-1 income, or another federal reporting obligation.'],
                ['Investment withholding', 'Dividends and other U.S.-source payments may be withheld at source. An ITIN can be needed for a return that reports the income and determines the proper tax result.'],
                ['Spouse and dependent matters', 'A family relationship alone does not establish eligibility. The U.S. return, residency rules, and current restrictions on dependent claims must support each individual application.'],
            ],
            'country_note_title' => 'Brazil has no comprehensive U.S. income tax treaty',
            'country_note' => 'Unlike the other six countries in this demand group, Brazil does not have a comprehensive income tax treaty with the United States. Applicants should not assume a treaty-reduced rate merely because they are Brazilian residents. U.S. domestic tax rules, the income type, withholding documents, and the federal return therefore deserve especially careful review.',
            'documents' => [
                'A valid Brazilian passport can usually serve as the sole stand-alone identity and foreign-status document when it meets IRS criteria.',
                'Multiple surnames and accents should follow the passport and remain consistent with U.S. property, entity, withholding, and return records.',
                'A CPF identifies the person in Brazil but does not replace a U.S. ITIN; it may be relevant when Form W-7 requests a foreign tax identifying number.',
                'A cartório notarization is not automatically equivalent to an IRS-accepted issuing-agency certified copy. The final document route must meet U.S. requirements.',
            ],
            'faqs' => [
                'Can I apply for an ITIN from Brazil without visiting the IRS?' => 'Yes. A qualifying applicant can prepare the filing from Brazil and use an accepted document route, including an eligible CAA procedure.',
                'Does Brazil have an income tax treaty with the United States?' => 'Brazil does not currently have a comprehensive U.S. income tax treaty. Specific agreements may address limited subjects, but a broad treaty reduction should not be assumed.',
                'Can my CPF be used in place of an ITIN?' => 'No. A CPF and ITIN identify a person in different national tax systems. One does not replace the other.',
                'Do I need an ITIN before buying a house in Florida?' => 'Not always. The purchase itself may not create ITIN eligibility, while rental income, withholding, a sale, or another federal filing can create the tax purpose.',
                'Can a Brazilian LLC owner use the company EIN personally?' => 'No. An EIN identifies the entity. The owner may separately need an ITIN if an individual U.S. tax obligation exists.',
            ],
        ],
    ];
    return $countries;
}

/**
 * Primary service-page FAQs.
 *
 * @return array<string,string>
 */
function ez_itin_service_faqs_legacy(): array
{
    return [
        'What does the ITIN application service include?' => 'The service includes an eligibility and filing-route review, Form W-7 preparation, identity and foreign-status document review, coordination with the supporting federal tax return or exception evidence, and CAA submission support when the case qualifies.',
        'Who is eligible to apply for an ITIN?' => 'A person who is not eligible for a Social Security number may apply when a permitted U.S. federal tax purpose requires a taxpayer identification number. The IRS, not the CAA, decides eligibility and issuance.',
        'Do I need to send my original passport to the IRS?' => 'Many eligible applicants who use a Certifying Acceptance Agent can avoid mailing an original passport to the IRS because the CAA examines it and submits the prescribed certification. Special rules apply to some dependents and documents.',
        'Does every ITIN application include a tax return?' => 'Most first-time applications are filed with a federal income tax return. Narrow IRS exceptions can apply when specified third-party documentation proves the tax purpose.',
        'How long does an ITIN application take?' => 'IRS processing time varies by filing season, applicant location, workload, and whether the IRS requests more information. EZ-ITIN does not guarantee an approval date or processing time.',
        'Can I use an ITIN to work or establish immigration status?' => 'No. An ITIN is a federal tax-processing number. It does not authorize employment, change immigration status, create Social Security eligibility, or replace an SSN.',
        'Can I apply for an ITIN from outside the United States?' => 'Yes. International applicants can complete the preparation and document-review process from abroad when a qualifying federal tax need exists.',
        'Can a Certifying Acceptance Agent guarantee ITIN approval?' => 'No. A CAA can improve the completeness and consistency of the submission, but only the IRS can issue an ITIN or request additional evidence.',
    ];
}

/**
 * Resources-page FAQs.
 *
 * @return array<string,string>
 */
function ez_itin_resource_faqs(): array
{
    return [
        'Where can I download the current Form W-7?' => 'Use the official IRS Form W-7 page linked in this resource hub. Always confirm the revision and instructions before filing.',
        'Which document proves both identity and foreign status?' => 'A valid passport is the only IRS-listed stand-alone document that can generally prove both. Without a passport, an acceptable combination of current documents is required.',
        'Are notarized passport copies accepted by the IRS?' => 'A routine notarized copy is generally not the same as a copy certified by the issuing agency. A CAA may be able to examine eligible originals and submit the authorized certification.',
        'What happens if Form W-7 and the tax return use different names?' => 'Inconsistent names can delay matching or trigger correspondence. Resolve legal-name, transliteration, and prior-name differences before submission.',
        'When does an unused ITIN expire?' => 'An ITIN not used on a federal tax return for three consecutive tax years expires. Renewal is generally needed only when the number will be used on a federal return.',
        'Is this resource hub a substitute for IRS instructions?' => 'No. It is a practical orientation. The current Form W-7 instructions and the applicant’s specific federal tax facts control the filing.',
    ];
}

/**
 * Build the primary ITIN application service page.
 */
function ez_itin_service_page_html_legacy(): string
{
    $faqs = ez_itin_service_faqs();
    $html = <<<'HTML'
<div class="ez-managed-page ez-service-page">
  <section class="ez-mp-hero" aria-labelledby="service-title"><div class="ez-shell ez-mp-hero__grid"><div><p class="ez-mp-kicker">IRS Certifying Acceptance Agent • Worldwide service</p><h1 id="service-title">ITIN Application Service from a Certifying Acceptance Agent</h1><p class="ez-mp-lede">Get focused ITIN application assistance for Form W-7, passport verification, identity-document review, and the supporting U.S. federal tax filing. Every package is built around a valid tax purpose—not a generic form checklist.</p><div class="ez-mp-actions"><a class="ez-mp-button ez-mp-button--primary" href="#start">Start your ITIN review</a><a class="ez-mp-button ez-mp-button--ghost" href="#process">See the application process</a></div><ul class="ez-mp-proof"><li>Form W-7 preparation</li><li>CAA document review</li><li>International coordination</li></ul></div><aside class="ez-mp-status" aria-label="ITIN application review stages"><p>Application readiness</p><strong>A coordinated filing, not a form handoff</strong><ol><li><span>01</span>Federal tax purpose <b>Reviewed</b></li><li><span>02</span>Form W-7 reason <b>Matched</b></li><li><span>03</span>Identity evidence <b>Checked</b></li><li><span>04</span>Submission package <b>Prepared</b></li></ol><small>The IRS makes the final eligibility and issuance decision.</small></aside></div></section>
  <nav class="ez-mp-jump" aria-label="On this page"><div class="ez-shell"><span>Explore</span><a href="#included">What is included</a><a href="#eligibility">Eligibility</a><a href="#process">Process</a><a href="#documents">Documents</a><a href="#caa-value">CAA support</a><a href="#faq">FAQ</a></div></nav>
  <section class="ez-mp-band"><div class="ez-shell ez-mp-metrics"><div><strong>Form W-7</strong><span>Prepared around the correct IRS reason</span></div><div><strong>Passport</strong><span>Examined under applicable CAA procedures</span></div><div><strong>Worldwide</strong><span>Structured for applicants living abroad</span></div><div><strong>Federal filing</strong><span>Coordinated with the tax purpose</span></div></div></section>
  <section id="included" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Primary ITIN application service</p><h2>What our ITIN application service includes</h2></div><p>Most avoidable ITIN problems begin when the form, documents, and tax reason are prepared as separate tasks. Our service connects Form W-7, identity evidence, and the federal filing as one submission.</p></div><div class="ez-mp-card-grid ez-mp-card-grid--4"><article><span class="ez-mp-icon">W7</span><h3>Form W-7 preparation</h3><p>We select and document the application reason, reconcile names and addresses, and prepare the fields around the applicant’s actual U.S. tax facts.</p></article><article><span class="ez-mp-icon">ID</span><h3>Identity and foreign status</h3><p>We review acceptable evidence, validity dates, issuing details, and whether a passport or an IRS-approved document combination fits the case.</p></article><article><span class="ez-mp-icon">US</span><h3>Tax-return coordination</h3><p>When a federal return is required, the taxpayer identity, filing year, income forms, and Form W-7 category are checked for a consistent package.</p></article><article><span class="ez-mp-icon">CAA</span><h3>CAA submission support</h3><p>For eligible cases, the Certifying Acceptance Agent examines original documents and supplies the prescribed certification without issuing the ITIN.</p></article></div></div></section>
  <section id="eligibility" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Who may need an ITIN</p><h2>Eligibility starts with a permitted federal tax purpose</h2></div><p>An ITIN is for people who need a U.S. taxpayer identification number but are not eligible for an SSN. It is never sold as a shortcut to banking, credit, or immigration benefits.</p></div><div class="ez-mp-bento"><article><h3>Nonresident federal return</h3><p>A nonresident alien filing Form 1040-NR for U.S.-source income, withholding, a refund, or another reporting obligation.</p></article><article><h3>U.S. partnership income</h3><p>A foreign partner or LLC member receiving a Schedule K-1 or allocated income that belongs on an individual federal filing.</p></article><article><h3>Real-estate activity</h3><p>A foreign owner reporting rental operations, property withholding, a disposition, or elections connected with U.S. real property.</p></article><article><h3>Treaty position</h3><p>A qualifying resident using a specific income-tax treaty article through a return or an IRS-permitted exception process.</p></article><article><h3>Spouse or dependent</h3><p>An individual included in an allowable tax filing whose residency, relationship, tax benefit, and documentation meet current rules.</p></article><article><h3>Student or researcher</h3><p>A qualifying applicant with scholarship, fellowship, wage, treaty, or reporting facts that require a federal taxpayer number.</p></article></div><p class="ez-mp-note"><strong>Not sure whether you qualify?</strong> We identify the filing route before requesting original documents. If you are eligible for a Social Security number, the IRS generally will not issue an ITIN.</p></div></section>
  <section id="process" class="ez-mp-section"><div class="ez-shell ez-mp-split"><div class="ez-mp-sticky"><p class="ez-mp-kicker ez-mp-kicker--blue">How the ITIN application service works</p><h2>A clear five-stage submission path</h2><p>The exact tax forms vary, but the quality controls remain consistent. Each stage must support the next before the package is treated as ready.</p><a class="ez-mp-link" href="/resources/#form-w7">Read the Form W-7 guide →</a></div><ol class="ez-mp-steps"><li><span>01</span><div><h3>Confirm the federal purpose</h3><p>We identify why the IRS taxpayer number is needed, which tax year is involved, and whether the applicant is ineligible for an SSN.</p></div></li><li><span>02</span><div><h3>Select the filing route</h3><p>Most applications accompany a federal return. If an exception may apply, we determine the exact third-party evidence the IRS instructions require.</p></div></li><li><span>03</span><div><h3>Prepare and reconcile Form W-7</h3><p>Names, birth details, citizenship, foreign address, prior ITIN history, visa data when relevant, and foreign tax-number fields are checked together.</p></div></li><li><span>04</span><div><h3>Examine supporting documents</h3><p>The document route is confirmed and, when eligible, the CAA examines the original passport or other acceptable evidence under IRS procedures.</p></div></li><li><span>05</span><div><h3>Assemble and submit</h3><p>The signed Form W-7, federal return or exception evidence, document certification, and supporting records are packaged for the IRS.</p></div></li></ol></div></section>
  <section id="documents" class="ez-mp-section ez-mp-section--blue"><div class="ez-shell ez-mp-split ez-mp-split--reverse"><div><p class="ez-mp-kicker ez-mp-kicker--blue">ITIN document requirements</p><h2>Current evidence must prove identity and foreign status</h2><p>A passport is the only IRS-listed stand-alone document that can generally establish both identity and foreign status. Applicants without a passport must use an acceptable combination from the IRS list, with at least one document containing a photograph unless a narrow rule says otherwise.</p><p>Digital copies help us review the file, but a scan alone is not the final evidence. The submission must use originals, copies certified by the issuing agency, or a permitted CAA certification. Ordinary notarization is not automatically sufficient.</p></div><div class="ez-mp-checks"><div><b>1</b><p><strong>Valid, unexpired evidence</strong>Documents must be current under the Form W-7 instructions.</p></div><div><b>2</b><p><strong>Matching legal identity</strong>Name, birth data, citizenship, and document numbers must agree.</p></div><div><b>3</b><p><strong>Foreign-status support</strong>The evidence must establish the status claimed on Form W-7.</p></div><div><b>4</b><p><strong>Correct certification route</strong>CAA, original, or issuing-agency certified evidence must fit the case.</p></div></div></div></section>
  <section id="caa-value" class="ez-mp-section ez-mp-section--dark"><div class="ez-shell ez-mp-split"><div><p class="ez-mp-kicker">Certifying Acceptance Agent assistance</p><h2>More control before the application reaches the IRS</h2><p>A Certifying Acceptance Agent is authorized through an agreement with the IRS to assist applicants, examine specified identity documents, and submit a Certificate of Accuracy when permitted. The CAA does not approve an application and cannot guarantee timing.</p><p>The practical value is pre-submission consistency: one reviewer connects the W-7 reason, supporting tax record, legal identity, and document route. Many eligible applicants can also avoid mailing an original passport to the IRS.</p></div><div class="ez-mp-compare"><div><span>Application element</span><strong>CAA review</strong></div><div><span>Federal tax purpose</span><b>Checked before filing</b></div><div><span>Form W-7 identity fields</span><b>Reconciled to evidence</b></div><div><span>Eligible original passport</span><b>Examined under CAA rules</b></div><div><span>IRS approval decision</span><b>Always made by IRS</b></div></div></div></section>
  <section id="international" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">International ITIN application service</p><h2>Country-aware support without changing the IRS standard</h2></div><p>Foreign addresses, naming conventions, treaty positions, local tax identifiers, and document certification practices differ. The federal eligibility rules stay the same, but the file should account for those local details.</p></div><div class="ez-mp-country-links"><a href="/itin-services/countries/canada/"><b>Canada</b><span>Cross-border property, partnerships, treaty filings</span></a><a href="/itin-services/countries/israel/"><b>Israel</b><span>Investments, entities, property, treaty questions</span></a><a href="/itin-services/countries/united-kingdom/"><b>United Kingdom</b><span>Different tax calendars and U.S. income</span></a><a href="/itin-services/countries/china/"><b>China</b><span>Name matching, property, academic filings</span></a><a href="/itin-services/countries/germany/"><b>Germany</b><span>Tax identifiers, treaty and investment support</span></a><a href="/itin-services/countries/japan/"><b>Japan</b><span>Romanized records and U.S. tax reporting</span></a><a href="/itin-services/countries/brazil/"><b>Brazil</b><span>Property, LLC interests, withholding filings</span></a></div><p class="ez-mp-centered"><a class="ez-mp-link" href="/itin-services/countries/">Explore all country-specific ITIN guides →</a></p></div></section>
  <section id="faq" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-faq-layout"><div><p class="ez-mp-kicker ez-mp-kicker--blue">ITIN application FAQ</p><h2>Answers before you start Form W-7</h2><p>These answers summarize common federal rules. The facts and current IRS instructions control each application.</p></div><div class="ez-mp-faqs">{{FAQS}}</div></div></section>
  <section id="start" class="ez-mp-cta"><div class="ez-shell"><div><p class="ez-mp-kicker">Start the ITIN application service review</p><h2>Prepare your ITIN application with a CAA review</h2><p>Bring the U.S. tax notice, K-1, withholding statement, property record, return, or other document that explains why the taxpayer number is needed.</p></div><a class="ez-mp-button ez-mp-button--primary" href="mailto:help@ez-itin.com?subject=ITIN%20application%20review">Request an application review</a></div></section>
</div>
HTML;
    return ez_itin_html_block(str_replace('{{FAQS}}', ez_itin_render_faqs($faqs), $html));
}

/**
 * CAA Services FAQs, written around the agent's authority and limitations.
 *
 * @return array<string,string>
 */
function ez_itin_service_faqs(): array
{
    return [
        'What are Certifying Acceptance Agent services?' => 'Certifying Acceptance Agent services help an ITIN applicant prepare Form W-7, establish the filing route, present acceptable identity and foreign-status evidence, and use an authorized document certification procedure when the case qualifies. The IRS makes the final decision.',
        'What is a Certificate of Accuracy?' => 'A Certificate of Accuracy is the prescribed certification a CAA submits after examining permitted original documents and confirming that the attached copies are accurate. It does not certify ITIN eligibility or guarantee approval.',
        'Can a CAA verify my passport so I keep the original?' => 'For many eligible applicants, a CAA can examine the original passport and submit the required certification, allowing the applicant to retain the passport instead of mailing it to the IRS. Special restrictions can apply, particularly to dependent cases.',
        'What is the difference between a CAA and an Acceptance Agent?' => 'An Acceptance Agent can assist with Form W-7 and the application process. A Certifying Acceptance Agent has additional IRS authorization to authenticate specified identity documents and submit a Certificate of Accuracy within the scope of the agreement.',
        'Is a notarized passport copy the same as CAA certification?' => 'No. Ordinary notarization generally confirms a signature or copy under local rules. CAA certification follows a separate IRS-authorized examination and Certificate of Accuracy procedure.',
        'Can a CAA certify every document for every applicant?' => 'No. The CAA must remain within the IRS agreement and current Form W-7 rules. Document type, applicant status, and special dependent requirements can change the permitted handling route.',
        'Does a CAA prepare the federal tax return too?' => 'A first-time Form W-7 is usually submitted with a federal return, while limited exceptions use specified evidence. Return preparation or coordination must be included separately and matched to the W-7 reason.',
        'Can CAA services guarantee ITIN approval or faster processing?' => 'No. A CAA can improve preparation, document handling, and consistency, but cannot issue an ITIN, direct the IRS decision, or guarantee an approval date.',
    ];
}

/**
 * Build the dedicated Certifying Acceptance Agent services page.
 */
function ez_itin_service_page_html(): string
{
    $faqs = ez_itin_service_faqs();
    $html = <<<'HTML'
<div class="ez-managed-page ez-caa-page">
  <section class="ez-mp-hero" aria-labelledby="caa-title"><div class="ez-shell ez-mp-hero__grid"><div><p class="ez-mp-kicker">CAA Services • IRS-authorized document procedures</p><h1 id="caa-title">Certifying Acceptance Agent Services for ITIN Applicants</h1><p class="ez-mp-lede">Use Certifying Acceptance Agent services to coordinate Form W-7, examine permitted identity documents, prepare a Certificate of Accuracy when authorized, and assemble an ITIN submission that keeps the applicant’s legal identity consistent throughout.</p><div class="ez-mp-actions"><a class="ez-mp-button ez-mp-button--primary" href="#caa-start">Request a CAA review</a><a class="ez-mp-button ez-mp-button--ghost" href="#caa-scope">See what a CAA does</a></div><ul class="ez-mp-proof"><li>Original-document examination</li><li>Certificate of Accuracy</li><li>Worldwide applicant support</li></ul></div><aside class="ez-mp-status" aria-label="CAA quality-control record"><p>CAA quality controls</p><strong>Identity evidence reviewed before submission</strong><ol><li><span>01</span>CAA authority and scope <b>Confirmed</b></li><li><span>02</span>Legal identity matching <b>Checked</b></li><li><span>03</span>Document validity <b>Examined</b></li><li><span>04</span>Accuracy certificate <b>Prepared</b></li></ol><small>A CAA certifies permitted documents—not the applicant’s eligibility or IRS approval.</small></aside></div></section>
  <nav class="ez-mp-jump" aria-label="CAA Services topics"><div class="ez-shell"><span>CAA Services</span><a href="#caa-scope">Agent role</a><a href="#caa-included">Services</a><a href="#certificate">Accuracy certificate</a><a href="#caa-documents">Documents</a><a href="#caa-process">Process</a><a href="#caa-faq">FAQ</a></div></nav>
  <section class="ez-mp-band"><div class="ez-shell ez-mp-metrics"><div><strong>IRS agreement</strong><span>Work performed within authorized CAA scope</span></div><div><strong>Document control</strong><span>Original evidence examined when permitted</span></div><div><strong>COA</strong><span>Certificate of Accuracy prepared for eligible files</span></div><div><strong>IRS decision</strong><span>Approval always remains with the agency</span></div></div></section>
  <section id="caa-scope" class="ez-mp-section"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Certifying Acceptance Agent services</p><h2>A defined IRS role—not a general document notarization</h2></div><div><p>A Certifying Acceptance Agent is an individual or organization operating under a written agreement with the Internal Revenue Service. The role is to help eligible applicants comply with Form W-7 procedures and, within the agreement’s scope, examine specified original identity and foreign-status documents.</p><p>When the document and applicant qualify, the CAA creates copies from the examined original and submits the prescribed Certificate of Accuracy. This can allow an applicant to maintain control of an original passport rather than place it in an IRS mailing. The certificate addresses the accuracy of the document copy; it does not promise that the tax purpose is sufficient.</p><p>CAA work is therefore narrower and more accountable than simply checking a form. The legal name, birth information, citizenship, foreign address, document number, federal return, and W-7 category must identify one person and one filing position.</p><p>Certifying Acceptance Agent services are especially useful when an international applicant wants a controlled way to present eligible original evidence, reduce avoidable document mailing, and resolve identity mismatches before the IRS receives the package. The service remains valuable only when the W-7 has a supportable federal tax purpose and the chosen documents meet current IRS requirements.</p></div></div></section>
  <section id="caa-included" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Dedicated CAA service components</p><h2>Four controls applied to an eligible ITIN file</h2></div><p>The engagement is structured around the CAA function, with tax-return preparation or other advisory work coordinated separately when the filing requires it.</p></div><div class="ez-mp-card-grid ez-mp-card-grid--4"><article><span class="ez-mp-icon">01</span><h3>W-7 intake control</h3><p>We review SSN eligibility, the stated federal tax purpose, the application category, prior ITIN history, signatures, and the required return or exception route.</p></article><article><span class="ez-mp-icon">02</span><h3>Original-document examination</h3><p>The CAA compares the permitted original evidence with the applicant’s W-7 identity fields and confirms validity, issuing details, and physical consistency.</p></article><article><span class="ez-mp-icon">03</span><h3>Certificate of Accuracy</h3><p>For an eligible document, the CAA prepares the IRS-prescribed certification identifying the evidence examined and the accuracy of the submitted copy.</p></article><article><span class="ez-mp-icon">04</span><h3>Submission coordination</h3><p>Form W-7, the accuracy certificate, document copies, and the supporting tax return or exception evidence are placed into one traceable filing package.</p></article></div></div></section>
  <section class="ez-mp-section ez-mp-section--dark"><div class="ez-shell ez-mp-split"><div><p class="ez-mp-kicker">CAA authority and limits</p><h2>What the CAA verifies—and what only the IRS decides</h2><p>A reliable service page should be explicit about the boundary. The CAA can review, examine, certify, and submit within the authorized procedure. The CAA cannot create eligibility, waive an IRS requirement, or issue the taxpayer number.</p><p>That distinction protects the applicant from promises based only on forming a company, opening a bank account, buying property, or wanting a U.S. identifier. A permitted federal tax need still has to support Form W-7.</p></div><div class="ez-mp-compare"><div><span>CAA action</span><strong>Authority</strong></div><div><span>Review the W-7 filing route</span><b>Within service scope</b></div><div><span>Examine permitted originals</span><b>When authorized</b></div><div><span>Submit a Certificate of Accuracy</span><b>For eligible evidence</b></div><div><span>Approve or issue the ITIN</span><b>IRS only</b></div><div><span>Guarantee processing time</span><b>Not permitted</b></div></div></div></section>
  <section id="certificate" class="ez-mp-section ez-mp-section--blue"><div class="ez-shell ez-mp-split ez-mp-split--reverse"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Certificate of Accuracy</p><h2>The document certification at the center of CAA Services</h2><p>The Certificate of Accuracy records that the CAA examined specified original evidence, compared it with the applicant’s identity, and created or reviewed the copy sent with the ITIN package. It is prepared under the CAA agreement and must accurately describe the document.</p><p>The certificate does not replace Form W-7, the federal tax return, or exception documentation. It also does not certify that the applicant will receive an ITIN. Its purpose is to give the IRS an authorized document-verification record while reducing the need to mail certain originals.</p></div><div class="ez-mp-checks"><div><b>1</b><p><strong>Original presented</strong>The eligible document is available for examination—not merely as an emailed scan.</p></div><div><b>2</b><p><strong>Identity reconciled</strong>Name, date of birth, nationality, expiration, and document number are checked against Form W-7.</p></div><div><b>3</b><p><strong>Copy confirmed</strong>The submitted reproduction accurately reflects the permitted original evidence.</p></div><div><b>4</b><p><strong>Certificate attached</strong>The CAA identifies the examination and includes the prescribed certification in the package.</p></div></div></div></section>
  <section id="caa-documents" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">CAA document examination</p><h2>Passport handling, alternative evidence, and dependent restrictions</h2></div><p>The document route depends on the applicant and evidence. “CAA verified” should never be assumed merely because a clear copy is available.</p></div><div class="ez-mp-scenario-grid"><article><span>01</span><h3>Passport as stand-alone evidence</h3><p>A valid passport is generally the only IRS-listed document that can establish both identity and foreign status by itself. It is the most common evidence examined in an eligible CAA case.</p></article><article><span>02</span><h3>Approved document combinations</h3><p>Without a passport, the applicant may need an acceptable combination from the current W-7 instructions. The CAA must be authorized to handle the particular evidence.</p></article><article><span>03</span><h3>Dependent applications</h3><p>Dependents can be subject to narrower certification and residency-document rules. Passport, birth record, medical, school, or other evidence must follow the current restriction.</p></article><article><span>04</span><h3>Notary and issuing-agency copies</h3><p>A routine notarized copy is not automatically equivalent to CAA certification or a copy certified by the issuing agency. The selected route must satisfy the IRS standard.</p></article></div><p class="ez-mp-note"><strong>Document safety:</strong> Preliminary scans can be used to identify inconsistencies before an appointment, but the CAA certification itself requires the examination procedure specified in the IRS agreement.</p></div></section>
  <section id="caa-process" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-split"><div class="ez-mp-sticky"><p class="ez-mp-kicker ez-mp-kicker--blue">Certifying Acceptance Agent service process</p><h2>Five stages from intake to the IRS package</h2><p>The process separates early eligibility screening from original-document handling, so applicants do not surrender sensitive evidence before the filing route is understood.</p><a class="ez-mp-link" href="/resources/#supporting-documents">Review the document guide →</a></div><ol class="ez-mp-steps"><li><span>01</span><div><h3>Screen the federal filing need</h3><p>We identify the U.S. tax event, SSN status, filing year, and whether a tax return or recognized exception supports the W-7 request.</p></div></li><li><span>02</span><div><h3>Reconcile the applicant identity</h3><p>Legal names, transliteration, birth data, citizenship, foreign address, prior IRS numbers, and payer or entity records are compared.</p></div></li><li><span>03</span><div><h3>Prepare Form W-7</h3><p>The correct category, supporting explanation, signature method, and associated federal records are organized before document certification.</p></div></li><li><span>04</span><div><h3>Examine eligible evidence</h3><p>The CAA follows the authorized original-document procedure and determines whether a Certificate of Accuracy can be supplied.</p></div></li><li><span>05</span><div><h3>Assemble the controlled submission</h3><p>The signed application, certificate, copies, return or exception material, and other support are checked and prepared for IRS delivery.</p></div></li></ol></div></section>
  <section id="caa-international" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">International CAA Services</p><h2>Country-aware identity review for applicants abroad</h2></div><p>Foreign naming systems, postal addresses, tax identifiers, treaty positions, and issuing-agency practices require local attention even though the CAA standard is federal.</p></div><div class="ez-mp-country-links"><a href="/itin-services/countries/canada/"><b>Canada</b><span>Cross-border identity and tax records</span></a><a href="/itin-services/countries/israel/"><b>Israel</b><span>Hebrew-to-English identity matching</span></a><a href="/itin-services/countries/united-kingdom/"><b>United Kingdom</b><span>UK records and U.S. filing years</span></a><a href="/itin-services/countries/china/"><b>China</b><span>Romanized names and address controls</span></a><a href="/itin-services/countries/germany/"><b>Germany</b><span>Passport spelling and tax identifiers</span></a><a href="/itin-services/countries/japan/"><b>Japan</b><span>Name order and foreign-address review</span></a><a href="/itin-services/countries/brazil/"><b>Brazil</b><span>Multiple surnames and CPF records</span></a></div><p class="ez-mp-centered"><a class="ez-mp-link" href="/itin-services/countries/">Open all international ITIN country guides →</a></p></div></section>
  <section id="caa-faq" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-faq-layout"><div><p class="ez-mp-kicker ez-mp-kicker--blue">CAA Services FAQ</p><h2>Document certification and agent-authority answers</h2><p>These answers explain the CAA function. The current Form W-7 instructions and the individual filing facts remain controlling.</p></div><div class="ez-mp-faqs">{{FAQS}}</div></div></section>
  <section id="caa-start" class="ez-mp-cta"><div class="ez-shell"><div><p class="ez-mp-kicker">Start Certifying Acceptance Agent services</p><h2>Review the tax purpose before presenting original documents</h2><p>Bring the U.S. tax, property, partnership, withholding, academic, or family record that explains why Form W-7 is needed.</p></div><a class="ez-mp-button ez-mp-button--primary" href="mailto:help@ez-itin.com?subject=CAA%20Services%20review">Request a CAA Services review</a></div></section>
</div>
HTML;
    return ez_itin_html_block(str_replace('{{FAQS}}', ez_itin_render_faqs($faqs), $html));
}

/**
 * Build the ITIN resources hub.
 */
function ez_itin_resources_page_html(): string
{
    $faqs = ez_itin_resource_faqs();
    $html = <<<'HTML'
<div class="ez-managed-page ez-resources-page">
  <section class="ez-mp-hero ez-mp-hero--compact" aria-labelledby="resources-title"><div class="ez-shell ez-mp-hero__grid"><div><p class="ez-mp-kicker">Practical guidance • Official IRS links</p><h1 id="resources-title">ITIN Application Resources and Form W-7 Guides</h1><p class="ez-mp-lede">Use these ITIN application resources to understand eligibility, Form W-7, supporting documents, nonresident tax filings, renewals, and international application issues before submitting anything to the IRS.</p><div class="ez-mp-actions"><a class="ez-mp-button ez-mp-button--primary" href="#guides">Browse ITIN guides</a><a class="ez-mp-button ez-mp-button--ghost" href="/itin-application-service/">Get CAA assistance</a></div></div><aside class="ez-mp-status"><p>Start with the right source</p><strong>Six decisions shape an ITIN filing</strong><ol><li><span>01</span>Eligibility and SSN status</li><li><span>02</span>Federal tax purpose</li><li><span>03</span>Return or exception</li><li><span>04</span>Form W-7 reason</li><li><span>05</span>Identity documents</li><li><span>06</span>Submission method</li></ol></aside></div></section>
  <nav class="ez-mp-jump" aria-label="Resource topics"><div class="ez-shell"><span>Topics</span><a href="#what-is-an-itin">What is an ITIN?</a><a href="#form-w7">Form W-7</a><a href="#supporting-documents">Documents</a><a href="#nonresident-filing">1040-NR</a><a href="#renewals">Renewal</a><a href="#international-guides">Countries</a></div></nav>
  <section id="guides" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">ITIN application resources</p><h2>How to use these ITIN application resources</h2></div><p>These guides explain the workflow in plain language and link to primary IRS sources. They do not replace the current instructions or case-specific tax advice.</p></div><div class="ez-mp-resource-grid"><a href="#what-is-an-itin"><span>01</span><h3>What is an ITIN?</h3><p>Purpose, limits, SSN eligibility, and common reasons a foreign person may need one.</p></a><a href="#form-w7"><span>02</span><h3>Form W-7 guide</h3><p>Application reasons, return attachments, exception evidence, and signature controls.</p></a><a href="#supporting-documents"><span>03</span><h3>Supporting documents</h3><p>Passport rules, acceptable alternatives, certified copies, and CAA examination.</p></a><a href="#nonresident-filing"><span>04</span><h3>Nonresident tax return</h3><p>How Form 1040-NR and U.S. income documents connect to a first ITIN filing.</p></a><a href="#renewals"><span>05</span><h3>ITIN renewal</h3><p>Three-year nonuse expiration, when renewal is necessary, and what not to send.</p></a><a href="#international-guides"><span>06</span><h3>Country guides</h3><p>Local naming, address, foreign tax-number, treaty, and document considerations.</p></a></div><div class="ez-mp-note ez-mp-note--wide"><strong>Recommended reading order:</strong> Confirm what an ITIN can do, identify the federal tax event, determine whether a return or exception belongs with Form W-7, and only then choose the identity-document route. Applicants living abroad should also open the relevant country guide before finalizing names, addresses, treaty claims, or foreign tax-number fields. This order keeps the commercial goal—such as an investment, property transaction, or partnership interest—from being confused with the federal reason the IRS evaluates. It also helps determine which records should be obtained before an original passport is examined.</div></div></section>
  <section id="what-is-an-itin" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">ITIN fundamentals</p><h2>What an Individual Taxpayer Identification Number does—and does not do</h2></div><div><p>An ITIN is a nine-digit tax-processing number issued by the Internal Revenue Service. It is available to certain resident and nonresident aliens, spouses, and dependents who need a U.S. taxpayer identification number for a federal tax purpose but are not eligible for a Social Security number.</p><p>The number helps the IRS receive returns and associate tax records with the correct individual. It does not authorize U.S. employment, provide lawful immigration status, qualify a person for Social Security benefits, or establish an identity outside the federal tax system. An EIN identifies a business or other entity; it does not replace a personal ITIN.</p><p>A bank, marketplace, payment processor, or company-formation provider may request a tax number, but that commercial request does not automatically prove eligibility. Form W-7 must be connected to a permitted tax filing or an exception specifically recognized in the IRS instructions.</p><p><a class="ez-mp-link" href="https://www.irs.gov/individuals/individual-taxpayer-identification-number" rel="noopener noreferrer">Read the official IRS ITIN overview →</a></p></div></div></section>
  <section id="form-w7" class="ez-mp-section"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Form W-7 application guide</p><h2>Match the application reason to the supporting federal record</h2></div><div><p>Form W-7 asks why the applicant needs an ITIN. The categories cover nonresident and resident filing situations, spouses and dependents, treaty benefits, and other specified federal-tax reasons. Choosing a box is not enough: the attached return or exception documentation must support the selected reason.</p><p>Names should match the legal identity evidence. The form also requests mailing and foreign addresses, birth details, citizenship, foreign tax identifying numbers when applicable, visa information for relevant applicants, and prior ITIN or IRS number history. Missing a prior number can create duplicate records; inconsistent transliteration can prevent the W-7 from matching the return.</p><p>Most new applications are attached to a completed federal income tax return and sent to the ITIN operation rather than the return’s ordinary filing address. Limited exceptions require exact third-party documentation. An exception should never be claimed simply to avoid preparing a required tax return.</p><p><a class="ez-mp-link" href="https://www.irs.gov/forms-pubs/about-form-w-7" rel="noopener noreferrer">Download current Form W-7 and instructions →</a></p></div></div></section>
  <section id="supporting-documents" class="ez-mp-section ez-mp-section--blue"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Identity and foreign-status evidence</p><h2>Use the IRS document standard, not a generic copy standard</h2></div><div><p>A passport is the only stand-alone document on the IRS list that can generally establish both identity and foreign status. Without one, applicants typically need at least two acceptable documents, and at least one must contain a photograph unless a specific dependent rule applies. Every document must be current and support the information claimed.</p><p>The IRS generally accepts original documents or copies certified by the agency that issued them. A copy notarized by a local notary is not automatically the same as an issuing-agency certification. A Certifying Acceptance Agent can examine specified original documents and submit a Certificate of Accuracy for eligible cases, often allowing the applicant to retain the passport.</p><p>Special restrictions can apply to dependents and to documents other than passports. Address and residency evidence may also be necessary. Review the current instructions before assuming that a document accepted in one application will be sufficient in another.</p><p><a class="ez-mp-link" href="https://www.irs.gov/individuals/international-taxpayers/submitting-identification-documents" rel="noopener noreferrer">Review official IRS identification-document rules →</a></p></div></div></section>
  <section id="nonresident-filing" class="ez-mp-section"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Nonresident federal tax filing</p><h2>Form 1040-NR often supplies the tax purpose for Form W-7</h2></div><div><p>A nonresident alien may need Form 1040-NR to report income effectively connected with a U.S. trade or business, claim deductions or elections, reconcile withholding, report a U.S. property transaction, or request a refund. When the applicant has no SSN or ITIN, the completed return is commonly attached to Form W-7.</p><p>The income records should identify the same person and year shown on the return. Examples include Forms 1042-S, 1099, 8288-A, and Schedule K-1, although the correct evidence depends on the transaction. A withholding form does not guarantee a refund, and an ITIN does not determine the final tax result.</p><p>The return must be complete enough to show a genuine filing purpose. Property elections, partnership statements, treaty disclosures, and other schedules may be necessary. Coordinating the tax return and W-7 at the same time reduces contradictions in names, addresses, income categories, and filing years.</p><p><a class="ez-mp-link" href="https://www.irs.gov/forms-pubs/about-form-1040-nr" rel="noopener noreferrer">Open the official Form 1040-NR page →</a></p></div></div></section>
  <section id="renewals" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Expired ITIN guidance</p><h2>Renew only when the number will be used on a federal return</h2></div><div><p>An ITIN expires after it is not used on a federal tax return for three consecutive tax years. An expired number can remain on historical records, but it should be renewed before it is used on a current return. Filing with an expired ITIN can delay credits or other return processing.</p><p>Renewal uses Form W-7 again, with the renewal path indicated and current identity documents supplied. A federal return is generally not attached solely to renew the number. Family members do not always need to renew together; each person’s upcoming filing need should be checked.</p><p>Do not renew an ITIN that will not be used on a federal return, and do not apply for a new number when the applicant already has one. Locating old notices and prior returns before preparation helps prevent duplicate-number issues.</p><p><a class="ez-mp-link" href="https://www.irs.gov/individuals/itin-expiration-faqs" rel="noopener noreferrer">Read the IRS ITIN expiration FAQs →</a></p></div></div></section>
  <section id="errors" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Pre-submission quality check</p><h2>Seven common ITIN application errors to remove</h2></div><p>Good preparation cannot guarantee approval, but it can eliminate contradictions that predictably create extra correspondence.</p></div><ol class="ez-mp-error-list"><li><b>1</b><span><strong>No demonstrated federal tax purpose</strong>A business or banking goal is stated without the return or exception evidence required by Form W-7.</span></li><li><b>2</b><span><strong>Wrong application category</strong>The checked W-7 reason does not match the applicant, income, treaty position, or attached tax record.</span></li><li><b>3</b><span><strong>Name mismatch</strong>The passport, return, withholding statement, partnership record, and W-7 identify the applicant differently.</span></li><li><b>4</b><span><strong>Unacceptable document copy</strong>A scan or routine notarization is submitted where an original, issuing-agency copy, or CAA procedure is required.</span></li><li><b>5</b><span><strong>Missing prior ITIN history</strong>An old number or application is omitted, increasing the risk of duplicate taxpayer records.</span></li><li><b>6</b><span><strong>Incomplete return package</strong>Necessary income forms, schedules, signatures, elections, or treaty disclosures are absent.</span></li><li><b>7</b><span><strong>Mailing-address failure</strong>The foreign delivery address is incomplete or likely to prevent the applicant from receiving an IRS notice.</span></li></ol></div></section>
  <section id="international-guides" class="ez-mp-section ez-mp-section--dark"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker">International ITIN guides</p><h2>Country-specific preparation for the highest-demand locations</h2></div><p>Official Taxpayer Advocate Service data for tax year 2022 identifies these seven foreign countries as the largest ITIN-filer locations. Each guide adds local issues without repeating generic copy.</p></div><div class="ez-mp-country-links ez-mp-country-links--dark"><a href="/itin-services/countries/canada/"><b>Canada</b><span>56,700 foreign-country ITIN filers</span></a><a href="/itin-services/countries/israel/"><b>Israel</b><span>19,239 foreign-country ITIN filers</span></a><a href="/itin-services/countries/united-kingdom/"><b>United Kingdom</b><span>15,085 foreign-country ITIN filers</span></a><a href="/itin-services/countries/china/"><b>China</b><span>12,687 foreign-country ITIN filers</span></a><a href="/itin-services/countries/germany/"><b>Germany</b><span>5,840 foreign-country ITIN filers</span></a><a href="/itin-services/countries/japan/"><b>Japan</b><span>5,149 foreign-country ITIN filers</span></a><a href="/itin-services/countries/brazil/"><b>Brazil</b><span>3,288 foreign-country ITIN filers</span></a></div></div></section>
  <section id="resource-faq" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-faq-layout"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Resource FAQ</p><h2>Quick answers about ITIN forms and evidence</h2><p>Use the official links above to confirm the current rule and form revision for your filing date.</p></div><div class="ez-mp-faqs">{{FAQS}}</div></div></section>
  <section class="ez-mp-cta"><div class="ez-shell"><div><p class="ez-mp-kicker">From ITIN application resources to filing</p><h2>Move from ITIN research to a reviewed application</h2><p>Our Certifying Acceptance Agent service connects the tax reason, Form W-7, identity evidence, and submission package.</p></div><a class="ez-mp-button ez-mp-button--primary" href="/itin-application-service/#caa-start">Explore CAA Services</a></div></section>
</div>
HTML;
    return ez_itin_html_block(str_replace('{{FAQS}}', ez_itin_render_faqs($faqs), $html));
}

/**
 * Build the international country hub.
 */
function ez_itin_countries_hub_html(): string
{
    $cards = '';
    foreach (ez_itin_country_pages() as $slug => $country) {
        $cards .= '<a href="/itin-services/countries/' . esc_attr($slug) . '/"><span>#' . (int) $country['rank'] . '</span><h3>' . esc_html($country['country']) . '</h3><p>' . esc_html($country['focus']) . ' guidance with ' . esc_html($country['count']) . ' foreign-country ITIN filers in tax year 2022.</p><b>Read country guide →</b></a>';
    }
    $faqs = [
        'Can I apply for an ITIN while living outside the United States?' => 'Yes. Applicants abroad can file when a qualifying federal tax purpose exists and the W-7 package follows IRS return, exception, and document rules.',
        'Are the IRS eligibility rules different by country?' => 'The federal standard is consistent, but treaties, local documents, name formats, foreign tax numbers, addresses, and common U.S. income sources vary by country.',
        'Why are these seven countries featured?' => 'They are the seven largest foreign-country locations in the Taxpayer Advocate Service table of ITIN filers for tax year 2022: Canada, Israel, the United Kingdom, China, Germany, Japan, and Brazil.',
        'Can a CAA outside my country help with the application?' => 'A CAA can coordinate eligible international cases, but original-document examination and any local delivery limitations must comply with the agent’s IRS procedures.',
        'Does a tax treaty guarantee ITIN approval?' => 'No. Treaty eligibility and ITIN eligibility are separate determinations tied to the exact facts, documentation, and federal tax filing.',
    ];
    $html = <<<'HTML'
<div class="ez-managed-page ez-country-hub">
  <section class="ez-mp-hero ez-mp-hero--compact" aria-labelledby="countries-title"><div class="ez-shell ez-mp-hero__grid"><div><p class="ez-mp-kicker">Worldwide Certifying Acceptance Agent support</p><h1 id="countries-title">International ITIN Application Assistance by Country</h1><p class="ez-mp-lede">Explore international ITIN application assistance for the seven highest-demand foreign-country locations, with local document, address, treaty, income, and Form W-7 considerations.</p><div class="ez-mp-actions"><a class="ez-mp-button ez-mp-button--primary" href="#country-guides">Choose your country</a><a class="ez-mp-button ez-mp-button--ghost" href="/itin-application-service/">View the primary service</a></div></div><aside class="ez-mp-status"><p>Official demand basis</p><strong>Top foreign-country ITIN filer locations</strong><ol><li><span>01</span>Canada <b>56,700</b></li><li><span>02</span>Israel <b>19,239</b></li><li><span>03</span>United Kingdom <b>15,085</b></li><li><span>04</span>China <b>12,687</b></li><li><span>05</span>Germany <b>5,840</b></li><li><span>06</span>Japan <b>5,149</b></li><li><span>07</span>Brazil <b>3,288</b></li></ol><small>Tax year 2022, Taxpayer Advocate Service analysis of IRS data.</small></aside></div></section>
  <section id="country-guides" class="ez-mp-section"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">International ITIN application assistance</p><h2>Country guides with local context and one federal standard</h2></div><p>Each page is written for the country’s common U.S. tax scenarios and record-keeping details. Demand order is based on official filer data, not search-volume estimates.</p></div><div class="ez-mp-country-grid">{{CARDS}}</div><p class="ez-mp-source">Source: <a href="https://www.taxpayeradvocate.irs.gov/reports/2024-annual-report-to-congress/" rel="noopener noreferrer">Taxpayer Advocate Service, 2024 Annual Report to Congress</a>, research study table for tax year 2022. Counts describe ITIN filers, not EZ-ITIN clients.</p><div class="ez-mp-note ez-mp-note--wide"><strong>How to choose a guide:</strong> Use the country where the applicant’s identity documents, foreign address, and tax residence are based—not simply the country of the U.S. payer or investment. The guide then highlights naming conventions, local tax identifiers, treaty cautions, address formatting, and the U.S. income patterns that commonly lead to Form W-7. Applicants with facts in more than one country should treat the guide as an orientation and resolve residency and treaty questions from the complete record. International ITIN application assistance still follows one IRS test: a permitted federal tax purpose supported by the proper return or exception evidence.</div></div></section>
  <section class="ez-mp-section ez-mp-section--blue"><div class="ez-shell ez-mp-split"><div><p class="ez-mp-kicker ez-mp-kicker--blue">What changes by country</p><h2>Country-aware details that affect application quality</h2><p>The IRS does not issue a different ITIN by nationality. However, a credible international application must translate local records into a coherent U.S. tax submission.</p></div><div class="ez-mp-checks"><div><b>1</b><p><strong>Names and transliteration</strong>Legal-name order, accents, scripts, and machine-readable passport spellings.</p></div><div><b>2</b><p><strong>Foreign delivery address</strong>Postal structures written clearly enough for IRS correspondence.</p></div><div><b>3</b><p><strong>Tax treaty position</strong>Country, residence, income category, article, and reporting route.</p></div><div><b>4</b><p><strong>Local tax identifiers</strong>Foreign numbers disclosed correctly without confusing them with an ITIN.</p></div></div></div></section>
  <section class="ez-mp-section"><div class="ez-shell ez-mp-split"><div class="ez-mp-sticky"><p class="ez-mp-kicker ez-mp-kicker--blue">International ITIN application assistance process</p><h2>Four controls before cross-border submission</h2><p>Distance should not turn the filing into a document relay. The tax reason, document route, and federal return are reviewed before originals are handled.</p></div><ol class="ez-mp-steps"><li><span>01</span><div><h3>Establish the U.S. tax event</h3><p>Identify the property, payer, partnership, academic program, family filing, or other fact that produces the federal need.</p></div></li><li><span>02</span><div><h3>Check treaty and filing route</h3><p>Determine whether a return is required and whether any treaty or W-7 exception actually applies to the person and income.</p></div></li><li><span>03</span><div><h3>Normalize identity records</h3><p>Reconcile the passport, local tax number, foreign address, and English or Romanized details with U.S. records.</p></div></li><li><span>04</span><div><h3>Complete CAA or IRS document handling</h3><p>Use the accepted original, issuing-agency certified, or CAA examination route and assemble the final signed package.</p></div></li></ol></div></section>
  <section id="country-faq" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-faq-layout"><div><p class="ez-mp-kicker ez-mp-kicker--blue">International ITIN FAQ</p><h2>Applying from abroad</h2><p>Country details matter, but the federal tax purpose always remains the foundation.</p></div><div class="ez-mp-faqs">{{FAQS}}</div></div></section>
  <section class="ez-mp-cta"><div class="ez-shell"><div><p class="ez-mp-kicker">International ITIN application assistance from anywhere</p><h2>Start with your country and U.S. tax reason</h2><p>Use the country guide, then move into a coordinated Form W-7 and document review.</p></div><a class="ez-mp-button ez-mp-button--primary" href="/itin-application-service/#caa-start">Request CAA assistance</a></div></section>
</div>
HTML;
    $html = str_replace(['{{CARDS}}', '{{FAQS}}'], [$cards, ez_itin_render_faqs($faqs)], $html);
    return ez_itin_html_block($html);
}

/**
 * Build one country landing page from unique narrative data.
 *
 * @param string $slug
 * @param array<string,mixed> $data
 */
function ez_itin_country_page_html(string $slug, array $data): string
{
    $phrase_country = $data['phrase_country'] ?? $data['country'];
    $scenario_one = $data['scenarios'][0][0];
    $scenario_two = $data['scenarios'][1][0];
    $scenario_html = '';
    foreach ($data['scenarios'] as $index => $scenario) {
        $scenario_html .= '<article><span>0' . ($index + 1) . '</span><h3>' . esc_html($scenario[0]) . '</h3><p>' . esc_html($scenario[1]) . '</p></article>';
    }
    $document_html = '';
    foreach ($data['documents'] as $index => $document) {
        $document_html .= '<div><b>' . ($index + 1) . '</b><p>' . esc_html($document) . '</p></div>';
    }
    $other_links = '';
    foreach (ez_itin_country_pages() as $other_slug => $other) {
        if ($other_slug === $slug) {
            continue;
        }
        $other_links .= '<a href="/itin-services/countries/' . esc_attr($other_slug) . '/">' . esc_html($other['country']) . '</a>';
    }
    $intro = '<p>' . implode('</p><p>', array_map('esc_html', $data['intro'])) . '</p>';
    $html = '
<div class="ez-managed-page ez-country-page">
  <section class="ez-mp-hero ez-mp-hero--country" aria-labelledby="country-title"><div class="ez-shell ez-mp-hero__grid"><div><p class="ez-mp-kicker">' . esc_html($data['country']) . ' • IRS Certifying Acceptance Agent</p><h1 id="country-title">ITIN Application from ' . esc_html($phrase_country) . ': CAA Assistance</h1><p class="ez-mp-lede">' . esc_html($data['hero']) . '</p><div class="ez-mp-actions"><a class="ez-mp-button ez-mp-button--primary" href="#country-start">Start a ' . esc_html($data['country']) . ' ITIN review</a><a class="ez-mp-button ez-mp-button--ghost" href="#country-process">See the process</a></div><ul class="ez-mp-proof"><li>Form W-7 preparation</li><li>Passport review</li><li>U.S. tax coordination</li></ul></div><aside class="ez-mp-status"><p>Demand position</p><strong>#' . (int) $data['rank'] . ' foreign-country ITIN filer location</strong><div class="ez-mp-big-number">' . esc_html($data['count']) . '</div><small>ITIN filers associated with ' . esc_html($data['country']) . ' in tax year 2022, according to Taxpayer Advocate Service analysis of IRS data.</small><hr><p>Application controls</p><ol><li><span>01</span>Federal purpose <b>Required</b></li><li><span>02</span>Identity evidence <b>Required</b></li><li><span>03</span>Return or exception <b>Matched</b></li></ol></aside></div></section>
  <nav class="ez-mp-jump" aria-label="Country guide topics"><div class="ez-shell"><span>' . esc_html($data['country']) . ' guide</span><a href="#country-overview">Overview</a><a href="#country-scenarios">Common reasons</a><a href="#country-process">Process</a><a href="#country-documents">Documents</a><a href="#country-faq">FAQ</a></div></nav>
  <section id="country-overview" class="ez-mp-section"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker ez-mp-kicker--blue">' . esc_html($data['focus']) . '</p><h2>' . esc_html($data['intro_title']) . '</h2></div><div>' . $intro . '<p>For an applicant in ' . esc_html($data['country']) . ', our CAA review tests whether the stated federal purpose agrees with the W-7 category, the local identity records, and the U.S. filing. That quality review can improve consistency, but the IRS alone decides whether to issue the number.</p></div></div></section>
  <section id="country-scenarios" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell"><div class="ez-mp-heading"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Common ' . esc_html($data['demonym']) . ' filing situations</p><h2>When a U.S. tax event can create an ITIN need</h2></div><p>The four ' . esc_html($data['demonym']) . ' patterns below are useful starting points, not automatic qualifications. A documented U.S. reporting event must connect the person, tax year, and requested number.</p></div><div class="ez-mp-scenario-grid">' . $scenario_html . '</div></div></section>
  <section class="ez-mp-section ez-mp-section--dark"><div class="ez-shell ez-mp-article"><div><p class="ez-mp-kicker">Country-specific tax context</p><h2>' . esc_html($data['country_note_title']) . '</h2></div><div><p>' . esc_html($data['country_note']) . '</p><p>For this ' . esc_html($data['demonym']) . ' filing, the payer records, return, exception material, and Form W-7 should express one supportable tax position. Receiving an ITIN never creates the treaty or domestic-law benefit being reported.</p><a class="ez-mp-link ez-mp-link--light" href="https://www.irs.gov/businesses/international-businesses/united-states-income-tax-treaties-a-to-z" rel="noopener noreferrer">Review official IRS treaty resources →</a></div></div></section>
  <section id="country-process" class="ez-mp-section"><div class="ez-shell ez-mp-split"><div class="ez-mp-sticky"><p class="ez-mp-kicker ez-mp-kicker--blue">' . esc_html($data['focus']) . ' process</p><h2>From cross-border tax event to a complete Form W-7 package</h2><p>For ' . esc_html($data['country']) . ', we review the tax and identity records before selecting any original-document route. That sequence confirms the federal need before sensitive documents are handled.</p></div><ol class="ez-mp-steps"><li><span>01</span><div><h3>Review the U.S. tax purpose</h3><p>Records connected with ' . esc_html($scenario_one) . ', ' . esc_html($scenario_two) . ', or another federal event are used to identify the taxpayer, filing year, and return requirement.</p></div></li><li><span>02</span><div><h3>Map ' . esc_html($data['demonym']) . ' identity to U.S. records</h3><p>We align the ' . esc_html($data['country']) . ' passport details, deliverable foreign address, applicable local tax number, and identity already reported by U.S. payers or entities.</p></div></li><li><span>03</span><div><h3>Prepare Form W-7 and the filing</h3><p>The selected W-7 category is tested against the U.S. tax year, the supporting return or exception, and the country context described under “' . esc_html($data['country_note_title']) . '.”</p></div></li><li><span>04</span><div><h3>Finish the ' . esc_html($data['country']) . ' document route</h3><p>After the file is coherent, eligible originals are examined through the chosen CAA or IRS method and the signed federal package is placed in submission order.</p></div></li></ol></div></section>
  <section id="country-documents" class="ez-mp-section ez-mp-section--blue"><div class="ez-shell ez-mp-split ez-mp-split--reverse"><div><p class="ez-mp-kicker ez-mp-kicker--blue">Documents for an ITIN from ' . esc_html($data['country']) . '</p><h2>' . esc_html($data['focus']) . ' document checklist</h2><p>Evidence issued in ' . esc_html($data['country']) . ' must still meet the current Form W-7 standard. A readable scan is useful for our preliminary comparison, while the final filing requires an IRS-accepted original, certification, or agent procedure.</p><p>When the case qualifies for CAA handling, the agent examines the eligible original document and prepares the prescribed accuracy certificate. ' . esc_html($data['demonym']) . ' dependent cases and non-passport evidence may require a different route.</p></div><div class="ez-mp-checks">' . $document_html . '</div></div></section>
  <section id="country-faq" class="ez-mp-section ez-mp-section--paper"><div class="ez-shell ez-mp-faq-layout"><div><p class="ez-mp-kicker ez-mp-kicker--blue">' . esc_html($data['country']) . ' ITIN FAQ</p><h2>Country-specific answers before filing</h2><p>These ' . esc_html($data['country']) . ' answers identify the records and cross-border details worth resolving first. They do not replace the IRS eligibility decision.</p></div><div class="ez-mp-faqs">' . ez_itin_render_faqs($data['faqs']) . '</div></div></section>
  <section class="ez-mp-section ez-mp-related"><div class="ez-shell"><p class="ez-mp-kicker ez-mp-kicker--blue">Other international guides</p><h2>Compare ITIN application requirements by country</h2><div>' . $other_links . '<a href="/itin-services/countries/">All country guides</a></div></div></section>
  <section id="country-start" class="ez-mp-cta"><div class="ez-shell"><div><p class="ez-mp-kicker">Start your ' . esc_html($data['focus']) . ' review</p><h2>Connect Form W-7 to the U.S. tax reason</h2><p>Begin with the ' . esc_html($data['country']) . ' identity record and the U.S. document that establishes the federal filing event; original evidence can follow after that review.</p></div><a class="ez-mp-button ez-mp-button--primary" href="mailto:help@ez-itin.com?subject=' . rawurlencode($data['country'] . ' ITIN application review') . '">Request a CAA review</a></div></section>
</div>';
    return ez_itin_html_block($html);
}

/**
 * SEO metadata and visible content for every managed route.
 *
 * @return array<string,array<string,mixed>>
 */
function ez_itin_managed_pages(): array
{
    static $managed = null;
    if (is_array($managed)) {
        return $managed;
    }
    $pages = [
        'itin-application-service' => [
            'title' => 'Certifying Acceptance Agent Services | EZ-ITIN',
            'description' => 'Get Certifying Acceptance Agent services for Form W-7, passport examination, Certificate of Accuracy preparation, and coordinated ITIN submission support.',
            'focus' => 'Certifying Acceptance Agent services',
            'schema' => 'Service',
            'faqs' => ez_itin_service_faqs(),
            'content' => ez_itin_service_page_html(),
        ],
        'resources' => [
            'title' => 'ITIN Application Resources | Form W-7 Guides',
            'description' => 'Explore ITIN application resources for Form W-7, passport documents, 1040-NR filings, renewals, IRS rules, and international applicants.',
            'focus' => 'ITIN application resources',
            'schema' => 'CollectionPage',
            'faqs' => ez_itin_resource_faqs(),
            'content' => ez_itin_resources_page_html(),
        ],
        'itin-services/countries' => [
            'title' => 'International ITIN Services by Country | EZ-ITIN',
            'description' => 'Explore international ITIN application assistance for Canada, Israel, the UK, China, Germany, Japan, and Brazil with country-specific CAA guidance.',
            'focus' => 'international ITIN application assistance',
            'schema' => 'CollectionPage',
            'faqs' => [
                'Can I apply for an ITIN while living outside the United States?' => 'Yes. Applicants abroad can file when a qualifying federal tax purpose exists and the W-7 package follows IRS return, exception, and document rules.',
                'Are the IRS eligibility rules different by country?' => 'The federal standard is consistent, but treaties, local documents, name formats, foreign tax numbers, addresses, and common U.S. income sources vary by country.',
                'Why are these seven countries featured?' => 'They are the seven largest foreign-country locations in the Taxpayer Advocate Service table of ITIN filers for tax year 2022: Canada, Israel, the United Kingdom, China, Germany, Japan, and Brazil.',
                'Can a CAA outside my country help with the application?' => 'A CAA can coordinate eligible international cases, but original-document examination and any local delivery limitations must comply with the agent’s IRS procedures.',
                'Does a tax treaty guarantee ITIN approval?' => 'No. Treaty eligibility and ITIN eligibility are separate determinations tied to the exact facts, documentation, and federal tax filing.',
            ],
            'content' => ez_itin_countries_hub_html(),
        ],
    ];

    foreach (ez_itin_country_pages() as $slug => $country) {
        $pages['itin-services/countries/' . $slug] = [
            'title' => $country['title'],
            'description' => $country['description'],
            'focus' => $country['focus'],
            'schema' => 'Service',
            'country' => $country['country'],
            'faqs' => $country['faqs'],
            'content' => ez_itin_country_page_html($slug, $country),
        ];
    }
    $managed = $pages;
    return $managed;
}

/**
 * Upsert one page and return its post ID, or zero on failure.
 */
function ez_itin_upsert_page(string $path, string $title, string $content, int $parent = 0): int
{
    $slug = basename($path);
    $existing = get_page_by_path($path, OBJECT, 'page');
    $post = [
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_parent' => $parent,
        'post_content' => $content,
        'comment_status' => 'closed',
        'ping_status' => 'closed',
    ];
    if ($existing instanceof WP_Post) {
        $post['ID'] = $existing->ID;
        $result = wp_update_post(wp_slash($post), true);
    } else {
        $result = wp_insert_post(wp_slash($post), true);
    }
    return is_wp_error($result) ? 0 : (int) $result;
}

/**
 * Store focus keyphrase and snippet fields for both supported SEO plugins.
 *
 * @param array<string,mixed> $definition
 */
function ez_itin_store_page_seo(int $post_id, array $definition): void
{
    if ($post_id < 1) {
        return;
    }
    update_post_meta($post_id, 'rank_math_focus_keyword', $definition['focus']);
    update_post_meta($post_id, 'rank_math_title', $definition['title']);
    update_post_meta($post_id, 'rank_math_description', $definition['description']);
    update_post_meta($post_id, '_yoast_wpseo_focuskw', $definition['focus']);
    update_post_meta($post_id, '_yoast_wpseo_title', $definition['title']);
    update_post_meta($post_id, '_yoast_wpseo_metadesc', $definition['description']);
}

/**
 * Provision the page hierarchy once per content version.
 */
function ez_itin_provision_managed_pages(): void
{
    if (get_option('ez_itin_managed_pages_version') === EZ_ITIN_MANAGED_PAGES_VERSION) {
        return;
    }
    $failed = false;
    $services_id = ez_itin_upsert_page('itin-services', 'ITIN Services', '', 0);
    if ($services_id === 0) {
        return;
    }
    $definitions = ez_itin_managed_pages();
    $primary_id = ez_itin_upsert_page('itin-application-service', 'CAA Services', $definitions['itin-application-service']['content']);
    $resources_id = ez_itin_upsert_page('resources', 'ITIN Application Resources', $definitions['resources']['content']);
    $countries_id = ez_itin_upsert_page('itin-services/countries', 'International ITIN Services by Country', $definitions['itin-services/countries']['content'], $services_id);
    ez_itin_store_page_seo($primary_id, $definitions['itin-application-service']);
    ez_itin_store_page_seo($resources_id, $definitions['resources']);
    ez_itin_store_page_seo($countries_id, $definitions['itin-services/countries']);
    if (!$primary_id || !$resources_id || !$countries_id) {
        $failed = true;
    }
    foreach (ez_itin_country_pages() as $slug => $country) {
        $path = 'itin-services/countries/' . $slug;
        $country_id = ez_itin_upsert_page($path, 'ITIN Application from ' . $country['country'], $definitions[$path]['content'], $countries_id);
        ez_itin_store_page_seo($country_id, $definitions[$path]);
        if (!$country_id) {
            $failed = true;
        }
    }
    if (!$failed) {
        update_option('ez_itin_managed_pages_version', EZ_ITIN_MANAGED_PAGES_VERSION, false);
        flush_rewrite_rules(false);
    }
}
add_action('init', 'ez_itin_provision_managed_pages', 20);

/**
 * Resolve the current managed page path.
 */
function ez_itin_current_managed_page_key(): string
{
    if (!is_page()) {
        return '';
    }
    $object = get_queried_object();
    if (!$object instanceof WP_Post) {
        return '';
    }
    $key = trim((string) get_page_uri($object), '/');
    return array_key_exists($key, ez_itin_managed_pages()) ? $key : '';
}

function ez_itin_is_managed_page(): bool
{
    return ez_itin_current_managed_page_key() !== '';
}

add_filter('body_class', static function (array $classes): array {
    if (ez_itin_is_managed_page()) {
        $classes[] = 'ez-managed-route';
    }
    return $classes;
});

/** @param mixed $title @return mixed */
function ez_itin_managed_title($title)
{
    $key = ez_itin_current_managed_page_key();
    return $key ? ez_itin_managed_pages()[$key]['title'] : $title;
}

/** @param mixed $description @return mixed */
function ez_itin_managed_description($description)
{
    $key = ez_itin_current_managed_page_key();
    return $key ? ez_itin_managed_pages()[$key]['description'] : $description;
}

/** @param mixed $canonical @return mixed */
function ez_itin_managed_canonical($canonical)
{
    $key = ez_itin_current_managed_page_key();
    return $key ? home_url('/' . trailingslashit($key)) : $canonical;
}

add_filter('pre_get_document_title', 'ez_itin_managed_title', 25);
add_filter('rank_math/frontend/title', 'ez_itin_managed_title', 25);
add_filter('rank_math/frontend/description', 'ez_itin_managed_description', 25);
add_filter('rank_math/frontend/canonical', 'ez_itin_managed_canonical', 25);
add_filter('wpseo_title', 'ez_itin_managed_title', 25);
add_filter('wpseo_metadesc', 'ez_itin_managed_description', 25);
add_filter('wpseo_canonical', 'ez_itin_managed_canonical', 25);

/**
 * Prevent the staging host from entering search indexes. Production metadata
 * remains indexable when the same theme is promoted to the live domain.
 */
function ez_itin_is_staging_host(): bool
{
    $host = strtolower((string) wp_parse_url(home_url('/'), PHP_URL_HOST));
    return $host === 'staging2.ez-itin.com' || strpos($host, 'staging') !== false;
}

add_filter('rank_math/frontend/robots', static function ($robots) {
    if (!ez_itin_is_staging_host() || !is_array($robots)) {
        return $robots;
    }
    $robots['index'] = 'noindex';
    $robots['follow'] = 'follow';
    unset($robots['nofollow']);
    return $robots;
}, 99);

add_filter('wp_robots', static function (array $robots): array {
    if (!ez_itin_is_staging_host()) {
        return $robots;
    }
    unset($robots['index'], $robots['nofollow']);
    $robots['noindex'] = true;
    $robots['follow'] = true;
    return $robots;
}, 99);

/**
 * Remove unused Elementor payload from all code-managed block pages.
 */
add_action('wp_enqueue_scripts', static function (): void {
    if (!ez_itin_is_managed_page()) {
        return;
    }
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_script('elementor-frontend');
    wp_dequeue_script('elementor-pro-frontend');
}, 101);

/**
 * Emit page-specific Service/CollectionPage, breadcrumb, and FAQ schema.
 */
add_action('wp_head', static function (): void {
    $key = ez_itin_current_managed_page_key();
    if (!$key) {
        return;
    }
    $page = ez_itin_managed_pages()[$key];
    $url = home_url('/' . trailingslashit($key));
    $name = preg_replace('/\s*\|.*$/', '', (string) $page['title']);
    $primary = [
        '@type' => $page['schema'],
        '@id' => $url . '#primary',
        'url' => $url,
        'name' => $name,
        'description' => $page['description'],
        'inLanguage' => 'en-US',
    ];
    if ($page['schema'] === 'Service') {
        $primary['serviceType'] = $page['focus'];
        $primary['provider'] = [
            '@type' => 'Organization',
            '@id' => home_url('/') . '#organization',
            'name' => 'EZ-ITIN',
            'url' => home_url('/'),
        ];
        $primary['areaServed'] = isset($page['country'])
            ? ['@type' => 'Country', 'name' => $page['country']]
            : 'Worldwide';
    }
    $crumbs = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')],
    ];
    if (strpos($key, 'itin-services/countries') === 0) {
        $crumbs[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Countries', 'item' => home_url('/itin-services/countries/')];
        if (isset($page['country'])) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $page['country'], 'item' => $url];
        }
    } else {
        $crumbs[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $name, 'item' => $url];
    }
    $graph = [
        $primary,
        [
            '@type' => 'BreadcrumbList',
            '@id' => $url . '#breadcrumb',
            'itemListElement' => $crumbs,
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $url . '#faq',
            'url' => $url . '#faq',
            'mainEntity' => ez_itin_faq_entities($page['faqs']),
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}, 31);

/**
 * Metadata fallback when neither Rank Math nor Yoast is active.
 */
add_action('wp_head', static function (): void {
    if (defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION')) {
        return;
    }
    $key = ez_itin_current_managed_page_key();
    if (!$key) {
        return;
    }
    $page = ez_itin_managed_pages()[$key];
    $url = home_url('/' . trailingslashit($key));
    echo '<meta name="description" content="' . esc_attr($page['description']) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page['description']) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary">' . "\n";
}, 2);

/**
 * Keep legacy global navigation links useful while their dedicated pages are
 * outside this delivery. Redirects are specific and preserve semantic intent.
 */
add_action('template_redirect', static function (): void {
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    $redirects = [
        'itin-services' => '/itin-application-service/',
        'start-application' => '/itin-application-service/#caa-start',
        'itin-renewal-service' => '/resources/#renewals',
        'international-itin-services' => '/itin-services/countries/',
        'nonresident-tax-filing' => '/resources/#nonresident-filing',
        'form-w7-itin-application' => '/resources/#form-w7',
        'what-is-an-itin' => '/resources/#what-is-an-itin',
        'faq' => '/itin-application-service/#caa-faq',
    ];
    if (isset($redirects[$path])) {
        wp_safe_redirect(home_url($redirects[$path]), 301, 'EZ-ITIN');
        exit;
    }
}, 1);
