<?php
/**
 * @throws \Exception
 */
function un_install_faqs()
{
    execute_sql_file(__DIR__.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'uninstall.sql');;
}

un_install_faqs();
