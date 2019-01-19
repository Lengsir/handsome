<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('component/header.php'); ?>

	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

  	<!-- content -->
	<div id="content" class="app-content">
   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
		<?php echo Content::exportPostPageHeader($this,$this->user->hasLogin()); ?>
      <div class="wrapper-md">
		<!--正文顶部的部件，如“返回首页”-->
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


    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->
