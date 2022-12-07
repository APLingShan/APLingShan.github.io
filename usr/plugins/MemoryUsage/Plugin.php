<?php
/**
 * 内存占用显示插件
 * 
 * @package MemoryUsage
 * @author doudou
 * @version 1.0.0
 * @link http://doudou.me
 * @date 2012-2-26
 */
class MemoryUsage_Plugin implements Typecho_Plugin_Interface
{ 
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/footer.php')->end = array('MemoryUsage_Plugin', 'backend_output');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 输出
     *
     * @access public
     * @return void
     */
    public static function backend_output()
    {
        $usage = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 2) : 0;
        $limit = (int) ini_get('memory_limit');
        echo "<script type='text/javascript'>$$('div.typecho-head-guid>p.operate').appendText('内存占用: " . $usage . ' of ' . $limit . " Mb | ','top');</script>";
    }

    /**
     * 输出
     *
     * @access public
     * @return void
     */
    public static function output()
    {
        echo function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 2) : 0;
    }
}
