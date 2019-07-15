<style type="text/css">
#tblProductStockList thead th{
	text-align: center;
	word-wrap: break-word;
	white-space: normal;
	padding-left:0px;
	padding-right:0px;
}	
</style>
<div class="content-wrapper">
<div class="col-md-12 set_med3">

<div class="col-md-5">
<div class="set_med2">
<table><tr><td>
	<label>Search</label></td></tr>

	<tr><td><input type="text" name="txtSearch" id="txtSearch" onkeyup="filterData()"></td></tr>
	<tr>
	<td><input type="radio" value="c" name="type" onclick="filterData();">Company
	<input type="radio" value="p" name="type" checked onclick="filterData();">Product</td></tr>
	</table>
</div>
<br>
     <div class="set_med4">
            <div class="set_med5">Product List</div>
            <table class="table table-bordered set_med6" id="tblProductList">
              <thead>
			    <th>Company Name</th>
                <th>Batch No.</th>
                <th>Product Name.</th>
                <th>Quantity</th>
                <th>Purchase Date</th>
                <th></th>
              </thead>
                <tbody> 
               </tbody>
              </table>
              </div>
              </div>

<div class="col-md-7 set_med" >
<div >
<div class="set_med7">
<i>Invoice Detail</i>
<div class="date pull-right set_med8"><input type="text" class="form-control" id="cash_invoice_date" name="cash_invoice_date" value="<?php echo date('Y-m-d');?>" readonly></div>
<input type="hidden" name="cash_invoice_time" id="cash_invoice_time" value="<?php echo date('h:i:s'); ?>">
</div>
<div class="text_fild set_med9">
   <input type="text" id="mobile_no" pattern="[0-9]{10}"  name="mobile_no" placeholder="Mobile Number" class="set_med12" onkeypress='return isNumberKey(event)' maxlength="12" requried><spam style="color:red;">*</spam>
</div>
<div class="text_fild set_med9">
   <input type="text" id="Name" name="Name" placeholder="Name" class="set_med12"><spam style="color:red;">*</spam>
</div>
<div class="text_fild set_med9">
   <textarea id="address" name="address" placeholder="Address" class="set_med12"></textarea><spam style="color:red;">*</spam>
</div>
<div class="text_fild set_med9">
   <select type="text" id="payment_type" name="payment_type" placeholder="Payment Type" class="set_med12">
      <option value="">Payment Type</option>
      <option value="Cash">Cash</option>
      <option value="Credit">Credit</option>
   </select><spam style="color:red;">*</spam>
</div>
<div class="text_fild set_med9">
   <input type="text" id="tin_no" name="tin_no" placeholder="TIN Number" class="set_med12">
</div>
</div>
<div  class="set_med1">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Stock</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered tab_mset" id="tblProductStockList">
                <thead>
                    <th>Sr.</th>
                    <th>Product</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Manage</th>
                </thead>
                 <tbody>
                </tbody>
              </table>
             </div>
            </div>
            <br>
           <!--  <div class="col-md-7"></div>
            <div class="col-md-2">Discount%</div>
            <div class="col-md-3"><input type="text" name=""></div> -->
            <!-- <div class="pull-right set_med10">Discount%&nbsp;<input type="text" name="txtDiscount" id="txtDiscount"></div> -->            
           <br><br>

            
          
          <div class=" pull-left set_med11">
  
        <button type="button" id="btnGenrateBill" class="btn btn-primary" onclick="genrateBill();">Generate Bill</button>
        
         <button type="button" id="btnReset" class="btn btn-danger" onclick="window.location.href='sales.php';">Cancel</button>
  </div>
          </div>
          </div>

