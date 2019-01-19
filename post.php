<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('component/header.php'); ?>
	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

  	<!-- content -->
	<div id="content" class="app-content markdown-body">
   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
      <?php echo Content::exportPostPageHeader($this,$this->user->hasLogin()); ?>
       <!--文章标题下面的小部件-->
       <ul class="entry-meta text-muted list-inline m-b-none small">
       <!--作者-->
        <li class="meta-author"><i class="iconfont icon-user1" aria-hidden="true"></i>&nbsp;<span class="sr-only"><?php _me("作者") ?>：</span> <a class="meta-value" href="<?php $this->author->permalink(); ?>" rel="author"> <?php $this->author(); ?></a></li>
        <!--发布时间-->
        <li class="meta-date"><i class="iconfont icon-clocko" aria-hidden="true"></i>&nbsp;<span class="sr-only"><?php _me("发布时间：") ?></span> <time class="meta-value"><?php $this->date(I18n::dateFormat()); ?></time></li>
        <!--浏览数-->
        <li class="meta-views"><i class="iconfont icon-eye" aria-hidden="true"></i>&nbsp;<span class="meta-value"><?php get_post_view($this) ?><?php _me('浏览'); ?></span></li>
        <!--评论数-->
        <li class="meta-comments"><i class="iconfont icon-comments" aria-hidden="true"></i><a class="meta-value" href="#comments">&nbsp;<?php $this->commentsNum(_mt('暂无评论'), _mt('1 条评论'), _mt('%d 条评论')); ?></a></li>
        <!--分类-->
        <li class="meta-categories"><i class="iconfont icon-tags" aria-hidden="true"></i> <span class="sr-only"><?php _me("分类") ?>：</span> <span class="meta-value"><?php $this->category(' '); ?></span></li>
       </ul>
      </header>
      <div class="wrapper-md">
	   <?php echo Content::exportPostPageTop($this, $this->options->rootUrl); ?>
       <!--博客文章样式 begin with .blog-post-->
       <div id="postpage" class="blog-post">
        <article class="panel">
        <!--文章页面的头图-->
        <?php if((!empty($this->options->indexsetup) && in_array('NoRandomPic-post', $this->options->indexsetup)) || $this->fields->thumb == "no"): ?>
        <?php else: ?>
        <?php echoPostThumbnail($this); ?>
        <?php endif; ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
          <div class="entry-content l-h-2x">
          <?php parseContent($this); ?>
          </div>
         </div>
        </article>
       </div>
       <!--上一篇&下一篇-->
       <nav class="m-t-lg m-b-lg">
        <ul class="pager">
        <?php thePrev($this); ?>   <?php theNext($this); ?>
        </ul>
       </nav>
       <!--评论-->
        <?php $this->need('component/comments.php') ?>
      </div>
     </div>
     <!--文章右侧边栏开始-->
    <?php $this->need('component/sidebar.php'); ?>
     <!--文章右侧边栏结束-->
    </div>
   </main>
  </div>
  	<!-- /content -->

<script src="<?php $this->options->themeUrl("js/toc.min.js") ?>"></script>
    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->
