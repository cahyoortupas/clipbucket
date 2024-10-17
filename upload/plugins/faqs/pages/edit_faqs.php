<?php
define('THIS_PAGE', 'edit_faqs');
require_once dirname(__DIR__, 3) . '/includes/admin_config.php';

$breadcrumb[0] = ['title' => 'Plugin Manager', 'url' => ''];
$breadcrumb[1] = ['title' => lang('manage_faqs'), 'url' => faqs::getInstance()->pages_url.'manage_faqs.php'];
$breadcrumb[2] = ['title' => lang('form faqs'), 'url' => faqs::getInstance()->pages_url.'edit_faqs.php'];

userquery::getInstance()->admin_login_check();
userquery::getInstance()->login_check('admin_access');
pages::getInstance()->page_redir();

$faq_id = $_GET['faq_id'] ?? null; 
$faq_data = null;

if ($faq_id) {
    $faq_data = Clipbucket_db::getInstance()->select(tbl('faqs'), '*', "faqid = '$faq_id'");
    if ($faq_data) {
        $faq_data = $faq_data[0];
    }
}

if (isset($_POST['update'])) {
    if ($faq_id) {
        Clipbucket_db::getInstance()->update(
            tbl('faqs'),
            ['question', 'answer', 'sort'],
            [mysql_clean($_POST['question']), mysql_clean($_POST['answer']), mysql_clean($_POST['sort'])],
            "faqid = '$faq_id'"
        );
        $msg = e(lang(faqs::$lang_prefix.'updated'), 'm');
    } else {
        faqs::add_faqs($_POST['question'], $_POST['answer'], $_POST['sort']);
        $msg = e(lang(faqs::$lang_prefix.'created'), 'm');
    }
    header('Location: manage_faqs.php');
    exit(); 
}

subtitle(lang(faqs::$lang_prefix.'subtitle'));
assign('faq_data', $faq_data); 
template_files('form_faqs.html', faqs::getInstance()->template_dir);
display_it();
?>
