<h3 class="heading">修改密码</h3>
<style type="text/css">
    .controls strong{line-height:2;}	
</style>

<div class="row-fluid">
    <div class="span6">
        <form class="form-horizontal well" action="/member/change_password" method="post" id="change_password_form" onsubmit="return check();">
            <fieldset>
                <div class="form-group">
                    <label class="col-lg-2 control-label">旧密码</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="password" id="old-password" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="old-password-error" style="text-align: left;color: red;">
                        <?php if($old_msg) echo $old_msg;?>
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">新密码</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="password" id="password" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="password-error" style="text-align: left;color: red;">
                        <?php if($msg) echo $msg;?>
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-success" id="change_password" type="submit" >确认</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>

    $(function () {
        function  check() {
            var old_pwd = $("#old-password").val();
            var new_pwd = $("#password").val();
            var new_pwd_len = new_pwd.length;
            $("#old-password-error").text('');
            $("#password-error").text('');
            if (old_pwd === '') {
                $("#old-password-error").text('请输入旧密码！');
                return false;
            }
            if (new_pwd == '') {
                $("#password-error").text('请输入新密码！');
                return false;
            }
            if (new_pwd!='' && (new_pwd_len<6 || new_pwd_len>8)) {
                $("#password-error").text('新密码长度应在6-8位！');
                return false;
            }
            return true;
        }

    });

</script>

