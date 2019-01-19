<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * en.php
 * Author     : hewro
 * Date       : 2017/4/29
 * Version    : 1.0
 * Description: English version
 */

class Lang_en extends Lang {

    /**
    * @return string 返回语言名称
    */
    public function name(){
        return "English";
    }

    /**
    * @return array 返回包含翻译文本的数组
    */
    public function translated(){
        return array(
            'zh-cmn-Hans' => 'en',
            /*评论 Comments*/
            '暂无评论' => ' No comments',
            '1 条评论' => ' one comment',
            '%d 条评论' => ' %d comments',
            '阅读: %d' => 'Read: %d',
            '浏览' => 'views',
            '早上好，' => 'Good morning, ',
            '中午好，' => 'Good afternoon, ',
            '晚上好，' => 'Good evening, ',
            '文章RSS' => 'Articles RSS',
            '评论RSS' => 'Comment RSS',
            '导航' => 'Navigation',
            '首页' => 'Home',
            '组成' => 'Components',
            '分类' => 'Categories',
            '页面' => 'Pages',
            '友链' => 'Links',
            '输入关键词搜索…' => 'Search projects...',
            '闲言碎语' => 'New thing',
            '登录' => 'Login',
            '后台管理' => 'Management',
            '退出' => 'Drop out',
            '用户名' => 'username',
            '密码' => 'password',
            '登录中' => 'logging in',
            '热门文章' => 'Popular articles',
            '最新评论' => 'Latest comments',
            '随机文章' => 'Random articles',
            '评论详情' => 'Comment details',
            '详情' => 'details',
            '随机文章' => 'Random articles',
            '分类' => 'Categories',
            '标签云' => 'Tag cloud',
            '文章目录' => 'Article Directory',
            /* 时光机页面 */
            '我的动态' => 'Small talk',
            '联系方式' => 'Contact information',
            '外观设置——输入email地址' => 'Appearance settings - enter email address',
            '外观设置——输入QQ号码' => 'Appearance settings - enter the QQ number',
            '外观设置——输入微博ID' => 'Appearance settings - enter microblogging ID',
            '外观设置——输入网易云音乐ID' => 'Appearance Settings - Enter NetEase Music ID',
            '网易云音乐' => 'Netease cloud music',
            '关于我' => 'About me',
            'Y 年 m 月 d 日 h 时 i 分 A' => 'F jS, Y \a\t h:i a',
            '作者' => 'Author',
            '返回首页' => 'Return to Home',
            '没有找到搜索结果，请尝试更换关键词。' => 'Can not find the search results, please try to replace the keyword.',
            '正文' => "Text",
            '发表评论' => 'Leave a Comment',
            '评论' => 'Comment',
            '欢迎' => 'Welcome',
            '归来' => 'to return',
            '名称' => 'Name',
            '邮箱' => 'Email',
            '网址' => 'Website',
            '姓名或昵称' => 'Name or nickname',
            '网站或博客' => 'Website or blog',
            '提交中' => 'submitting',
            '此处评论已关闭' => 'Comment here is closed',
            '发表新鲜事' => 'Published something new',
            '欢迎你来到「时光机」栏目。在这里你可以记录你的日常和心情。而且，首页的“闲言碎语”栏目会显示最新的三条动态哦！这是默认的第一条说说，当你发布第一条说说的时候，该条动态会自动消失。' => 'Welcome to the "Time Machine" section. Here you can record your daily and mood. Moreover, the home page of the "gossip" column will show the latest three dynamic Oh! This is the first to talk about the default, when you release the first talk about the time, the dynamic will automatically disappear.',
            '分享到' => 'Share to',
            'QQ空间' => 'Qzone',
            '微博' => 'Weibo',
            '用户名或电子邮箱' => 'User name or e-mail address'
        );
    }

    /**
    * @return string 返回日期的格式化字符串
    */
    public function dateFormat(){
        return "F j, Y";
    }
}
