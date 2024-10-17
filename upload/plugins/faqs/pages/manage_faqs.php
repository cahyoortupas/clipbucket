<?php
define('THIS_PAGE', 'manage_faqs');
require_once dirname(__DIR__, 3) . '/includes/admin_config.php';

userquery::getInstance()->admin_login_check();
pages::getInstance()->page_redir();

$breadcrumb[0] = ['title' => 'Plugin Manager', 'url' => ''];
$breadcrumb[1] = ['title' => lang('manage_faqs'), 'url' => DirPath::getUrl('plugins') . 'faqs/pages/manage_faqs.php'];

$faqs = faqs::get_all_faqs();

if (isset($_POST['delete_faq'])) {
    $faq_id = mysql_clean($_POST['faq_id']);
    Clipbucket_db::getInstance()->delete(tbl('faqs'), ['faqid'], [$faq_id]);
    $msg = e(lang(faqs::$lang_prefix.'deleted'), 'm');
}

assign('faqs', $faqs);

subtitle(lang('plugin_faqs'));
template_files('manage_faqs.html', DirPath::get('plugins') . 'faqs/template/');
display_it();
?>
