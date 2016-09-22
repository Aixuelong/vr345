<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title><?php echo ($seo["title"]); ?></title>
    <meta name="keywords" content="<?php echo ($seo["keywords"]); ?>">
    <meta name="description" content="<?php echo ($seo["description"]); ?>">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Skins/wap/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/Skins/wap/style_s.css" />
    <script type="text/javascript" src="__PUBLIC__/Skins/jquery.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Skins/swiper.min.js"></script>
</head>

<body class="page-top">
    <header class="header">
        <div class="logo">
            <a href="/"><img src="<?php if(empty($config["logo"])): ?>__PUBLIC__/Skins/logo.png<?php else: ?>__PUBLIC__/Uploads<?php echo ($config["logo"]); endif; ?>" height='44px' alt="<?php echo ($config["title"]); ?>"></a>
        </div>
    </header>
    <div id="container" class="wrap">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="section" id="<?php echo ($vo["alias"]); ?>">
<div class="cn_hd clearfix">
<h2 class="cn_h2"><?php echo ($vo["name"]); ?></h2>
<div class="swiper-c fr">
<div id="prev<?php echo ($vo["alias"]); ?>" class="swiper-button-prev"></div>
<div id="swiper<?php echo ($vo["alias"]); ?>" class="swiper-container">
<ul class="swiper-wrapper">
<?php if(!empty($vo["category"])): ?><li class="current swiper-slide"><?php echo lang('all');?></li><?php endif; ?>
<?php if(is_array($vo["category"])): $i = 0; $__LIST__ = $vo["category"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><li class="swiper-slide"><?php echo ($cat["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
<div id="next<?php echo ($vo["alias"]); ?>" class="swiper-button-next"></div>
</div>
</div>

                <div class="content">
                    <ul class="time-list clearfix">
                        <?php if(is_array($vo["list"])): $i = 0; $__LIST__ = $vo["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li>
                                <a href="<?php echo ($li["url"]); ?>" target="_blank"><?php echo ($li["title"]); ?> <?php if(($li["is_hot"]) == "1"): endif; ?></a>
                                <p><?php echo ($li["description"]); ?></p>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php if(is_array($vo["category"])): $i = 0; $__LIST__ = $vo["category"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?><div class="content" id="<?php echo ($cat['alias']); echo ($cat['id']); ?>" style="display:none">
                        <ul class="time-list clearfix">
                            <?php $catlist = D('Item')->getcategoryList($cat['id']); ?>
                            <?php if(is_array($catlist)): $i = 0; $__LIST__ = $catlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li>
                                    <a href="<?php echo ($li["url"]); ?>" target="_blank"><?php echo ($li["title"]); if(($li["is_hot"]) == "1"): endif; ?></a>
                                    <p><?php echo ($li["description"]); ?></p>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
    <script>
    var swiper<?php echo ($vo["alias"]); ?> = new Swiper('#swiper<?php echo ($vo["alias"]); ?>', {
        nextButton: '#next<?php echo ($vo["alias"]); ?>',
        prevButton: '#prev<?php echo ($vo["alias"]); ?>',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 30,
        freeMode: true
    });
    </script><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <script type="text/javascript">
    $('.section').each(function() {



        $(this).find('.swiper-wrapper li').removeClass('current').eq(0).addClass('current')



        $(this).find('.content').hide().eq(0).show()



        $(this).find('.swiper-wrapper li').each(function(i) {



            $(this).hover(function() {



                $(this).parents('.section ').find('.swiper-wrapper li').removeClass('current').eq(i).addClass('current')



                $(this).parents('.section ').find('.content').hide().eq(i).show()



            })



        })



    })
    </script>
    <footer class="footer">
        <div class="container">
            <?php echo ($config["footer"]); ?>
        </div>
    </footer>
</body>

</html>