<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
        public function sendEmailSMTP($data,$view,$type);            
        public function addToData($row);
}
 ?>