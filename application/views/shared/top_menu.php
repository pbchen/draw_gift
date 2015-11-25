<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand pull-left" href="/member/index">爱礼物</a>
            <ul class="nav navbar-nav user_menu pull-right">
                <?php if($this->uc_service->is_login()):?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo RES; ?>img/user_avatar.png" alt="" class="user_avatar">
                        <?php echo $this->uc_service->get_user_nickname();?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="/member/index">我的个人信息</a></li>
                        <li><a href="/member/change_password">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="/login/logout">退出</a></li>
                    </ul>
                </li>
                <?php else:?>
                <li><a href="/login/login">登录</a></li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
