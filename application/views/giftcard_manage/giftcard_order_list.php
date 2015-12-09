<!-- datatables -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/datatables/extras/TableTools/media/css/TableTools.css">
<link rel="stylesheet" href="<?php echo RES; ?>/common/common.css" />
<?php $this->load->view('shared/upload-file-css'); ?>
<?php $this->load->view('shared/alert'); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">商品品牌列表</h3>
        <div class="w-box-header">
            <div class="pull-left sort-disabled margin-left-2">
                <input name="s_name" class="input-medium form-control" placeholder="品牌名称" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <input name="s_id" class="input-medium form-control" placeholder="品牌id" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_status" class="select-medium form-control">
                    <option value="0">全部状态</option>
                    <option value="1">启用</option>
                    <option value="2">停用</option>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-6">
                <button class="btn btn-success label search">查询</button>
            </div>
        </div>
        <div class="empty"></div>
        <div class="w-box-header">
            <div class="pull-left sort-disabled">
                <a class="btn btn-success label" id="edit-pay-status">修改付款状态</a>
            </div>
        </div>
        <table class="table table-striped table-bordered dTableR" id="giftcard-order_tb">
            <thead>
                <tr>
                    <th class="table_checkbox center">
                        <input name="select_rows" class="select_rows" data-tableid="giftcard-order_tb" type="checkbox">
                    </th>
                    <th class="center">交易时间</th>
                    <th class="center">销售员</th>
                    <th class="center">客户名称</th>
                    <th class="center">记录人</th>
                    <th class="center">礼册</th>
                    <th class="center">总价格</th>
                    <th class="center">付款状态</th>
                    <th class="center">付款备注</th>
                    <th class="center">开卡备注</th>
                    <th class="center" width="200">操&nbsp;&nbsp;&nbsp;&nbsp;作</th>
                </tr>
            </thead>
            <tbody class="center">

            </tbody>        
        </table>
    </div>
</div>

<!---------新建弹层---------->
<div class="modal fade" id="add-giftcard-order-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-max-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">新建品牌</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="center">品牌名称</td>
                            <td>
                                <input name="a_name" type="text" class="form-control">
                            </td>
                            <td class="alert-label-error center" id="name-error"></td>
                        </tr>
                        <tr>
                            <td class="center">备注</td>
                            <td>
                                <textarea name="a_remark" cols="6" rows="3" class="form-control"></textarea>
                            </td>
                            <td class="alert-label-error center" id="remark-error"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="center">
                                <button type="button" class="btn btn-success" id="add-giftcard-order-bnt">确认</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!---------编辑弹层---------->
<div class="modal fade" id="edit-giftcard-order-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-max-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">编辑品牌</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="center">品牌id</td>
                            <td>
                                <span name="e_id" class="form-control"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">名称</td>
                            <td>
                                <input name="e_name" type="text" class="form-control">
                            </td>
                            <td class="alert-label-error center" id="edit-name-error"></td>
                        </tr>
                        <tr>
                            <td class="center">状态</td>
                            <td>
                                <select name="e_status" class="form-control">
                                    <option value="1">启用</option>
                                    <option value="2">停用</option>
                                </select>
                            </td>
                            <td class="alert-label-error center" id="edit-status-error"></td>
                        </tr>
                        <tr>
                            <td class="center">备注</td>
                            <td>
                                <textarea name="e_remark" cols="6" rows="2" class="form-control"></textarea>
                            </td>
                            <td class="alert-label-error center" id="edit-remark-error"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="center">
                                <button type="button" class="btn btn-success" id="edit-giftcard-order-bnt">确认</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- datatable -->
<script src="<?php echo RES; ?>lib/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo RES; ?>lib/datatables/extras/Scroller/media/js/dataTables.scroller.min.js"></script>
<!-- datatable table tools -->
<script src="<?php echo RES; ?>lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
<script src="<?php echo RES; ?>lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
<!-- datatables bootstrap integration -->
<script src="<?php echo RES; ?>lib/datatables/jquery.dataTables.bootstrap.min.js"></script>
<!-- datatable functions -->
<script src="<?php echo RES; ?>js/pages/gebo_datatables.js"></script>
<!-- tables functions -->
<script src="<?php echo RES; ?>js/pages/gebo_tables.js"></script>

<?php $this->load->view('shared/upload-file'); ?>
<?php $this->load->view('shared/alert-upload'); ?>

<script src="<?php echo RES; ?>giftcard/giftcard_order_list.js"></script>