<script type="text/javascript">
  $(document).ready(function(){
       $('#sidebar-toggle').trigger('click');
       filterData();
       $('#cash_invoice_date').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
       });
       $('#txtDiscount').keyup(function(){
           var val = $(this).val();
           if(isNaN(val)){
               val = val.replace(/[^0-9\.]/g,'');
               if(val.split('.').length>2) 
                   val =val.replace(/\.+$/,"");
           }
          $(this).val(val); 
      });
  });

  filterData = function(){
  	 ajaxloader.async = false;
     ajaxloader.load('ajax/cashinvoice.php',function(resp){
     	           ajaxloader.async = true;
                   var tr = "";
                   if(resp){
                     try{				   
						  resp = JSON.parse(resp); 
						  $('#tblProductList tbody').html('');
						  if(resp.error == '1'){
							 tr += "<tr><td colspan='6' align='center'>No record found!</td></tr>";
						  }
						  else
						  {
							  $.each(resp, function(index, item){
									   tr += "<tr>\
									           <td>"+item.company_name+"</td>\
											   <td>"+item.batch_no.substring(0,15)+"</td>\
											   <td>"+item.name.substring(0,15)+"</td>\
											   <td>"+item.quantity_in_stock+"</td>\
											   <td>"+item.perchaise_date+"</td>\
											   <td>\
													<input type='button' value='ADD' onclick='addIntoPurchaseStock(this)'>\
													<input type='hidden' value='"+JSON.stringify(item)+"'>\
											   </td>\
											</tr>";
							  });
						  }
						  $('#tblProductList tbody').html(tr);
					  }
					  catch(ex){}
                   }
                   else
                   {
                      $('#tblProductList tbody').html(tr);
                   }
         }, 
        null,
         {
           txtSearch:$('#txtSearch').val(),
           type:$("input[name='type']:checked").val()
        });
  }

  addIntoPurchaseStock = function(obj){
      var product = $(obj).parent().find('input[type=hidden]').val();
      var product = JSON.parse(product);
      var already_added = false;
      $('#tblProductStockList tbody tr').each(function(index){
           var company_name = $.trim($(this).find('td:eq(2)').html());
           var product_name = $.trim($(this).find('td:eq(1)').html());
           if(company_name == $.trim(product.company_name) && product_name == $.trim(product.name)){
                already_added = true;
                return false;
           }
      });
      if(already_added){
         alert('This product has been already added!');
         already_added = false;
         return false;
      }

      var myArr_product_type_uniform = product.product_type_uniform.split(',');
      var myArr_product_type_uniform_name = product.product_type_uniform_name.split(',');
      var options = '';
      for(var i=0;i<myArr_product_type_uniform.length;i++){
           options += '<option value="'+myArr_product_type_uniform[i]+'">'+myArr_product_type_uniform_name[i]+'</option>';
      }

      var tr = "<tr style='background-color:#b2b1b1;text-align:center;'> \
                    <td>"+($('#tblProductStockList tbody tr').length+1)+"</td>  \
                    <td style='word-wrap: break-word;white-space: normal;'>"+product.name+"<input type='hidden' name='product_id' value='"+product.id+"'></td>\
                    <td style='word-wrap: break-word;white-space: normal;'>"+product.company_name+"<input type='hidden' name='product_quantity_uni' value='"+product.quantity+"'></td>\
                    <td>"+product.product_type_name+"<input type='hidden' name='product_type_id' value='"+product.product_id+"'></td>\
                    <td style='padding:8px 3px;'>\
                       <select name='unit' style='width:100%;height:25px;' onchange='checkUniform(this);'>\
                          <option value=''>select</option>\
                           "+options+"\
                       </select>\
                     </td>\
                    <td><input type='text' name='quantity' style='width:75%;' onkeypress='return isNumberKey(event)' onblur='checkUniform(this);'><input type='hidden' name='hid_quantity_in_stock' value='"+product.quantity_in_stock+"' /></td>\
                    <td><input type='text' name='gross_total' id='gross_totalquantity' style='width:75%;'  readonly></td>\
                    <td><input type='text' name='discount' style='width:75%;' onkeypress='return isNumberKey(event)' onblur='checkUniform(this);'></td>\
                    <td><input type='text' name='total' id='totalquantity' style='width:75%;'  readonly></td>\
                    <td><input type='hidden' name='product_info' value='"+JSON.stringify(product)+"'><i class='fa fa-times' aria-hidden='true' onclick='removeCurrentRow(this)'></i></td>\
               </tr>";
      $('#tblProductStockList tbody').append(tr);
  }

   removeCurrentRow = function(obj){
         $(obj).parent().parent().remove();
         $('#tblProductStockList tbody tr').each(function(index){
             $(this).find('td:eq(0)').html(index+1);
         });
  } 

  genrateBill = function(){
      var select_unit = true;
      var enter_quantity = true;
      var bool_quantity = true;
      var select_unit_index, enter_quantity_index, bool_quantity_index;
      if($('#mobile_no').val() == ''){
           alert('Please enter Mobile No');
           $('#mobile_no').focus();
           return false;
      }
      if($('#Name').val() == ''){
           alert('Please enter name');
           $('#Name').focus();
           return false;
      }       
      if($('#tblProductStockList tbody tr').length<1){
         alert('Please add product');
         return false;
      }
      $('#tblProductStockList tbody select[name=unit]').each(function(index){
           if($(this).val() == ''){
               select_unit = false;
               select_unit_index = index;
               return false;
            }
      });
      if(!select_unit){
         alert('Please select unit');
         $('#tblProductStockList tbody tr').eq(select_unit_index).find('select[name=unit]').focus();
         select_unit = true;
         return false;
      }
      $('#tblProductStockList tbody input[name=quantity]').each(function(index){
           if($(this).val() == ''){
               enter_quantity = false; 
               enter_quantity_index = index;
               return false;
            }
      });
      if(!enter_quantity){
         alert('Please enter quantity');
         $('#tblProductStockList tbody tr').eq(enter_quantity_index).find('input[name=quantity]').focus();
         enter_quantity = true;
         return false;
      }
      $('#tblProductStockList tbody tr').each(function(index){
          var quantity = $(this).find('input[name=quantity]').val();
          var quantity_in_stock = $(this).find('input[name=hid_quantity_in_stock]').val();
          if(quantity>quantity_in_stock){
               bool_quantity = false;
               bool_quantity_index = index;
               return false;
          }
      });
      if(!bool_quantity){
      	  alert('Quantity should be less than or equal to product list quantity!');
      	  $('#tblProductStockList tbody tr').eq(bool_quantity_index).find('input[name=quantity]').focus();
          bool_quantity = true;
          return false;
      }
      var obj = {};
      obj.name = $('#Name').val();
      obj.cash_invoice_date = $('#cash_invoice_date').val();
      obj.cash_invoice_time = $('#cash_invoice_time').val();
     // obj.discount = $('#txtDiscount').val();
      obj.mobile_no = $('#mobile_no').val();
      obj.address = $('#address').val();
      obj.tin_no = $('#tin_no').val();
      obj.payment_type = $('#payment_type').val();
      obj.products = [];
      $('#tblProductStockList tbody tr').each(function(){
             var product_info = $(this).find('input[name=product_info]').val();
             product_info = JSON.parse(product_info);
             product_info.unit = $(this).find('select[name=unit]').val();
             product_info.quantity = $(this).find('input[name=quantity]').val();
             product_info.total = $(this).find('input[name=total]').val();
             product_info.discount = $(this).find('input[name=discount]').val();
             product_info.gross_total  = $(this).find('input[name=gross_total]').val();
             ajaxloader.async = false;
             ajaxloader.load('ajax/cash_cal.php?product_uniform='+$(this).find('select[name=unit]').val()+'&quantity='+$(this).find('input[name=quantity]').val()+'&product_id='+$(this).find('input[name=product_id]').val()+'&product_total='+$(this).find('input[name=total]').val(),function(resp){  
             ajaxloader.async = true;
             var demo = resp;
             product_info.product_batch = demo;
             obj.products.push(product_info);
          });
      });
      ajaxloader.async = false;
      ajaxloader.load('ajax/save_sales.php?product_data='+JSON.stringify(obj),function(resp){ 
      	  ajaxloader.async = true;
      });
      Service_Store.setLocal('purchase_stock_product_list', JSON.stringify(obj));
      window.location.href = 'cashinvoice_bill.php';
  }
  checkUniform = function(obj){
     if($(obj).parent().parent().find('select[name=unit]').val() == ''){
         alert('Please select unit first');
         $(obj).val('');
         $(obj).parent().parent().find('select[name=unit]').focus();
         return false;
     }
     else
     {
        if($(obj).val() != ''){
        	ajaxloader.async = false;
            ajaxloader.load('ajax/cashinvoice.php?opt=total_calc&product_uniform='+$(obj).parent().parent().find('select[name=unit]').val()+'&quantity='+$(obj).parent().parent().find('input[name=quantity]').val()+'&product_id='+$(obj).parent().parent().find('input[name=product_id]').val()+'&product_type_id='+$(obj).parent().parent().find('input[name=product_type_id]').val()+'&product_qty_uni='+$(obj).parent().parent().find('input[name=product_quantity_uni]').val()+'&product_discount='+$(obj).parent().parent().find('input[name=discount]').val()+'&product_total='+$(obj).parent().parent().find('input[name=gross_total]').val(),function(resp){
            	ajaxloader.async = true;
           var resp = JSON.parse(resp);
           totalquantity = resp['total'];	
           type = resp['type'];
           gross_amount = resp['gross_total'];
           if(type=='gross_total')
           {
                $(obj).parent().parent().find('input[name=gross_total]').val(totalquantity);
                $(obj).parent().parent().find('input[name=total]').val(totalquantity); 
            }
           else  
           {   
              $(obj).parent().parent().find('input[name=gross_total]').val(gross_amount);
              $(obj).parent().parent().find('input[name=total]').val(totalquantity);
            }		
      });			
		}
		
     }
  }

  function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
   }
</script>