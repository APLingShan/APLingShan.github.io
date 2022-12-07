

 *

 * @package CommentLocation

 * @author Ryan

 * @version 1.0

 * @link http://lxl.521314.love

 */

class CommentLocation_Plugin implements Typecho_Plugin_Interface

{

    /**

     * 插件启用函数

     * @return void


    }

    /**

     * 获取插件配置面板

     *

     * @access public

     * @param Typecho_Widget_Helper_Form $form 配置面板

     * @return void

     * @throws Typecho_Db_Exception

     * @throws Typecho_Exception

     */

    public static function config(Typecho_Widget_Helper_Form $form)

    {

        $isDrop = new Typecho_Widget_Helper_Form_Element_Radio(

            'isDrop',

            array('0' => _t('删除'), '1' => _t('不删除')),

            '1',

            _t('彻底卸载(<b style="color:red">请慎重选择</b>)'),

            _t('请选择是否在禁用插件时，清除数据')

        );

        $form->addInput($isDrop);

    }

    /**

     * 个人用户的配置面板

     *

     * @access public

     * @param Typecho_Widget_Helper_Form $form

     * @return void

     */

    public static function personalConfig(Typecho_Widget_Helper_Form $form)

    {

    }

    public static function render($archive, ?string $template)

    {

        $archive = $archive === null ? Typecho_Widget::widget('Widget_Comments_Archive') : $archive;

        $template = $template ?? "%s";

        $db = Typecho_Db::get();

        $prefix = $db->getPrefix();

        $coid = $archive->coid;

        $result = $db->fetchRow("SELECT `location` FROM `${prefix}comments` WHERE `coid` = ${coid} and `location` is not null");

        if ($result) {

            $location = unserialize($result['location']);

        } else {

            if (!filter_var($archive->ip, FILTER_VALIDATE_IP)) {

                self::updateLocation($archive->coid, ["未知"]);

                return _t($template, "未知");

            }

            try {

                $client = Typecho_Http_Client::get();

                $client->setMethod(Typecho_Http_Client::METHOD_GET);

                $client->setHeader('User-Agent', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');

                $client->setTimeout(60);

                $responseBody = $client->send("https://whois.pconline.com.cn/ipJson.jsp?ip=" . $archive->ip);

                if (class_exists('\Typecho\Http\Client')) $responseBody = $client->getResponseBody();

                if ($responseBody) {

                    $encode = mb_detect_encoding($responseBody, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5'));

                    $responseBody =  mb_convert_encoding($responseBody, 'UTF-8', $encode);

                    $responseBody = str_replace("if(window.IPCallBack) {IPCallBack(", "", $responseBody);

                    $responseBody = str_replace(");}", "", $responseBody);

                    $location = json_decode($responseBody, true);

                    self::updateLocation($archive->coid, $location);

                }

            } catch (Exception $e) {

                self::log($e->getMessage(), 'error');

            }

        }

        $locationText = empty($location['pro']) ? $location['addr'] : $location['pro'] . $location['city'];

        return _t($template, $locationText);

    }

    /**

     * 更新评论定位

     *

     * @param int $coid 评论 ID

     * @param $location 定位

     * @return bool

     */

    public static function updateLocation(int $coid, $location)

    {

        $db = Typecho_Db::get();

        $location = is_array($location) ? serialize($location) : $location;

        $result = $db->fetchAll($db->select('coid')->from('table.comments')->where('table.comments.coid = ?', $coid));

        if (is_array($result) && count($result)) {

            $updateQuery = $db->update('table.comments')->rows(array('location' => $location))->where('coid = ?', $coid);

            return $db->query($updateQuery) > 0;

        }

        return false;

    }

    /**

     * 写入日志

     * @param mixed $log

     * @param string $type

     */

    public static function log($log, $type = 'info')

    {

        $l<?php

/**
 * 输出评论 IP 定位
 *
 * @package CommentLocation
 * @author Ryan
 * @version 1.0
 * @link http://lxl.521314.love
 */

class CommentLocation_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 插件启用函数
     * @return void
     */
    public static function activate()
    {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('location', $db->fetchRow($db->select()->from('table.comments')->page(1, 1)))) {
            $db->query('ALTER TABLE `' . $prefix . 'comments` ADD `location` varchar(511) DEFAULT null;');
        }
        Typecho_Plugin::factory('Widget_Comments_Archive')->___location = [__CLASS__, 'render'];
    }

    /**
     * 插件禁用函数
     *
     * @return string
     * @throws Typecho_Db_Exception
     */
    public static function deactivate()
    {
        if (Helper::options()->plugin('CommentLocation')->isDrop == 0) {
            $db = Typecho_Db::get();
            $prefix = $db->getPrefix();
            try {
                $db->query('ALTER TABLE `' . $prefix . 'comments` DROP `location`;');
            } catch (Exception $e) {
                self::log($e->getMessage(), 'error');
            }
            return _t("如果无法清除数据，请检查 history.log");
        }
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     * @throws Typecho_Db_Exception
     * @throws Typecho_Exception
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $isDrop = new Typecho_Widget_Helper_Form_Element_Radio(
            'isDrop',
            array('0' => _t('删除'), '1' => _t('不删除')),
            '1',
            _t('彻底卸载(<b style="color:red">请慎重选择</b>)'),
            _t('请选择是否在禁用插件时，清除数据')
        );
        $form->addInput($isDrop);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function render($archive, ?string $template)
    {
        $archive = $archive === null ? Typecho_Widget::widget('Widget_Comments_Archive') : $archive;
        $template = $template ?? "%s";
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        $coid = $archive->coid;
        $result = $db->fetchRow("SELECT `location` FROM `${prefix}comments` WHERE `coid` = ${coid} and `location` is not null");
        if ($result) {
            $location = unserialize($result['location']);
        } else {
            if (!filter_var($archive->ip, FILTER_VALIDATE_IP)) {
                self::updateLocation($archive->coid, ["未知"]);
                return _t($template, "未知");
            }
            try {
                $client = Typecho_Http_Client::get();
                $client->setMethod(Typecho_Http_Client::METHOD_GET);
                $client->setHeader('User-Agent', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
                $client->setTimeout(60);
                $responseBody = $client->send("https://whois.pconline.com.cn/ipJson.jsp?ip=" . $archive->ip);
                if (class_exists('\Typecho\Http\Client')) $responseBody = $client->getResponseBody();
                if ($responseBody) {
                    $encode = mb_detect_encoding($responseBody, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5'));
                    $responseBody =  mb_convert_encoding($responseBody, 'UTF-8', $encode);
                    $responseBody = str_replace("if(window.IPCallBack) {IPCallBack(", "", $responseBody);
                    $responseBody = str_replace(");}", "", $responseBody);
                    $location = json_decode($responseBody, true);
                    self::updateLocation($archive->coid, $location);
                }
            } catch (Exception $e) {
                self::log($e->getMessage(), 'error');
            }
        }
        $locationText = empty($location['pro']) ? $location['addr'] : $location['pro'] . $location['city'];
        return _t($template, $locationText);
    }

    /**
     * 更新评论定位
     *
     * @param int $coid 评论 ID
     * @param $location 定位
     * @return bool
     */
    public static function updateLocation(int $coid, $location)
    {
        $db = Typecho_Db::get();
        $location = is_array($location) ? serialize($location) : $location;
        $result = $db->fetchAll($db->select('coid')->from('table.comments')->where('table.comments.coid = ?', $coid));
        if (is_array($result) && count($result)) {
            $updateQuery = $db->update('table.comments')->rows(array('location' => $location))->where('coid = ?', $coid);
            return $db->query($updateQuery) > 0;
        }
        return false;
    }

    /**
     * 写入日志
     * @param mixed $log
     * @param string $type
     */
    public static function log($log, $type = 'info')
    {
        $logLine = _t("[%s][%s] %s\n", date('Y-m-d H:i:s'), strtoupper($type), $log);
        $logFile = Helper::options()->pluginDir('CommentLocation/history.log');
        file_put_contents($logFile, $logLine, FILE_APPEND);
    
