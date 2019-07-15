
<div class="content-wrapper"> 
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Product Type</h3>
              <a style="color: #FFF;" href="product_type.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
                 Product Type List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($result as $rows) { ?>
            <form class="form-horizontal" method="POST" id="form1" >
             <div  id="email_error"></div> 
              <div class="box-body">
              <input type="hidden" name="ids" value="<?php echo $rows['id']; ?>"/>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Type</label>
                  <div class="col-sm-10" id="select">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows['name']; ?>" required>


                     <?php $result_uni= $user->get_uni(); 
                     $checkbox = explode(",", $rows['product_uniform']);
                     foreach ($result_uni as $row) {  ?>  
                    <label class="ch_set ">
                      <input class="myCheckbox" type="checkbox" name="id[]" value="<?php echo $row['id'];?>"
                      <?php 
                      if(in_array($row['id'], $checkbox)) {
                        ?>                      
                      checked="checked"
                      <?php 
                      
                      } 
                      ?> 
                      >&nbsp;<?php echo $row['name'];
                      
                     ?> &nbsp;&nbsp;

                    </label>
                    <?php } ?>                   
                  </div>

                </div>
                <div class="form-group">
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                 <button type="submit" class="btn btn-primary pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <?php }; ?>
                  </div>
                </div>
               <div class="form-group">
                  <div class="checkbox">
                    <!-- <?php 
                   // $id_uni = explode(",",$rows['uniform_name']);
                     // $len = count($id_uni);
                      //for($i=0; $i<$len;$i++)
                      { 
                         //$result_uni[$i]= $user->get_uni($id_uni[$i]);                      
                      }
                    ?> -->
                  
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
              url: 'productType_update.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  //console.log(data_r);
                  if(data_r == '1'){ 
                   //alert('Successfully Updated');  
                   window.location.href = 'product_type.php';
                }else{                                           
                   document.getElementById("email_error").innerHTML = "Unsuccessfully Updated";
                }
              }
            });
            return false;
          });
        });
        </script>
