
<div class="content-wrapper">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">View Purchase Stock Detail</h3>
              <a style="color: #FFF;" href="perchaise_stock.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                Back
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($results as $rows) { 
               $get_product_detail=$stock->getproduc_detail($rows['product_id']);
              ?>
            <form class="form-horizontal" method="POST" id="form1" action="" onsubmit="return validateForm()" name="form1">
             <div  id="email_error"></div> 
              <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Invoice Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="bill_number" disabled name="bill_number" value="<?php echo $rows['invoice_nmbr']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_name;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $rows['customer_name']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_mobile;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="mobile" disabled name="mobile" value="<?php echo $rows['mobile_no']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_address;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="address" disabled name="address" value="<?php echo $rows['address']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_product;?></label>
                  
                  <div class="col-sm-2">
                   <input type="text" class="form-control" disabled id="product_name" value="<?php echo $get_product_detail[0]['name']; ?>" name="product_name" placeholder="Product" value="" readonly>
                   <input type="hidden" name="product_id" value="<?php echo $rows['product_id']; ?>" id="product_id">
                   </div>

                  <div id="product_display"> 
                  </div> 
                  <div class = "pull-left">
                  </div>                 
                </div>


                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_cost_price;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="cost_price" disabled name="cost_price" value="<?php echo $rows['cost_price']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_mrp;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="mrp" disabled name="mrp" value="<?php echo $rows['mrp']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_quantity_unifrom;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="quantity_uniform" disabled name="quantity_uniform" value="<?php echo $rows['product_quantity']; ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_batch_nmbr;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="batch_nmbr" disabled name="batch_nmbr" value="<?php echo $rows['batch_no'];?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_perchaise_date;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="perchaise_date" disabled name="perchaise_date" value="<?php echo $rows['perchaise_date']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_expire_date;?></label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="expire_date" disabled name="expire_date" value="<?php echo $rows['expire_date']; ?>" readonly><br>
                    <!--<button type="submit" name="cancel" class="btn btn-primary ">Submit</button>-->
                  </div>
                </div>


                <div class="form-group">
                </div>

              <!-- /.box-footer -->
            </form>
            <?php }; ?>
          </div>
         
        </div>
        </div>




<script type="text/javascript">
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
<td class="bor_set"><input type="submit" name="<?php echo($val['id']); ?>" value="Select" onclick="add_pro('<?php echo $val['name']?>','<?php echo $val['id'];?>')">
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
            $.each($("#product :input[type=text]"), function(){            
                favorite.push($(this).val());
            });
            document.getElementById("product_id").value=favorite.join(", ");
            document.getElementById("product_id").innerHTML="Products are: " + favorite.join(", ");
           $("#overlay_form").fadeOut(500);
        });
    });

   
    add_pro = function(name, id){
        $('#overlay_form').hide();
        $("#product_name").val(name);
        $("#product_id").val(id);
   }




$(document).ready(function () {
    $('#perchaise_date').datepicker({
        format: "yyyy/mm/dd",
        autoclose: true
    });

    //Alternativ way
    $('#expire_date').datepicker({
      format: "yyyy/mm/dd"
    }).on('change', function(){
        $('.datepicker').hide();
    });

});
</script> 
 <script type="text/javascript">
//for submit data
           
   


           filterData = function(){             
                 ajaxloader.load('ajax/perchaise_stock.php',function(resp){
                           var tr = "";
                               if(resp){
                                // convert string to JSON
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
    
     
  function validateForm() {
    var x = document.forms["form1"]["product_name"].value;
    if (x == "") {
        alert("Product Name must be filled out");
        return false;
    }
    else
    {
            $.ajax({
              type: 'post',
              url: 'perchaise_stock_update.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   alert('Successfully Updated');  
                   window.location.href = 'perchaise_stock.php';
                }else{                                           
                   document.getElementById("email_error").innerHTML = "Unsuccessfully Updated";
                }
              }
            });
            return false;
    }
}
</script>
    
