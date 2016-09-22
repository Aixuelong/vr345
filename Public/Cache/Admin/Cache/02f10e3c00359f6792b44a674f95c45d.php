<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="UTF-8" /><title><?php echo lang('admin_panel');?></title><link href="__PUBLIC__/Assets/css/esui.css" rel="stylesheet" type="text/css" /><link href="__PUBLIC__/Assets/css/union.css" rel="stylesheet" type="text/css" /><link href="__PUBLIC__/Assets/css/font.css" rel="stylesheet" type="text/css" /><link href="__PUBLIC__/Assets/css/font-ie7.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.fx.js"></script><link href="__PUBLIC__/Assets/js/artDialog/skins/black.css" rel="stylesheet" type="text/css" /><script src="__PUBLIC__/Assets/js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script><script type="text/javascript">
$(function(){
	$('.ajax').click(function(e){
		var url = $(this).attr('href');
		e.preventDefault();
		var dialog = $.dialog({lock: true,title:'操作进行中……',content: '<img src="__PUBLIC__/Assets/img/waiting.gif" />'});
		$.ajax({
			type:'get',
			url:url,
			dataType:'json',
			success:function(data){
				dialog.close();
				$.dialog({content: data.info,time:5000,ok:true});
				console.log(data);
			}
		})
	})
})
</script></head><body><div id="MainPage"><div id="Header" class="layout-full-width"><div id="Logo"><a href="<?php echo U('Index/index');?>"><img src="__PUBLIC__/Assets/img/logo.png" height="35" /></a></div><ul id="Toolbar"><li><a href="http://<?php echo ($_SERVER['HTTP_HOST']); echo C('ROOT_FILE');?>" class="toolbar_item" target="_blank"><?php echo lang('website_index');?></a></li><li><a href="<?php echo U('Public/buildHtml');?>" class="toolbar_item ajax"><?php echo lang('静态生成');?></a></li><li><a href="<?php echo U('Public/delCache');?>" class="toolbar_item ajax"><?php echo lang('delete_cache');?></a></li><li class="last"><a href="<?php echo U('Public/logout');?>" class="toolbar_item" ><?php echo lang('logout');?></a></li></ul><!-- 主菜单 --><ul id="Nav"><?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(($module) == $key): ?>class="active"<?php endif; ?>><a href="<?php echo U($key.'/index');?>"><?php echo (lang($key)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div><div id="MainBody" class="layout-full-width"><div class="layout-sidebar"><div class="pinned"><?php if(is_array($menu[$module])): $i = 0; $__LIST__ = $menu[$module];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="box sub-nav"><h3><?php echo (lang($vo["name"])); ?></h3><ul class="ui-list"><?php if(is_array($vo["list"])): foreach($vo["list"] as $k=>$m): ?><li <?php if(($k) == $action): ?>class="active"<?php endif; ?>><a href="<?php echo U(MODULE_NAME.'/'.$k);?>"><?php echo (lang($m)); ?></a></li><?php endforeach; endif; ?></ul></div><?php endforeach; endif; else: echo "" ;endif; ?></div></div><!--.layout-sidebar-->