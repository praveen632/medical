<div class="content-wrapper">
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales Product List</h3>
              <a style="color: #FFF;" href="sales_report.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">Sales Report List
              </div></a>
              <div class="box-tools">              
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <div  id="email_error"></div>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Company Name</th>                                  
                </tr>
               </thead>
               <tbody>
                <?php
                if($result[0]){
                foreach ($result as $rows) { ?>
                 <tr>
                      <td><?php echo $rows[0]['id']?></td>
                      <td><?php echo $rows[0]['name']?></td>
                      <td><?php echo $rows[0]['company_name']?></td>                      
                 </tr>
               <?php }} ?>
               </tbody> 
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      </div>

 