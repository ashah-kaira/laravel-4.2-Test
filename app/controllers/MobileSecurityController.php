<?php

use DataProviders\SecurityDataProvider;
use DataProviders\ISecurityDataProvider;
use ViewModels\LoginModel;
use ViewModels\ServiceRequest;
use ViewModels\ServiceResponse;
use \Infrastructure\Common;
use \Infrastructure\Constants;


class MobileSecurityController extends BaseController {

	protected $securityDataProvider;
	function __construct(ISecurityDataProvider $securityDataProvider){
		$this->securityDataProvider = $securityDataProvider;
	}
	public function postSignup(){
        $serviceResponse= new ServiceResponse();
		$securityDataProvider = new SecurityDataProvider();
        $serviceRequest=$this->GetObjectFromJsonRequest(Input::json()->all());
		$serviceResponse = $this->securityDataProvider->Signup($serviceRequest->Data);
        return $this->GetJsonResponse($serviceResponse);
	}
    public function postAuthenticate(){
        $serviceResponse= new ServiceResponse();
        $securityDataProvider = new SecurityDataProvider();
        $serviceRequest=$this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->securityDataProvider->postAuthenticate($serviceRequest->Data);
        if($serviceResponse->IsSuccess){
            $serviceResponse->Data=json_encode($serviceResponse->Data);
        }
        return $this->GetJsonResponse($serviceResponse);
    }
    public function postOTPverified(){
        $serviceResponse= new ServiceResponse();
        $securityDataProvider = new SecurityDataProvider();
        $serviceRequest=$this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->securityDataProvider->OTPverified($serviceRequest->Data);
        if($serviceResponse->IsSuccess){
            $serviceResponse->Data=json_encode($serviceResponse->Data);
        }

        return $this->GetJsonResponse($serviceResponse);
    }

    public function postForgot(){
        $serviceResponse = new ServiceResponse();
        $securityDataProvider = new SecurityDataProvider();
        $serviceRequest = $this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->securityDataProvider->Forgot($serviceRequest->Data);
        if($serviceResponse->IsSuccess){
            $serviceResponse->Data=json_encode($serviceResponse->Data);
        }
        return $this->GetJsonResponse($serviceResponse);
    }
}