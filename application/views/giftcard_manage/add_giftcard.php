<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<?php $this->load->view('shared/upload-file-css'); ?>
<?php $this->load->view('shared/alert'); ?>
<style type="text/css">
	.add_gift_list_tb{
		margin-left: 35px;
	}
	.add_gift_list_tb button{
		margin: 10px 0;
	}
	.add_gift_list_tb table th,.add_gift_list_tb table td{
		text-align: center;
	}
	.add_card{
		padding-left: 20px;
		padding-right: 20px;
	}
	.gift_price{
		width:100px
	}
	.modal-body center{
		text-align: right;
	}
	.del_gift_list{
		cursor: pointer;
	}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">礼册下单</h3>
        <div class="form-horizontal" id="fileupload">
            <fieldset>
                
                <div class="form-group">
                    
                    <label for="a_salename" class="control-label col-sm-2">销售员</label>
                    <div class="col-sm-2">
                        <select name="a_salename" id="a_salename" data-placeholder="选择销售员" class="chzn_a form-control">
                            <option value="1" selected="selected">李家俊1</option>
                            <option value="2">李家俊1</option>
                            <option value="3">李家俊1</option>
                            <option value="4">李家俊1</option>
                        </select>
                    </div>
                    
                    <label for="a_trade_date" class="control-label col-sm-1">交易日期</label>
                    <div class=" col-sm-2">
						<input class="form-control" readonly id="a_trade_date" type="text" value="2016-05-01">
					</div>
                    
                </div>
                
                <div class="form-group">
                    <label for="a_customer" class="control-label col-sm-2">客户名称</label>
                    <div class="col-sm-2">
                    	<select name="a_customer" id="a_customer" data-placeholder="选择销售员" class="chzn_a form-control">
                            <option value="1" selected="selected">李家俊1</option>
                            <option value="2">李家俊1</option>
                            <option value="3">李家俊1</option>
                            <option value="4">李家俊1</option>
                        </select>
                    </div>

                    <label for="a_enduser" class="control-label col-sm-1">最终用户</label>
                    <div class="col-sm-2">
                        <input name="a_enduser" id="a_enduser" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="a_contact_person" class="control-label col-sm-2">联系人</label>
                    <div class="col-sm-2">
                        <input name="a_contact_person" id="a_contact_person" class="input-xlarge form-control" value="" type="text">
                    </div>
                    
                    
                    <label for="a_telephone" class="control-label col-sm-1">电话</label>
                    <div class="col-sm-2">
                        <input name="a_telephone" id="a_telephone" class="input-xlarge form-control" value="" type="text">
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label for="a_address" class="control-label col-sm-2">地址</label>
                    <div class="col-sm-5">
                        <input name="a_address" id="a_address" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="a_expiration_date" class="control-label col-sm-2">失效日期</label>
                    <div class=" col-sm-2">
						<input class="form-control" id="a_expiration_date" type="text" value="2016-05-01" readonly>
					</div>
                </div>
                
                <div class="form-group">
                	<label for="a_wx_template" class="control-label col-sm-2">微信模板</label>
                    <div class="col-sm-2">
                        <select name="a_wx_template" id="a_wx_template" data-placeholder="选择微信模板" class="chzn_a form-control">
                            <option value="1" selected="selected">模板1</option>
                            <option value="2">模板1</option>
                            <option value="3">模板1</option>
                            <option value="4">模板1</option>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="a_remark" class="control-label col-sm-2">礼册备注</label>
                    <div class="col-sm-5">
                        <textarea name="a_remark" id="a_remark" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                
                
		<div class="form-group">
			 <label class="control-label col-sm-1"></label>
			 <div class="add_gift_list_tb col-sm-6">
			 	<button class="btn btn-info add_card">增加</button>
			 	<table class="table table-striped table-bordered " id="add_gift_list_tb">
		            <thead>
		                <tr>
		                    <th class="center">礼品册名称</th>
		                    <th class="center">单价</th>
		                    <th class="center">折扣</th>
		                    <th class="center">开始号码</th>
		                    <th class="center">结束号码</th>
		                    <th class="center">数量</th>
		                    <th class="center">操作</th>
		                </tr>
		            </thead>
		            <tbody class="center">
						<tr class="odd">
							<td class="">新春赠礼礼册</td>
							<td class="">688.00</td>
							<td class="">5</td>
							<td class="">10000000</td>
							<td class=" sorting_1">10000003</td>
							<td class="">4</td>
							<td class=""><a rel="1" class="del_gift_list">删除</a></td>
						</tr>
		            </tbody>        
		        </table>
			 </div>
			
		</div>   
                
                
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-5"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="add-giftbook-ok1">完成</div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    
    
    
    <!---------新建弹层---------->
