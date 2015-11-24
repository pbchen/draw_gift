<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>爱礼物<?php if (isset($title)) echo '----' . $title ?></title>
        <!---加载头部------>
        <?php $this->load->view('shared/header'); ?> 
        <!---加载子头部------>
        <?php if ( isset($sub_header) ) $this->load->view($sub_header); ?>        
    </head>
    
    <body>
        <div id="loading_layer" style="display:none">
            <img src="<?php echo RES; ?>img/ajax_loader.gif" alt="客官别急，加载中..." />
        </div>
        <div id="maincontainer" class="clearfix">

            <?php $this->load->view('shared/top_menu'); ?>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    <?php echo $content_for_layout ?>
                </div>

                <div class="main_content">
                    <div style="text-align:center">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
                </div>
            </div>

            <?php $this->load->view('shared/sidebar'); ?>
            <?php $this->load->view('shared/footer'); ?>
            <?php if ( isset($sub_footer) ) $this->load->view($sub_footer);?> 		
        </div>
    </body>
</html>