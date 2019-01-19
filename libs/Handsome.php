<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * handsome.php
 * Author     : hewro
 * Date       : 2017/04/23
 * Version    : 1.0.0
 * Description: check to getting lastest version
 */

class Handsome{
	//$randomColor = array();
	//$themes = Typecho_Widget::widget('Widget_Themes_List');
	//$themes[0]->version();
	//echo "版本为".current($themes)->version();
	public static $version = "2.2.1";
	static public  function SettingsWelcome(){
		return self::useIntro() . self::checkupdatejs();
	}

	static public function getBackgroundColor(){
		$colors = array(
			array('#673AB7', '#512DA8'),
			array('#20af42', '#1a9c39'),
			array('#336666', '#2d4e4e'),
			array('#2e3344', '#232735')
		);
		$randomKey = array_rand($colors, 1);
		$randomColor = $colors[$randomKey];
		return $randomColor;
	}
    static function checkupdatejs(){
		$current_version = self::$version;
        /* php解析api，导致速度过慢！
        $url = "https://api.github.com/repos/ihewro/typecho-theme-handsome/releases/latest";
        $res=json_decode(file_get_contents($url),true); //读取api得到json
        //$res = $res['collections'];
        $new_version_available = false;
        $latest_version = $res["tag_name"];
        $update_link = $res["html_url"];
        if(!empty($current_version)){
            $current_version2 = explode('.', $current_version);
            $latest_version2 = explode('.', $latest_version);
            $len = count($current_version2) > count($latest_version2) ? count($current_version2) : count($latest_version2);
            for($i = 0; $i < $len; $i++){
                $n1 = $current_version2[$i];
                $n2 = $latest_version2[$i];
                if($n1 < $n2){
                    $new_version_available = true;
                    break;
                }else if($n1 > $n2){
                    $new_version_available = false;
                    break;
                }else{
                    continue;
                }
            }
        }
        if($new_version_available == true){
            return <<<EOF
<script>
var message = "[新版本 {$latest_version} 已可用, 前往github获取最新版本:-D]";
            var color = "#1abc9c";
            $("#update_notification").css("color",color).html(message);
            $("#update_link").attr("href","{$update_link}");
</script>          
EOF;
        }else{
            return <<<EOF
<script>
$("#update_notification").css("color","#1abc9c").html("[当前已为最新版]");
</script>
EOF;
        }*/

    return <<<EOF
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js" type="text/javascript"></script>
<script>
var VersionCompare = function (currVer, promoteVer) {
    currVer = currVer || "0.0.0";
    promoteVer = promoteVer || "0.0.0";
    if (currVer == promoteVer) return false;
    var currVerArr = currVer.split(".");
    var promoteVerArr = promoteVer.split(".");
    var len = Math.max(currVerArr.length, promoteVerArr.length);
    for (var i = 0; i < len; i++) {
        var proVal = ~~promoteVerArr[i],
            curVal = ~~currVerArr[i];
        if (proVal < curVal) {
            return false;
        } else if (proVal > curVal) {
            return true;
        }
    }
    return false;
};
    (function($){
    $.getJSON("https://api.github.com/repos/ihewro/typecho-theme-handsome/releases/latest",
    function(data){
            if(VersionCompare("$current_version", data.tag_name)){        //有更新版本更新
                var message = "[新版本" +  data.tag_name + "已可用, 前往github获取最新版本:-D]";
                var color = "#1abc9c";
                $("#update_notification").css("color",color).html(message);
                $("#update_link").attr("href","data.html_url");
                //alert(data.tag_name);
            }else{
                $("#update_notification").css("color","#1abc9c").html("[当前已为最新版]");
            }
    })
})(jQuery)
</script>
EOF;
    }
	static function useIntro(){
		$version = self::$version;
		$randomColor = self::getBackgroundColor();
		return <<<EOF
<p style="font-size:14px;" id="use-intro">
    <span style="display: block;
    margin-bottom: 10px;
    margin-top: 10px;
    font-size: 16px;">感谢您使用 handsome主题&emsp; </span>
    <span style="margin-bottom:10px;display:block"> 如果您喜欢handsome主题，<a href="https://github.com/ihewro/typecho-theme-handsome/stargazers" style="color: rgb(255, 255, 255); background: {$randomColor[0]};">给该项目star一下吧</a>，是我不断更新的动力哦！</span>

    <span style="margin-bottom:10px;display:block">当前版本：{$version}  <a id="update_link" href="https://github.com/ihewro/typecho-theme-handsome" target="_blank"><span id="update_notification"></span></a></span>

    <span style="margin-bottom:10px;display:block">
    <a href="https://www.ihewro.com/archives/489/" >帮助&支持</a> &nbsp;
    <a href="https://github.com/ihewro/typecho-theme-handsome/issues" target="_blank">建议&反馈</a>&nbsp;
    <a href="https://handsome.ihewro.com/#/copyright" target="_blank">版权&声明</a>
    </span>
    </p>
EOF;
	}

