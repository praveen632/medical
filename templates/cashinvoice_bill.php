<style>
.tableset{ padding:5px border:3px solid #CCCCCC;}
.anu_set{padding:5px; border:3px solid #CCCCCC}
</style>
<div class="content-wrapper">
  <div class="col-md-12">
     <div class="box">
            <div class="light-table">
              <table align="center" id="mytable">
                <thead>
                <tr>
                  <td colspan="11" align="center" style="padding:20px; border:3px solid #CCCCCC">
                    <h3><spam id="type_type"></spam> Bill</h3>
                  </td>
                </tr>
                <tr>
                  <td height="128" colspan="5" class="tableset" style="padding:20px; border:3px solid #CCCCCC">
                    <p class="heading-2"><strong><?php echo $get_user_detail[0]['company_name']; ?></strong></p>
                    <p class="heading-3"><?php echo $get_user_detail[0]['address']; ?></p>
                    <!--<p class="heading-4">(Subject to Gorakhpur Jurisdiction)</strong></p>-->
                    <p><?php echo $get_user_detail[0]['phone']; ?></p>
                    <?php echo $get_user_detail[0]['tin_no']; ?></td>
                  <td colspan="4" style="padding:5px; border:3x solid #CCCCCC">
                    <p><strong>TO : </strong><spam id="name"></spam> </p>
                    <p><strong>Address : </strong><spam id="address"></spam></p>
                    <p><strong>Mobile : </strong><spam id="mobile"></spam></p>
                     <p><strong>Tin No: </strong><spam id="tin_no"></spam></p>
                  </td>
                  <td width="141" style="padding:20px; border:3px solid #CCCCCC">
                  
                  INVOICE NO.:<spam id="invoice_no"></spam> <br>
                  <br>
                  DATE: <spam id="date"></spam><br>   
                  </td>
                </tr>
                <tr>
                  <td width="100"  class="anu_set">Company Name</td>
                  <td width="100"  class="anu_set">PRODUCT</td>
                  <td style="font-size:10PX" class="anu_set">BATCH NO:</td>
                  <td width="49" class="anu_set">Type</td>
                  <td width="49" class="anu_set">Uniform</td>
                  <td width="85" class="anu_set">QUANTITY</td>
                  <td width="85" class="anu_set">Gross Total</td>
                  <td width="85" class="anu_set">Discount</td>
                  <td width="180" class="anu_set">AMOUNT</td>
                  <td width="53" class="anu_set">Tax%</td>
                                    
                </tr>
                 </thead>
                <tbody>

                </tbody>
                <tfoot>  
                <tr>
                  <td colspan="8" class="anu_set">
                  No of Item: <spam id="no_of_item"></spam><br />
                  Amount : <strong><spam id="amout_word"></spam>Rs Only</strong><br />
                  
                  </td>
                  <td colspan="2" align="right" class="anu_set">
                  Amount : <spam id="total"></spam><br />
                  Taxes : <spam id="tax"></spam><br />
                  Discount : <spam id="discount"></spam><br />
                  NET Amount.:<spam id="net_bill"></spam> 
                  </td>
                </tr> 
                <tr>
                  <td colspan="6" class="anu_set">Sig. of Authorised Signatory<br />
                  Name & Status :</td>
                  <td colspan="1" align="center" class="anu_set">Sig. Of Receiver</td>
                  <td colspan="3" class="anu_set">Sig. Of Person issuing invoice<br />
                  Name & Status :</td>
                </tr>
                <tr>
                  <td colspan="10" class="anu_set"><strong>SUBJECT TO GORAKHPUR JURISDICTION ONLY</strong><br />On the assurance of the party that they havegot there valide<br />Drug licence or he is a r.m.p. .we are executing the indent</td>
                <tr>
                <tr ><td colspan="8" class="anu_set" style=" border-radius:0px 0px 0px 8px;">Inclusive of all Taxes.</td><td align="right" colspan="2" class="anu_set" style=" border-radius:0px 0px 8px 0px;"><input type="submit" value="Print" onClick="prnt()"></td></tr>
                </tfoot>
            </table>
          </div>
          <!--<p><center><br/><br/><br/>This page is under construction.<br/><br/><br/></center></p>-->
      </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $('#sidebar-toggle').trigger('click');
        var purchase_stock_product_list =  Service_Store.getLocal('purchase_stock_product_list');
        purchase_stock_product_list = JSON.parse(purchase_stock_product_list);
        var result = purchase_stock_product_list;
        console.log(result);
		ajaxloader.async = false;
        ajaxloader.load('ajax/get_invoice_no.php',function(resp){ 
          ajaxloader.async = false;
		  var invoice = resp;
          $('#invoice_no').html(invoice);
        });
        
        $('#address').html(result['address']);
        $('#name').html(result['name']);
        $('#mobile').html(result['mobile_no']);
        $('#date').html(result['cash_invoice_date']);
        $('#type_type').html(result['payment_type']);
        $('#tin_no').html(result['tin_no']);   
        var len = (result['products']).length;
        $('#no_of_item').html(len);
        var tr = '';
		var total= 0;
        var gross_tax=0;
        var discount = 0;
        for(var i=0;i<len; i++) 
        {
		      var tax_item = '';
			    var tax_per = 0;
              ajaxloader.async = false;
              ajaxloader.load('ajax/get_tax.php?tax_id='+result['products'][i]['tax_id'],function(resp){
                 ajaxloader.async = true;
                 tax = JSON.parse(resp);
          				 $.each(tax, function(index, item){
          				     tax_item += item.name+'-'+item.tax_rate+'<br />';
          					 tax_per += parseFloat(item.tax_rate);
				            });
              });
              ajaxloader.async = false;
              ajaxloader.load('ajax/get_company_datail.php?company_id='+result['products'][i]['company_id'],function(resp){
                  ajaxloader.async = true;
                  company = resp;
              });
              //alert(company);
            tr ="<tr>\
						<td width='100' class='anu_set'>"+company+"</td>\
						<td width='100' class='anu_set'>"+result['products'][i]['name']+"</td>\
						<td width='49' class='anu_set'>"+result['products'][i]['product_batch']+"</td>\
						<td width='49' class='anu_set'>"+result['products'][i]['product_type_name']+"</td>\
						<td width='100' class='anu_set'>"+result['products'][i]['product_uniform_name']+"</td>\
						<td width='85' class='anu_set'>"+result['products'][i]['quantity']+"</td>\
						<td width='53' class='anu_set'>"+result['products'][i]['gross_total']+"</td>\
						<td class='anu_set'>"+(result['products'][i]['discount']==''?0:result['products'][i]['discount'])+"%</td>\
						<td  class='anu_set'>"+result['products'][i]['total']+"</td>\
						<td width='180' class='anu_set'>"+tax_item+"<input type='hidden' name='calc_tax' value='"+tax_per+"'></td>\
				</tr>";
              $("#mytable tbody").append(tr);
        }
		$("#mytable tbody tr").each(function (){
		     total = eval(parseFloat(total) + parseFloat($(this).find('td:eq(6)').html()));
			 gross_tax = eval(parseFloat(gross_tax) + parseFloat($(this).find('td:eq(6)').html())*parseFloat($(this).find("input[name='calc_tax']").val())/100);
			 discount = eval(parseFloat(discount) + parseFloat($(this).find('td:eq(6)').html())*parseFloat($(this).find('td:eq(7)').html())/100);
		});
		
        $('#total').html(total.toFixed(2));
		$('#tax').html(gross_tax.toFixed(2));
        $('#discount').html(discount.toFixed(2));
		$('#net_bill').html(eval(parseFloat($('#total').html())+parseFloat($('#tax').html())-parseFloat($('#discount').html())).toFixed(2));
        $('#amout_word').html(toWords(parseFloat($('#net_bill').html())));
    }); 



var th = ['', 'thousand', 'million', 'billion', 'trillion'];
var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        str += 'point ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
    return str.replace(/\s+/g, ' ');
}


    function prnt()
    {

        window.print();

    }

</script>