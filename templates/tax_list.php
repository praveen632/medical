<div class="content-wrapper">
<div class="col-md-12">
<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Manage Your Tax</h3>
              <a class="white" href="tax_list_add.php"><div class="btn btn-info but_set">
                 Add
              </div></a>
              <div class="pull-right Search_set1"> 
              <input type="text" class="glyphicon-search"  placeholder="Search" id="search" name="search">
              <span class="glyphicon glyphicon-search" onclick="filterData();"></span>  
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="tblTaxList">
                <thead>
                    <th><?php echo $ln_tax_name;?></th>
                    <th><?php echo $ln_tax_rate;?></th>
                    <th class="width">Action</th>
                </thead>
                <tbody>
               </tbody>
              </table>
            </div>
            
           <div class="col-md-4 col-sm-4"></div>
            <div class="container">
            <div class="col-md-4 col-sm-4 ali_set">
               <div id="Pagination" ></div> 
               <input type="hidden" value="<?php echo PAGE_SIZE;?>" name="items_per_page" id="items_per_page">
               <input type="hidden" value="<?php echo NUM_DISPLAY_ENTRIES;?>" name="num_display_entries" id="num_display_entries">
               <input type="hidden" value="Prev" name="prev_text" id="prev_text">
               <input type="hidden" value="Next" name="next_text" id="next_text">
           </div>
         </div>
         <div class="col-md-4 col-sm-4" ></div>
         
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
        $('#search').keypress(function (e) {
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
      //<td>"+item.id+"</td>\
     function loadData(start,per_page,event_type){
        ajaxloader.loadURL('ajax/tax_list.php', {start:start,search:$('#search').val()}, function(res){
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
                                             <td>"+item.name+"</td>\
                                             <td>"+item.tax_rate+"</td>\
                                             <td><a class='fa fa-fw fa-edit' href='tax_list_edit.php?id="+item.id+"''></a>&nbsp;<a type='submit' class='glyphicon glyphicon-trash' data-toggle='modal' onclick=destroy("+item.id+") ></a></td>\
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
              url: 'tax_list_delete.php',
              data: data,
              contentType: false,  
              processData: false,
              success: function (datas) {                          
                  var data_r = datas;
                  console.log(data_r);
                  if(data_r == '1'){ 
                  //alert('Successfully Deleted');  
                  window.location.href = 'tax_list.php';
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