/**
* 添加标签的函数
* @param els
* @param tags
* @return
*/

function imgSelectorInit() {
    $('#imgSelectorChoice').delegate('img', 'click', function () {
        var el = $(this);
        if (!el.hasClass('selected'))
            buildSelectedImg(el);
    }).delegate('img', 'mouseenter', function () {
        $(this).addClass('hovered');
    }).delegate('img', 'mouseleave', function () {
        $(this).removeClass('hovered');
    });
}
function ipostSortInit() {
    $('.ipost-list').sortable({
        items: '> .post',
        containment: 'parent',
        appendTo: 'parent',
        tolerance: 'pointer',
        axis: 'y',
        placeholder: 'holder',
        forceHelperSize: true,
        forcePlaceholderSize: true,
        opacity: 0.8,
        cursor: 'ns-resize'
    });
}
function addFile(image) {
    var el = $('<li class="post file" data-post-id="' + image.id + '">'
         + '<input type="hidden" value="' + image.id + '" name="photoid[]">'
		 + '<input type="hidden" value="' + image.url + '" name="url[]">'
		+ '<a class="thumb" href="' + image.url + '" target="_blank" title="点击查看原图，拖动排序"><img src="' + image.thm_url + '"><span class="file-thumb-title">上传成功</span></a>'//this.thumb
		//+ '<p class="file-name">' + image.title + '<span class="file-info">' + (json ? json.warning || json.message : '') + '</span></p>'//this.info
		+ '<dl class="form data">'
		        + '<dt>排序</dt><dd><input type="text" class="text" placeholder="请留空" name="sort[]" value="0" /></dd>' 
			+ '<dt>标题</dt><dd class="title"><input type="text" class="text" placeholder="无标题请留空" name="title[]" value="' + (image.title || '') + '" /></dd>' //this.title
			+ '<dt>描述</dt><dd class="description"><textarea name="description[]">' + image.content + '</textarea></dd>'
			//+ '<dt class="tags">标签</dt><dd class="tags"><input type="text" class="text" placeholder="多个标签之间用空格分隔" name="images[' + image.id + '][tags]" /></dd>'
		+ '</dl>'
		+ '<ul class="action">'
    //+ '<li class="file-size"></li>'//用flash或者html5一定有size
		+ '<li class="delete"><a class="ir">删除</a></li>'
		+ '<li class="sort"><a class="ir">排序</a></li>'
		+ '</ul>'
	+ '</li>').appendTo($('#fileList'));
    //$("html,body").animate({scrollTop:'+=145'})
    return el;
    //根据现在的代码，上传成功或者像素数提示的字符被隐藏无法显示出来。
}
function initUpload(el,count, op,url,delurl,swfurl) {
    var c = count - $("li.file").length;
    el.uploadify({
        'swf': swfurl,
        'uploader': url,
        'cancelImage': 'uploadify-cancel.png',
        'buttonClass': 'btn pl_add btn-primary',
        'removeTimeout': 0,
        'fileSizeLimit': '300kb',
        'buttonText': '<i class="icon-plus-sign"></i> 添加图片',
        'formData': op,
        'buttonCursor': 'pointer',
        'fileTypeDesc': '图片格式',
        'fileTypeExts': '*.jpg;*.bmp;*.png; *.jpeg',
        'queueSizeLimit': 300,
        'uploadLimit': c<=0?1:c,
        'onUploadError': function (file, errorCode, errorMsg, errorString, queue) { alert(file.name + "上传失败") },
        'onUploadStart': function (file) {
            $('#file_upload-button').html('<i class="icon-plus-sign"></i> 继续上传');
            if ($("#bsubmit").length == 0) {
                //$('#file_upload-button').parent().append('   <button id="bsubmit" type="submit" data-loading-text="提交中..." class="btn">保存</button>') 
                $("#submit").show();
            }
  
        },
        'onInit': function(instance) {
            if ((count - $("li.file").length) <= 0) {
                var button = $("#file_upload-button");
                button.addClass("disabled").attr("style", "z-index: 999;")
                button.html('上传已达限制...');
            }
        },
        'onUploadSuccess': function (file, data, response) {
            var json = $.parseJSON(data);
            if (json.result !== 'SUCCESS') {
                G.ui.tips.info(json.message || data);
                return;
            }else{
				addFile(json.image);
			}
        } 

    }); 
    $('#fileList').delegate('.ir', 'click', function (e) {
        $.fallr('show', {
            buttons: {
                button1: {
                    text: '确定', danger: true, onclick: function () {
                        var el = $(e.target).closest('li.file');
                        $.post(delurl, {
                            "id": el.data('postId'),
							"url": el.children().eq(1).val()
                        });
                        el.remove(); 
//                        if ((count - $("li.file").length) >=0) {
//                            var button = $("#file_upload-button");
//                            button.removeClass("disabled").attr("style", "")
//                            button.html('<i class="icon-plus-sign"></i> 继续上传');
//                        }
                        $.fallr('hide');

                    }
                },
                button2: {
                    text: '取消'
                }
            },
            content: '<p>你确定要删除这张图片吗？</p>',
            icon: 'trash'
        });
    })
}
