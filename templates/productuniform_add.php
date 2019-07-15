
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
              <a style="color: #FFF;" href="productuniform_list.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                 Product Uniform List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="" id="form1">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    <br>
                    <button type="submit" class="btn btn-info ">Save</button>
                  </div>
                </div>
                <!--<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                  </div>
                </div>-->
                
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
//for submit data
        $(function () {
        $('#form1').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'productuniform_save.php',
            data: $('#form1').serialize(),
            success: function (datas) {
              var data = datas;
              console.log(data);              
              if(data == '1'){              
                 window.location.href = 'productuniform_list.php';
              }else{
                 document.getElementById("error").innerHTML = "Data is not added";
              }
            }
          });
          return false;
        });
      });
      </script>