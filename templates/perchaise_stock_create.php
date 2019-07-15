<form class="form-horizontal" id="frm_purchase_stock" name="frm_purchase_stock">
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ADD Product</h3>
               <a style="color: #FFF;" href="perchaise_stock.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                Purchase Stock List
              </div></a>
            </div>
            <div  id="email_error"></div>
           <div class="col-sm-12">
              <div class="box-body">
                <div class="">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $ln_bill_nmbr;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="bill_number" name="bill_number" placeholder="Bill Number">
                  </div>
                </div>
                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_name;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                  </div>
                </div>
                
                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_mobile;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" pattern="[0-9]{10}" onkeypress='return isNumberKey(event)' id="mobile" name="mobile" placeholder="Mobile" maxlength="12" required>
                  </div>
                </div>
             </div>

                <div class="col-sm-12">
                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_product;?></label>
                  
                  <div class="col-sm-2">
                   <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product" value="" readonly>
                   <input type="hidden" name="product_id" id="product_id">
                   <input type="hidden" name="product_uniform" id="product_uniform">
                   </div>

                  <div id="product_display"> 
                  </div> 
                  <div class="pull-left">
                  </div>                 
                </div>

                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_address;?></label>

                  <div class="col-sm-2">
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Address"></textarea>
                  </div>
                </div>
                

                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_cost_price;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="cost_price" name="cost_price" placeholder="Cost Price">
                  </div>
                </div>
                </div>

              <br>
               <div class="col-sm-12"  style="margin-top: 12px;">
                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_mrp;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="mrp" name="mrp" placeholder="MRP">
                  </div>
                </div>

                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_quantity_unifrom;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="quantity_uniform" name="quantity_uniform" placeholder="No of Strip/Voil">
                  </div>
                </div>

                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_batch_nmbr;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="batch_nmbr" name="batch_nmbr" placeholder="Batch Number">
                  </div>
                </div>
              
              </div>
             <div class="col-sm-12 msr_set" style="margin-top: 12px;">
             <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_perchaise_date;?></label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="perchaise_date" value="<?php echo date('Y-m-d'); ?>" name="perchaise_date" placeholder="Perchaise Date" readonly>
                  </div>
                </div>
                <div class="" >
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_expire_date;?></label>
                  <input type="hidden" name = "current_date" value="<?php echo date("Y-m-d h:i:s"); ?>">
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="expire_date" name="expire_date" placeholder="Expire Date" readonly><br>
                  </div>
                </div>
                  
                <div class="">
                  <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>

                  <div class="col-sm-2">
                   <button type="button" id="btnAdd" class="btn btn-info" style="width:100px;">Add</button> 
                  </div>
                </div>
                  
                </div>
              </div>           
          </div>
        </div>
        </div>
            <div class="col-md-12" style="display:none;" id="div_product_info">
            <div class="box">
               <div class="box-body">
                  <table class="table table-bordered" id="tblProuct">
                    <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Product</th>
                        <th>Batch</th>
                        <th>Cost</th>
                        <th>MRP</th>
                        <th>Quantity</th>
                        <th>Purchase Date</th>
                        <th>Exp. Date</th>
                        <th>&nbsp;</th>
                    </tr> 
                    </thead>
                    <tbody>
                         
                    </tbody>
                  </table>
              </div>
            </div>
             <button type="button" id="btnSave" class="btn btn-info pull-right" style="width:100px;margin-top:-5px;margin-right:90px;">Save</button> 
            </div>
       </div>
       </form>

 
<script type="text/javascript">
function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
         return false;

      return true;
   }
 // for popup
$(document).ready(function(){
//open popup
$("#product_name").click(function(){
      $("#overlay_form").fadeIn(1000);
      positionPopup();
});
 
//close popup
$("#close").click(function(){
    $("#overlay_form").fadeOut(500);
});


});
 
//position the popup at the center of the page
function positionPopup(){
    if(!$("#overlay_form").is(':visible')){
    return;
    }
    $("#overlay_form").css({
    left: ($(window).width() - $('#overlay_form').width()) / 2,
    top: ($(window).width() - $('#overlay_form').width()) / 7,
    position:'absolute'
    });
}
 
//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);
 
</script>

<br />
<div class="set_med4" id="overlay_form" style="display:none">
<div >
<h3 align="center"> <b><u>Select your product here..</u></b></h3>
<a href="" id="close" class="pull-right form_set1" >Close</a>
<div>
<br>
<span style="color: #00f; font-weight: bold;">Search</span>&nbsp;&nbsp;&nbsp;<input type="text" name="txtSearch" id="txtSearch" onkeyup="filterData()" placeholder="search">
</div>
<hr size="7px">
<br>
<table class="table_set1" id="tblProductList" border="1px">
 
<?php 
    $results= $stock->getproductname();
   if($results){
    foreach($results as $val){
   // $value=$val['name'].','.$val['id'];
?>
<tr>
<td class="bor_set"><?php echo($val['name']); ?></td>
<td class="bor_set"><input type="submit" name="<?php echo($val['id']); ?>" value="Select" onclick="add_pro('<?php echo $val['name'];?>','<?php echo $val['id'];?>','<?php echo $val['product_uniform']; ?>')">
</td>
</tr>

<?php }} ?> 

</table>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#product").click(function(){
            var favorite = [];
            $.each($("#product :selected"), function(){            
                favorite.push($(this).val());
            });           
           $("#overlay_form").fadeOut(500);
        });
    });

    add_pro = function(name, id, product_uniform){
        $('#overlay_form').hide();
        $("#product_name").val(name);
        $("#product_id").val(id);
        $("#product_uniform").val(product_uniform);
   }

    

