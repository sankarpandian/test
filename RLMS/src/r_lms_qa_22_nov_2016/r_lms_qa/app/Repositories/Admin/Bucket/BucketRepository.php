<?php

namespace App\Repositories\Admin\bucket;
use Illuminate\Database\Eloquent\Model;
use App\Models\lms_calldetails;
class BucketRepository extends Model
{
	public function __construct(lms_calldetails $lms_calldetails,lms_customerslots $lms_customerslots,lms_customerdetails $lms_customerdetails)
	{
		$this->lms_calldetails     = $lms_calldetails;
		$this->lms_customerslots   = $lms_customerslots;
		$this->lms_customerdetails = $lms_customerdetails;
	}
	
  public function GetListCustomerDetails($CustomerId)
  {
  $resultCustomerDetails = $this->lms_customerdetails
  ->join("lms_calldetails","lms_customerdetails.lcd_CustomerId","=","lms_calldetails.lld_CustomerId")
  ->join("lms_customerslots","lms_customerdetails.lcd_CustomerId","=","lms_customerslots.lcs_CustomerId")
  ->where("lms_customerdetails.lcd_CustomerId","=",$CustomerId)
  ->first();	
	  
	return $resultCustomerDetails;
	
  }
	
		
}
