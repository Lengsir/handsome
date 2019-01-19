  <?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
  <!--选择侧边栏的颜色-->
  <?php echo Content::selectAsideStyle(); ?>
      <div class="aside-wrap">
        <div class="navi-wrap">
          <!-- user -->
        <?php if (!empty($this->options->indexsetup) && in_array('show-avatar', $this->options->indexsetup)): ?>
          <div class="clearfix hidden-xs text-center hide" id="aside-user">
        <?php else: ?>
          <div class="clearfix hidden-xs text-center hide show" id="aside-user">
        <?php endif; ?>
            <div class="dropdown wrapper">
            <?php if($this->options->rewrite == 1): ?>
              <a href="<?php $this->options->rootUrl(); ?>/cross.html">
            <?php else: ?>
              <a href="<?php $this->options->rootUrl(); ?>/index.php/cross.html">
            <?php endif; ?>
                <span class="thumb-lg w-auto-folded avatar m-t-sm">
                  <img src="<?php $this->options->BlogPic() ?>" class="img-full">
                </span>
              </a>
              <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                <span class="clear">
                  <span class="block m-t-sm">
                    <strong class="font-bold text-lt"><?php $this->options->BlogName(); ?></strong>
                    <b class="caret"></b>
                  </span>
                  <span class="text-muted text-xs block"><?php $this->options->BlogJob() ?></span>
                </span>
              </a>
              <!-- dropdown -->
              <ul class="dropdown-menu animated fadeInRight w hidden-folded">
                <li class="wrapper b-b m-b-sm bg-info m-t-n-xs">
                  <span class="arrow top hidden-folded arrow-info"></span>
                  <div>
                <?php
                    $time= date("H",time()+($this->options->timezone - idate("Z")));
                    $percent= $time/24;
                    $percent= sprintf("%01.2f", $percent*100).'%';
                ?>
                <?php if($time>=6 && $time<=11): ?>
                  <p><?php _me("早上好，") ?><?php $this->options->BlogName(); ?>.</p>
                <?php elseif($time>=12 && $time<=17): ?>
                  <p><?php _me("中午好，") ?><?php $this->options->BlogName(); ?>.</p>
                <?php else : ?>
                <p><?php _me("晚上好，") ?><?php $this->options->BlogName(); ?>.</p>
                <?php endif; ?>
                  </div>
                  <div class="progress progress-xs m-b-none dker">
                    <div class="progress-bar bg-white" data-toggle="tooltip" data-original-title="<?php echo $percent; ?>" style="width: <?php echo $percent; ?>"></div>
                  </div>
                </li>
              <!--文章RSS订阅-->
              <li>
                <a href="<?php $this->options->feedUrl(); ?>" data-toggle="tooltip" title="订阅文章 Feed 源">
                  <i style="position: relative;width: 30px;margin: -11px -10px;margin-right: 0px;overflow: hidden;line-height: 30px;text-align: center;" class="iconfont icon-rss" ></i><span><?php _me("文章RSS") ?></span>
                </a>
              </li>
              <!--评论RSS订阅-->
              <li>
                <a href="<?php $this->options->commentsFeedUrl(); ?>" data-toggle="tooltip" title="订阅评论 Feed 源"><i style="position: relative;width: 30px;margin: -11px -10px;margin-right: 0px;overflow: hidden;line-height: 30px;text-align: center;" class="iconfont icon-rss1" ></i><span>评论RSS</span></a>
              </li>

              <li class="divider"></li>
              <?php if($this->user->hasLogin()): ?>
              <!--后台管理-->
              <li>
                <a data-no-instant target="_blank" href="<?php $this->options->adminUrl(); ?>"><i style="position: relative;width: 30px;margin: -11px -10px;margin-right: 0px;overflow: hidden;line-height: 30px;text-align: center;" class="iconfont icon-cogs"></i><span>后台管理</span></a>
              </li>
              <?php else: ?>
              <li>
                <a data-no-instant href="<?php $this->options->loginUrl(); ?>">登录</a>
              </li>
              <?php endif; ?>
              </ul>
              <!-- / dropdown -->
            </div>
            <div class="line dk hidden-folded"></div>
          </div>
          <!-- / user -->

          <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
             <!--index-->
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span><?php _me("导航") ?></span>
              </li>
              <!--主页-->
              <li>
                <a href="<?php $this->options->rootUrl(); ?>" class="auto">
                  <i class="iconfont icon-home icon text-md"></i>
                  <span><?php _me("首页") ?></span>
                </a>
              </li>
              <!-- /主页 -->
              <!--lucky try-->

              <!-- /lucky try-->
              <li class="line dk"></li>
			<!--Components-->
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span><?php _me("组成") ?></span>
              </li>
              <!--分类category-->
              <li>
                <a data-no-instant class="auto">
                  <span class="pull-right text-muted">
                    <i class="iconfont icon-fw icon-angleright text"></i>
                    <i class="iconfont icon-fw icon-angledown text-active"></i>
                  </span>
                  <i class="iconfont icon-c-classification"></i>
                  <span><?php _me("分类") ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a data-no-instant>
                      <span><?php _me("分类") ?></span>
                    </a>
                  </li><!--不会显示出来-->
                  <!--循环输出分类-->
                <?php $this->widget('Widget_Metas_Category_List')
               ->parse('<li><a href="{permalink}"><span>{name}</span></a></li>'); ?>
                </ul>
              </li>
              <!--独立页面pages-->
              <li>
                <a data-no-instant class="auto">
                  <span class="pull-right text-muted">
                    <i class="iconfont icon-fw icon-angleright text"></i>
                    <i class="iconfont icon-fw icon-angledown text-active"></i>
                  </span>
                  <i class="iconfont icon-176pages"></i>
                  <span><?php _me("页面") ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a data-no-instant>
                      <span><?php _me("页面") ?></span>
                    </a>
                  </li><!--这个字段不会被显示出来-->
                  <!--循环输出独立页面-->
                  <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                   <?php while($pages->next()): ?>
                    <li><a href="<?php $pages->permalink(); ?>"><span><?php $pages->title(); ?></span></a></li>
                   <?php endwhile; ?>
                </ul>
              </li>
              <!--友情链接-->
              <li>
                <a data-no-instant class="auto">
                  <span class="pull-right text-muted">
                    <i class="iconfont icon-fw icon-angleright text"></i>
                    <i class="iconfont icon-fw icon-angledown text-active"></i>
                  </span>
                  <i class="iconfont icon-pengyouquan"></i>
                  <span><?php _me("友链") ?></span>
                </a>
                <ul class="nav nav-sub dk">
                  <li class="nav-sub-header">
                    <a data-no-instant>
                      <span><?php _me("友链") ?></span>
                    </a>
                  </li>
                  <!--使用links插件，输出全站友链-->
                 <?php $mypattern1 = "<li><a href=\"{url}\" target=\"_blank\" title=\"{title}\"><span>{name}</span></a></li>";
                  Links_Plugin::output($mypattern1, 0, "ten");?>
                </ul>
              </li>

            </ul>
          </nav>
          <!-- nav -->


        </div>
      </div>
  </aside>
