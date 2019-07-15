
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
           

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ACCOUNTS</h3>
            </div>
            <div class="col-md-12">
            
             <!-- <div class="col-md-2"> 
                  <input type="text" class="glyphicon-search"  placeholder="Product Name" id="product_name" name="product_name">
                  <span onclick="filterData();"></span>  
             
             </div> -->
           
              <div class="col-md-4"> 

                 <select name="ptype" onchange="filterData();" id="ptype" class="glyphicon-search" style="margin-left: 48px;">

                  <option value=''>Payment Type</option>
                  <option value="cash">Cash</option>
                  <option value="Credit">Credit</option>
                </select> 
             </div>
            
             
              <div class="col-md-4"> 
                  <input type="text" class="glyphicon-search"  placeholder="Invoice Number" id="inum" name="inum">
                  <span onclick="filterData();"></span>  
             </div>

             <div class="col-sm-4">
             
                    <input type="text" class="glyphicon-search" id="from_date" name="from_date" placeholder="From Date" readonly style="margin-right: 10px; margin-left: -10px;">
                    <span onclick="filterData();"></span> 
           

                    <input type="text" class="glyphicon-search" id="to_date" name="to_date" placeholder="To Date" readonly style="margin-left: -10px">
                    <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
                    
            </div>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
              <table id="tblTaxList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date & Time</th>
                  <th>Transactional Detail</th>
                  <th>Customer Info</th>
                  <th>Batch No.</th>
                  <th>Invoice No.</th>
                  <th>Uniform Type</th>
                   <th>Quantity</th>
                   <th>Total Amount</th>
                   <th>Discount%</th>
                   <th>Taxes%</th>
                    <th>Customer Paid</th>
                     <th>Payment Type</th>
                </tr>
                </thead>
                <tbody>
                         
                
                </tbody>
                
              </table>
            </div>
             <div class="container">
               <div id="Pagination" style="text-align: center;"></div> 
               <input type="hidden" value="<?php echo PAGE_SIZE;?>" name="items_per_page" id="items_per_page">
               <input type="hidden" value="<?php echo NUM_DISPLAY_ENTRIES;?>" name="num_display_entries" id="num_display_entries">
               <input type="hidden" value="Prev" name="prev_text" id="prev_text">
               <input type="hidden" value="Next" name="next_text" id="next_text">
           </div> 
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
   
 <script type="text/javascript">
  $(document).ready(function(){
      $('#sidebar-toggle').trigger('click');
  });


 $(document).ready(function(){
   $('#from_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

   $('#to_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
  });

var num_display_entries,items_per_page,num_entries,start;
    function pageselectCallback(page_index, jq, event_type){
        start = page_index*items_per_page
        if(typeof event_type == 'undefined')
             loadData(start,items_per_page,event_type)
        return false;
     }

     function initPagination() {
      try{
        $("#Pagination").pagination(num_entries, {
          num_display_entries: num_display_entries,
          items_per_page:items_per_page,
          callback: pageselectCallback
        });
        }
        catch(ex){}
     }
     
     $(document).ready(function(){      
        $('#product_name,#ptype,#inum,#from_date,#to_date').keypress(function (e) {
          //alert(product_name);
              if (e.which == 13) {
                filterData();
                return false;    
              }
        });

        items_per_page = $('#items_per_page').val();
        num_display_entries = $('#num_display_entries').val();
        items_per_page = $('#items_per_page').val();
        loadData(0,items_per_page,'ready');
     });
      
     function loadData(start,per_page,event_type){
       ajaxloader.loadURL('ajax/sales_report.php', {start:start, ptype:$('#ptype').val(), inum:$('#inum').val(), from_date:$('#from_date').val(), to_date:$('#to_date').val()}, function(res){
                //alert(res['total_no_records']);
                if(res.error=='1')
                {
                    tr += "<tr><td colspan='10' align='center'>No record found!</td></tr>";
                }
                else
                {
                       num_entries = res['total_no_records'];
                       var result = res['rst'];
                       //console.log(result);
                       var tr = '';
                       
                        $.each(result, function(index, item){
                            var discount_tot = (parseFloat(item.gross_total)*(parseFloat(item.discount)/100)).toFixed(2);
                            var tax_tot = (parseFloat(item.gross_total)*(parseFloat(item.tax)/100)).toFixed(2);
                               if(item.type == 'ST'){
                                      tr +="<tr >\
                                            <td >"+item.date+"</td>\
                                            <td><div><i> Product Name: </i>"+item.product_uniform+"</div><div><i>Product Type:</i> "+item.uniform_type+" </div><div><i>Cost Price: </i>"+item.cost_price+"</div>\
                                            <div><i>MRP:</i> "+item.mrp+"</div> <div><i> No. of Strip/Voil: </i>"+item.rest_stock+"</div></td>\
                                            <td><div><i> Name: </i>"+item.customer_details.customer_name+"</div><div><i> Mobile No. : </i>"+item.customer_details.mobile_no+"</div><div><i> Tin No. :</i>"+item.customer_details.tin_no+"</div></td>\
                                            <td>"+item.batch_no+"</td>\
                                            <td>"+item.invoice_nmbr+"</td>\
                                            <td>"+item.uniform_name+"</td>\
                                            <td>"+item.product_quantity+"</td>\
                                            <td>"+item.total_amount+"</td>\
                                            <td>"+item.discount+"</td>\
                                            <td>"+item.tax+"</td>\
                                            <td>"+item.total_amount+"</td>\
                                            <td>"+item.payment_type+"</td>\
                                          </tr>";
                                  }
                                  else
                                  {
                                    item.total_amount = eval((parseFloat(item.gross_total) - parseFloat(discount_tot)) + parseFloat(tax_tot)).toFixed(2);
                                       tr +="<tr>\
                                            <td>"+item.date+"</td>\
                                            <td><div><i> Product Name: </i>"+item.product_uniform+"</div>\
                                            <td><div><i> Name: </i>"+item.customer_details.customer_name+"</div><div><i> Mobile No. : </i>"+item.customer_details.mobile_no+"</div><div><i> Tin No. :</i>"+item.customer_details.tin_no+"</div></td>\
                                            <td>"+item.batch_no+"</td>\
                                            <td>"+item.invoice_nmbr+"</td>\
                                            <td>"+item.uniform_name+"</td>\
                                            <td>"+item.product_quantity+"</td>\
                                            <td>"+item.gross_total+"</td>\
                                            <td>"+item.discount+"</td>\
                                            <td>"+item.tax+"</td>\
                                            <td>"+item.total_amount+"</td>\
                                            <td>"+item.payment_type+"</td>\
                                          </tr>";
                                  }
                        });
                  }
                  $('#tblTaxList tbody').html(tr);
                  if(!result){
                     $('#Pagination').hide();
                  }
                  else
                  {
                    $('#Pagination').show();
                  }
                  if(event_type == 'ready')
                     initPagination();
          });     
     }

     filterData = function (){
           loadData(0,$('#items_per_page').val(),'ready');
       }


</script>






