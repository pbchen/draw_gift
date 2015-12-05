<!-- datatables -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/datatables/extras/TableTools/media/css/TableTools.css">
<link rel="stylesheet" href="<?php echo RES; ?>/common/common.css" />
<?php $this->load->view('shared/alert'); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">礼册列表</h3>
        <div class="w-box-header">
            <div class="pull-left sort-disabled margin-left-2">
                <input name="s_name" class="input-medium form-control" placeholder="礼册名称" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <input name="s_id" class="input-medium form-control" placeholder="礼册id" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_status" class="select-medium form-control">
                    <option value="0">全部状态</option>
                    <option value="1">启用</option>
                    <option value="2">停用</option>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_theme" class="select-medium form-control">
                    <option value="0">全部主题</option>
                    <?php foreach($theme as $v):?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_set" class="select-medium form-control">
                    <option value="0">全部系列</option>
                    <?php foreach($set as $v):?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_type" class="select-medium form-control">
                    <option value="0">全部类型</option>
                    <option value="1">普通卡</option>
                    <option value="2">年卡</option>
                    <option value="3">半年卡</option>
                    <option value="4">季卡</option>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-6">
                <button class="btn btn-success label search">查询</button>
            </div>
        </div>
        <div class="empty"></div>
        <div class="w-box-header">
            <div class="pull-left sort-disabled">
                <a class="btn btn-success label" href="/giftbook_manage/add_giftbook">新建</a>
                <a class="btn btn-success label margin-left-2" id="stop-giftbook">停用</a>
                <a class="btn btn-success label margin-left-2" id="start-giftbook">启用</a>
            </div>
        </div>
        <table class="table table-striped table-bordered dTableR" id="giftbook_tb">
            <thead>
                <tr>
                    <th class="table_checkbox center">
                        <input name="select_rows" class="select_rows" data-tableid="giftbook_tb" type="checkbox">
                    </th>
                    <th class="center">名&nbsp;&nbsp;称</th>
                    <th class="center">id</th>
                    <th class="center">状&nbsp;&nbsp;态</th>
                    <th class="center">价&nbsp;&nbsp;格</th>
                    <th class="center">主&nbsp;&nbsp;题</th>
                    <th class="center">系&nbsp;&nbsp;列</th>
                    <th class="center">商品数量</th>
                    <th class="center">礼册类型</th>
                    <th class="center">&nbsp;&nbsp;操作&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody class="center">

            </tbody>        
        </table>
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

<script src="<?php echo RES; ?>giftbook/giftbook_list.js"></script>

