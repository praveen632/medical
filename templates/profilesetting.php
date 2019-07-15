
<div class="content-wrapper" >

<div class="abc" ><h3>User Profile</h3></div>

<div class="abc_1" >
<?php

    foreach ($result as $rows) {?>

<form method="POST" action="profilesetting_update.php" onsubmit="return myFunction()">
<div class="col-md-3 corm_nmset">
	<div ><strong class="right_sre"></strong></div>
    </div>
    <div class="col-md-9 corm_nmset" >
    <input type="hidden" name="password" class="ch_manset" style="padding: 6px;" placeholder="****************"> 
    </div>
<div class="col-md-3" >

	<strong class="right_sre"> New Password</strong>
    </div>
<div class="col-md-9">
    <input type="password" name="newpassword" id="newpassword" class="ch_manset padd_set">
	</div>
	<div class="col-md-3">
	<strong class="right_sre">Confirm Password</strong>
    </div>
     <div class="col-md-9">
    <input type="password" name="confirmpassword" id="confrmpwd" class="ch_manset padd_set">
    </div>
    <div class="col-md-3 corm_nmset">
    <div ><strong class="right_sre">Name</strong></div>
    </div>
    <div class="col-md-9 corm_nmset" >
    <input type="name" name="name" class="ch_manset" style="padding: 6px;" value="<?php echo $rows['name']; ?>" required> 
    </div>
    <div class="col-md-3 corm_nmset">
    <div ><strong class="right_sre">Company Name</strong></div>
    </div>
    <div class="col-md-9 corm_nmset" >
    <input type="name" name="c_name" class="ch_manset" style="padding: 6px;" value="<?php echo $rows['company_name']; ?>" required> 
    </div>
    <div class="col-md-3" >
    <strong class="right_sre">Phone Number</strong>
    </div>
    <div class="col-md-9">
    <input type="text" name="phone" id="phone" pattern="[0-9]{10}" class="ch_manset padd_set" value="<?php echo $rows['phone'];?>" required>
    </div>
    <div class="col-md-3">
    <strong class="right_sre">Address</strong>
    </div>
     <div class="col-md-9">
    <textarea type="text" name="address" id="address" class="ch_manset padd_set"><?php echo $rows['address'];?></textarea>
    </div>
    <div class="col-md-3">
    <strong class="right_sre">Tin Number</strong>
    </div>
     <div class="col-md-9">
    <input type="text" name="tin_no" id="tin_no" class="ch_manset padd_set" value="<?php echo $rows['tin_no']; ?>">
    </div>
    <div style="margin-left: 27%;" >
    <input type="submit" name="submit" value="Submit" onkeyup="check();" class="abc_2" style="width:80px;">&nbsp;
    <input type="button"  value="Cancel" onclick="window.location.href='index.php'" class="abc_2" style="width:80px;">
    </div>
    </div>

</form>
<?php };?>
</div>
</div>
</div>



  <script>
 function myFunction() {
    var newpassword = document.getElementById("newpassword").value;
    var confrmpwd = document.getElementById("confrmpwd").value;
    var ok = true;
    if (newpassword != confrmpwd) {
        alert("Passwords Do not match");
        document.getElementById("newpassword").style.borderColor = "#E34234";
        document.getElementById("confrmpwd").style.borderColor = "#E34234";
        ok = false;
    }
    else {
           ok = true;
    }
    return ok;
}
 </script>
