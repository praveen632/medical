
<div class="content-wrapper">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
              <a class="col_pro-1" href="product.php"><div class="btn btn-info">
                 Product List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <form class="form-horizontal" method="POST" id="form1" >
            
             <div  id="email_error"></div> 
              <div class="box-body">
             
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Product Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Product Name" required>
                  </div>
                </div>

                <?php $result_company= $user->get_company();?>               
                  <div class="form-group">
                  <div class="col-md-3" >
                  <label class="col_pro4">Select Company</label> 
                  </div>
                  <div class="col-md-9">                  
                  <select class="form-control" name="ids" required>
                    <option value="">Select</option>
                  <?php  foreach ($result_company as $row) {  ?> 
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php }; ?>                   
                  </select> 
                  </div>                 
                </div>
                <?php $result_product= $user->get_product();?>               
                  <div class="form-group"  >
                  
                  <div class="col-md-3"  >
                  <label class="col_pro4">Select Product Type</label> 
                  </div>
                  <div class="col-md-9">              
                  <select class="form-control" onchange="getuniform(this.value)" name ="idss" required>
                   <option value="">Select</option>
                  <?php  foreach ($result_product as $row) {  ?> 
                    <option value="<?php echo  $row['id'];?>"><?php echo $row['name']; ?></option>
                    <?php }; ?>                   
                  </select>                  
                </div> 
                </div>   
                
               <div class="form-group" >
               <div class="col-md-3" >
                  <label  class="col_pro4"> Product Uniform</label>
                  </div>
                  <div class="col-md-9" >
                  <select class="form-control" id="unform" name ="id2" required>

                  </select>
                </div>
                     </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Quantity in Uniform</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" pattern="{[0-9]}" id="quantity" name="quantity" value="" placeholder="Quantity" required>
                  </div>
                </div>

                <?php $result_tax= $user->get_tax(); ?>               
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
                          <input type="checkbox" name="idT[]" value="<?php echo $row['id']; ?>">&nbsp;<?php echo $row['name']; ?>&nbsp;&nbsp;
                    </label>
                    <?php }; ?>        
                </div> 
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required> </textarea>
                    <br>
                    <button type="submit" class="btn btn-primary ">Add</button>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                 
              </div>
              <!-- /.box-footer -->
               
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
              url: 'product_save.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   //alert('Successfully Updated');  
                   window.location.href = 'product.php';
                }else{                                           
                   alert("Please Select Tax field At list One");
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
