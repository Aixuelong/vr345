<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME,'do'=>$_GET['do']));?><link  href="__PUBLIC__/Assets/js/uploadify/uploadify.css" rel="stylesheet" type="text/css"><script src="__PUBLIC__/Assets/js/uploadify/jquery.uploadify.js" type="text/javascript"></script><script type="text/javascript">
$(function() {
	$('#file_upload').uploadify({
		'formData'     : {
			'timestamp' : '<?php echo ($_SERVER["REQUEST_TIME"]); ?>',
			'token'     : '<?php echo (md5($_SERVER["REQUEST_TIME"])); ?>'
		},
		'onUploadSuccess' : function(file, data, response) {
			$('#logo').val(data);
		},
		'swf'         : '__PUBLIC__/Assets/js/uploadify/uploadify.swf',
		'uploader'    : '<?php echo U("Public/upload");?>',
		'buttonImage' : '__PUBLIC__/Assets/js/uploadify/swfBnt.png',
		'fileTypeExts': '*.bmp;*.jpg;*.jpeg;*.gif;*.png'//文件格式限制

	});
});
</script><div class="layout-main"><div id="breadclumb" class="box"><h3><strong><?php echo lang('breadclumb_colon');?></strong><?php echo lang(MODULE_NAME);?><span></span><?php if(empty($_GET["id"])): echo lang('add'); else: echo lang('edit'); endif; ?></h3></div><div class="box clear-fix"><div class="layout-block-header"><h2><?php echo lang('details_info');?></h2></div><div id="AccountInfo"><div class="info-block"><form method="post" action="<?php echo U(MODULE_NAME.'/proccess/');?>" id="ajaxform" enctype="multipart/form-data"><table class="info-table"><tbody><?php if(!empty($info['id']) AND empty($info['status'])): ?><tr><th><b class="verifing">*</b><?php echo lang('check_status_colon');?></th><td><input type="checkbox" name="status" value="1"><span class="ui-validityshower-info">（选择此项提交则审核通过）</span></td></tr><?php endif; ?><tr><th><b class="verifing">*</b><?php echo lang('title_colon');?></th><td><input name="title" type="text" class="ui-text validate[required,minSize[2]]" size="40" value="<?php echo ($info["title"]); ?>"></td></tr><tr><th><b class="verifing">*</b><?php echo lang('url_colon');?></th><td><input name="url" id="url" type="text" class="ui-text validate[required,minSize[2],custom[url]]" size="40" value="<?php echo ($info["url"]); ?>"><span class="ui-validityshower-info">（示例：http://www.baidu.com）</span></td></tr><tr><th><b class="verifing">*</b><?php echo lang('category_colon');?></th><td><div style="padding:0 10px;height:115px;width:400px;line-height:18px;border:1px solid #ccc;overflow-y:auto;"><ul id="category"><?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span style="margin-left:<?php echo ($vo['level']-1)*2; ?>em;"><?php if(($vo["level"]) > "1"): ?>└─<?php endif; ?><input type="checkbox" name="tags[]" value="<?php echo ($vo["tags_type_id"]); ?>" class="validate[minCheckbox[1]] <?php if(empty($vo["pid"])): ?>parent<?php else: ?>child<?php endif; ?>" <?php if(in_array($vo['tags_type_id'],$itemTags)): ?>checked='checked'<?php endif; if(empty($vo["pid"])): ?>id="parent-<?php echo ($vo["id"]); ?>"<?php else: ?>data-node="<?php echo ($vo["pid"]); ?>"<?php endif; ?> /><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></td></tr><tr><th><?php echo lang('sortorder_colon');?></th><td><input name="sort_order" type="text" class="ui-text" value="<?php echo (intval($info["sort_order"])); ?>" size="4"><span class="ui-validityshower-info">（数字越大越靠前）</span></td></tr><tr><th><?php echo lang('hot_colon');?></th><td><input name="is_hot" type="checkbox" value="1" <?php if(!empty($info["is_hot"])): ?>checked="checked"<?php endif; ?>></td></tr><tr><th><?php echo lang('logo_colon');?></th><td><input name="logo" id="logo" type="text" class="ui-text" value="<?php echo ($info["logo"]); ?>" size="40" style="float:left"><input id="file_upload" name="file_upload" type="file" multiple="true" value="<?php echo lang('upload');?>"></td></tr><tr><th><?php echo lang('details_content_colon');?></th><td><textarea name="description" id="description" class="input-textarea editor" cols="80" rows="4"><?php echo ($info["description"]); ?></textarea><span class="ui-validityshower-info">最佳字数：<b id="count" class="alert">0</b> / 35 个字符</span></td></tr><tr><th>&nbsp;</th><td><?php if(!empty($_GET['id'])): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" /><?php else: ?><input type="hidden" name="status" value="1" /><?php endif; ?><input type="hidden" name="mid" value="<?php echo ($_GET['mid']); ?>" /><input type="hidden" name="cid" value="<?php echo ($_GET['cid']); ?>" /><input type="hidden" name="user_id" value="<?php echo ($user["id"]); ?>" /><input type="submit" class="btn btn-ok" value="<?php echo lang('confirm');?>" /><a class="btn" href="<?php if(empty($_GET["id"])): echo U('Item/index'); else: echo ($_SERVER['HTTP_REFERER']); endif; ?>"><?php echo lang('goback');?></a></td></tr></tbody></table></form></div></div></div><!--.box--><link href="__PUBLIC__/Assets/js/validation/validationEngine.jquery.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine.js"></script><script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine-zh_CN.js"></script><script type="text/javascript" src="__PUBLIC__/Assets/js/jquery.form.js"></script><script type="text/javascript">
$(function(){
    $("#ajaxform").validationEngine('attach', {promptPosition : "centerRight", autoPositionUpdate : true});	
    $('#ajaxform').ajaxForm({
        timeout: 5000,
        error:function(){ $('#ajaxLoading').hide();alert("<?php echo lang('ajaxError');?>");},
        beforeSubmit:function(){ $('#ajaxLoading').show();},
        success:function(data){ 
            $('#ajaxLoading').hide();
            if(data.status==1){
                var redirectURL = "<?php if(empty($_GET["id"])): echo U('Item/index'); else: echo ($_SERVER['HTTP_REFERER']); endif; ?>";
                $.alert(data.info,data.status,function(){window.location.href=redirectURL});
            }else{
                $.alert(data.info,data.status);
            }
        },
        dataType: 'json'
    });
});
    
$('#description').bind('keydown keyup click',function(){
	var len = $('#description').val().length;
	$('#count').html(len);	
})

$('#category .parent').click(function(){
	var id = $(this).val();
	var checked = $(this).attr('checked');
	var isCheck = checked=='checked'?checked:false;
	$('[data-node='+id+']').each(function () {
		$(this).attr('checked',isCheck);
    })
})
$('#category .child').click(function(){
	var id = $(this).attr('data-node');
	var checked = $(this).attr('checked');
	if(checked) $('#parent-'+id).attr('checked',checked);
})

</script><?php echo W("Foot");?>