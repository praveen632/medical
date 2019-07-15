
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Company</h3>
              <a style="color: #FFF;" href="company.php"><div class="btn btn-info " style="margin: 5px 30px 5px;">
                 Company List
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
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                    <br>
                    <button type="submit" class="btn btn-info ">Save</button>
                  </div>
                </div>
                 
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
            url: 'company_save.php',
            data: $('#form1').serialize(),
            success: function (datas) {
              var data = datas;              
              if(data == '1'){              
                 window.location.href = 'company.php';
              }else if(data == '2'){
                alert('Please Enter Another Company name');
              }
              else{
                 alert("Data is not added");
              }
            }
          });
          return false;
        });
      });
      </script>