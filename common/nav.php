<aside class="main-sidebar">
   <section class="sidebar">
     <ul class="sidebar-menu" data-widget="tree">
        <li id="main_0">
            <a href="index.php" onclick="clickMenu(this);">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li id="main_4">
            <a href="profilesetting.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Profile Setting</span></a>
        </li>
        <li id="main_1">
            <a href="tax_list.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Tax</span></a>
        </li>
         <li class="treeview" id="main_2">
              <a href="#" onclick="clickMenu(this);">
                <i class="fa fa-files-o"></i>
                <span>Medicine</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">5</span>
                </span>
              </a>
              <ul class="treeview-menu">    			       
    			       <li id="main_2_2"><a href="productuniform_list.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i>Product Uniform</a></li>	
    			       <li id="main_2_3"><a href="product_type.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i>Product Type</a></li>
                 <li id="main_2_1"><a href="company.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i>Company</a></li>
                 <li id="main_2_4"><a href="product.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i>Product</a></li>
                 <li id="main_2_5"><a href="perchaise_stock.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i> Purchase Stock</a></li>
             </ul>
		    </li>
        <li id="main_3">
            <a href="sales.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Sales</span></a>
        </li>
        <li id="main_5">
            <a href="expired_medicine.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Expired Medicine</span></a>
        </li>
        <li id="main_6">
            <a href="expiry_medicine.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Expiry Medicine</span></a>
        </li>
        <li id="main_7">
            <a href="shortage_stock.php" onclick="clickMenu(this);"><i class="fa fa-files-o"></i><span>Shortage Stock</span></a>
        </li>
        <li class="treeview" id="main_8">
              <a href="#" onclick="clickMenu(this);">
                <i class="fa fa-files-o"></i>
                <span>Report</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">1</span>
                </span>
              </a>
              <ul class="treeview-menu">
                 <li id="main_8_1"><a href="sales_report.php" onclick="clickMenu(this);"><i class="fa fa-circle-o"></i>Sales Report</a></li>                 
             </ul>
        </li>
      </ul>
     </li>        
   </ul>
  </section>
</aside>
<script type="text/javascript">
    function clickMenu(object){
        localStorage.setItem("selected_node", $(object).parent().attr('id'));
    }
    
    /*This is only work on logout and home logo*/
    function removeMenu(){
        localStorage.removeItem("selected_node");
    }

   
    if(localStorage.getItem("selected_node") == null || localStorage.getItem("selected_node") == 'main_0'){
       $('#main_0').addClass('active');
    }
    else
    {
       $('#'+localStorage.getItem("selected_node")).addClass('active');
       if($('#'+localStorage.getItem("selected_node")).parent().attr('class') == 'treeview-menu'){
           $('#'+localStorage.getItem("selected_node")).parent().parent().addClass('menu-open');
           $('#'+localStorage.getItem("selected_node")).parent().css('display','block');
       }
    }
</script>
