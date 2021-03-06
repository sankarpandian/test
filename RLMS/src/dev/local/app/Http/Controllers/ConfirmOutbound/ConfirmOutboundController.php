<?php

namespace App\Http\Controllers\ConfirmOutbound;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\home;
use App\Models\lms_customerdetails;
use App\Models\lms_calldetails;
use App\Models\lms_customerslots;
use App\Models\lms_callstatus;

class ConfirmOutboundController extends Controller
{
	public function __construct(home $home)
	{
		
		$this->home= $home;		
	}

 public function confirmOutbound()
 {
 	/* $user_id = session('usrs_userid');
 	//$user_id =1;
    $list_dashborad_data = $this->home->get_dashboard_menu($user_id);

	$message=array('title' => 'Scheduling Outbound',  'description' => "" , 'page' => 'Scheduling Outbound','get_dashborad_data' => $list_dashborad_data);
 	$call_status=lms_callstatus::whereIn('lmscs_call_status_id',[21,22,31,23,27])->get();
 	$user= lms_customerdetails::join('lms_calldetails','lms_customerdetails.lcd_CustomerId','=','lms_calldetails.lld_CustomerId')
 	->join('lms_branches','lms_customerdetails.lcd_Territory','=','lms_branches.lmsb_territory_id')
 	->join('lms_products','lms_calldetails.lld_ProductCode','=','lms_products.product_code')
 	->where('lld_CallStatusId','=',2)
	->orWhere('lld_CallStatusId', '=', 1)->first();
	if(count($user)==0)
	{
		$user = array('null');
	}*/
  	$get_all_user_data  = Session::all();
	$sess_user_id       = $get_all_user_data['usrs_userid'];
	$agent_access=$this->home->get_dashboard_menu($sess_user_id);
	
	$customer_details= lms_customerdetails::join('lms_calldetails','lms_customerdetails.lcd_CustomerId','=','lms_calldetails.lld_CustomerId')
 	->join('lms_branches','lms_customerdetails.lcd_Territory','=','lms_branches.lb_TerritoryId')
 	->join('lms_products','lms_calldetails.lld_ProductCode','=','lms_products.lp_ProductCode')
 	->where('lms_calldetails.lld_CallStatusId','=',2)->first();
	
	
	
	
    return view('ConfirmationOutbound.ConfirmationCallerScreen',array('title' => 'Confirmation Outbound', 'description' =>'Confirmation Outbound' , 'page' => 'Confirmation Outbound','get_dashborad_data' => $agent_access,'customer_details'=>$customer_details));

 	
 	
 }
}
