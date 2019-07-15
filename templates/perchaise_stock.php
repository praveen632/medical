<div class="content-wrapper">
<div class="col-md-12">
<div class="box">
            
            <div class="box-header">
              <h3 class="box-title">Purchase Stock</h3>
               <a style="color: #FFF;" href="perchaise_stock_create.php"><div class="btn btn-info" style="margin: 5px 30px 5px;">
                     Add
                  </div></a>       
             
            </div>
            <div class="col-md-12">
            
             <div class="col-md-3"> 
                  <input type="text" class="glyphicon-search"  placeholder="Invoice Number" id="bill" name="bill">
                  <span onclick="filterData();"></span>  
             
             </div>
           
              <div class="col-md-3"> 
                  <input type="text" class="glyphicon-search"  placeholder="Vendor Name" id="vname" name="vname">
                  <span onclick="filterData();"></span>  
             </div>
            
             
              <div class="col-md-3"> 
                  <input type="text" class="glyphicon-search"  placeholder="Product Name" id="pname" name="pname">
                  <span onclick="filterData();"></span>  
             </div>
              <div class="col-md-3"> 
                  <input type="text" class="glyphicon-search"  placeholder="Batch No" id="bname" name="bname">
                  <span class="glyphicon glyphicon-search" onclick="filterData();"></span>  
             </div>
             </div>
             <br><br>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="tblTaxList">
            
                <thead>              
                  <th>Invoice Number</th>
                  <th>Vendor Name</th>
                  <th>Product Name</th>
                  <th>Batch No.</th>
                  <th>Cost</th>
                  <th>MRP</th>
                  <th>No Of Strip/Voil</th>
                  <th>Remaining Strip/Voil</th>
                  <th>Purchase Date</th>
                  <th>Exp. Date</th>
                  <th style="width: 40px">Action</th>                
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
  $(document).ready(function(){
      $('#sidebar-toggle').trigger('click');
  });
  function destroy($id){
     if(confirm("Are you sure you want to delete this?")){
         var data = new FormData();
         data.append("id", $id);
        $.ajax({
              type: 'post',
              url: 'perchaise_stock_delete.php',
              data: data,
              contentType: false,  
              processData: false,
              success: function (datas) {                          
                  var data_r = datas;
                  
                  if(data_r == '1'){ 
                  //alert('Successfully Deleted');  
                  window.location.href = 'perchaise_stock.php';
                }else{                                           
                   document.getElementById("error").innerHTML = "Unsuccessfully Deleted";
                }
              }
            });
    }
    else{
        return false;
    }
  
}

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
        $('#bill,#vname,#pname,#bname').keypress(function (e) {
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
        ajaxloader.loadURL('ajax/stock_pagination.php', {start:start,bill:$('#bill').val(), vname:$('#vname').val(), pname:$('#pname').val(), bname:$('#bname').val()}, function(res){
                 if(res['rst']==false){
                   tr += "<tr><td colspan='10' align='center'>No record found!</td></tr>";
                  }
                  else
                  {
                         num_entries = res['rst'].length;
                         var result = res['rst'];

                         var tr = '';
                          $.each(result, function(index, item){
                                  tr += "<tr>\
                                             <td>"+item.invoice_nmbr+"</td>\
                                             <td>"+item.name+"</td>\
                                             <td>"+item.product+"</td>\
                                             <td>"+item.batch_no+"</td>\
                                             <td>"+item.cost_price+"</td>\
                                             <td>"+item.mrp+"</td>\
                                             <td>"+item.product_quantity+"</td>\
                                             <td>"+item.rest_stock+"</td>\
                                             <td>"+item.perchaise_date+"</td>\
                                             <td>"+item.expire_date+"</td>\
                                             <td><a class='fa fa-fw fa-weibo' href='perchaise_stock_edit.php?id="+item.id+"''></a>&nbsp;<a type='submit' class='glyphicon glyphicon-trash' data-toggle='modal' onclick=destroy("+item.id+") ></a></td>\
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


</script>






