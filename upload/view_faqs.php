<?php
define('THIS_PAGE', 'faqs');
define('PARENT_PAGE', 'faqs');

require 'includes/config.inc.php';

$faqs = Clipbucket_db::getInstance()->select(tbl('faqs'));

assign('faqs', $faqs);

subtitle(lang('Frequently Asked Questions (FAQs)'));
template_files('faqs.html');
display_it();
?>
