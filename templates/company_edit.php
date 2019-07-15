
<div class="content-wrapper">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Company</h3>
               <a style="color: #FFF;" href="company.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                Company List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($result as $rows) { ?>
            <form class="form-horizontal" method="POST" id="form1" >
             <div  id="email_error"></div> 
              <div class="box-body">
              <input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows['name']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="description" name="description" required><?php echo $rows['description']; ?> </textarea>
                    <br>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                  </div>
                </div>
                <div class="form-group">
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                 
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
              url: 'company_update.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   alert('Successfully Updated');  
                   window.location.href = 'company.php';
                }else if(data_r == '2')
                {
                    alert('Please Choose Another Company name'); 
                }
                else{                                           
                   alert("Unsuccessfully Updated");
                }
              }
            });
            return false;
          });
        });
        </script>
