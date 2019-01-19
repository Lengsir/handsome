<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    $options = Typecho_Widget::widget('Widget_Options');
    define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/'));

?>
<!DOCTYPE HTML>
<html class="no-js" lang="<?php _me("zh-cmn-Hans") ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta charset="<?php $this->options->charset(); ?>">
<!--IE 8浏览器的页面渲染方式-->
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<!--默认使用极速内核：针对国内浏览器产商-->
<meta name="renderer" content="webkit">
<!--针对移动端的界面优化-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--chrome Android 地址栏颜色-->
<?php if($this->options->ChromeThemeColor): ?>
<meta name="theme-color" content="<?php $this->options->ChromeThemeColor() ?>" />
<?php endif; ?>
<?php echo Content::exportDNSPrefetch(); ?>
<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')) : ?> - <?php $this->options->titleintro() ?><?php endif; ?>
</title>
<?php $this->header(); ?>
<?php if($this->options->favicon): ?>
<link rel="icon" type="image/ico" href="<?php $this->options->favicon() ?>">
<?php endif; ?>


<!-- 第三方CDN加载CSS -->
<link href="//bootcdn.lenget.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="//bootcdn.lenget.com/jquery/2.1.4/jquery.min.js" data-no-instant></script>
<!-- 本地develope版本 -->
<!--
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/animate.css') ?>" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('css/iconfont.css') ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/font.css') ?>" type="text/css" />
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/OwO.min.css') ?>" type="text/css" />
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/app.css') ?>" type="text/css" />-->



    <!-- 本地compass版本 -->
  <link rel="stylesheet" href="<?= THEME_URL ?>/css/appall.min.css" type="text/css" />
  <script src="<?= THEME_URL ?>/js/OwO.min.js"></script>

  <link href="//bootcdn.lenget.com/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">



<style type="text/css">
<?php if ( $this->options->ismobilehide =='0' && in_array('musicplayer', $this->options->indexsetup) ) : ?>
@media only screen and (max-width:766px){.ymusic{display:none}}
<?php else: ?>
<?php endif; ?>
<?php if($this->options->progresscolor) : ?>
  #instantclick-bar {
    background: <?php $this->options->progresscolor() ?>!important;
  }
<?php endif; ?>
  html.bg{
  <?php echo Content::exportBackground(); ?>
  }
  <?php $this->options->customCss() ?>/*自定义css代码输出位置*/
</style>

  <!--网站统计代码-->
<script data-no-instant type="text/javascript">
<?php $this->options->analysis(); ?>
</script>

</head>
<?php if($this->options->BGopacity): ?>
<style type="text/css">
  #body{
    opacity: <?php $this->options->BGopacity() ?>;
  }
</style>
<?php endif; ?>
<body id="body">
<div id="alllayout" class="app">
<script type="text/javascript">
  <?php if (!empty($this->options->indexsetup) && in_array('aside-fix', $this->options->indexsetup)): ?>
    $('#alllayout').addClass("app-aside-fixed");
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('aside-folded', $this->options->indexsetup)): ?>
    $('#alllayout').addClass("app-aside-folded");
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('aside-dock', $this->options->indexsetup)): ?>
    $('#alllayout').addClass("app-aside-dock");
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('container-box', $this->options->indexsetup)): ?>
  $('html').addClass("bg");
  $('#alllayout').addClass("container");
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('header-fix', $this->options->indexsetup)): ?>
  $('#alllayout').addClass("app-header-fixed");
<?php endif; ?>
</script>
    <!-- header -->
<?php $this->need('component/headnav.php'); ?>
  <!-- / header -->
