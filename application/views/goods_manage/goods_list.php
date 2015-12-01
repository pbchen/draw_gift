<!-- datatables -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/datatables/extras/TableTools/media/css/TableTools.css">
<link rel="stylesheet" href="<?php echo RES; ?>/common/common.css" />
<?php $this->load->view('shared/alert'); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">商品列表</h3>
        <div class="w-box-header">
            <div class="pull-left sort-disabled">
                <input name="s_gid" class="input-medium form-control" placeholder="商品id" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <input name="s_gname" class="input-medium form-control" placeholder="商品名称" type="text">
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_gstatus" class="select-medium form-control">
                    <option value="0">全部状态</option>
                    <option value="1">上架</option>
                    <option value="2">下架</option>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_gtype" class="select-medium form-control">
                    <option value="0">单品+组合</option>
                    <option value="1">单品</option>
                    <option value="2">组合</option>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_gsupply" class="select-medium form-control">
                    <option value="0">供应商</option>
                    <?php foreach($suppley as $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_gclassify" class="select-medium form-control">
                    <option value="0">分类</option>
                    <?php foreach($classify as $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-2">
                <select name="s_gbrand" class="select-medium form-control">
                    <option value="0">品牌</option>
                    <?php foreach($brand as $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="pull-left sort-disabled margin-left-6">
                <button class="btn btn-success label search">查询</button>
            </div>
        </div>
        <div class="empty"></div>
        <div class="w-box-header">
            <div class="pull-left sort-disabled">
                <a class="btn btn-success label" href="/goods_manage/add_goods">新建</a>
                <a class="btn btn-success label margin-left-2" id="download-goods">导出</a>
                <a class="btn btn-success label margin-left-2" id="multiple-down">批量下架</a>
                <a class="btn btn-success label margin-left-2 down-up-goods" id="goods-down">下架</a>
                <a class="btn btn-success label margin-left-2" id="multiple-up">批量上架</a>
                <a class="btn btn-success label margin-left-2 down-up-goods" id="goods-up">上架</a>
            </div>
        </div>
        <table class="table table-striped table-bordered dTableR" id="goods_tb">
            <thead>
                <tr>
                    <th class="table_checkbox center">
                        <input name="select_rows" class="select_rows" data-tableid="goods_tb" type="checkbox">
                    </th>
                    <th class="center">商品名称</th>
                    <th class="center">商品id</th>
                    <th class="center">状态</th>
                    <th class="center">库存</th>
                    <th class="center">售出</th>
                    <th class="center">供应商</th>
                    <th class="center">分类</th>
                    <th class="center">品牌</th>
                    <th class="center">组合形式</th>
                    <th class="center">操作&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

<script src="<?php echo RES; ?>goods_manage/goods_list.js"></script>

