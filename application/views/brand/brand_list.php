<!-- datatables -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/datatables/extras/TableTools/media/css/TableTools.css">
<link rel="stylesheet" href="<?php echo RES; ?>/common/common.css" />
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
                    <option value="1">使用</option>
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
                <a class="btn btn-success label" id="add-brand">新建</a>
                <a class="btn btn-success label margin-left-2" id="stop-brand">停用</a>
                <a class="btn btn-success label margin-left-2" id="start-brand">启用</a>
            </div>
        </div>
        <table class="table table-striped table-bordered dTableR" id="brand_tb">
            <thead>
                <tr>
                    <th class="table_checkbox center">
                        <input name="select_rows" class="select_rows" data-tableid="brand_tb" type="checkbox">
                    </th>
                    <th class="center">名&nbsp;&nbsp;称</th>
                    <th class="center">id</th>
                    <th class="center">状&nbsp;&nbsp;态</th>
                    <th class="center">商品数量</th>
                    <th class="center">备&nbsp;&nbsp;注</th>
                    <th class="center">&nbsp;&nbsp;操作&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody class="center">

            </tbody>        
        </table>
    </div>
</div>

<!---------新建弹层---------->
<div class="modal fade" id="add-brand-modal">
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
                                <button type="button" class="btn btn-success" id="add-brand-bnt">确认</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!---------编辑弹层---------->
<div class="modal fade" id="edit-brand-modal">
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
                                <button type="button" class="btn btn-success" id="edit-brand-bnt">确认</button>
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

<script src="<?php echo RES; ?>brand/brand_list.js"></script>

