
<div class="content-wrapper">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Tax List</h3>
              <a style="color: #FFF;" href="tax_list.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
                 Tax List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($results as $rows) { ?>
            <form class="form-horizontal" method="POST" id="form1" action="">
             <div  id="email_error"></div> 
              <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name Of Tax</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows['name']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tax of Rate</label>

                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="name" name="tax_rate" value="<?php echo $rows['tax_rate']; ?>" required>
                   <br>
                   <button type="submit" name="cancel" class="btn btn-primary ">Add</button>
                  </div>
                </div>
                <div class="form-group">
                 
                </div>
              </div>
              
              <!-- /.box-footer -->
            </form>
            <?php }; ?>
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
              url: 'tax_list_update.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   alert('Successfully Updated');  
                   window.location.href = 'tax_list.php';
                }else{                                           
                   document.getElementById("email_error").innerHTML = "Unsuccessfully Updated";
                }
              }
            });
            return false;
          });
        });
        </script>
