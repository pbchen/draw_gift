<h3 class="heading">修改资料</h3>
<style type="text/css">
    .controls strong{line-height:2;}	
</style>

<div class="row-fluid">
    <div class="span6">
        <form class="form-horizontal well" name="form" action="/member/change_info" method="post" onSubmit="return check();">
            <fieldset>
                <div class="form-group">
                    <label class="col-lg-2 control-label">账号：</label>
                    <div class="col-sm-3 col-md-3">
                        <?php echo $user['user_name'];?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">姓名：</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" name="nick_name" value="<?php echo $user['nick_name'];?>" id="nick_name" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="nick_name-error" style="text-align: left;color: red;">

                    </label>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">手机：</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" name="phone" value="<?php echo $user['phone'];?>" id="phone" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="phone-error" style="text-align: left;color: red;">

                    </label>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">邮箱：</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" name="email" value="<?php echo $user['email'];?>" id="email" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="email-error" style="text-align: left;color: red;">

                    </label>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-success" id="change_info" type="submit" >确认</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
    function  check() {
        var nick_name = $("#nick_name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var nick_name_len = nick_name.length;
        var is_mobile = /^(?:13\d|15\d)\d{5}(\d{3}|\*{3})$/;   
        var is_phone = /^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/;
        var is_email =  /^[a-z0-9-\_]+[\.a-z0-9_\-]*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/;
        
        $("#nick_name-error").text('');
        $("#phone-error").text('');
        $("#email-error").text('');
        if (nick_name === ''|| nick_name_len<4 || nick_name_len>10) {
            $("#nick_name-error").text('请输入4-10位字符的姓名！');
            return false;
        }
        if (phone == '' ||(!is_mobile.test(phone) && !is_phone.test(phone))) {
            $("#phone-error").text('请输入正确的电话！');
            return false;
        }
        if (email == '' || !is_email.test(email)) {
            $("#email-error").text('请输入正确的邮箱！');
            return false;
        }
        return true;
    }
</script>

