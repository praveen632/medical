<div class="content-wrapper">
<div class="col-md-12">
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Sales</h3>
      <a style="color: #FFF;" href="cashinvoice_list.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
    Cash Invoice
      </div></a>
      <div class="col-md-12">
      <div class="col-md-4"> 
        <input type="text" class="glyphicon-search"  placeholder="Invoice Number" id="invoice_nmbr" name="invoice_nmbr">
         
      </div>

      <div class="col-md-4"> 
          <input type="text" class="glyphicon-search"  placeholder="Customer Name" id="cuname" name="cuname">
            
      </div>

      <div class="col-md-4"> 
          <input type="text" class="glyphicon-search"  placeholder="Phone Number" id="phnum" name="phnum">
            
          <span class="glyphicon glyphicon-search" onclick="filterData();"></span> 
      </div>
      </div>
    </div>
    <!-- /.box-header -->
     <div class="box-body table-responsive no-padding">
       <table class="table table-hover" id="tblTaxList">
     <!--  <div  id="email_error"></div> -->
       <thead>
          <th>Customer Name</th>
          <th>Payment Type</th>
          <th>Invoice No</th>
          <th>Mobile No</th>
          <th>Address</th>
          <th>Actions</th>                 
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
  </div>
 </div>
</div>

  <script type="text/javascript">
    
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
        $('#invoice_nmbr,#cuname,#phnum').keypress(function (e) {
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
        ajaxloader.loadURL('ajax/cashinvoice_list.php', {start:start,invoice_nmbr:$('#invoice_nmbr').val(),cuname:$('#cuname').val(),phnum:$('#phnum').val()}, function(res){
                  if(res['rst']==false){
                   tr += "<tr><td colspan='6' align='center'>No record found!</td></tr>";
                  }
                   else
                   {
                           num_entries = res['total_no_records'];
                           var result = res['rst'];
                           var tr = '';
                            $.each(result, function(index, item){
                                    tr += "<tr>\
                                               <td>"+item.customer_name+"</td>\
                                               <td>"+item.payment_type+"</td>\
                                               <td>"+item.invoice_nmbr+"</td>\
                                               <td>"+item.mobile+"</td>\
                                               <td>"+item.address+"</td>\
                                               <td><a type='submit' class='glyphicon glyphicon-trash' data-toggle='modal' onclick=destroy("+item.id+") ></a></td>\
                                               </tr>";
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

function destroy($id){
     if(confirm("Are you sure you want to delete this?")){
         var data = new FormData();
         data.append("id", $id);
        $.ajax({
              type: 'post',
              url: 'sales_delete.php',
              data: data,
              contentType: false,  
              processData: false,
              success: function (datas) {                          
                  var data_r = datas;
                  
                  if(data_r == 1){ 
                  //alert('Successfully Deleted');  
                  window.location.href = 'sales.php';
                }else{                                           
                   document.getElementById("email_error").innerHTML = "Unsuccessfully Deleted";
                }
              }
            });
    }
    else{
        return false;
    } 
}

</script>

