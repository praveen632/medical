

<div class="content-wrapper">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Product</h3>
              <a style="color: #FFF;" href="product.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
                 Product List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <form class="form-horizontal" method="POST" id="form1" >
             <?php foreach ($result as $rows) { ?>
             <div  id="email_error"></div> 
              <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" required >
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Product Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows['name']; ?>" required>
                  </div>
                </div>
                <?php $result_company= $user->get_company();
                ?>               
                  <div class="form-group">
                  <div class="col-md-3">
                  <label class="col_pro4" >Company Name</label>                  
                </div>
                  <div class="col-md-9">   
                  <select class="form-control" name="ids" required>
                    <option value="0"><strong>Select</strong></option>
                  <?php  foreach ($result_company as $row) {  ?> 
                    <option value="<?php echo $row['id']; ?>" <?php if($row['id']==$rows['company_id']){ echo"selected"; } ?>><?php echo $row['name']; ?></option>
                    <?php }; ?>                   
                  </select>
                  </div>                  
                </div>
                <?php 
                  $result_product= $user->get_product();
                  $get_type = $user->get_type_product($rows['product_uniform']); 
                ?>               
                  <div class="form-group"  >
                  <div class="col-md-3">
                  <label class="col_pro4">Select Product Type</label>  
                  </div>
                  <div class="col-md-9">                 
                  <select class="form-control" onchange="getuniform(this.value)" name ="idss" required > 
                  <option value="0"><strong>Select</strong></option>                  
                  <?php  foreach ($result_product as $row) {  ?> 
                    <option value="<?php echo  $row['id'];?>" <?php if($row['id']==$rows['product_id']){ echo"selected"; } ?>><?php echo $row['name']; ?></option>
                    <?php }; ?>                   
                  </select>                  
                </div>    
                </div>
               <div class="form-group" >
               <div class="col-md-3">
                  <label class="col_pro4">Select Product Uniform</label>
                  </div>
                  <div class="col-md-9">
                  <select class="form-control" id="unform" name ="id1" required> 
                  <?php  foreach ($get_type as $row) {  ?> 
                    <option value="<?php echo  $row['id'];?>" <?php if($row['id']==$rows['product_uniform']){ echo"selected"; } ?>><?php echo $row['name']; ?></option>
                    <?php }; ?>                  
                  </select>
                </div>
                </div>
                <div class="form-group">

                  <label for="inputEmail3" class="col-sm-3 control-label">Quantity Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $rows['quantity']; ?>" required>
                  </div>
                </div>

                <?php 
                  $result_tax= $user->get_tax(); 
                  $tax = explode(',',$rows['tax_id']);
                ?>               
                  <div class="form-group"  >
                  <div class="col-md-2" ></div>
                  <div class="col-md-1" >
                  <label class="col_pro4">Tax</label> 
                  </div>
                  <div class="col-md-9">                  
                  <!--  <select class="form-control"  name ="idT" required> -->
                  <?php  foreach ($result_tax as $row) {  ?> 
                    <!-- <option value="<?php //echo  $row['id'];?>"><?php //echo $row['name']; ?></option> -->
                     <label class="ch_set">
                      <input type="checkbox" name="idT[]" value="<?php echo $row['id']; ?>" <?php if(in_array($row['id'],$tax)){ echo "checked";}  ?>>&nbsp;<?php echo $row['name']; ?>&nbsp;&nbsp;
                                        </label>

                    <?php }; ?>                   
                                                 
                </div> 
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" id="description" name="description" required><?php echo $rows['description']; ?> </textarea>
                    <br>
                    <button type="submit" class="btn btn-primary ">Save</button>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                 
              </div>
              <!-- /.box-footer -->
               <?php }; ?>
            </form>
           
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        </div> 
           
         <script type="text/javascript">
          $(function () {
          $('#form1').bind('submit', function () {
            $.ajax({
              type: 'post',
              url: 'product_update.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   //alert('Successfully Updated');  
                  window.location.href = 'product.php';
                }else{                                           
                   document.getElementById("email_error").innerHTML = "Unsuccessfully Updated";
                }
              }
            });
            return false;
          });
        });

         function getuniform($id){  
                 $select = $('#unform');     
               var data = new FormData();
               data.append("id", $id);
              $.ajax({
                    type: 'post',
                    url: 'unform_name.php',
                    data: data,
                    dataType:'json',
                    contentType: false,  
                    processData: false,
                    success: function (datas) {                    
                          $select.html('');
                          $select.append('<option value="">Select</option>');
                          $.each(datas, function(key, val){
                            $select.append('<option value="' + val[0].id + '">' + val[0].name + '</option>');
                          })
                        }
                    
                  });
         
        
      }

        </script>
