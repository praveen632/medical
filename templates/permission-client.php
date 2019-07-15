<div class="row">
  <div class="col s12 m12 l12">
    <h5 class="breadcrumbs-title"><?php echo $ln_clientPermission;?></h5>
    <ol class="breadcrumbs">
        <li><a href="index.php">Dashboard</a></li>
        <li class="active"><?php echo $ln_clientPermission;?> Save</li>
    </ol>
  </div>
</div>
<div class="row" >
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <h4 class="header2"><?php echo $ln_clientPermission;?></h4>
      <div class="row">
          <form method="post" action="" enctype="multipart/form-data" class="col s12">
           
             
             <?php 
            if($permissions) { ?>
            <div class="row">
              <div class="col s12">
                 
                  
                    <?php
                    $start=1;
                    foreach($permissions as $permission) { ?>
					<div class="col s4">
                      <input type="checkbox" name="perm_ids[]" value="<?php echo $permission['perm_id'];?>" <?php echo (in_array($permission['perm_id'], (array)$selected_ids)) ? 'checked="checked"': '' ?> id="perm_id<?php echo $start;?>" />
                    <label for="perm_id<?php echo $start;?>"><?php echo $permission['perm_name'];?></label>
                    </div>
					<?php $start++; } ?>
                  
              </div>
            </div> 
            <?php } ?> 
            <div class="row">  
              <div class="input-field col s12">
                <button type="submit" name="submit" class="btn cyan waves-effect waves-light right">
                    Save
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>




               