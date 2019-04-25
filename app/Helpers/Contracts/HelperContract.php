<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
        public function sendEmailSMTP($data,$view,$type);     
        public function clearTokens();
        public function getClient();
        public function updateClient($data);
        public function getAccessToken();
        public function getHardLink($state);
        public function sendRequest($data);
}
 ?>