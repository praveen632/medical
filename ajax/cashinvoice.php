<?php
  include(dirname(dirname(__FILE__)).'/include/includes.php');
  $cashinvoice = new Cashinvoice;
  if(isset($_REQUEST['opt']) && $_REQUEST['opt'] == 'total_calc'){
	$uniform_id = $_REQUEST['product_uniform'];
	$product_stock  = $cashinvoice->getStock($_REQUEST['product_id']);
	$product_detail = $cashinvoice->getProductdetail($_REQUEST['product_id']);
	$pro_uniform_id = $product_detail[0]['product_uniform'];
	$qty = $_REQUEST['quantity'];
	$total = 0;

	foreach($product_stock as $product)
	{
		$total_rest_stock = $product['rest_stock'];
		$id = $product['id'];
		if(($product['rest_stock']!= 0))
		{
				$data = "";
				if($_REQUEST['product_qty_uni']==1)
				{	
					if($total_rest_stock<=$qty)
					{
						if($total!=0)			
							$total = $total+($qty * $product['mrp']);				
						else
							$total = $total_rest_stock * $product['mrp'];
						$qty = $qty-$total_rest_stock;
					}
					else
					{
						if($total!=0)					
							$total = $total+($qty * $product['mrp']);					
						else
							$total = $qty * $product['mrp'];	
						$qty = $total_rest_stock-$qty; 
						break;
					}
				}
				else{
					if($uniform_id == $pro_uniform_id)
					{
						if($total_rest_stock<=$qty)
						{
							if($total!=0)			
								$total = $total+($qty * $product['mrp']);				
							else
								$total = $total_rest_stock * $product['mrp'];
							$qty = $qty-$total_rest_stock;
						}
						else{	
							if($total!=0)						
								$total = $total+($qty * $product['mrp']);						
							else						
							$total = $qty * $product['mrp'];
							$qty = $total_rest_stock-$qty; 
							break;	
						}					
					}
					else{
						$qty1 = $product_detail[0]['quantity']/$qty;
						$price_unit = $product['mrp']/$product_detail[0]['quantity'];
						if($total_rest_stock<=$qty1)
						{
							if($total!=0)			
								$total = $total+($qty * $price_unit);				
							else
								$total = $qty * $price_unit;
							$qty = $qty-$total_rest_stock;
						}
						else{							
							if($total!=0)
								$total = $total+($qty * $price_unit);
							else
							$total = $price_unit * $qty;
							if(is_float($qty))
								$qty = round($qty,2);
							break;
						}
					}
				}
		}		
	}
	if($_REQUEST['product_discount']!='')
	{
		$pro_discount = $_REQUEST['product_discount'];
		$discount = $total*($pro_discount/100);
		$total_with_discount = $total-$discount;
		$val['total'] =$total_with_discount;
		$val['type'] = 'total';
		$val['gross_total'] =$total;
	}
	else
	{
		$val['total'] =$total;
		$val['type'] = 'gross_total';
	}
	echo json_encode($val);
	return false;
  }
  //print_r($_REQUEST);
  $company_list = $cashinvoice->getCompanyList();
  $product_type_list = $cashinvoice->getProductType();
  $product_uniform_list = $cashinvoice->getProductUniform();
  $arr_company_list = [];
  $arr_product_type_list = [];
  $arr_product_uniform = [];
  foreach($company_list as $value) {
  	 $arr_company_list[$value['id']] = $value['name'];
  }
  foreach($product_type_list as $value) {
  	 $arr_product_type_list[$value['id']]['name'] = $value['name'];
  	 $arr_product_type_list[$value['id']]['product_uniform'] = $value['product_uniform'];
  }
  foreach($product_uniform_list as $value) {
  	 $arr_product_uniform[$value['id']] = $value['name'];
  }
  if(isset($_REQUEST['txtSearch']) && !empty($_REQUEST['txtSearch']) && $_REQUEST['type'] == 'p'){
       $rst = $cashinvoice->getProductsBySearch($_REQUEST['txtSearch']);
       //print_r($rst);
      $ro =  appendCompanyandProducttype($rst);
       echo json_encode($ro);
  }
  else if(isset($_REQUEST['txtSearch']) && !empty($_REQUEST['txtSearch']) && $_REQUEST['type'] == 'c'){
       $rst = $cashinvoice->getCompanyProductsBySearch($_REQUEST['txtSearch']);
       //print_r($rst);
      $ro =  appendCompanyandProducttype($rst);
      //print_r($ro);
       echo json_encode($ro);   
  }
  else
  {
       $rst = $cashinvoice->getProducts();
       //print_r($rst);
       $ro = appendCompanyandProducttype($rst);

       echo json_encode($ro);
  }
  //print_r($rst);
  function appendCompanyandProducttype($rst){
  	   global $arr_company_list, $arr_product_type_list, $arr_product_uniform;
  	   foreach ($arr_product_type_list as $key => $value) {
  	   	   $product_uniform='';
  	   	   foreach (explode(',',$value['product_uniform']) as $val) {
  	   	   	   $product_uniform .= $arr_product_uniform[$val].',';
  	   	   }
  	   	   $product_uniform = substr($product_uniform, 0, -1);
  	   	   $arr_product_type_list[$key]['product_uniform_name'] = $product_uniform;
  	   }
	   if(!empty($rst)){
			   foreach ($rst as $key => $value) {
				   $rst[$key]['company_name'] = (isset($arr_company_list[$value['company_id']]) ? $arr_company_list[$value['company_id']] : '');
				   $rst[$key]['product_type_name'] = (isset($arr_product_type_list[$value['product_id']]['name']) ? $arr_product_type_list[$value['product_id']]['name'] : '');
				   $rst[$key]['product_type_uniform'] = (isset($arr_product_type_list[$value['product_id']]['product_uniform']) ? $arr_product_type_list[$value['product_id']]['product_uniform'] : '');
				   $rst[$key]['product_type_uniform_name'] = (isset($arr_product_type_list[$value['product_id']]['product_uniform_name']) ? $arr_product_type_list[$value['product_id']]['product_uniform_name'] : '');
				   $rst[$key]['product_uniform_name'] = (isset($arr_product_uniform[$value['product_uniform']]) ? $arr_product_uniform[$value['product_uniform']] : '');
			   }
			   //print_r($rst);
	   }
	   else
	   {
	       $rst = array('error'=>1);
	   }
       return $rst;
  }
  
?>