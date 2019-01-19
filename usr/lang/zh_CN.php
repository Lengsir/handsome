<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * zh_cn.php
 * Author     : hewro
 * Date       : 2017/04/30
 * Version    :
 * Description:
 */
class Usr_Lang_zh_CN extends Lang_zh_CN{

    /**
     * @return array 返回包含翻译文本的数组
     */
    public function translated() {
        return array(
            //'浏览' => '小伙伴看过',
        );
    }

    public function dateFormat() {
       // return "m 月 d 日 Y 年 ";
    }
}
