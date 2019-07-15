
     <div id="container"> 
          <div class="container" style="border:3px solid #d9d9d9 !important;"> 
          	<div class="crumbs"> 
            <ul id="breadcrumbs" class="breadcrumb"> 
            	<li> <a href="index.php" style="font-size:24px;"><i class="icon-chevron-left"></i></a> </li>
            </ul> 
            <h2 style="text-align:center; margin-top:6px; padding-top:5px; font-weight:bolder;">User Setting</h2>
           
          </div>
          <div class="row"> 
          	<div class="col-md-12"> 
            	<div class="tabbable tabbable-custom tabbable-full-width"> 
               	<div> <!--class="tab-content row"--> 				
                 <div class="tab-pane active" id="tab_edit_account"> 
                 	<form class="form-horizontal" method="post" action=""> 
                      <div class="col-md-12"> <div class="widget">
                      <div class="widget-header" style="text-align:center;">
                       <h4 style="margin-bottom:16px;font-weight:bolder;"><?php echo $_SESSION['user_data']['name']; ?></h4> </div> 
                      <div class="widget-content"> 
					  <?php if(!$message==0){ ?>
                      <div class="container" style="background:#DEEC90; border:1px solid #ccc; width:300px; border-radius:25px;">
						<div align="center" style="color:#000;  font-weight:300; margin-bottom:2px;"><?php echo $message;  ?></div>
                        </div>
						<?php } ?>
                       
                      	<div class="row"> 
                        	<div class="col-md-6">  
                            	<div class="form-group"> <label class="col-md-4 col-xs-4 control-label">User name:</label> 
                                	<div class="col-md-8 col-xs-8"><input type="text" name="uname" class="form-control" value="<?php echo $_SESSION['user_data']['username']; ?>" disabled ></div> 
                                </div> 
                              	<div class="form-group"> <label class="col-md-4 col-xs-4 control-label">New Password:</label> 
                                	<div class="col-md-8 col-xs-8"><input type="password" name="pass" class="form-control" style="border:1px solid #000 !important;"  ></div>                                 
                                </div> 
								 
                            </div>
                           <div class="col-md-6">
                            	<div class="form-group"> <label class="col-md-4 col-xs-4 control-label">Email:</label> 
                                	<div class="col-md-8 col-xs-8"><input type="text" name="email_con" class="form-control" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" value="<?php echo $_SESSION['user_data']['email']; ?>"  ></div> 
                                </div> 
                              	<div class="form-group"> <label class="col-md-4 col-xs-4 control-label" >Confirm New Password:</label> 
                                	<div class="col-md-8 col-xs-8"><input type="password" name="con_pass" class="form-control" style="border:1px solid #000 !important;"></div> 
                                    
                                </div>
								 
                            </div>
                          </div> 
                          <div class="col-md-12"> 
                          	<div class="widget"> 
                            	
                                	<div class="widget-content"> 
                                    	<div class="row"> 
                                        	<div class="col-md-6 col-xs-6 fild_set "> 
                                            <a href="faq.php" class="btn btn-icon input-block-level" style="width:100% !important;">
                                            	<div style="font-family:Avenir;"> <span class="font_set1">FAQ</span></div> </a> </div> 
                                            <div class="col-md-6 col-xs-6 fild_set"> 
                                            <a href="report_us.php" class="btn btn-icon input-block-level" style="width:100% !important;">
                                            	<div style="font-family:Avenir;"><span class="font_set1">Report a problem</span></span></div></a> </div> 
                                                <div class="col-md-6 col-xs-6 fild_set"> 
                                            <a href="contact_us.php" class="btn btn-icon input-block-level" style="width:100% !important;">
                                                <div style="font-family:Avenir;"><span class="font_set1">Contact us</span></div> </a> 
                                                </div> 
                                                <div class="col-md-6 col-xs-6 fild_set"> 
                                                <div  class="btn btn-icon input-block-level" style="width:100% !important;"> 
                                               <div style="font-family:Avenir;"><span class="font_set1">Version 2.0.1</span></div> </div> 
                                                </div>
                                                <div class="col-md-12"> 
                                            <button type="submit" name="submit" class="btn btn-icon input-block-level" style="background-color:#F00 !important; font-size:16px !important; color:#FFF !important; width:100% !important;">
                                            	<div>Update</div> </button> </div>  
                                          </div>   
                                   </div> 
                                </div> 
                             </div>
                          </div> 
                      </div> 
                   </div> 
				   </form>
                </div> 
                </div> 
                </div> 
                </div> 
                </div> 
                <div class="widget-content align-center">
            	<p style="font-size:18px;"> <i class="icon-calendar"></i> <span></span><b id="ti" style="font-family:arial !important;"></b>  <i class="icon-time"></i> <span></span><b id="ht"></b><strong><b id="mt"></b>hr</strong></p>
                 </div>
                </div> 
                </div>