    static function styleoutput(){
		$randomColor = self::getBackgroundColor();
		//$randomColor[0] = "#fff";
        return <<<EOF
<style>
/*后台外观全局控制*/
@media screen and (min-device-width: 1024px) {
    ::-webkit-scrollbar-track {
        background-color: rgba(255,255,255,0);
    }
    ::-webkit-scrollbar {
        width: 6px;
        background-color: rgba(255,255,255,0);
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 3px;
        background-color: rgba(193,193,193,1);
    }
}
.row {
    margin: 0px;
}
#use-intro {
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px;
    padding: 8px;
    padding-left: 20px;
    margin-bottom: 40px;
}
.message{
    background-color:{$randomColor[0]} !important;
    color:#fff;
}
.success{
    background-color:{$randomColor[0]};
    color:#fff;
}

#typecho-nav-list{display:none;}
.typecho-head-nav {
    padding: 0 10px;
    background: {$randomColor[0]};
}
.typecho-head-nav .operate a{
    border: none;
    padding-top: 0px;
    padding-bottom: 0px;
    color: rgba(255,255,255,.6);
}
.typecho-head-nav .operate a:hover {
    background-color: rgba(0, 0, 0, 0.05);
    color: #fff;
}
ul.typecho-option-tabs.fix-tabs.clearfix {
    background: {$randomColor[1]};
}
.col-mb-12 {
    padding: 0px!important;
}
.typecho-page-title {
    margin:0;
    height: 70px;
    background: {$randomColor[0]};
    background-size: cover;
    padding: 30px;
}
.typecho-page-title h2{
    margin: 0px;
    font-size: 2.28571em;
    color: #fff;
}
.typecho-option-tabs{
    padding: 0px;
    background: #fff;
}
.typecho-option-tabs a:hover{
    background-color: rgba(0, 0, 0, 0.05);
    color: rgba(255,255,255,.8);
}
.typecho-option-tabs a{
    border: none;
    height: auto;
    color: rgba(255,255,255,.6);
    padding: 15px;
}
li.current {
    background-color: #FFF;
    height: 4px;
    padding: 0 !important;
    bottom: 0px;
}
.typecho-option-tabs li.current a, .typecho-option-tabs li.active a{
    background:none;
}
.container{
    margin:0;
    padding:0;
}
.body.container {
    min-width: 100% !important;
    padding: 0px;
}
.typecho-option-tabs{
    margin:0;
}
.typecho-option-submit button {
    float: right;
    background: #00BCD4;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    color: #FFF;
}
.typecho-option-tabs li{
    margin-left:20px;
}
.typecho-option{
    border-radius: 3px;
    background: #fff;
    padding: 12px 16px;
}
.col-mb-12{
    padding-left: 0px!important;
}
.typecho-option-submit{
    background:none!important;
}
.typecho-option {
    float: left;
}
.typecho-option span {
    margin-right: 0;
}
.typecho-option label.typecho-label {
    font-weight: 500;
    margin-bottom: 20px;
    margin-top: 10px;
    font-size: 16px;
    padding-bottom: 5px;
    border-bottom: 1px solid rgba(0,0,0,0.2);
}
.typecho-page-main .typecho-option input.text {
    width: 100%;
}
input[type=text], textarea {
    border: none;
    border-bottom: 1px solid rgba(0,0,0,.60);
    outline: none;
    border-radius: 0;
}
.typecho-option-submit {
    position: fixed;
    right: 32px;
    bottom: 32px;
}
.typecho-foot {
    padding: 16px 40px;
    color: rgb(158, 158, 158);
    background-color: rgb(66, 66, 66);
    margin-top: 80px;
}
@media screen and (max-width: 480px){
.typecho-option {
    width: 94% !important;
    margin-bottom: 20px !important;
}
}
/*大标题样式控制*/
label.typecho-label.settings-title{
	font-size: 30px;
    font-weight: bold;
    border: none;
}
#typecho-option-item-appearanceTitle-0, #typecho-option-item-appearanceTitle-7, #typecho-option-item-appearanceTitle-9, #typecho-option-item-appearanceTitle-23, #typecho-option-item-appearanceTitle-32,#typecho-option-item-appearanceTitle-36, #typecho-option-item-appearanceTitle-41,#typecho-option-item-appearanceTitle-45{
	float: inherit;
    margin-bottom: 0px;
	box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 94%;
	display: table;
}