$(document).ready(function () {
    $('#perchaise_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

    //Alternativ way
    $('#expire_date').datepicker({
      format: "yyyy-mm-dd"
    }).on('change', function(){
        $('.datepicker').hide();
    });

});
</script> 
 <script type="text/javascript">
//for submit data

        $(function () {
              $('#sidebar-toggle').trigger('click');
              $('#btnAdd').on('click',function(e){
              var fit_start_time  = new Date($("#perchaise_date").val());
              var fit_end_time    = new Date($("#expire_date").val());
              if(fit_end_time<fit_start_time){
                  alert('Expire date must be greater than Purchase date!');
                  return false;
              }
              
            var isValid = true;
            $('#bill_number,#name,#mobile,#product_id,#product_name,#address,#cost_price,#mrp,#quantity_uniform,#batch_nmbr,#perchaise_date,#expire_date').each(function () {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border": "1px solid red",
                        "background": "#FFCECE"
                    });
                }
                else{
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }
            });
            if (isValid == false)
                e.preventDefault();

             else{
              
                var tr = "<tr>\
                              <td>"+($('#tblProuct tbody tr').length+1)+"</td>\
                              <td>"+$('#product_name').val()+"<input type='hidden' name='product_id[]' value='"+$('#product_id').val()+"'></td>\
                              <td><input type='text' style='width:125px;' name='batch_nmbr[]' value='"+$('#batch_nmbr').val()+"'></td>\
                              <td><input type='text' style='width:125px;' name='cost_price[]' value='"+$('#cost_price').val()+"'></td>\
                              <td><input type='text' style='width:125px;' name='mrp[]' value='"+$('#mrp').val()+"'></td>\
                             <td><input type='text' style='width:125px;' name='quantity_uniform[]' value='"+$('#quantity_uniform').val()+"'></td>\
                             <td><input type='text' style='width:125px;' name='perchaise_date[]' value='"+$('#perchaise_date').val()+"' placeholder='yyyy/mm/dd' onkeyup='dateMask(this)' maxlength='10' data-id='date'></td>\
                             <td><input type='text' style='width:125px;' name='expire_date[]' value='"+$('#expire_date').val()+"' placeholder='yyyy/mm/dd' onkeyup='dateMask(this)' maxlength='10' data-id='date'></td>\
                             <td><i class='fa fa-times' aria-hidden='true' onclick='removeCurrentRow(this)'></i></td>\
                        </tr>";
                $('#tblProuct tbody').append(tr);
                $('#batch_nmbr, #cost_price, #mrp, #quantity_uniform, #perchaise_date, #expire_date').val('');
                if($('#tblProuct tbody tr').length>0){
                    $('#div_product_info').show();
                }
              }
            });
            $(document).ready(function(){
                $("#bill_number").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#name").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                }); 
                $("#mobile").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#product_id").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#address").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                 $("#cost_price").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#mrp").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#quantity_uniform").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#batch_nmbr").keydown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#product_name").mousedown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#perchaise_date").mousedown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });
                $("#expire_date").mousedown(function(){
                     $(this).css({
                        "border": "",
                        "background": ""
                    });
                });                   
            });           
            dateMask = function(obj){
                 var date = obj.value;
                 if (date.match(/^\d{4}$/) !== null) {
                    obj.value = date + '/';
                  } else if (date.match(/^\d{4}\/\d{2}$/) !== null) {
                     obj.value = date + '/';
                 }
            }

            removeCurrentRow = function(obj){
               $(obj).parent().parent().remove();
               if($('#tblProuct tbody tr').length<1){
                    $('#div_product_info').hide();
                }
               resetSequence();
            }

            resetSequence = function(){
               $('table tbody tr').each(function(index){
                   $(this).find('td:eq(0)').html(index+1);
               });
            }

            filterData = function(){             
                 ajaxloader.load('ajax/perchaise_stock.php',function(resp){
                           var tr = "";
                               if(resp){
                                  resp = JSON.parse(resp);
                                  
                                  $('#tblProductList tbody').html('');
                                  $.each(resp, function(index, item){
                                           tr += "<tr>\
                                                   <td>"+item.name+"</td>\
                                                   <td><input type='submit' name='Select' value='Select' onclick='add_pro(\""+item.name+"\")'></td>\
                                                </tr>";
                                  });
                                  $('#tblProductList tbody').append(tr);
                               }
                               else
                               {
                                  $('#tblProductList tbody').html(tr);
                               }
                     }, 
                    null,
                     {
                       txtSearch:$('#txtSearch').val(),
                    });
              }

            $('#btnSave').on('click', function(){
                 $('table tbody input[type=text]').each(function(){
                      if($(this).val() == ''){
                         alert('Input field cannot be blank!');
                         $(this).focus();
                         return false;
                      }
                      else if($(this).attr('data-id') == 'date'){
                         if($(this).val().indexOf("-")<0){
                              alert('Please enter valid date format');
                              $(this).focus();
                              return false;
                         }
                      }
                      else
                      {
                        
                      }
                 });
                 $.ajax({
                    type: 'post',
                    url: 'perchaise_stock_save.php',
                    data: $('#frm_purchase_stock').serialize(),
                    success: function (resp) {
                      var data =resp;

                        if(data == '1'){ 
                      
                        window.location.href = 'perchaise_stock.php';
                      }else{                                           
                         document.getElementById("email_error").innerHTML = "Unsuccessfully Deleted";
                      }
                     }
                  });
            });
      });
      </script>


<script>
function f1(objButton){  
    alert(objButton.value);
}
</script>
