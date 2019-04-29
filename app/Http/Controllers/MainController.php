<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use Redirect; 
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataBatchImport;

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
        $ret = null;
	
    	return view("index");
    }
    
    
    
    public function getBomb(Request $request)
	{
           $req = $request->all();
		   #dd($req);
           $ret = "";
              #{'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth};
                $validator = Validator::make($req, [
                             'em' => 'required|email',
                             'msg' => 'required',
                             'subject' => 'required',
                             'sn' => 'required',
                             'se' => 'required|email',
                             'ss' => 'required',
                             'sp' => 'required',
                             'su' => 'required',
                             'spp' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = json_encode(["op" => "mailer","status" => "error-validation"]);
                       
                 }
                
                 else
                 {              	 
                       $msg = $req["msg"];
                       $em = $req["em"];
                       $title = $req["subject"];

                       $this->helpers->sendEmailSMTP($req,'emails.cp_alert','view'); 
			
                       $ret = json_encode(["op" => "mailer","status" => "ok"]);       
                  }       
           return $ret;                                                                                            
	}
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postImport(Request $request)
    {
        if($request->hasFile('dataa'))
        {
        	$status = "ok";
        	$file = $request->file('dataa');
            Excel::import(new DataBatchImport($this->helpers), $file);
        }
    	return redirect()->intended('result');
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getResult()
    {
        $ret = null;
	    dd($this->helpers->dataa);
    	return view("index");
    }
	
}