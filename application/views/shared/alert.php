<style>
    div.modal-content{max-width: 320px;max-height: 240px;margin-top: 40%;margin-left: 30%;}
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
<script>
    var stime = null;
    var ltime = null;
    function alertError(obj,msg){
        $(obj).find('.modal-body').text(msg);
        $(obj).modal('show');
    }
    
    function alertSuccess(obj,href){
        $(obj).modal('show');
        clearTimeout(stime);
        clearTimeout(ltime);
        stime = setTimeout(function(){
            $(obj).modal('hide');
        },800);
        if(href!=''){
            ltime = setTimeout(function(){
                window.location.href = href;
            },900);
        }
    }
    
</script>

