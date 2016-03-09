<?php

namespace Infrastructure;

use Illuminate\Support\Facades\DB;
use \Mail;
use \stdClass;

class Common
{
	
	public static function SendEmail($bodyTempate, $bodyData,$subject, $toEmail,$toEmailName)
	{
		try
		{
			 $dataModel=new StdClass();
			 $dataModel->Subject=$subject;
			 $dataModel->ToEmail=$toEmail;
			 $dataModel->ToEmailName=$toEmailName;
			 $array=(array)$dataModel;

			 

			 Mail::queue($bodyTempate, $bodyData, function($message) use ($array)
			  {
				 $message->to($array['ToEmail'],$array['ToEmailName'])->subject($array['Subject']);
			  });

			  
		}
		catch (Exception $e)
		{
			
		}
	}

    public static function getValidationMessagesFormat($validationMessage){
        $validationMessagesArray = "";
        foreach($validationMessage->toArray() as $key=>$value){
            $validationMessagesArray.= '<li>'.$value[0].'</li>';
        }
        return $validationMessagesArray;
    }

	public static function myRandom($no,$isNumeric=false, $chr = 'ACEFHJKMNPRTUVWXY4937',$str = "") {
		if($isNumeric)
			$chr="1234567890";
		 $length = strlen($chr);
		  while($no --) {
			   $str .= $chr{mt_rand(0, $length- 1)};
		  }
       return $str;
    }

	public static function SendGoogleCloudMessage($deviceToken, $messageArray)  
	{  

			$AuthorizationKey='AIzaSyAYW66HrRW8dLHpWZ1dw6JJBaeOMcdOo44';

			$url = 'https://android.googleapis.com/gcm/send';
			$headers = array('Authorization:key=' . $AuthorizationKey,'Content-Type: application/json');  
			$data = array(  
				'to' =>  $deviceToken,  
				//'collapse_key' => $collapseKey,  
				//'data.title'=>'Title Goes Here',
				'data' => $messageArray);
		  
//return json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);  
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
			curl_setopt($ch, CURLOPT_POST, true);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  
		  

			$response = curl_exec($ch); 

			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

			if (curl_errno($ch)) {  
				//request failed  
				return 'false';//probably you want to return false  
			}  

			if ($httpCode != 200) {  
				//request failed  
				return 'false';//probably you want to return false  
			}  

//return 1;
			curl_close($ch);  
			return $response;  
	}
	
	public static function GetGoogleCloudMessage($userID,$message,$EventType='',$issue_id='',$project_id='',$project_name=''){

      return array(
      	"UserID"=>$userID,
      	"Message"=>$message,
      	"EventType"=>$EventType,
		"issue_id"=>$issue_id,
		  "project_id"=>$project_id,
		  "project_name"=>$project_name
	  );
    }
   
	public static function EncryptionDecryption($action, $string) {
		$output = false;
	
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'secret_key_AES-256-CBC';
		$secret_iv = 'secret_iv_AES-256-CBC';
	
		// hash
		$key = hash('sha256', $secret_key);
	
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
	
		return $output;
	}
	
	public static function GetEncryptedvalue($propertyName)
	{
		return urlencode(Common::EncryptionDecryption('encrypt', $propertyName));
	}

	public static function GetDencryptedvalue($propertyName)
	{
		return urldecode(Common::EncryptionDecryption('decrypt', $propertyName));
	}
}