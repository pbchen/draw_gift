<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<?php $this->load->view('shared/upload-file-css'); ?>
<?php $this->load->view('shared/alert'); ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">新建客户</h3>
        <form class="form-horizontal" id="fileupload">
            <fieldset>
                <div class="form-group">
                    <label for="a_name" class="control-label col-sm-2">客户名称</label>
                    <div class="col-sm-2">
                        <input name="a_name" id="a_name" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <label for="a_type" class="control-label col-sm-1">客户类型</label>
                    <div class="col-sm-2">
                        <select name="a_type" id="a_type" data-placeholder="选择类型..." class="chzn_a form-control">
                            <option value="1" selected="selected">代理商</option>
                            <option value="2">企业大客户</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_contact_person" class="control-label col-sm-2">联系人</label>
                    <div class="col-sm-2">
                        <input name="a_contact_person" id="a_contact_person" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <label for="a_phone" class="control-label col-sm-1">联系电话</label>
                    <div class="col-sm-2">
                        <input name="a_phone" id="a_phone" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_postcode" class="control-label col-sm-2">邮编</label>
                    <div class="col-sm-2">
                        <input name="a_postcode" id="a_postcode" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <label for="a_email" class="control-label col-sm-1">邮箱</label>
                    <div class="col-sm-2">
                        <input name="a_email" id="a_email" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_address" class="control-label col-sm-2">地址</label>
                    <div class="col-sm-5">
                        <input name="a_address" id="a_address" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_remark" class="control-label col-sm-2">备注</label>
                    <div class="col-sm-5">
                        <textarea name="a_remark" id="a_remark" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-5"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="add-giftbook-ok">完成</div>
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

<?php $this->load->view('shared/upload-file'); ?>

<script>
    $(document).ready(function () {
        $(".chzn_a").chosen({
            allow_single_deselect: true
        });
        //成功提示框设置
        $('#alert-success').modal({
            backdrop: false,
            show:false
        });
        
        $("#add-giftbook-ok").die().live('click',function(){
            var flag = true;
            var name = $("#a_name").val();
            var type = $('#a_type').val();     
            var contact_person = $("#a_contact_person").val(); //联系人
            var phone = $("#a_phone").val();    
            var postcode = $("#a_postcode").val();   //邮编
            var email = $("#a_email").val();
            var address = $("#a_address").val();
            var remark = $("#a_remark").val();
            var is_mobile = /^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/;   
            var is_phone = /^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/;
            var is_email =  /^[a-z0-9-\_]+[\.a-z0-9_\-]*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/;
            if(name=='' || name==undefined){
                flag = flag & false;
                alertError("#alert-error",'客户名称不能为空！');
                return ;
            }
            if(contact_person=='' || contact_person==undefined){
                flag = flag & false;
                alertError("#alert-error",'联系人不能为空！');
                return ;
            }
            if(phone=='' ||( !is_phone.test(phone) && !is_mobile.test(phone))){
                flag = flag & false;
                alertError("#alert-error",'请填写正确的手机号！');
                return ;
            }
            if(email=='' || !is_email.test(email)){
                flag = flag & false;
                alertError("#alert-error",'请填写正确的邮箱！');
                return ;
            }
            if(postcode=='' || postcode.length<6){
                flag = flag & false;
                alertError("#alert-error",'请填写正确的邮编！');
                return ;
            }            
            if(address=='' || address==undefined){
                flag = flag & false;
                alertError("#alert-error",'地址不能为空！');
                return ;
            }
            if(flag){
                $.post('/customer_manage/add_customer',
                {
                    name:name,contact_person:contact_person,type:type,
                    phone:phone,postcode:postcode,email:email,
                    address:address,remark:remark
                },function(ret){
                    var d = $.parseJSON(ret);
                    if(d.errCode==0){
                        alertSuccess("#alert-success",'/customer_manage/add_customer');
                    }else{
                        alertError("#alert-error",d.msg);
                    }
                });
            }
            
        });
    });
</script>
