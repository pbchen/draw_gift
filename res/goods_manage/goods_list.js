
$(document).ready(function () {
    var ajax_source = "/goods_manage/goods_list_page";
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
        oSettings.sAjaxSource = ajax_source
        + "?id="+$("input[name=s_gid]").val()
        +"&name="+encodeURIComponent($("input[name=s_gname]").val())
        +"&status="+$("select[name=s_gstatus]").val()
        +"&type="+$("select[name=s_gtype]").val()
        +"&supply="+$("select[name=s_gsupply]").val()
        +"&classify="+$("select[name=s_gclassify]").val()
        +"&brand="+$("select[name=s_gbrand]").val();
        oTable.fnDraw();

    });
});


