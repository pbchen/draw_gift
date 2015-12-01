
$(document).ready(function () {
    //上架下架提示框
    $('#down-up-goods').modal({
        backdrop: 'static',
        show:false
    });
    
    var ajax_source = "/goods_manage/goods_list_page";
    //列表datatable
    var oTable = $('#goods_tb').dataTable({
        "sDom": "<'row'<'col-sm-6'f>r>t<'row'<'col-sm-2'<'dt_actions'>l><'col-sm-2'i><'col-sm-8'p>>",
        "sPaginationType": "bootstrap_alt",
        "bFilter": false, //禁止过滤
        "aaSorting": [[4, 'desc']], //默认排序
        "sAjaxSource": ajax_source,
        "bServerSide": true,
        "aoColumnDefs": [
            {
                "aTargets": [0, 1, 2, 3, 5, 6, 7, 8, 9, 10],
                "bSortable": false
            }
        ],
        "aoColumns": [
            {"mData": "checkbox"},
            {"mData": "g_name"},
            {"mData": "id"},
            {"mData": "status"},
            {"mData": "store_num"},
            {"mData": "sold_num"},
            {"mData": "c_name"},
            {"mData": "b_name"},
            {"mData": "s_name"},
            {"mData": "type"},
            {"mData": "oper"}
        ],
        "oLanguage": {
            "sLengthMenu": "显示 _MENU_ ",
            "sInfo": "展示第 _START_ 到 _END_ 共_TOTAL_",
            "sProcessing": "正在查询...",
            "sZeroRecords": "抱歉，没找到相关记录",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上一页",
                "sNext": "下一页",
                "sLast": "末页"
            },
        }
    });
    //查询
    $('button.search').die().live("click", function (e) {
        var oSettings = oTable.fnSettings();
        oSettings.sAjaxSource = ajax_source + getSearchParams();
        oTable.fnDraw();
    });
    //下载商品
    $("#download-goods").click(function () {
        var download_url = '/goods_manage/download_goods' + getSearchParams();
        window.open(download_url);
    });
    /**
     * 获取查询条件呢
     * @returns {String}
     */
    function getSearchParams() {
        var params;
        params = "?id=" + $("input[name=s_gid]").val()
                + "&name=" + encodeURIComponent($("input[name=s_gname]").val())
                + "&status=" + $("select[name=s_gstatus]").val()
                + "&type=" + $("select[name=s_gtype]").val()
                + "&supply=" + $("select[name=s_gsupply]").val()
                + "&classify=" + $("select[name=s_gclassify]").val()
                + "&brand=" + $("select[name=s_gbrand]").val();
        return params;
    }

    /**
     * 获取选中的商品id
     * @returns {Array}
     */
    function getCheckedIds() {
        var ids = [],
                checkedInput = $("tbody input[name=row_sel]:checked");
        for (var i = 0; i < checkedInput.length; i++) {
            ids.push(checkedInput[i].id);
        }
        return ids;
    }
    //商品下架
    $("a.down-up-goods").die().live('click', function (e) {
        e.preventDefault();
        var checkedIds = getCheckedIds();
        var upId = $(this).attr('id');
        var alertErrorInfo = '';
        var confirmInfo = '';
        var status;
        if(upId=='goods-down'){
            status = 2;
            alertErrorInfo = '请选择要下架的商品！';
            confirmInfo = '商品下架后前台将不再对用户显示，是否确认下架？';
        }else{
            status = 1; 
            alertErrorInfo = '请选择要上架架的商品！';
            confirmInfo = '是否确认上架？';
        }
        if (checkedIds.length < 1) {
            alertError("#alert-error", alertErrorInfo);
        } else {
            smoke.confirm(confirmInfo, function (e) {
                if (e) {
                    $.post('/goods_manage/update_goods?' + new Date().getTime(), {ids: checkedIds,status:status}, function (ret) {
                        var d = $.parseJSON(ret);
                        if (d.errCode==0) {
                            alertSuccess("#alert-success",'');
                            var oSettings = oTable.fnSettings();
                            oSettings.sAjaxSource = ajax_source + getSearchParams();
                            oTable.fnDraw();
                        } else {
                            alertError("#alert-error",d.msg);
                        }
                    });
                } else {
                }
            }, {ok: "确定", cancel: "取消"});
        }
    });
    
    //上下架操作
    function downUpOper(clickId){
        $("#down-up-goods").modal('show');
        var status = 1;
        if(clickId=='multiple-down'){
            status = 2;
        }
        $("#down-up-goods-bnt").die().live('click',function(){
            $(".alert-label-error").text('');
            var flag = true;
            var g_ids = $("textarea[name=g_ids]").val();
            var remark = $("textarea[name=g_remark]").val();
           if( g_ids=='' ){
               flag = flag & false;
               $("#gids-error").text('请填写商品ID');
           }
           if(remark==''){
               flag = flag & false;
               $("#remark-error").text('请填写备注！');
           }
           if(flag){
               $.post('/goods_manage/update_goods?',{ids:g_ids.split(","),status:status},function(ret){
                   var d = $.parseJSON(ret);
                   $("#down-up-goods").modal('hide');
                   if (d.errCode==0) {
                        alertSuccess("#alert-success",'');
                        var oSettings = oTable.fnSettings();
                        oSettings.sAjaxSource = ajax_source + getSearchParams();
                        oTable.fnDraw();
                    } else {
                        alertError("#alert-error",d.msg);
                    }
               });
           }
        });
    }
    //上架
    $("#multiple-up").click(function(){
        downUpOper('multiple-up');
    });
    //下架
    $("#multiple-down").click(function(){
        downUpOper('multiple-down');
    });

});


