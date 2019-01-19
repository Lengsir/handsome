<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


require_once("libs/Settings.php");
require_once("libs/I18n.php");
require_once("libs/Handsome.php");
require_once("libs/Title.php");
require_once("libs/Lang.php");
require_once("libs/Content.php");



function themeInit($archive)
{
    Helper::options()->commentsMaxNestingLevels = 999;
    $options = mget();
    //$options = Typecho_Widget::widget('Widget_Options');
    if (strtoupper($options->language) != "AUTO") {
        //echo $options->language + 'langis';
        I18n::setLang($options->language);
    }
}

function themeConfig($form) {
    echo Handsome::styleoutput();
    echo Handsome::SettingsWelcome();
    I18n::loadAsSettingsPage(true);

    //Typecho_Widget::widget('Widget_Themes_List')->to($themes);
    //$themes->next()
    //echo $themes->version();
    //标题1：主题外观

    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('主题外观'), NULL));
    $indexsetup = new Typecho_Widget_Helper_Form_Element_Checkbox('indexsetup',
    array(
    'header-fix' => _t('固定头部'),
    'aside-fix' => _t('固定导航'),
    'aside-folded' => _t('折叠导航'),
    'aside-dock' => _t('置顶导航'),
    'container-box' => _t('盒子模型'),
    'show-avatar' => _t('折叠左侧边栏头像'),
    'NoRandomPic-post' => _t('文章页面不显示头图'),
    'NoRandomPic-index' => _t('首页不显示头图'),
    'NoSummary-index' => _t('首页文章不显示摘要'),
    'lazyloadimg' => _t('图片延迟加载(firefox中可能会卡顿)'),
    'musicplayer' => _t('启用音乐播放器')
    ),
    array('header-fix', 'aside-fix','container-box','musicplayer'), _t('全站设置开关'));

    $form->addInput($indexsetup->multiMode());
    //主题色调选择
    $themetype = new Typecho_Widget_Helper_Form_Element_Radio('themetype',
        array(
            '0' => _t('black-white-black &emsp;&emsp;'),
            '1' => _t('dark-white-dark &emsp;&emsp;</br>'),
            '2' => _t('white-white-black &emsp;&emsp;'),
            '3' => _t('primary-white-dark &emsp;&emsp;</br>'),
            '4' => _t('info-white-black &emsp;&emsp;'),
            '5' => _t('success-white-dark &emsp;&emsp;</br>'),
            '6' => _t('danger-white-dark &emsp;&emsp;</br>'),
            '7' => _t('black-black-white &emsp;&emsp;</br>'),
            '8' => _t('dark-dark-light &emsp;&emsp;'),
            '9' => _t('info-info-light &emsp;&emsp;</br>'),
            '10' => _t('primary-primary-dark &emsp;&emsp;'),
            '11' => _t('info-info-black &emsp;&emsp;</br>'),
            '12' => _t('success-success-dark &emsp;&emsp;'),
            '13' => _t('danger-danger-dark &emsp;&emsp;</br>')
        ),

        //Default choose
        '0',_t('主题色调选择'),_t("</br>选择背景方案.如默认的<b>dark-white-dark</b> 分别代表：左侧边栏和上导航栏的交集部分、上导航栏、左侧边栏的颜色。")
    );
    $form->addInput($themetype);
    //盒子模型中背景样式选择
   $BGtype = new Typecho_Widget_Helper_Form_Element_Radio('BGtype',
        array(
            '0' => _t('纯色背景 &emsp;'),
            '1' => _t('图片背景 &emsp;'),
            '2' => _t('渐变背景 &emsp;')
        ),

        //Default choose
        '2',_t('盒子模型中背景样式选择'),_t("<b>如果你没有选中“盒子模型”，该项不会生效。</b>选择背景方案, 对应填写下方的 '<b>背景颜色 / 图片</b>' 或选择 '<b>渐变样式</b>', 这里默认使用纯色背景.")
    );
    $form->addInput($BGtype);
    //背景透明度
    $BGopacity = new Typecho_Widget_Helper_Form_Element_Text('BGopacity', NULL, NULL, _t('背景透明度'), _t('该项请填写0-1的小数，1表示不透明，0表示完全透明。如：0.88。建议先选择“图片背景”再使用该项。'));
    $form->addInput($BGopacity);
    //盒子模型种背景颜色/图片填写
    $bgcolor = new Typecho_Widget_Helper_Form_Element_Text('bgcolor', NULL, NULL, _t('背景颜色 / 图片'), _t('<b>如果你没有选中“盒子模型”，请忽略该项。</b><br />背景设置如果选择纯色背景, 这里就填写颜色代码; <br />背景设置如果选择图片背景, 这里就填写图片地址;<br />
    不填写则默认显示 #F5F5F5 或主题文件夹下的 /img/bg.jpg'));
    $form->addInput($bgcolor);
    //盒子模型中渐变样式选择
    $GradientType = new Typecho_Widget_Helper_Form_Element_Radio('GradientType',
        array(
            '0' => _t('Aerinite &emsp;'),
            '1' => _t('Ethereal &emsp;'),
            '2' => _t('Patrichor <br />'),
            '3' => _t('Komorebi &emsp;'),
            '4' => _t('Crepuscular &emsp;'),
            '5' => _t('Autumn <br />'),
            '6' => _t('Shore &emsp;'),
            '7' => _t('Horizon &emsp;'),
            '8' => _t('Green Beach <br />'),
            '9' => _t('Virgin <br />'),
        ),

        '3', _t('渐变样式'), _t("<b>如果你没有选中“盒子模型”，请忽略该项。</b><br />如果选择渐变背景, 在这里选择想要的渐变样式.")
    );
    $form->addInput($GradientType);

    //加载进度条颜色
    $progresscolor = new Typecho_Widget_Helper_Form_Element_Text('progresscolor', NULL, NULL, _t('加载进度条颜色'), _t('在这里填写正确的颜色代码作为顶部加载进度条的颜色，默认为蓝色#29。'));
    $form->addInput($progresscolor);
    //chrome 安卓选项卡颜色
    $ChromeThemeColor = new Typecho_Widget_Helper_Form_Element_Text('ChromeThemeColor', NULL, _t('#3a3f51'), _t('Android Chrome 地址栏颜色'), _t('安卓系统下的chrome浏览器顶部的地址栏颜色，请填写正确的颜色代码。'));
    $form->addInput($ChromeThemeColor);

    //标题2：个人信息

    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('个人信息设置'), NULL));

    //首页名称
    $IndexName = new Typecho_Widget_Helper_Form_Element_Text('IndexName', NULL, '友人C', _t('首页的名称'), _t('输入你的首页显示的名称'));
    $form->addInput($IndexName);
    //博主名称：aside.php中会调用
    $BlogName = new Typecho_Widget_Helper_Form_Element_Text('BlogName', NULL, 'ihewro', _t('博主的名称'), _t('输入你的名称建议为英文，中文也可'));
    $form->addInput($BlogName);

    //博主头像：在本主题中首页index.php 和 aboutme.php中将会调用此头像
    $BlogPic = new Typecho_Widget_Helper_Form_Element_Text('BlogPic', NULL, 'https://ww4.sinaimg.cn/large/a15b4afegy1fcgr86xdu6j2064064mxd', _t('头像图片地址'), _t('logo头像地址，尺寸在200X200左右即可,会在首页的侧边栏和顶部导航栏显示。'));
    $form->addInput($BlogPic);

    //博主职业
    $BlogJob = new Typecho_Widget_Helper_Form_Element_Text('BlogJob', NULL, 'A student', _t('博主的介绍'), _t('输入你的简介，在侧边栏的名称下面和时光机页面显示'));
    $form->addInput($BlogJob);

    //twitter
    $socialtwitter = new Typecho_Widget_Helper_Form_Element_Text('socialtwitter', NULL,'#', _t('输入twitter链接'), _t('在这里输入twitter链接,带http://，在时光机页面显示,为空则不显示按钮'));
    $form->addInput($socialtwitter);
    //facebook
    $socialfacebook = new Typecho_Widget_Helper_Form_Element_Text('socialfacebook', NULL,'#', _t('输入facebook链接'), _t('在这里输入facebook链接,带http://，在时光机页面显示,为空则不显示按钮'));
    $form->addInput($socialfacebook);
    //google+
    $socialgooglepluse = new Typecho_Widget_Helper_Form_Element_Text('socialgooglepluse', NULL,'#', _t('输入google+链接'), _t('在这里输入google+链接,带http://，在时光机页面显示,为空则不显示按钮'));
    $form->addInput($socialgooglepluse);

    //github
    $socialgithub = new Typecho_Widget_Helper_Form_Element_Text('socialgithub', NULL,'https://github.com/ihewro', _t('输入github链接'), _t('在这里输入github链接,带http://，在时光机页面显示,为空则不显示按钮'));
    $form->addInput($socialgithub);

    //email
    $socialemail = new Typecho_Widget_Helper_Form_Element_Text('socialemail', NULL,'ihewro@163.com', _t('输入email地址'), _t('在这里输入email地址，在时光机页面显示'));
    $form->addInput($socialemail);
    //QQ
    $socialqq = new Typecho_Widget_Helper_Form_Element_Text('socialqq', NULL,'#', _t('输入QQ号码'), _t('在这里输入QQ号码，在时光机页面显示'));
    $form->addInput($socialqq);
    //weibo
    $socialweibo = new Typecho_Widget_Helper_Form_Element_Text('socialweibo', NULL,'#', _t('输入微博ID'), _t('在这里输入微博名称，在时光机页面显示'));
    $form->addInput($socialweibo);
    //网易云音乐
    $socialmusic = new Typecho_Widget_Helper_Form_Element_Text('socialmusic', NULL,'#', _t('输入网易云音乐ID'), _t('在这里输入网易云音乐ID，在时光机页面显示'));
    $form->addInput($socialmusic);
    //时光机中关于我的内容
    $about = new Typecho_Widget_Helper_Form_Element_Textarea('about', NULL, '来自南部的一个小城市，个性不张扬，讨厌随波逐流。', _t('输入关于我的内容'), _t('输入关于我的内容，将会在时光机的关于我栏目中显示'));
    $form->addInput($about);

    //标题三：高级选项

    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('高级选项'), NULL));
    //首页标题后缀
    $titleintro = new Typecho_Widget_Helper_Form_Element_Text('titleintro', NULL, '首页标题后缀', _t('首页标题后缀'), _t('你的博客标题栏博客名称后面的副标题'));
    $form->addInput($titleintro);
    //首页文字：将会在首页博客名称下面和404.php页面调用此字段
    $Indexwords = new Typecho_Widget_Helper_Form_Element_Text('Indexwords', NULL, '迷失的人迷失了，相逢的人会再相逢', _t('首页一行文字介绍'), _t('输入你喜欢的一行文字吧，在首页博客名称下面显示'));
    $form->addInput($Indexwords);
    //favicon图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon 地址'), _t('填入博客 favicon 的地址, 不填则显示主机根目录下的favicon.ico文件'));
    $form->addInput($favicon);
    //博客公告消息
    $blogNotice = new Typecho_Widget_Helper_Form_Element_Textarea('blogNotice', NULL, NULL, _mt('博客公告消息'), _mt('显示在博客页面顶端的一条消息。'));
    $form->addInput($blogNotice);
    //时光机页面的头图
    $timepic = new Typecho_Widget_Helper_Form_Element_Text('timepic', NULL, 'https://ww4.sinaimg.cn/large/a15b4afegy1fcets6ivogj20p00ho45a', _t('时光机页面的头图'), _t("填写图片地址，在时光机页面cross.html独立页面的头图，图片大小切勿过大，控制在100K左右为佳。"));
    $form->addInput($timepic);
    // 文章缩略图数目设置
    $RandomPicAmnt = new Typecho_Widget_Helper_Form_Element_Text('RandomPicAmnt', NULL, _t('4'), _t('文章头图随机缩略图数量'), _t('对应于主题目录下的img/sj 文件夹中的图片的数量。说明：文章头图显示方式：<b>thumb（自定义字段）--> 文章第一张图片 --> 随机图片输出</b>。图片必须以从1开始的数字命名，而且必须是.jpg文件'));
    $form->addInput($RandomPicAmnt);
    // 右侧边栏缩略图数目设置
    $RandomPicAmnt2 = new Typecho_Widget_Helper_Form_Element_Text('RandomPicAmnt2', NULL, _t('15'), _t('右侧边栏随机缩略图数量'), _t('对应于主题目录下的img/sj2文件夹中的图片的数量。这里指的缩略图是<b>右侧边栏热门文章、随机文章的缩略图</b>'));
    $form->addInput($RandomPicAmnt2);
    //文章缩略图设置
    $RandomPicChoice = new Typecho_Widget_Helper_Form_Element_Radio('RandomPicChoice',
        array(
            '0' => _t('只显示随机图片'),
            '1' => _t('显示顺序：thumb自定义字段——文章第一张图片'),
            '2' => _t('显示顺序：thumb自定义字段——文章第一张图片——随机图片(推荐)')
        ),
        //Default choose
        '2',_t('博客头图设置'),_t('该头图设置对首页和文章页面同时生效。推荐选择第三个。<br><spanstyle="color: #f00">注意</span>：此项设置仅在全局设置开启头图后才生效')
    );
    $form->addInput($RandomPicChoice);



    //标题四：instantclick

    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('InstantClick'), NULL));
    //instantclick预加载模式
   $preload = new Typecho_Widget_Helper_Form_Element_Radio('preload',
        array(
            '0' => _t('mouseover &emsp;'),
            '1' => _t('mousedown &emsp;'),
            '2' => _t('on-mouseover-with-a-delay &emsp;')
        ),

        //Default choose
        '1',_t('instantclick预加载模式选择'),_t("<b>mouseover</b>:鼠标悬停在链接上，就开始预加载。<b>mousedown</b>:鼠标点击链接的同时才开始预加载。 <b>on-mouseover-with-a-delay</b>:鼠标悬停在链接上并有一定延迟时间才开始预加载，选中此项，必须设置下面的延迟时间项。")
    );
    $form->addInput($preload);
    //instantclick延迟时间设置
    $delaytime = new Typecho_Widget_Helper_Form_Element_Text('delaytime', NULL, '70', _t('instantclick延迟时间设置'), _t('只有当你instantclick选择<b>on-mouseover-with-a-delay</b>,才需要配置此项。默认70，官方推荐在50——100之间的整数。'));
    $form->addInput($delaytime);

    //回调函数
    $ChangeAction = new Typecho_Widget_Helper_Form_Element_Textarea('ChangeAction', NULL, NULL, _t('instantclick回调函数'), _t('本主题使用instantclick.js 技术，instantclick提供丰富的回调函数接口，方便在通过instantclick跳转页面时候再次调用函数，避免了由于instantclick导致的函数失效。最常用的是change函数，当页面跳转的同时就会触发该函数，在这里填入相应的事件以便回调（与pjax的send函数相似）。</br><span style="color: #f00">注意</span>：如果你没有修改主题源码，是不需要填写此项的。如果你不明白该项，建议不要填写。'));
    $form->addInput($ChangeAction);


    //标题五：主题增强功能



    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('主题增强功能'), NULL));
    //播放器音乐
    $musiclist = new Typecho_Widget_Helper_Form_Element_Textarea('musiclist', NULL,'{title:"晚安；）",artist:"性人盒",mp3:"xxxx.mp3"}', _t('音乐播放器的音乐列表'), _t('格式: {title:"xxx", artist:"xxx", mp3:"http:xxxx"} ，每个歌曲之间用英文逗号隔开。请保证歌曲列表里至少有一首歌！（在全站设置项启用播放器后才有效）<div style="background-color:#56A5CE;padding:5px 8px;max-width:250px;border-radius: 2px;"><a href="'.Helper::options()->themeUrl.'/libs/NetEaseCloudMusic.php" target="_blank" style="font-size:14px;color:#fff;outline:none;text-decoration:none;">网易云音乐id解析(主机需支持curl扩展)</a>
            </div>请自行去网易云音乐网页版获取音乐id(具体在每个音乐项目的网址最后会有个id)。<b>将解析出的音乐链接复制到上面歌曲列表里(注意检查每首歌曲之间是否用英文逗号隔开)</b>'));
    $form->addInput($musiclist);

    //音乐播放器是否自动播放
   $isautoplay = new Typecho_Widget_Helper_Form_Element_Radio('isautoplay',
        array(
            '0' => _t(' 不自动播放'),
            '1' => _t('自动播放')
        ),
        //Default choose
        '0',_t('音乐播放器播放设置'),_t("自动播放指打开页面会自动播放音乐（在全站设置项启用播放器后才有效）")
    );
    $form->addInput($isautoplay);
    //音乐播放器手机端是否隐藏
   $ismobilehide = new Typecho_Widget_Helper_Form_Element_Radio('ismobilehide',
        array(
            '0' => _t(' 隐藏'),
            '1' => _t('不隐藏')
        ),
        //Default choose
        '1',_t('音乐播放器手机端是否隐藏'),_t("默认不隐藏（在全站设置项启用播放器后才有效）")
    );
    $form->addInput($ismobilehide);
    //语言设置
    /*$langis = new Typecho_Widget_Helper_Form_Element_Radio('langis',
        array(
            '0' => _t('English <br />'),
            '1' => _t('简体中文 <br />'),
            '2' => _t('繁体中文 <br />')
        ),

        '1', _t('界面语言设置'), _t("默认使用简体中文语言")
    );
    $form->addInput($langis);*/
    $language = new Typecho_Widget_Helper_Form_Element_Select('language', I18n_Options::listLangs(), 'auto','界面语言', '默认为自动, 即根据浏览器设置自动选择语言。');
    $form->addInput($language->multiMode());


    //标题六：速度优化


    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('速度优化'), NULL));

    //七牛云镜像存储
    $srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('图片CDN替换前地址'), _t('即你的附件存放链接，一般为http://www.yourblog.com/usr/uploads/'));
    $form->addInput($srcAddress);

    $cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('图片CDN替换后地址'), _t('即你的七牛云存储域名，一般为http://yourblog.qiniudn.com/，可能也支持其他有镜像功能的CDN服务'));
    $form->addInput($cdnAddress);

    //dns 预加载
    $dnsPrefetch = new Typecho_Widget_Helper_Form_Element_Textarea('dnsPrefetch', NULL, NULL, _mt('DNS Prefetch'), _mt('DNS 预读取是一种使浏览器主动执行 DNS 解析已达到优化加载速度的功能。<br>你可以在这里设置需要预读取的域名，<bold>每行一个，仅填写域名即可。</bold><br>如：img.example.com'));
    $form->addInput($dnsPrefetch);


    //标题七：主题自定义扩展


    $form->addInput(new Title('appearanceTitle', NULL, NULL, _mt('主题自定义扩展'), NULL));
    //gravatar镜像源
    $CDNURL = new Typecho_Widget_Helper_Form_Element_Text('CDNURL', NULL, 'https://secure.gravatar.com', _t('gravatar镜像源地址'), _t("
    gravatar由于国内被墙，推荐使用https://secure.gravatar.com 或者https://cdn.v2ex.com/gravatar 镜像源。你可以使用你自己的镜像源(末尾不要加斜杠！！！)"));
    $form->addInput($CDNURL);
    //网站底部左侧信息
    $BottomleftInfo = new Typecho_Widget_Helper_Form_Element_Textarea('BottomleftInfo', NULL, NULL, _t('博客左侧底部信息'), _t('这里面填写的是html代码，位置是博客底部的左边。可以填写备案号等一些信息。注意：所有屏幕尺寸下都会显示该内容'));
    $form->addInput($BottomleftInfo);
    //网站底部右侧信息
    $BottomInfo = new Typecho_Widget_Helper_Form_Element_Textarea('BottomInfo', NULL, NULL, _t('博客底部右侧信息'), _t('这里面填写的是html代码，位置是博客底部的右边。可以填写备案号等一些信息。注意：屏幕尺寸小于767px，不会显示该内容'));
    $form->addInput($BottomInfo);
    //自定义css
    $customCss = new Typecho_Widget_Helper_Form_Element_Textarea('customCss', NULL, NULL, _t('自定义 CSS'), _t('在这里，你可以填写一些css代码来进行自定义样式，会自动输出到<code></head></code>标签之前'));
    $form->addInput($customCss);
    //自定义js
    $customJs = new Typecho_Widget_Helper_Form_Element_Textarea('customJs', NULL, NULL, _t('自定义 JS'), _t('在这里，你可以填写一些js代码，会自动输出到<code></body></code>标签之前'));
    $form->addInput($customJs);
    //网站统计代码
    $analysis = new Typecho_Widget_Helper_Form_Element_Textarea('analysis', NULL, NULL, _t('网站统计代码'), _t('填入第三方统计代码.<b>注意：</b>这里面填写的是js代码，<b>而无需"\<\script\>\"标签！！！！！</b></br><span style="color: #f00">提示：</span><span><b>推荐使用google analysis、百度统计</b>，由于ajax，CNZZ代码用户请使用样例代码的第一种，而且“统计代码”字样会随着页面加载消失，望了解。</span>(不推荐cnzz，因为cnzz代码使用document.wirte创建“站长统计”字样不安全，而且cnzz界面不好看~)'));
    $form->addInput($analysis);
}

// 首页文章缩略图

function showThumbnail($widget){

    // 当文章无图片时的默认缩略图
    $rand = rand(1,$widget->widget('Widget_Options')->RandomPicAmnt); // 随机 1-3 张缩略图

    $random = $widget->widget('Widget_Options')->themeUrl . '/img/sj/' . $rand . '.jpg'; // 随机缩略图路径
    //正则匹配 主题目录下的/images/sj/的图片（以数字按顺序命名）

    $cai = '';
    if (!empty($attachments)){
        $attach = $widget->attachments(1)->attachment;
    }else{
        $attach='';
    }
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';


    //return输出
    if ($widget->widget('Widget_Options')->RandomPicChoice =='0'){//只输出随机缩略图
        return $random;
    }else{//thumb->第一张图片->(随机缩略图)

        if(!empty($widget->fields->thumb)){//thumb字段已经填写了图片地址
            $ctu = $widget->fields->thumb;
        }else{//thumb值中没有图片地址

            if ($attach && $attach->isImage) {//调用第一个图片附件
                $ctu = $attach->url.$cai;
            }else if (preg_match_all($pattern, $widget->content, $thumbUrl)) {//下面是调用文章第一个图片
                $ctu = $thumbUrl[1][0].$cai;
            }else if (preg_match_all($patternMD, $widget->content, $thumbUrl)) {//如果是内联式markdown格式的图片
                $ctu = $thumbUrl[1][0].$cai;
            }else if (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {//如果是脚注式markdown格式的图片
                $ctu = $thumbUrl[1][0].$cai;
            }else {//如果文章中没有图片
                    $ctu = '';
            }

            if($ctu == '' && $widget->widget('Widget_Options')->RandomPicChoice =='2'){//文章中没有图片，选项二此时输出随机图片
                $ctu = $random;
            }
        }
        return $ctu;
    }
}


//输出文章缩略图
function echoPostThumbnail($obj){

    $options = Typecho_Widget::widget('Widget_Options');
    $placeholder = $obj->widget('Widget_Options')->themeUrl.'/img/white.gif';
    $output = '';

    if(!empty($options->indexsetup) && in_array('lazyloadimg', $options->indexsetup)){//开启图片延迟加载
        if($obj->is('index') || $obj->is('archive')){
            $output .= '<div id="index-post-img"><a href="'.$obj->permalink.'"><img data-original="'.showThumbnail($obj).'" src="'.$placeholder.'" class="img-full" /></a></div>';
        }else{
            $output .= '<div class="entry-thumbnail" aria-hidden="true"><img width="900" height="auto" data-original="'.showThumbnail($obj).'" src="'.$placeholder.'" class="img-responsive center-block wp-post-image" /></div>';
        }
    }else{//不开启图片延迟加载
        if($obj->is('index') || $obj->is('archive')){
            $output .= '<div id="index-post-img"><a href="'.$obj->permalink.'"><img src="'.showThumbnail($obj).'" class="img-full" /></a></div>';
        }else{
            $output .= '<div class="entry-thumbnail" aria-hidden="true"><img width="900" height="auto" src="'.showThumbnail($obj).'" class="img-responsive center-block wp-post-image" /></div>';
        }
    }

    echo $output;

}

//文章页面侧边栏缩略图
function showThumbnail2($widget)
{
    // 当文章无图片时的默认缩略图
    $rand = rand(1,$widget->widget('Widget_Options')->RandomPicAmnt2); // 随机 1-15 张缩略图

    $random = $widget->widget('Widget_Options')->themeUrl . '/img/sj2/' . $rand . '.jpg'; // 随机缩略图路径
    //正则匹配 主题目录下的/images/sj/的图片（以数字按顺序命名）

return $random;
}

/**
* 显示上一篇
*
* @access public
* @param string $default 如果没有上一篇,显示的默认文字
* @return void
*/
function theNext($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);
$content = $db->fetchRow($sql);

if ($content) {
$content = $widget->filter($content);
$link = '<li class="previous"> <a href="' . $content['permalink'] . '" title="' . $content['title'] . '" data-toggle="tooltip"> 上一篇 </a></li>
';
echo $link;
} else {
$link = '';
echo $link;
}
}

/**
* 显示下一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);
$content = $db->fetchRow($sql);

if ($content) {
$content = $widget->filter($content);
$link = '<li class="next"> <a href="' . $content['permalink'] . '" title="' . $content['title'] . '" data-toggle="tooltip"> 下一篇 </a></li>';
echo $link;
} else {
$link = '';
echo $link;
}
}

//热门文章（评论最多）
function theme_hot_posts($hot){
$days = 99999999999999;
$num = 5;
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->limit($num)
->order('commentsNum',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="list-group-item">
                <a href="' . $val['permalink'] . '" class="pull-left thumb-sm m-r">
                <img style="height: 40px!important;width: 40px!important;" src="'.showThumbnail2($hot).'" class="img-circle wp-post-image">
                </a>
                <div class="clear">
                    <h4 class="h5 l-h"> <a href="' . $val['permalink'] . '" title="' . $val['title'] . '"> ' . $val['title'] . ' </a></h4>
                    <small class="text-muted">
                    <span class="meta-views"> <i class="iconfont icon-comments" aria-hidden="true"></i> <span class="sr-only">评论数：</span> <span class="meta-value">'.$val['commentsNum'].'</span>
                    </span>
                    <span class="meta-date m-l-sm"> <i class="iconfont icon-eye" aria-hidden="true"></i> <span class="sr-only">浏览次数:</span> <span class="meta-value">'.$val['views'].'</span>
                    </span>
                    </small>
                    </div>
            </li>';
}
}

//随机显示文章
function theme_random_posts($random){
$defaults = array(
'number' => 5, //输出文章条数
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$db = Typecho_Db::get();

$sql = $db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->limit($defaults['number'])
->order('RAND()');

$result = $db->fetchAll($sql);
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="list-group-item">
                <a href="' . $val['permalink'] . '" class="pull-left thumb-sm m-r">
                <img style="height: 40px!important;width: 40px!important;" src="'.showThumbnail2($random).'" class="img-circle wp-post-image">
                </a>
                <div class="clear">
                    <h4 class="h5 l-h"> <a href="' . $val['permalink'] . '" title="' . $val['title'] . '"> ' . $val['title'] . ' </a></h4>
                    <small class="text-muted">
                    <span class="meta-views"> <i class="iconfont icon-comments" aria-hidden="true"></i> <span class="sr-only">评论数：</span> <span class="meta-value">'.$val['commentsNum'].'</span>
                    </span>
                    <span class="meta-date m-l-sm"> <i class="iconfont icon-eye" aria-hidden="true"></i> <span class="sr-only">浏览次数:</span> <span class="meta-value">'.$val['views'].'</span>
                    </span>
                    </small>
                    </div>
            </li>';
}
}

//获取评论的锚点链接
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
                                 ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        echo $href;
    } else {
        echo '';
    }

}

//文章阅读次数含cookie
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}


//获得读者墙
function getFriendWall()
{   $options = Typecho_Widget::widget('Widget_Options');
    $db = Typecho_Db::get();
    $sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')
              ->from('table.comments')
              ->where('status = ?', 'approved')
              ->where('type = ?', 'comment')
              ->where('authorId = ?', '0')
              ->where('mail != ?', $options->socialemail)   //排除自己上墙
              ->group('author')
              ->order('cnt', Typecho_Db::SORT_DESC)
              ->limit('15');    //读取几位用户的信息
    $result = $db->fetchAll($sql);
    $mostactive = "";
    if (count($result) > 0) {
        $maxNum = $result[0]['cnt'];
        foreach ($result as $value) {
            $mostactive .= '<li><a target="_blank" rel="nofollow" href="' . $value['url'] . '"><span class="pic" style="background: url(https://secure.gravatar.com/avatar/'.md5(strtolower($value['mail'])).'?s=36&d=&r=G) no-repeat;background-size: 36px;"></span><em>' . $value['author'] . '</em><strong>+' . $value['cnt'] . '</strong><br />' . $value['url'] . '</a></li>';
        }
        echo $mostactive;
    }
}

//重新输出文章内容
function parseContent($obj){

    $options = Typecho_Widget::widget('Widget_Options');
    if(!empty($options->src_add) && !empty($options->cdn_add)){
        $obj->content = str_ireplace($options->src_add,$options->cdn_add,$obj->content);
    }//七牛镜像加速
    $obj->content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $obj->content);//文章中的链接，以新链接方式打开
    echo trim($obj->content);
}

function themeFields(Typecho_Widget_Helper_Layout $layout) {

    /*$thumb = new Typecho_Widget_Helper_Form_Element_Textarea('banner', NULL, NULL, _t('Banner'), _t('输入图片URL，如有多个则一行一个，随机选择展示。'));
    $layout->addItem($thumb);
    $thumb = new Typecho_Widget_Helper_Form_Element_Select('TOC', array('0'=>_mt('不启用'), '1'=>_mt('开启(默认隐藏)'), '3'=>_mt('始终显示(限当前页)')), NULL, _t('显示文章目录树'), NULL);
    $layout->addItem($thumb);
    //$layout->addItem(new Title('documentTitle', NULL, NULL, '', _mt('其他自定义字段使用提示(区分大小写)：').'<br>'.Utils::toCode('bannerHeight').','.Utils::toCode('headTitle').','.Utils::toCode('mastheadTitle').','.Utils::toCode('mastheadSubtitle').','.Utils::toCode('mastheadTitleColor').','.Utils::toCode('textAlign').','.Utils::toCode('contentWidth').','.Utils::toCode('css').','.Utils::toCode('js').'.<br><br>'._mt('相关用法请查看<a href="https://hran.me/archives/mirages-custom-fields.html" target="_blank">主题自定义字段使用帮助</a><br><br>使用时请点击左下角的「+添加字段」，然后在字段名称处键入上述可选值，类型为字符，在字段值处按字段要求键入相应的值即可。')));*/
}
