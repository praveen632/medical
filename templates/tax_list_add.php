
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ADD TAX</h3>
              <a style="color: #FFF;" href="tax_list.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                 Tax List
              </div></a>
            </div>  
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="" id="form1">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $ln_tax_name;?></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="true">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $ln_percentage_tax;?></label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control"  id="tax_rate" name="tax_rate" placeholder="Percentage of tax" required="true">
                    <br>
                    <button type="submit" name="submit" class="btn btn-info ">Save</button>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                 
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
         
          <!-- /.box -->
        </div>
        </div>
        </div>
        
         <script type="text/javascript">
          $(function () {
          $('#form1').bind('submit', function () {
            $.ajax({
              type: 'post',
              url: 'tax_list_save.php',
              data: $('#form1').serialize(),
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                   alert('Successfully Added');  
                   window.location.href = 'tax_list.php';
                }else{                                           
                   document.getElementById("error").innerHTML = "Data is not added";
                }
              }
            });
            return false;
          });
        });
        </script>