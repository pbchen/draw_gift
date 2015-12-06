<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<?php $this->load->view('shared/upload-file-css'); ?>
<?php $this->load->view('shared/alert'); ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">新建商品</h3>
        <form class="form-horizontal" id="fileupload">
            <fieldset>
                <div class="form-group">
                    <label for="g_name" class="control-label col-sm-2">商品名称</label>
                    <div class="col-sm-4">
                        <input name="g_name" id="g_name" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input value="1" name="g_type" checked="checked" type="radio">
                            单品
                        </label>
                        <label class="radio-inline">
                            <input value="2" name="g_type" type="radio">
                            组合商品
                        </label>
                    </div>
                </div>
                <div class="form-group goods-single-own">
                    <label for="g_classify" class="control-label col-sm-2">商品分类</label>
                    <div class="col-sm-2">
                        <select name="g_classify" id="g_classify" data-placeholder="选择商品分类..." class="chzn_a form-control">
                            <?php foreach($classify as $c):?>
                            <option value="<?php echo $c['id']?>"><?php echo $c['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <label for="g_brand" class="control-label col-sm-1">商品品牌</label>
                    <div class="col-sm-2">
                        <select name="g_brand" id="g_brand" data-placeholder="选择商品品牌..." class="chzn_a form-control">
                            <?php foreach($brand as $b):?>
                            <option value="<?php echo $b['id']?>"><?php echo $b['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <label for="g_supplier" class="control-label col-sm-1">供应商</label>
                    <div class="col-sm-2">
                        <select name="g_supplier" id="g_supplier" data-placeholder="选择供应商..." class="chzn_a form-control">
                            <?php foreach($suppley as $s):?>
                            <option value="<?php echo $s['id']?>"><?php echo $s['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group goods-multiple-own" style="display: none;">
                    <label for="g_ids" class="control-label col-sm-2">商&nbsp;品&nbsp;ID&nbsp;</label>
                    <div class="col-sm-6">
                        <textarea name="g_ids" id="g_ids" cols="10" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_price" class="control-label col-sm-2">销售价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_price" id="g_price" size="16" class="form-control" type="text">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                    <label for="g_cost" class="control-label col-sm-1">采购价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_cost" id="g_cost" size="16" class="form-control" type="text">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="goods-single-own">
                        <label for="g_inventory" class="control-label col-sm-2">商品库存</label>
                        <div class="col-sm-3">
                            <input name="g_inventory" id="g_inventory" class="input-xlarge form-control" value="" type="text">
                        </div>
                    </div>
                    <label for="g_unit" class="g-unit control-label col-sm-1">商品单位</label>
                    <div class="col-sm-3">
                        <input name="g_unit" id="g_unit" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_deliver" class="control-label col-sm-2">默认快递</label>
                    <div class="col-sm-2">
                        <select name="g_deliver" id="g_deliver" data-placeholder="选择商品快递..." class="chzn_a form-control">
                            <?php foreach($deliver as $d):?>
                            <option value="<?php echo $d['id']?>"><?php echo $d['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_description" class="control-label col-sm-2">产品描述</label>
                    <div class="col-sm-6">
                        <textarea name="g_description" id="g_description" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-2">宣传图片</label>
                    <!-- The table listing the files available for upload/download -->
                    <span role="presentation" class="table table-striped">
                        <ul class="files">
                            
                        </ul>
                    </span>
                    <span class="btn btn-success fileinput-button" id="fileupload-bnt" title="添加图片">
                        <i class="glyphicon glyphicon-plus"></i>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload-img" type="file" name="files" multiple="" data-url="/upload_file/img_upload?" onclick="return checkUpload(5);">
                    </span>
                </div>
                <div class="form-group">
                    <label for="g_rk" class="control-label col-sm-2">产品备注</label>
                    <div class="col-sm-6">
                        <textarea name="g_rk" id="g_rk" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-8"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="add-goods-ok">完成</div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!-- multiselect -->
<script src="<?php echo RES; ?>lib/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo RES; ?>lib/multi-select/js/jquery.quicksearch.js"></script>
<!-- enhanced select (chosen) -->
<script src="<?php echo RES; ?>lib/chosen/chosen.jquery.min.js"></script>
<!-- autosize textareas -->
<script src="<?php echo RES; ?>js/forms/jquery.autosize.min.js"></script>
<!-- user profile functions -->
<script src="<?php echo RES; ?>js/pages/gebo_user_profile.js"></script>

<?php $this->load->view('shared/upload-file'); ?>

<script src="<?php echo RES; ?>goods_manage/add_goods.js"></script>

<script>
    var upload_path = "<?php echo UPLOAD; ?>";
    $('#fileupload-img').fileupload({
        formData: {script: true}
        , add: function (e, data) {
            data.submit();
        }
        , done: function (e, data) {
            if(data.result.errCode==0){
                var file_name = data.result.val.name;
                var file_id = data.result.val.id;
                var file_path = upload_path + data.result.val.path;
                var html = '<li class="template-download fade none-list-style in">';
                    html += '<p class="preview">';
                    html += '<a href="'+file_path+ file_name+'" target="_blank" class="img-uploaded" title="'+file_name+'" >';
                    html += '<img src="'+file_path+'thumb_'+file_name+'">';
                    html += '</a></p>';
                    html += '<span class="delete text-center btn-danger img-uploaded" id="'+file_id+'">删除</span>';
                    html += '</li>';
                $("ul.files").append(html);
            }else{
                alertError("#alert-error",'文件上传失败');
            }
        }
    });

</script>
