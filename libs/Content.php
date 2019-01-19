<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * Content.php
 * Author     : hewro
 * Date       : 2017/05/08
 * Version    : 1.0.0
 * Description: 封装可重复利用的模块
 */

class Content{

    public static function exportPostPageTop($archive, $WebUrl){
        $html = "";
            $html .= '
            <ol class="breadcrumb bg-white b-a" itemscope="">
             <li>
                 <a href="'.$WebUrl.'" itemprop="breadcrumb" title="'._mt("返回首页").'" data-toggle="tooltip"><i class="iconfont icon-home" aria-hidden="true"></i>&nbsp;'._mt("首页").'</a>
             </li>';
             if ($archive->is('page')) {
                 $html .= '<li class="active">'.$archive->title.'&nbsp;&nbsp;</li>';
             }else{
                 $html .= '<li class="active">'._mt("正文").'&nbsp;&nbsp;</li>';
             }
             $html .= '
              <div style="float:right;">
   '._mt("分享到").'：
   <style>
   i.iconfont.icon-qzone:after {
    padding: 0 0px 0 5px;
    color: #ccc;
    content: "/\00a0";
    }
   </style>
   <a href="http://connect.qq.com/widget/shareqq/index.html?url='.$archive->permalink.'&title='.$archive->title.'&site='.$WebUrl.'" itemprop="breadcrumb" target="_blank" title="" data-toggle="tooltip" data-original-title="'._mt("分享到QQ空间").'"><i style ="font-size:15px;" class="iconfont icon-qzone" aria-hidden="true"></i></a>
   <a href="http://service.weibo.com/share/share.php?url='.$archive->permalink.'&title='.$archive->title.'" target="_blank" itemprop="breadcrumb" title="" data-toggle="tooltip" data-original-title="'._mt("分享到微博").'"><i style ="font-size:15px;" class="iconfont icon-weibo" aria-hidden="true"></i></a>
  </div>
            </ol>
             ';
        return $html;
    }

    public static function exportPostPageHeader($archive, $isLogin){
        $html = "";
        $html .=  '
        <header class="bg-light lter b-b wrapper-md">
             <h1 class="entry-title m-n font-thin h3 text-black l-h">'.$archive->title;
             if ($isLogin) {
                 $html .= '
                 <a class="superscript" href="'.Helper::options()->adminUrl.'write-page.php?cid='.$archive->cid.'" target="_blank"><i class="iconfont icon-pencilsquareo" aria-hidden="true"></i></a>
                 ';
             }
             if ($archive ->is("page")) {
                 $html .= '</h1></header>';
             }else {
                 $html .= '</h1>';//此时不用封闭header标签
             }
             return $html;
    }

    public static function exportDNSPrefetch() {
        $defaultDomain = array(
            "cdn.bootcss.com",
        );
        $customDomain = mget()->dnsPrefetch;
        if (!empty($customDomain)) {
            $customDomain = mb_split("\n", $customDomain);
            $defaultDomain = array_merge($defaultDomain, $customDomain);
            $defaultDomain = array_unique($defaultDomain);
        }
        $html = "<meta http-equiv=\"x-dns-prefetch-control\" content=\"on\">\n";
        foreach ($defaultDomain as $domain) {
            $domain = trim($domain, " \t\n\r\0\x0B/");
            if (!empty($domain)) {
                $html .= "<link rel=\"dns-prefetch\" href=\"//{$domain}\" />\n";
            }
        }
        return $html;
    }

    public static function selectAsideStyle(){
        $html = "";
        $options = mget();
        switch($options->themetype){
            case 0: $html .= '<aside id="aside" class="app-aside hidden-xs bg-black">';break;
            case 1: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 2: $html .= '<aside id="aside" class="app-aside hidden-xs bg-black">';break;
            case 3: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 4: $html .= '<aside id="aside" class="app-aside hidden-xs bg-black">';break;
            case 5: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 6: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 7: $html .= '<aside id="aside" class="app-aside hidden-xs bg-white b-r">';break;
            case 8: $html .= '<aside id="aside" class="app-aside hidden-xs bg-light">';break;
            case 9: $html .= '<aside id="aside" class="app-aside hidden-xs bg-light dker b-r">';break;
            case 10: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 11: $html .= '<aside id="aside" class="app-aside hidden-xs bg-black">';break;
            case 12: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;
            case 13: $html .= '<aside id="aside" class="app-aside hidden-xs bg-dark">';break;

        }
        return $html;
    }

