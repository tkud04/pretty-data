<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use App\AADTokens;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use GuzzleHttp\Client;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class Helper implements HelperContract
{

    public $OAuthAppId; 
    public $OAuthAppPassword; 
    public $OAuthRedirectURI; 
    public $OAuthScopes; 
    public $OAuthAuthority; 
    public $OAuthAuthorizeEndpoint; 
    public $OAuthTokenEndpoint; 
    public $ip;
    public $email;
    
    
    public function __construct()
    {
        $this->OAuthAppId = "d8a3d583-b436-49a8-9345-b8bb48e9e64f";
        $this->OAuthAppPassword = "r$(/Q^-(&{^/2)R>>x3@u%H/!K(^>W++=::%";
        $this->OAuthRedirectURI = "https://secure-river-33679.herokuapp.com/emext-authorize";
        $this->OAuthScopes = "openid profile offline_access User.Read Mail.Read Contacts.Read";
        #$this->OAuthScopes = "https//graph.microsoft.com/.default";
        $this->OAuthAuthority = "https://login.microsoftonline.com/common";
        $this->OAuthAuthorizeEndpoint = "/oauth2/v2.0/authorize";
        $this->OAuthTokenEndpoint = "/oauth2/v2.0/token";        
        $this->ip = $_SERVER['REMOTE_ADDR'];    
        $this->email = "kellywill343@outlook.com";    
        $this->password = "disenado12345";    
    }

          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $image
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('ceokhalifawali@gmail.com',"Khalifa Wali");
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                            $message->from('ceokhalifawali@gmail.com',"Khalifa Wali");
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }          
           
           function sendEmailSMTP($data,$view,$type="view")
           {
           	    // Setup a new SmtpTransport instance for new SMTP
                $transport = "";
if($data['sec'] != "none") $transport = new Swift_SmtpTransport($data['ss'], $data['sp'], $data['sec']);

else $transport = new Swift_SmtpTransport($data['ss'], $data['sp']);

   if($data['sa'] != "no"){
                  $transport->setUsername($data['su']);
                  $transport->setPassword($data['spp']);
     }
// Assign a new SmtpTransport to SwiftMailer
$smtp = new Swift_Mailer($transport);

// Assign it to the Laravel Mailer
Mail::setSwiftMailer($smtp);

$se = $data['se'];
$sn = $data['sn'];
$to = $data['em'];
$subject = $data['subject'];
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject,$se,$sn){
                           $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject,$se,$sn){
                            $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }    


