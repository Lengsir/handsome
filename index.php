<?php
/**
 * 夜深忽梦少年事，梦啼妆泪红阑干
 *
 * @package handsome
 * @author 友人C
 * @version 2.2.0
 * @link https://github.com/ihewro/typecho-theme-handsome/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('component/header.php');
 ?>

  <!-- aside -->
  <?php $this->need('component/aside.php'); ?>
  <!-- / aside -->

    <!-- content -->
<div id="content" class="app-content">
  <div class="butterbar hide">
    <span class="bar"></span>
  </div>
  <a class="off-screen-toggle hide"></a>
  <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
      <div class="col">
          <!--公告位置-->
          <?php if($this->options->blogNotice): ?>
          <div class="alert alert-warning alert-block" style="
              margin-bottom: 0px;">
              <button type="button" class="close" data-dismiss="alert">×</button><p><?php $this->options->blogNotice(); ?></p>
          </div>
          <?php endif; ?>
        <header class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3 text-black l-h"><?php $this->options->IndexName(); ?></h1>
          <small class="text-muted"><?php $this->options->Indexwords(); ?></small>
          </header>
        <div class="wrapper-md">
            <!--首页输出文章-->
      <div class="blog-post">
      <?php while($this->next()): ?>
        <div class="panel">
         <!--首页文章页面头图-->
         <?php if((!empty($this->options->indexsetup) && in_array('NoRandomPic-index', $this->options->indexsetup)) || $this->fields->thumb == "no"): ?>
        <?php else: ?>
         <?php echoPostThumbnail($this); ?>
         <?php endif; ?>
          <!--首页文章内容-->
          <div class="wrapper-lg">

            <h2 class="m-t-none"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
         <?php if (!empty($this->options->indexsetup) && in_array('NoSummary-index', $this->options->indexsetup)): ?>
        <?php else: ?>
            <p class="summary">
            <?php $this->excerpt(200, '...'); //200就是摘要的字数，...是后缀; ?>
            </p>
        <?php endif; ?>
            <div class="line line-lg b-b b-light"></div>
            <div class="text-muted">
              <i class="iconfont icon-user1 text-muted"></i> <a href="<?php $this->author->permalink(); ?>" class="m-r-sm"><?php $this->author(); ?> </a>
              <i class="iconfont icon-clocko text-muted"></i>&nbsp;<?php $this->date(I18n::dateFormat()); ?>
              <a href="<?php $this->permalink() ?>#comments" class="m-l-sm"><i class="iconfont icon-comments text-muted"></i>&nbsp;<?php $this->commentsNum(_mt('暂无评论'), _mt('1 条评论'), _mt('%d 条评论')); ?></a>
            </div>
          </div>
        </div>
     <?php endwhile; ?>

      </div>

          <!--分页首页按钮-->
          <nav class="text-center m-t-lg m-b-lg" role="navigation">
        <?php $this->pageNav('&laquo;', '&raquo;'); ?>
          </nav>
          <script type="text/javascript">
$(".page-navigator").addClass("pagination pagination-md");
$(".page-navigator .current").addClass("active");
          </script>
        </div>
      </div>
      <!--首页右侧栏-->
      <?php $this->need('component/sidebar.php') ?>
    </div>
  </main>
</div>
    <!-- /content -->

    <!-- footer -->
  <?php $this->need('component/footer.php'); ?>
    <!-- / footer -->
