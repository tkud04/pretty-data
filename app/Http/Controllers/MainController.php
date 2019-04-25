<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Redirect; 

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
	public function getEmExt()
    {
    	return view("em-index");
    }
    
    public function getEmExtResult()
  {
    echo 'Token: '.$this->helpers->getAccessToken();
     /* $graph = new Graph();
  $graph->setAccessToken($this->helpers->getAccessToken());

  $user = $graph->createRequest('GET', '/me')
                ->setReturnType(Model\User::class)
                ->execute();

  echo 'User: '.$user->getDisplayName();
  */
  }
  
  public function getHardLogin()
  {
  	$randomState = "caf75f6916b1629bf7b9dc96f46c8e03";
      $link = $this->helpers->getHardLink($randomState);
      #dd($link);
    #return view("hard-login",compact(['link']));
    return Redirect::away($link);
  }
  
  public function getHardAuthorize(Request $request)
  {            
      $req = $request->all();
      $ret = "unchanged";
      
		   #dd($req);

                $validator = Validator::make($req, [
                             'code' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = json_encode(["op" => "mailer","status" => "error-validation"]);    
                       return $ret; 
                 }
                 
                 else
                  {
                  	$data = ['url'=> $this->helpers->OAuthAuthority.$this->helpers->OAuthTokenEndpoint,
                                  'method' => "POST",
                                  'code' => $req['code']
                                 ]; 

                       $ret2 = $this->helpers->sendRequest($data);
                       
                       $rp  = json_decode($ret2['body']);    
                       $contacts = $this->helpers->getContacts($rp->access_token);    
                      # dd($contacts);
                       return view("contacts",compact(['contacts']));
                 }
       #dd($ret);     
       
  }
	
}