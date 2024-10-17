<?php
/*
    Plugin Name: FAQs
    Description: This plugin will count number of characters  typed in a textfield and also displays number of characters allowed or left
    Author: Arslan Hassan
    ClipBucket Version: 5.5.1
    Version: 1.0
    Website: https://github.com/arslancb/clipbucket
*/

class faqs
{
    private static $plugin;
    public $template_dir = '';
    public $pages_url = '';
    public static $table_name = 'cb_' . self::class;
    public static $lang_prefix = 'plugin_' . self::class . '_';

    /**
     * @throws Exception
     */
    function __construct(){
        $this->template_dir = DirPath::get('plugins') . self::class . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR;
        $this->pages_url = DirPath::getUrl('plugins') . self::class . '/pages/';
        if (has_access('admin_access', true)) {
            $this->addAdminMenu();
        }
        $this->register_anchor_function();
    }

    public static function getInstance(): self
    {
        if( empty(self::$plugin) ){
            self::$plugin = new self();
        }
        return self::$plugin;
    }

    /**
     * @throws Exception
     */
    private function addAdminMenu(){
        add_admin_menu(lang('configurations'), lang('Manage FAQs'), $this->pages_url.'manage_faqs.php');
    }

    private function register_anchor_function(){
        register_anchor_function('get_global_announcement', 'faqs', self::class);
    }

    /**
     * @throws Exception
     */
    public static function get_global_announcement($display = true)
    {
        echo '<li><a href="'.BASEURL.'/plugins/faqs/pages/view_faqs.php">FAQs</a></li>';

    }

    /**
     * @throws Exception
     */

     public static function get_all_faqs()
     {
         return Clipbucket_db::getInstance()->select(tbl('faqs'));
     }

     public static function delete_faq($faq_id)
     {
         Clipbucket_db::getInstance()->delete(tbl('faqs'), "id = '$faq_id'");
     }

    /**
     * @throws Exception
     */
    public static function add_faqs($question, $answer, $sort)
    {
        $questionsCheck = str_replace(['<p>', '</p>', '<br>'], '', $question);
        $answerCheck = str_replace(['<p>', '</p>', '<br>'], '', $answer);

        if (strlen($questionsCheck) < 1) {
            $question = '';
        }
        
        if (strlen($answerCheck) < 1) {
            $answer = '';
        }

        Clipbucket_db::getInstance()->execute(
            'INSERT INTO `cb_faqs` (`question`, `answer`, `date_added` ,`sort`) VALUES (
                \'' . mysql_clean($question) . '\', \'' . mysql_clean($answer) . '\', "'.NOW().'", "'.$sort.'")' 
        );
    }


}

new faqs();
