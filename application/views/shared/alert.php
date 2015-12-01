<style>
    div.modal-content{max-width: 320px;max-height: 240px;margin-top: 40%;margin-left: 30%;}
    .table>tbody>tr>td.center{text-align: center;vertical-align: middle;}
    .alert-label-error{text-align: left;color: red;}
    .table>tbody>tr>td.alert-label-error{text-align: left;min-width: 60px;}
    div.modal-body>.table>tbody>tr>td{border: 0px;background-color: white;}
    #modal-max-content{max-width: 720px;max-height: 420px;margin-top: 20%;margin-left: 10%;}
</style>
<div class="modal fade" id="alert-error">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">错误提示：</h3>
            </div>
            <div class="modal-body">
                商品名称不能为空！
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alert-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <h3 class="modal-title" style="text-align: center;">操作成功！</h3>
            </div>
        </div>
    </div>
</div>
<!---------批量上下架弹层---------->
<div class="modal fade" id="down-up-goods">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-max-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">批量下架</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="center">商品id</td>
                            <td>
                                <textarea name="g_ids" cols="6" rows="2" class="form-control"></textarea>
                            </td>
                            <td class="alert-label-error center" id="gids-error"></td>
                        </tr>
                        <tr>
                            <td class="center">备注</td>
                            <td>
                                <textarea name="g_remark" id="g_remark" cols="6" rows="3" class="form-control"></textarea>
                            </td>
                            <td class="alert-label-error center" id="remark-error"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="center">
                                <button type="button" class="btn btn-success" id="down-up-goods-bnt">确认</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var stime = null;
    var ltime = null;
    function alertError(obj, msg) {
        $(obj).find('.modal-body').text(msg);
        $(obj).modal('show');
    }

    function alertSuccess(obj, href) {
        $(obj).modal('show');
        clearTimeout(stime);
        clearTimeout(ltime);
        stime = setTimeout(function () {
            $(obj).modal('hide');
        }, 800);
        if (href != '') {
            ltime = setTimeout(function () {
                window.location.href = href;
            }, 900);
        }
    }
</script>

