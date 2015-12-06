<!-- sidebar -->
<a href="javascript:void(0)" class="sidebar_switch on_switch bs_ttip" data-placement="auto right" data-viewport="body" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">

    <div class="">
        <div class="sidebar_inner">
            <div id="side_accordion" class="panel-group">
                <?php foreach( $this->config->item('gift_navigation') as $nav_itme):?>
                    <?php if( nav_item_display($nav_itme['display_role'],$this->uc_service->get_user_role()) ):?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="#<?php echo $nav_itme['collapse']?>" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                    <?php if($nav_itme['is_home']):?>
                                    <i class="glyphicon glyphicon-user"></i>
                                    <?php else:?>
                                    <i class="glyphicon glyphicon-folder-close"></i>
                                    <?php endif;?>
                                    <?php echo $nav_itme['title'];?>
                                </a>
                            </div>
                            <div class="accordion-body collapse <?php if($this->uri->segment(1) == $nav_itme['self_url']) echo 'in';?>" 
                                 id="<?php echo $nav_itme['collapse']?>" <?php if($this->uri->segment(1) == $nav_itme['self_url']) echo 'aria-expanded="true"';?>>
                                <div class="panel-body">
                                    <?php if($nav_itme['sub_nav']):?>
                                    <ul class="nav nav-pills nav-stacked">
                                        <?php foreach($nav_itme['sub_nav'] as $sub_nav):?>
                                            <?php if( nav_item_display($sub_nav['display_role'],$this->uc_service->get_user_role()) ):?>
                                            <li <?php if($this->uri->segment(2) == $sub_nav['self_url']) echo' class="active"' ?>>
                                                <a href="<?php echo '/'.$nav_itme['self_url'].'/'.$sub_nav['self_url'];?>"><?php echo $sub_nav['title']?></a>
                                            </li>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </ul>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
                

            <div class="push"></div>
        </div>

    </div>

</div>