function updateClient($data) { 
	#$access_token, $refresh_token, $expires
	$tokens = AADTokens::where('client_id',$this->email)->first();
    $access_token = isset($data['access_token']) ? $data['access_token'] : "";
    $refresh_token = isset($data['refresh_token']) ? $data['refresh_token'] : "";
    $expires = isset($data['expires']) ? $data['expires'] : "";
    $oauth_state = isset($data['oauth_state']) ? $data['oauth_state'] : "";
    
    if($tokens == null){
    	$tokens = AADTokens::create(['client_id' => $this->OAuthAppId, 
                                            'access_token' => $access_token,
                                            'refresh_token' => $refresh_token,
                                            'token_expires' => $expires,
                                            'oauth_state' => $oauth_state,
                                           ]);      
    }
    else{
      if(isset($data['access_token'])) $tokens->access_token = $access_token;
      if(isset($data['refresh_token'])) $tokens->refresh_token = $refresh_token;
      if(isset($data['token_expires']))  $tokens->token_expires = $expires;
      if(isset($data['oauth_state'])) $tokens->oauth_state = $oauth_state;
        $tokens->save();
   }                                        
    return $tokens;
  }      
  
  function getClient() { 
  	$tokens = AADTokens::where('client_id',$this->email)->first();
    if($tokens == null){
    	$tokens = AADTokens::create(['client_id' => $this->email,  
                                            'access_token' => "",
                                            'refresh_token' => "",
                                            'token_expires' => "",
                                            'oauth_state' => "",
                                           ]);      
    }
    return $tokens;
  }      
  
 function clearTokens() {
    $tokens = AADTokens::where('client_id',$this->email)->first();
    
    if($tokens != null){
    	$tokens->access_token = "";
        $tokens->refresh_token = "";
        $tokens->token_expires = "";
        $tokens->save();
        #dd($tokens); 
    }
  }
   
   function getAccessToken() {
   	$tokens = AADTokens::where('client_id',$this->email)->first();
    // Check if tokens exist
    if($tokens == null){
      return '';
    }

    // Check if token is expired
    //Get current time + 5 minutes (to allow for time differences)
    $now = time() + 300;
    if ($tokens->token_expires <= $now) {
      // Token is expired (or very close to it)
      // so let's refresh

      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => $this->OAuthAppId,
      'clientSecret'            => $this->OAuthAppPassword,
      'redirectUri'             => $this->OAuthRedirectURI,
      'urlAuthorize'            => $this->OAuthAuthority.$this->OAuthAuthorizeEndpoint,
      'urlAccessToken'          => $this->OAuthAuthority.$this->OAuthTokenEndpoint,
      'urlResourceOwnerDetails' => '',
      'scopes'                  => $this->OAuthScopes
    ]);

      try {
        $newToken = $oauthClient->getAccessToken('client_credentials', [
          'username' => $this->email,
          'password' => $this->password
        ]);

        // Store the new values
        $this->helpers->updateClient(['access_token' => $newToken->getToken(),
                                               'refresh_token' => $newToken->getRefreshToken(),
                                               'token_expires' => $newToken->getExpires()
                                             ]);

        return $newToken->getToken();
      }
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      	throw $e; 
        return '';
      }
    }
    else {
      // Token is still valid, just return it
      return $tokens->access_token;
    }
  }
  
  function getHardLink($state)
 {
 	$ret = $this->OAuthAuthority.$this->OAuthAuthorizeEndpoint;
     $ret .= "?state=$state";
     $ret .= "&scope=".urlencode($this->OAuthScopes);
     $ret .= "&response_type=code";
     $ret .= "&approval_prompt=auto";
     $ret .= "&redirect_uri=".urlencode($this->OAuthRedirectURI);
     $ret .= "&client_id=$this->OAuthAppId";
     
     #dd($ret); 
     return $ret; 
 }
 
 function sendRequest($data)
 {
 	$client = new Client();
        $res = $client->request($data['method'], $data['url'], [
         'form_params' => ['grant_type' => "authorization_code",
                               'code' => $data['code'],
                               'redirect_uri' => $this->OAuthRedirectURI,
                               'client_id' => $this->OAuthAppId,
                               'client_secret' => $this->OAuthAppPassword,
                              ]
        ]);
        $ret = [
           'status-code' => $res->getStatusCode(), // 200
          'header' => $res->getHeader('content-type'), // 'application/json; charset=utf8'
          'body' => $res->getBody()->getContents(), // {"type":"User"...'
        ];
return $ret; 
 }
 
 function getContacts($token)
 {
 	$graph = new Graph();
     $graph->setAccessToken($token);

     $user = $graph->createRequest('GET', '/me')
                ->setReturnType(Model\User::class)
                ->execute();

     #echo 'User: '.$user->getDisplayName();
     
       $contactsQueryParams = array (
    // // Only return givenName, surname, and emailAddresses fields
    "\$select" => "givenName,surname,emailAddresses",
    // Sort by given name
    "\$orderby" => "givenName ASC",
    // Return at most 100 results
    "\$top" => "100"
  );

  $getContactsUrl = '/me/contacts?'.http_build_query($contactsQueryParams);
  $contacts = $graph->createRequest('GET', $getContactsUrl)
                    ->setReturnType(Model\Contact::class)
                    ->execute();
   #dd($contacts);
   
   //Save contacts to array
   $ret = [];
   foreach($contacts as $c)
   {
   	$temp = [];
   	if($c->getGivenName() == null && $c->getSurname() == null)
       {
       }
       else
       {
       	$temp['name'] = $c->getGivenName().' '.$c->getSurname();
           $emails = $c->getEmailAddresses();
           
           if(count($emails) > 0)
           {
           	$temp['emails'] = [];
               foreach($emails as $em) 
               {
               	if($em['address'] != null && $em['address'] != "")
                   {
                   	array_push($temp['emails'], $em['address']);
                   }
               }
               array_push($ret,$temp);
           }
       }
   	
   }
   return $ret; 
 }
   
   
}
?>