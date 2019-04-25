<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class OAuthController extends Controller {

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
	public function getLogin()
  {
    /*if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }*/

    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => $this->helpers->OAuthAppId,
      'clientSecret'            => $this->helpers->OAuthAppPassword,
      'redirectUri'             => $this->helpers->OAuthRedirectURI,
      'urlAuthorize'            => $this->helpers->OAuthAuthority.$this->helpers->OAuthAuthorizeEndpoint,
      'urlAccessToken'          => $this->helpers->OAuthAuthority.$this->helpers->OAuthTokenEndpoint,
      'urlResourceOwnerDetails' => '',
      'scopes'                  => $this->helpers->OAuthScopes
    ]);

    // Output the authorization endpoint
    $authorizationUrl = $oauthClient->getAuthorizationUrl();
    
      // Create profile for this IP and save client state so we can validate in response   
      $state = $oauthClient->getState();  
      $this->helpers->updateClient(['oauth_state' => $state]);
      $client = $this->helpers->getClient();
      $debugData = ['os'=> $state, 'client' => $client, 'authorizationUrl' => $authorizationUrl];
      #dd($debugData);

  // Redirect to authorization endpoint
  header('Location: '.$authorizationUrl);
    exit();
  }
  
  public function getAuthorize()
{
  // Authorization code should be in the "code" query param
  if (isset($_GET['code'])) {
  	$client = $this->helpers->getClient();
      $debugData = ['get'=> $_GET, 'client' => $client];
      #dd($debugData);
    if (empty($_GET['state']) || ($_GET['state'] !== $client->oauth_state) ) {
      exit('State provided in redirect does not match expected value.');
    }

    // Clear saved state
    $client->oauth_state = "";
    $client->save();
    
    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => $this->helpers->OAuthAppId,
      'clientSecret'            => $this->helpers->OAuthAppPassword,
      'redirectUri'             => $this->helpers->OAuthRedirectURI,
      'urlAuthorize'            => $this->helpers->OAuthAuthority.$this->helpers->OAuthAuthorizeEndpoint,
      'urlAccessToken'          => $this->helpers->OAuthAuthority.$this->helpers->OAuthTokenEndpoint,
      'urlResourceOwnerDetails' => '',
      'scopes'                  => $this->helpers->OAuthScopes
    ]);
    
    try {
      // Make the token request
      $accessToken = $oauthClient->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

      // Save the access token and refresh tokens in session
      // This is for demo purposes only. A better method would
      // be to store the refresh token in a secured database
      $this->helpers->updateClient(['access_token' => $accessToken->getToken(),
                                               'refresh_token' => $accessToken->getRefreshToken(),
                                               'token_expires' => $accessToken->getExpires()
                                             ]);

      // Redirect back to mail page     
      $returnUrl = "https://secure-river-33679.herokuapp.com/cobra";
      header('Location: '.$returnUrl);
    }
    catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      #exit('ERROR getting tokens: '.$e->getMessage());
      throw $e; 
    }
    exit();
  }
  elseif (isset($_GET['error'])) {
    exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
  }
}
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getHardLogin()
  {
    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => $this->helpers->OAuthAppId,
      'clientSecret'            => $this->helpers->OAuthAppPassword,
      'redirectUri'             => $this->helpers->OAuthRedirectURI,
      'urlAuthorize'            => $this->helpers->OAuthAuthority.$this->helpers->OAuthAuthorizeEndpoint,
      'urlAccessToken'          => $this->helpers->OAuthAuthority.$this->helpers->OAuthTokenEndpoint,
      'urlResourceOwnerDetails' => '',
      'scopes'                  => $this->helpers->OAuthScopes
    ]);

    try {
        $newToken = $oauthClient->getAccessToken('password', [
          'username' => $this->helpers->email,
          'password' => $this->helpers->password
        ]);

      

        return "Token: ".$newToken->getToken();
      }
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      	throw $e; 
        return '';
      }
  }
	
}