<div class="modal fade" id="add-card-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-max-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">增加礼册</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped">
                    <tbody>
                        <tr>
                            <td class="center">选择礼册</td>
                            <td>
                               <select name="giftBook" id="giftBook" data-placeholder="选择礼册" class="chzn_a form-control">
		                            <option value="1" selected="selected">模板1</option>
		                            <option value="2">模等等等等等等板1</option>
		                            <option value="3">模板1</option>
		                            <option value="4">模板1</option>
		                        </select>
                            </td>
	                        <td class="alert-label-error center"></td>
                        </tr>
                        <tr>
                            <td class="center">单价</td>
                            <td>
                            	<span class="form-control gift_show_price">
                            		10.00
                            	</span>
                            </td>
                            <td class="alert-label-error center" ></td>
                        </tr>
                        
                        <tr>
                            <td class="center">折扣</td>
                            <td>
                            	<input name="discount" id="discount" class="input-xlarge form-control" value="" type="text">
                            </td>
                            <td class="alert-label-error center"></td>
                        </tr>
                        
                        <tr>
                            <td class="center">开始号码</td>
                            <td>
                            	<input name="start_num" id="start_num" class="input-xlarge form-control" value="" type="text">
                            </td>
                            <td class="alert-label-error center"></td>
                        </tr>
                        
                        <tr>
                            <td class="center">结束号码</td>
                            <td>
                            	<input name="end_num" id="end_num" class="input-xlarge form-control" value="" type="text">
                            </td>
                            <td class="alert-label-error center"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="3" class="center">
                                <button type="button" class="btn btn-success" id="add-gift-btn">确认</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