    public static function exportBackground(){
        $html = "";
        $options = mget();
        if ($options->BGtype == 0) {
            $html .= 'background: '.$options->bgcolor.'';
        }elseif ($options->BGtype == 1) {
            $html .= 'background: url('.$options->bgcolor.') fixed;background-size: cover';
        }elseif ($options->BGtype == 2) {
            switch ($options->GradientType) {
                case 0: $html .= <<<EOF
            background-image:
                           -moz-radial-gradient(0% 100%, ellipse cover, #96DEDA 10%,rgba(255,255,227,0) 40%),
                           -moz-linear-gradient(-45deg,  #1fddff 0%,#FFEDBC 100%)
                           ;
            background-image:
                           -o-radial-gradient(0% 100%, ellipse cover, #96DEDA 10%,rgba(255,255,227,0) 40%),
                           -o-linear-gradient(-45deg,  #1fddff 0%,#FFEDBC 100%)
                           ;
            background-image:
                           -ms-radial-gradient(0% 100%, ellipse cover, #96DEDA 10%,rgba(255,255,227,0) 40%),
                           -ms-linear-gradient(-45deg,  #1fddff 0%,#FFEDBC 100%)
                           ;
            background-image:
                           -webkit-radial-gradient(0% 100%, ellipse cover, #96DEDA    10%,rgba(255,255,227,0) 40%),
                           -webkit-linear-gradient(-45deg,  #1fddff 0%,#FFEDBC 100%)
                           ;
EOF; 
break;
                
                case 1: $html .= <<<EOF
           background-image:
               -moz-radial-gradient(-20% 140%, ellipse ,  rgba(255,144,187,.6) 30%,rgba(255,255,227,0) 50%),
               -moz-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%),
               -moz-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -moz-linear-gradient(-45deg,  rgba(18,101,101,.8) -10%,#d9e3e5 80% )
               ;
           background-image:
               -o-radial-gradient(-20% 140%, ellipse ,  rgba(255,144,187,.6) 30%,rgba(255,255,227,0) 50%),
               -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%),
               -o-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -o-linear-gradient(-45deg,  rgba(18,101,101,.8) -10%,#d9e3e5 80% )
               ;
           background-image:
               -ms-radial-gradient(-20% 140%, ellipse ,  rgba(255,144,187,.6) 30%,rgba(255,255,227,0) 50%),
               -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%),
               -ms-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -ms-linear-gradient(-45deg,  rgba(18,101,101,.8) -10%,#d9e3e5 80% )
               ;
           background-image:
               -webkit-radial-gradient(-20% 140%, ellipse ,  rgba(255,144,187,.6) 30%,rgba(255,255,227,0) 50%),
               -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%),
               -webkit-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -webkit-linear-gradient(-45deg,  rgba(18,101,101,.8) -10%,#d9e3e5 80% )
               ;
EOF;
break;
                case 2: $html .= <<<EOF
           background-image:
               -moz-radial-gradient(-20% 140%, ellipse ,  rgba(235,167,171,.6) 30%,rgba(255,255,227,0) 50%),
               -moz-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -moz-linear-gradient(-45deg,  rgba(62,70,92,.8) -10%,rgba(220,230,200,.8) 80% )
               ;
           background-image:
               -o-radial-gradient(-20% 140%, ellipse ,  rgba(235,167,171,.6) 30%,rgba(255,255,227,0) 50%),
               -o-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -o-linear-gradient(-45deg,  rgba(62,70,92,.8) -10%,rgba(220,230,200,.8) 80% )
               ;
           background-image:
               -ms-radial-gradient(-20% 140%, ellipse ,  rgba(235,167,171,.6) 30%,rgba(255,255,227,0) 50%),
               -ms-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -ms-linear-gradient(-45deg,  rgba(62,70,92,.8) -10%,rgba(220,230,200,.8) 80% )
               ;
           background-image:
               -webkit-radial-gradient(-20% 140%, ellipse ,  rgba(235,167,171,.6) 30%,rgba(255,255,227,0) 50%),
               -webkit-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -webkit-linear-gradient(-45deg,  rgba(62,70,92,.8) -10%,rgba(220,230,200,.8) 80% )
               ;
EOF;
break;
                case 3: $html .= <<<EOF
           background-image:
               -moz-radial-gradient(-20% 140%, ellipse ,  rgba(143,192,193,.6) 30%,rgba(255,255,227,0) 50%),
               -moz-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -moz-linear-gradient(-45deg,  rgba(143,181,158,.8) -10%,rgba(213,232,211,.8) 80% )
           ;
           background-image:
               -o-radial-gradient(-20% 140%, ellipse ,  rgba(143,192,193,.6) 30%,rgba(255,255,227,0) 50%),
               -o-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -o-linear-gradient(-45deg,  rgba(143,181,158,.8) -10%,rgba(213,232,211,.8) 80% )
           ;
           background-image:
               -ms-radial-gradient(-20% 140%, ellipse ,  rgba(143,192,193,.6) 30%,rgba(255,255,227,0) 50%),
               -ms-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -ms-linear-gradient(-45deg,  rgba(143,181,158,.8) -10%,rgba(213,232,211,.8) 80% )
           ;
           background-image:
               -webkit-radial-gradient(-20% 140%, ellipse ,  rgba(143,192,193,.6) 30%,rgba(255,255,227,0) 50%),
               -webkit-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -webkit-linear-gradient(-45deg,  rgba(143,181,158,.8) -10%,rgba(213,232,211,.8) 80% )
               ;
EOF;
break;
                case 4: $html .= <<<EOF
           background-image:
               -moz-radial-gradient(-20% 140%, ellipse ,  rgba(214,195,224,.6) 30%,rgba(255,255,227,0) 50%),
               -moz-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -moz-linear-gradient(-45deg, rgba(97,102,158,.8) -10%,rgba(237,187,204,.8) 80% )
               ;
           background-image:
               -o-radial-gradient(-20% 140%, ellipse ,  rgba(214,195,224,.6) 30%,rgba(255,255,227,0) 50%),
               -o-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -o-linear-gradient(-45deg, rgba(97,102,158,.8) -10%,rgba(237,187,204,.8) 80% )
               ;
           background-image:
               -ms-radial-gradient(-20% 140%, ellipse ,  rgba(214,195,224,.6) 30%,rgba(255,255,227,0) 50%),
               -ms-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -ms-linear-gradient(-45deg, rgba(97,102,158,.8) -10%,rgba(237,187,204,.8) 80% )
               ;
           background-image:
               -webkit-radial-gradient(-20% 140%, ellipse ,  rgba(214,195,224,.6) 30%,rgba(255,255,227,0) 50%),
               -webkit-radial-gradient(60% 40%,ellipse,   #d9e3e5 10%,rgba(44,70,76,.0) 60%),
               -webkit-linear-gradient(-45deg, rgba(97,102,158,.8) -10%,rgba(237,187,204,.8) 80% )
               ;
EOF;
break;
                case 5: $html .= <<<EOF
           background-image: #DAD299; /* fallback for old browsers */
           background-image: -webkit-linear-gradient(to left, #DAD299 , #B0DAB9); /* Chrome 10-25, Safari 5.1-6 */
           background-image: linear-gradient(to left, #DAD299 , #B0DAB9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
EOF;
break;
                case 6: $html .= <<<EOF
           background-image: linear-gradient(-20deg, #d0b782 20%, #a0cecf 80%);
EOF;
break;
                case 7: $html .= <<<EOF
           background: #F1F2B5; /* fallback for old browsers */
           background: -webkit-linear-gradient(to left, #F1F2B5 , #135058); /* Chrome 10-25, Safari 5.1-6 */
           background: linear-gradient(to left, #F1F2B5 , #135058); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ *
EOF;
break;
                case 8: $html .= <<<EOF
           background: #02AAB0; /* fallback for old browsers */
           background: -webkit-linear-gradient(to left, #02AAB0 , #00CDAC); /* Chrome 10-25, Safari 5.1-6 */
           background: linear-gradient(to left, #02AAB0 , #00CDAC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
EOF;
break;
                case 9: $html .= <<<EOF
           background: #C9FFBF; /* fallback for old browsers */
           background: -webkit-linear-gradient(to left, #C9FFBF , #FFAFBD); /* Chrome 10-25, Safari 5.1-6 */
           background: linear-gradient(to left, #C9FFBF , #FFAFBD); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
EOF;
break;
            }
        }
        return $html;
    }
}
