<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<?php $this->load->view('shared/upload-image-css'); ?>
<?php $this->load->view('shared/alert'); ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">编辑商品</h3>
        <form class="form-horizontal" id="fileupload">
            <fieldset>
                <div class="form-group">
                    <label for="g_name" class="control-label col-sm-2">商&nbsp;品&nbsp;id&nbsp;</label>
                    <div class="col-sm-4">
                        <label class="control-label col-sm-2"><?php echo $goods['id']; ?></label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input value="1" name="g_type" <?php echo $goods['type'] == 1 ? 'checked="checked"' : ''; ?> type="radio" disabled>
                            单品
                        </label>
                        <label class="radio-inline">
                            <input value="2" name="g_type" <?php echo $goods['type'] == 2 ? 'checked="checked"' : ''; ?> type="radio" disabled >
                            组合商品
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_name" class="control-label col-sm-2">商品名称</label>
                    <div class="col-sm-4">
                        <input name="g_id" id="g_id" type="hidden" value="<?php echo $goods['id'] ?>">
                        <input name="g_name" id="g_name" class="input-xlarge form-control" value="<?php echo $goods['name']; ?>" type="text">
                    </div>
                </div>
                <div class="form-group goods-single-own" <?php echo $goods['type'] == 1 ? '' : 'style="display: none;"'; ?>>
                    <label for="g_classify" class="control-label col-sm-2">商品分类</label>
                    <div class="col-sm-2">
                        <select name="g_classify" id="g_classify" data-placeholder="选择商品分类..." class="chzn_a form-control">
                            <?php foreach ($classify as $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php echo $v['id'] == $goods['classify_id'] ? 'selected' : '' ?>>
                                    <?php echo $v['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label for="g_brand" class="control-label col-sm-1">商品品牌</label>
                    <div class="col-sm-2">
                        <select name="g_brand" id="g_brand" data-placeholder="选择商品品牌..." class="chzn_a form-control">
                            <?php foreach ($brand as $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php echo $v['id'] == $goods['brand_id'] ? 'selected' : '' ?>>
                                    <?php echo $v['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label for="g_supplier" class="control-label col-sm-1">供应商</label>
                    <div class="col-sm-2">
                        <select name="g_supplier" id="g_supplier" data-placeholder="选择供应商..." class="chzn_a form-control">
                            <?php foreach ($suppley as $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php echo $v['id'] == $goods['supply_id'] ? 'selected' : '' ?>>
                                    <?php echo $v['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group goods-multiple-own" <?php echo $goods['type'] == 2 ? '' : 'style="display: none;"'; ?>>
                    <label for="g_ids" class="control-label col-sm-2">组&nbsp;合&nbsp;ID&nbsp;</label>
                    <div class="col-sm-6">
                        <textarea name="g_ids" id="g_ids" cols="10" rows="2" class="form-control"><?php echo $goods['groupid'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_price" class="control-label col-sm-2">销售价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_price" id="g_price" size="16" class="form-control" type="text" value="<?php echo $goods['sale_price'] ?>">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                    <label for="g_cost" class="control-label col-sm-1">采购价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_cost" id="g_cost" size="16" class="form-control" type="text" value="<?php echo $goods['buy_price'] ?>">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="goods-single-own" <?php echo $goods['type'] == 1 ? '' : 'style="display: none;"'; ?>>
                        <label for="g_inventory" class="control-label col-sm-2">商品库存</label>
                        <div class="col-sm-3">
                            <input name="g_inventory" id="g_inventory" class="input-xlarge form-control" value="<?php echo $goods['store_num'] ?>" type="text">
                        </div>
                    </div>
                    <label for="g_unit" class="control-label col-sm-2">商品单位</label>
                    <div class="col-sm-3">
                        <input name="g_unit" id="g_unit" class="input-xlarge form-control" value="<?php echo $goods['munit'] ?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_deliver" class="control-label col-sm-2">默认快递</label>
                    <div class="col-sm-2">
                        <select name="g_deliver" id="g_deliver" data-placeholder="选择商品快递..." class="chzn_a form-control">
                            <?php foreach ($deliver as $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php echo $v['id'] == $goods['deliver_id'] ? 'selected' : '' ?>>
                                    <?php echo $v['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_description" class="control-label col-sm-2">产品描述</label>
                    <div class="col-sm-6">
                        <textarea name="g_description" id="g_description" cols="10" rows="3" class="form-control"><?php echo $goods['desciption'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-2">宣传图片</label>
                    <!-- The table listing the files available for upload/download -->
                    <span role="presentation" class="table table-striped">
                        <ul class="files">
                            <?php foreach (explode(',', $goods['pic_ids']) as $img): ?>
                                <?php if ($img): ?>
                                    <li class="template-download fade none-list-style in">
                                        <p class="preview">
                                            <a href="<?php echo IMAGE_SERVER; ?>files/<?php echo $img; ?>" class="img-uploaded" title="<?php echo $img; ?>" download="<?php echo $img; ?>" data-gallery="">
                                                <img src="<?php echo IMAGE_SERVER; ?>files/thumbnail/<?php echo $img; ?>">
                                            </a>
                                        </p>
                                        <span class="delete text-center btn-danger img-uploaded" >
                                            删除
                                        </span>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </span>
                    <span class="btn btn-success fileinput-button" id="fileupload-bnt" title="添加图片">
                        <i class="glyphicon glyphicon-plus"></i>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="files[]" multiple="" onclick="return checkUpload(5);">
                    </span>
                </div>
                <div class="form-group">
                    <label for="g_rk" class="control-label col-sm-2">产品备注</label>
                    <div class="col-sm-6">
                        <textarea name="g_rk" id="g_rk" cols="10" rows="3" class="form-control"><?php echo $goods['remark'] ?></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-8"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="update-goods-ok">完成</div>
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
<?php $this->load->view('shared/upload-image'); ?>

<script>
    $(document).ready(function () {
        $(".chzn_a").chosen({
            allow_single_deselect: true
        });
        //成功提示框设置
        $('#alert-success').modal({
            backdrop: false,
            show: false
        });

        //监听radio事件
        $('input[name="g_type"]:radio').change(function () {
            var value = $(this).val();
            if (value == 1) {
                $("div.goods-multiple-own").hide();
                $("div.goods-single-own").show();
            } else {
                $("div.goods-single-own").hide();
                $("div.goods-multiple-own").show();
            }
        });

        $("#update-goods-ok").on('click', function () {
            var flag = true;
            var g_name = $("#g_name").val();
            var g_id = $("#g_id").val();
            var g_type = $('input[name="g_type"]:checked ').val();
            var g_classify = $("#g_classify").val();
            var g_brand = $("#g_brand").val();
            var g_supplier = $("#g_supplier").val();
            var g_ids = $("#g_ids").val();
            var g_price = $("#g_price").val();
            var g_cost = $("#g_cost").val();
            var g_inventory = $("#g_inventory").val();
            var g_unit = $("#g_unit").val();
            var g_deliver = $("#g_deliver").val();
            var g_description = $("#g_description").val();
            var g_remark = $("#g_rk").val();
            var pic_ids = getUploadImg();
            var price_preg = /^([0-9]+[\.]?[0-9]+|\d+)$/;
            if (g_name == '' || g_name == undefined) {
                flag = flag & false;
                alertError("#alert-error", '商品名称不能为空！');
                return;
            }
            if (g_type == 2) {
                if (g_ids == '') {
                    flag = flag & false;
                    alertError("#alert-error", '商品ID不能为空！');
                    return;
                }
            }
            if (g_price == '' || !price_preg.test(g_price)) {
                flag = flag & false;
                alertError("#alert-error", '请填写正确的销售价格！');
                return;
            }
            if (g_cost == '' || !price_preg.test(g_cost)) {
                flag = flag & false;
                alertError("#alert-error", '请填写正确的采购价格！');
                return;
            }
            if (g_type == 1 && (g_inventory == '' || !/^[0-9]+$/.test(g_inventory))) {
                flag = flag & false;
                alertError("#alert-error", '请填写商品库存！');
                return;
            }
            if (g_unit == '') {
                flag = flag & false;
                alertError("#alert-error", '请填写商品单位！');
                return;
            }
            if (pic_ids == '') {
                flag = flag & false;
                alertError("#alert-error", '请上传宣传图片！');
                return;
            }
            if (flag) {
                $.post('/goods_manage/update_goods_info',
                        {
                            id:g_id,name: g_name, groupid: g_ids, type: g_type, classify_id: g_classify,
                            brand_id: g_brand, supply_id: g_supplier, sale_price: g_price,remark: g_remark,
                            buy_price: g_cost, store_num: g_inventory, deliver_id: g_deliver,
                            munit: g_unit, desciption: g_description, 
                            pic_ids: pic_ids
                        }, function (ret) {
                    var d = $.parseJSON(ret);
                    if (d.errCode == 0) {
                        alertSuccess("#alert-success", '/goods_manage/goods_list');
                    } else {
                        alertError("#alert-error", d.msg);
                    }
                });
            }

        });
    });
</script>