var giftArr = [];
    $(document).ready(function () {
    	//添加提示框
    	$('#add-card-modal').modal({
	        backdrop: 'static',
	        show: false
	    });
	    
	    //新建
	    $(".add_card").click(function(){
	        $("#add-card-modal").modal('show');
	        $('#giftBook').change(function(){
	        	$('.gift_show_price').html(13)
	        })
	        $("#add-gift-btn").die().live('click',function(){
	            $(".alert-label-error").text('');
	            var flag = true;
	            
	            var giftBook = $('#giftBook');
	            var discount = $('#discount');
	            var start_num = $('#start_num');
	            var end_num = $('#end_num');
	            var giftBookPrice = $('.gift_show_price');
	            var isNum = /^[0-9]*$/;
	            if( giftBook.val() == '' ){
	            	flag = flag & false;
	            	giftBook.parents('tr').find('.alert-label-error').html('请填写选择礼册');
				}
	            
	            if( discount.val() == '' || !isNum.test( discount.val() )  ){
	            	flag = flag & false;
	            	discount.parents('tr').find('.alert-label-error').html('请填写正确的折扣');
				}
	            
	            if( start_num.val() == '' || !isNum.test( start_num.val() ) ){
	            	flag = flag & false;
	            	start_num.parents('tr').find('.alert-label-error').html('请填写正确的开始号码');
				}
				
	            if( end_num.val() == '' || !isNum.test( end_num.val() ) ){
	            	flag = flag & false;
	            	end_num.parents('tr').find('.alert-label-error').html('请填写正确的结束号码');
				}
	            
	           if(flag){
	               var gift_json = {};
	               
	               gift_json.giftBookId = giftBook.val();
	               gift_json.giftBookTxt = $('.modal-body [value="'+giftBook.val()+'"]').html();
	               gift_json.gift_price = $.trim(giftBookPrice.html());
	               gift_json.discount = $.trim(discount.val());
	               gift_json.start_num = $.trim(start_num.val());
	               gift_json.end_num = $.trim(end_num.val());
	               gift_json.num = Number(gift_json.end_num)- Number(gift_json.start_num);
	               giftArr.push(gift_json);
	               
	               rendGiftList();
	               $("#add-card-modal").modal('hide');
	           }
	        });
	    })
	    
	    function inArray(arr,id){
	    	var datakey = -1;
	    	$(arr).each(function( key,val ){
	    		if( val.giftBookId == id ){
	    			datakey = key;
	    		}
	    	})
	    	return datakey;
	    }
	    
	    
	    
	    function rendGiftList(){
	    	var tdStr = '';
	    	$(giftArr).each(function( key,val ){
	    		tdStr+='<tr id="'+val.giftBookId+'">'
	    		tdStr+='<td>'+val.giftBookTxt+'</td>'
	    			+'<td>'+val.gift_price+'</td>'
	    			+'<td>'+val.discount+'</td>'
	    			+'<td>'+val.start_num+'</td>'
	    			+'<td>'+val.end_num+'</td>'
	    			+'<td>'+val.num+'</td>'
	    			+'<td class=""><a rel="1" class="del_gift_list">删除</a></td>'
    			tdStr+='</tr>'
	    	})
	    	$('#add_gift_list_tb tbody').html(tdStr);
	    	
	    	
	    	$('.del_gift_list').off('click').click(function(){
		    	var tr = $(this).parents('tr');
		    	var id = tr.attr('id');
		    	var inkey = inArray(giftArr,id);
		    	if( inkey != -1 ){
		    		giftArr.splice(inkey,1);
		    	}
		    	 rendGiftList();
		    })
	    }
	    
    	
    	

    	$('#a_trade_date').datepicker({
    		 minDate: new Date(),
    		 dateFormat:"yy-mm-dd"
    	});
    	$('#a_expiration_date').datepicker({
    		minDate: new Date(),
    		dateFormat:"yy-mm-dd"
    	});
    	
        $(".chzn_a").chosen({
            allow_single_deselect: true
        });
        //成功提示框设置
        $('#alert-success').modal({
            backdrop: false,
            show:false
        });
        
        $("#add-giftbook-ok1").die().live('click',function(){
            var flag = true;
            var a_salename = $("#a_salename").val();
            var a_trade_date = $('#a_trade_date').val();
            var a_customer = $('#a_customer').val();
            var a_contact_person = $('#a_contact_person').val();
            var a_telephone = $('#a_telephone').val();
            var a_address = $('#a_address').val();
            var a_expiration_date = $('#a_expiration_date').val();
            var remark = $("#a_remark").val();
            var is_mobile = /^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/;   
            var is_phone = /^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/;
            
            
            if(a_salename=='' || a_salename==undefined){
                flag = flag & false;
                alertError("#alert-error",'销售员不能为空！');
                return ;
            }
            if(a_trade_date=='' || a_trade_date==undefined){
                flag = flag & false;
                alertError("#alert-error",'交易日期不能为空！');
                return ;
            }
            
            if(a_expiration_date=='' || a_expiration_date==undefined){
                flag = flag & false;
                alertError("#alert-error",'交易日期不能为空！');
                return ;
            }
            
            if(a_customer==''||a_customer==undefined){
                flag = flag & false;
                alertError("#alert-error",'请选择客户！');
                return ;
            }
            
            if(a_contact_person=='' || a_contact_person==undefined){
                flag = flag & false;
                alertError("#alert-error",'联系人不能为空！');
                return ;
            }
            
            
            if(a_telephone=='' || (!is_phone.test(a_telephone) && !is_mobile.test(a_telephone)  )){
                flag = flag & false;
                alertError("#alert-error",'请输入正确的电话！');
                return ;
            }
            
            if(a_address=='' || a_address==undefined){
                flag = flag & false;
                alertError("#alert-error",'地址不能为空！');
                return ;
            }
            if(remark=='' || remark==undefined){
                flag = flag & false;
                alertError("#alert-error",'地址不能为空！');
                return ;
            }
            
            if( !giftArr.length ){
            	flag = flag & false;
            	alertError("#alert-error",'请添加礼品册！');
                return ;
            }
           
           
            if(flag){
                $.post('/giftbook_manage/add_giftbook',
                {
                    salename:a_salename,
                    trade_date:a_trade_date,
                    customer:a_customer,
                    contact_person:a_contact_person,
                    telephone:a_telephone,
                    address:a_address,
                    expiration_date:a_expiration_date,
                    remark:remark,
                    giftArr:giftArr
                },function(ret){
                    var d = $.parseJSON(ret);
                    if(d.errCode==0){
                        alertSuccess("#alert-success",'/giftbook_manage/add_giftbook');
                    }else{
                        alertError("#alert-error",d.msg);
                    }
                });
            }
            
        });
    });
</script>