/*组件大小为94%*/
#typecho-option-item-timepic-28, #typecho-option-item-RandomPicChoice-31, #typecho-option-item-ChangeAction-35,#typecho-option-item-musiclist-37, #typecho-option-item-language-40,#typecho-option-item-dnsPrefetch-44, #typecho-option-item-CDNURL-46, #typecho-option-item-analysis-51{
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 94%;
	margin-bottom:20px;
}

/*组件大小为60%*/
#typecho-option-item-about-22,#typecho-option-item-preload-33{
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 60%;
}

/*组件大小为44%*/
#typecho-option-item-BGtype-3, #typecho-option-item-BGopacity-4, #typecho-option-item-bgcolor-5, #typecho-option-item-GradientType-6,#typecho-option-item-progresscolor-7, #typecho-option-item-ChromeThemeColor-8, #typecho-option-item-IndexName-10, #typecho-option-item-BlogName-11, #typecho-option-item-BlogPic-12, #typecho-option-item-BlogJob-13, #typecho-option-item-socialtwitter-14, #typecho-option-item-socialfacebook-15, #typecho-option-item-socialgooglepluse-16, #typecho-option-item-socialgithub-17,#typecho-option-item-titleintro-24,#typecho-option-item-Indexwords-25,#typecho-option-item-favicon-26,#typecho-option-item-blogNotice-27,#typecho-option-item-RandomPicAmnt-29,#typecho-option-item-RandomPicAmnt2-30,#typecho-option-item-isautoplay-38,#typecho-option-item-ismobilehide-39,#typecho-option-item-src_add-42,#typecho-option-item-cdn_add-43,#typecho-option-item-BottomleftInfo-47,#typecho-option-item-BottomInfo-48,#typecho-option-item-customCss-49,#typecho-option-item-customJs-50{
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 44%;
    margin-bottom: 30px;
}

/*组件大小为27%*/
#typecho-option-item-socialemail-18, #typecho-option-item-socialqq-19, #typecho-option-item-socialweibo-20,#typecho-option-item-socialmusic-21, #typecho-option-item-delaytime-34{
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 27.333%;
    margin-bottom: 40px;
}

/*某些组件特殊控制样式*/
#typecho-option-item-indexsetup-1 {
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 29%;
}
#typecho-option-item-themetype-2 {
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    background-color: #fff;
    margin: 8px 1%;
    padding: 8px 2%;
    width: 59%;
	margin-bottom: 80px;
}
#typecho-option-item-BGtype-3 {
    margin-bottom: 0px;
}
#typecho-option-item-bgcolor-5 {
    margin-bottom: 20px;
}
#typecho-option-item-BlogJob-13 {
    margin-bottom: 55px;
}
</style>
EOF;
    }
}
