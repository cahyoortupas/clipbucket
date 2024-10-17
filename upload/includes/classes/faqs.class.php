<?php

class Faqs
{
    private static $faqs;
    private $tablename = '';
    private $tablename_categories = '';
    private $fields = [];
    private $fields_categories = [];
    private $display_block = '';
    private $display_var_name = '';
    private $search_limit = 0;

    /**
     * @throws Exception
     */
    public function __construct(){
        $this->tablename = 'video';
        $this->tablename_categories = 'video_categories';

        $this->fields = [
            'videoid'
            ,'videokey'
            ,'video_password'
            ,'video_users'
            ,'username'
            ,'userid'
            ,'title'
            ,'file_name'
            ,'file_type'
            ,'file_directory'
            ,'description'
            ,'broadcast'
            ,'location'
            ,'datecreated'
            ,'country'
            ,'allow_embedding'
            ,'rating'
            ,'rated_by'
            ,'voter_ids'
            ,'allow_comments'
            ,'comment_voting'
            ,'comments_count'
            ,'last_commented'
            ,'featured'
            ,'featured_date'
            ,'allow_rating'
            ,'active'
            ,'favourite_count'
            ,'playlist_count'
            ,'views'
            ,'last_viewed'
            ,'date_added'
            ,'flagged'
            ,'duration'
            ,'status'
            ,'default_thumb'
            ,'embed_code'
            ,'downloads'
            ,'uploader_ip'
            ,'video_files'
            ,'file_server_path'
            ,'video_version'
            ,'thumbs_version'
            ,'re_conv_status'
            ,'subscription_email'
        ];

        $version = Update::getInstance()->getDBVersion();
        if ($version['version'] > '5.3.0' || ($version['version'] == '5.3.0' && $version['revision'] >= 1)) {
            $this->fields[] = 'is_castable';
            $this->fields[] = 'bits_color';
        }
        if ($version['version'] > '5.5.0' || ($version['version'] == '5.5.0' && $version['revision'] >= 305)) {
            $this->fields[] = 'age_restriction';
        }
        if ($version['version'] > Tmdb::MIN_VERSION || ($version['version'] == Tmdb::MIN_VERSION && $version['revision'] >= Tmdb::MIN_REVISION)) {
            $this->fields[] = 'default_poster';
            $this->fields[] = 'default_backdrop';
        }

        $this->fields_categories = [
            'category_id'
            ,'parent_id'
            ,'category_name'
            ,'category_order'
            ,'category_desc'
            ,'date_added'
            ,'category_thumb'
            ,'isdefault'
        ];

        $this->display_block = LAYOUT . '/blocks/video.html';
        $this->display_var_name = 'video';
        $this->search_limit = (int)config('videos_items_search_page');
    }
}