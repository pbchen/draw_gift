<h3 class="heading">修改密码</h3>
<style type="text/css">
    .controls strong{line-height:2;}	
</style>

<div class="row-fluid">
    <div class="span6">
        <form class="form-horizontal well">
            <fieldset>
                <div class="form-group">
                    <label class="col-lg-2 control-label">旧密码</label>
                    <div class="col-sm-3 col-md-3">
                        <input type="password" id="old-password" class="form-control"/>
                    </div>
                    <label class="col-lg-2 control-label" id="password-error" style="text-align: left;color: red;">
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
                        <button class="btn btn-success" id="change_password" type="button" >确认</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>

    $(function () {
        function  check() {
            var pwd = $("#password").val();
            var newpwd = $("#newpwd").val();
            var newpassword = $("#newpassword").val();
            if (pwd === '') {
                return false;
            }
            if (newpwd == '') {
                return false;
            }
            if (newpwd != newpassword) {
                return false;
            }
            return true;
        }

    });

</script>

