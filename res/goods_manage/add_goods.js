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
            $("label.g-unit").removeClass('col-sm-2');
            $("label.g-unit").addClass('col-sm-1');
        } else {
            $("div.goods-single-own").hide();
            $("div.goods-multiple-own").show();
            $("label.g-unit").removeClass('col-sm-1');
            $("label.g-unit").addClass('col-sm-2');
        }
    });
    
    $("span.delete").die().live('click',function(){
        $(this).parent().remove();
    })

    $("#add-goods-ok").die().live('click', function () {
        var flag = true;
        var g_name = $("#g_name").val();
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
            $.post('/goods_manage/add_goods',
                    {
                        name: g_name, groupid: g_ids, type: g_type, classify_id: g_classify,
                        brand_id: g_brand, supply_id: g_supplier, sale_price: g_price,
                        buy_price: g_cost, store_num: g_inventory, deliver_id: g_deliver,
                        munit: g_unit, desciption: g_description, remark: g_remark,
                        pic_ids: pic_ids
                    }, function (ret) {
                var d = $.parseJSON(ret);
                if (d.errCode == 0) {
                    alertSuccess("#alert-success", '/goods_manage/add_goods');
                } else {
                    alertError("#alert-error", d.msg);
                }
            });
        }

    });
});

