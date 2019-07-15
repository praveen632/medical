
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product Type</h3>
              <a style="color: #FFF;" href="product_type.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
                 Product Type List
              </div></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  id="form1">
              <div class="box-body" id="DivId">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                     <?php  foreach ($result as $rows) { ?>
                    <label class="ch_set">
                      <input type="checkbox" name="id[]" value="<?php echo $rows['id']; ?>">&nbsp;<?php echo $rows['name']; ?>&nbsp;&nbsp;
                                        </label>
                    <?php  }; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="checkbox">
                   
                  </div>

                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                 <button type="button" class="btn btn-info pull-right" id="buttonId">Save</button>
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
$("#buttonId").click(function(){
    if($('#name').val()=='')
    {
        alert('Please enter name');
		$('#name').focus();
		return false;
    }
    else if($('#DivId').find('input[type=checkbox]:checked').length == 0)
    {
        alert('Please select atleast one checkbox');
		return false;
    }
    else
    {
                $.ajax({
                  type: 'post',
                  url: 'productType_save.php',
                  data: $('#form1').serialize(),
                  success: function (datas) {
                    var data = datas;              
                    if(data == '1'){              
                      window.location.href = 'product_type.php';
                    }else{
                       document.getElementById("error").innerHTML = "Data is not added";
                    }
                  }
                });
                return false;
    }
});

</script>