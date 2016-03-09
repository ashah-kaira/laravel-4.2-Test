<?php
namespace DataProviders;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use \UserEntity;
use \UserRoleEntity;
use \vwLoginEntity;
use \ViewModels\ServiceResponse;
use \ViewModels\SearchValueModel;
use \Infrastructure\Constants;
use \Infrastructure\Common;
use \stdClass;
use \DateTime;
use \DateInterval;
use \Crypt;
use \Mail;
use \Authentication;

class SecurityDataProvider extends BaseDataProvider implements ISecurityDataProvider {

    public function Call(){
        return 12;
    }


    public static function GetGoogleCloudMessage($otp){
        //$token=$email;
        return array(
//            /"Token"=>$token,
            "OTP"=>$otp
        );
    }

    public function Signup($loginModel)
    {
        $response = new ServiceResponse();
        $userModel=new stdClass();
        /*$messages = array(
            'required' => trans('messages.PropertyRequired'),
            'min' => trans('messages.PropertyMin'),
            'max' => trans('messages.PropertyMax')
            //'regex' => trans('messages.passwordregex')
        );*/

        $userEntity = new UserEntity();
        $isEditMode = $loginModel->UserID > 0;
        $dateTime = date(Constants::$DefaultDateTimeFormat);

        /*$validator = Validator::make((array)$loginModel, $isEditMode ? UserEntity::$userprofileUpdate_rules : UserEntity::$addUser_rules, $messages);
        $validator->setAttributeNames(UserEntity::$niceNameArray);
        if ($validator->fails()) {
            $response->Message = Common::getValidationMessagesFormat($validator->messages());
            return $response;
        }*/

        /* Check Email */
        $searchEmailParams = array();
        $searchValueData = new SearchValueModel();
        $searchValueData->Name = "Email";
        $searchValueData->Value = $loginModel->Email;
        $searchValueData->CheckStartWith = Constants::$CheckStartWith;
        array_push($searchEmailParams, $searchValueData);

        if($isEditMode)
            $customWhere = "UserID NOT IN ($loginModel->UserID)";
        else
            $customWhere = "";

        $checkUniqueEmail = $this->GetEntityCount(new UserEntity(), $searchEmailParams, "", "", $customWhere);

        if ($checkUniqueEmail>0) {
            $response->IsSuccess = false;
            $response->Message = trans('messages.EmailAlreadyRegistered');
        } else {

            /* Check Mobile Number */
            $searchParams = array();
            $searchValueData = new SearchValueModel();
            $searchValueData->Name = "Mobile";
            $searchValueData->Value = $loginModel->Mobile;
            $searchValueData->CheckStartWith = Constants::$CheckStartWith;
            array_push($searchParams, $searchValueData);

            if ($isEditMode)
                $customWhere = "UserID NOT IN ($loginModel->UserID)";
            else
                $customWhere = "";

            $checkUniqueMobile = $this->GetEntityCount(new UserEntity(), $searchParams, "", "", $customWhere);
            if ($checkUniqueMobile > 0) {
                $response->IsSuccess = false;
                $response->Message = trans('messages.MobileAlreadyRegistered');
            } else {
                if ($isEditMode) {
                    $userEntity = $this->GetEntityForUpdateByPrimaryKey(new UserEntity(), $loginModel->UserID);
                    $userEntity->ModifiedDate = $dateTime;
                } else {
                    $userEntity->CreatedDate = $dateTime;


                    $userEntity->ModifiedDate = $dateTime;
                }

                $userEntity->FirstName = $loginModel->FirstName;
                $userEntity->LastName = $loginModel->LastName;
                $userEntity->Email = $loginModel->Email;
                $userEntity->Password = md5($loginModel->Password);
                $userEntity->City = $loginModel->City;
                $userEntity->IsAndroid =property_exists($loginModel,'IsAndroid')?'yes':Constants::$Value_False;
                $userEntity->IsEnable = Constants::$Value_True;
                $userEntity->IsSocial = property_exists($loginModel,'IsSocial')?$loginModel->IsSocial:Constants::$Value_False;
                $userEntity->Mobile = $loginModel->Mobile;
                $userEntity->DeviceID = property_exists($loginModel,'DeviceID')?$loginModel->DeviceID:Constants::$Value_False;
                $otp = rand(100000, 999999);
                $userEntity->OTP=$otp;
                $userResult = $userEntity->save();

                $userRoleEntity = new UserRoleEntity();
                $userRoleEntity->UserID = $userEntity->UserID;
                $userRoleEntity->RoleID = Constants::$RoleCustomer;
                $userRoleEntity->save();

                $UserDetails=UserEntity::find($userEntity->UserID);

                $message=file_get_contents("http://smsc.a4add.com/api/smsapi.aspx?username=naresh123&password=naresh123&from=SMCLUB&to=".$UserDetails->Mobile."&message=".urlencode("Dear Customer, One Time Password(OTP) to complete registration is ").$UserDetails->OTP.urlencode(" DO NOT share with anyone.")."");

                if ($isEditMode) {
                    $response->Message = trans('messages.UserUpdateSuccess');
                } else {
                    $response->Message = trans('messages.UserCreationSuccess');
                    //common::SendGoogleCloudMessage($deviceUdID, self::GetGoogleCloudMessage($otp));
                }
                $response->Data = $UserDetails;
                $response->IsSuccess = true;
            }
        }
        return $response;
    }


    public function postAuthenticate($loginModel)
    {
        $response = new ServiceResponse();

        $userEntity = new UserEntity();
        $dateTime = date(Constants::$DefaultDateTimeFormat);
        if(property_exists($loginModel,'IsSocial')){
            $searchParams = array();

            $searchUserParams=Array();
            $searchValueData=new SearchValueModel();
            $searchValueData->Name="Email";
            $searchValueData->Value = $loginModel->Email;
            array_push($searchUserParams, $searchValueData);

            $searchValueData = new SearchValueModel();
            $searchValueData->Name = "IsVerified";
            $searchValueData->Value = Constants::$Value_True;
            array_push($searchUserParams, $searchValueData);

            $check = $this->GetEntity(new vwLoginEntity(),$searchUserParams);

            if($check)
            {
                $response->Data = $check;
                $response->IsSuccess = true;
                $response->Message = trans('messages.LoginSuccess');
            }else{
                $userEntity->FirstName = $loginModel->FirstName;
                $userEntity->LastName = $loginModel->LastName;
                $userEntity->Email   = $loginModel->Email;
                $userEntity->IsAndroid = property_exists($loginModel,'IsAndroid')?'yes':Constants::$Value_False;
                $userEntity->IsEnable   = Constants::$Value_True;
                $userEntity->IsSocial   = Constants::$Value_True;

                if(!empty($loginModel->GoogleID))
                    $userEntity->GoogleID = $loginModel->GoogleID;

                if(!empty($loginModel->FbID))
                    $userEntity->FbID = $loginModel->FbID;

                $userEntity->Mobile = $loginModel->Mobile;
                $userEntity->DeviceID = property_exists($loginModel,'DeviceID')?$loginModel->DeviceID:Constants::$Value_False;
                $otp = rand(100000, 999999);
                $userEntity->OTP=$otp;
                $userResult = $userEntity->save();

                $userRoleEntity = new UserRoleEntity();
                $userRoleEntity->UserID = $userEntity->UserID;
                $userRoleEntity->RoleID = Constants::$RoleCustomer;
                $userRoleEntity->save();

                $UserDetails = UserEntity::find($userEntity->UserID);

                //$message=file_get_contents("http://smsc.a4add.com/api/smsapi.aspx?username=naresh123&password=naresh123&from=SMCLUB&to=".$UserDetails->Mobile."&message=".urlencode("Your OTP for mobile verification is ").$UserDetails->OTP."");
                $message=file_get_contents("http://smsc.a4add.com/api/smsapi.aspx?username=naresh123&password=naresh123&from=SMCLUB&to=".$UserDetails->Mobile."&message=".urlencode("Dear Customer, One Time Password(OTP) to complete registration is ").$UserDetails->OTP.urlencode(" DO NOT share with anyone.")."");
                $response->Message = trans('messages.LoginSuccess');
                $response->Data = $UserDetails;
                $response->IsSuccess = true;
            }

        }else{

            $searchLoginParams = array();

            $searchValueData = new SearchValueModel();
            $searchValueData->Name = "Email";
            $searchValueData->Value = $loginModel->Email;
            array_push($searchLoginParams, $searchValueData);

            $searchValueData = new SearchValueModel();
            $searchValueData->Name = "IsVerified";
            $searchValueData->Value = Constants::$Value_True;
            array_push($searchLoginParams, $searchValueData);

            $searchValueData = new SearchValueModel();
            $searchValueData->Name = "Password";
            $searchValueData->Value = md5($loginModel->Password);
            array_push($searchLoginParams, $searchValueData);

            $checkLogin = $this->GetEntity(new vwLoginEntity(),$searchLoginParams);
            if($checkLogin) {
                $response->Data=$checkLogin;
                $response->IsSuccess = true;
                $response->Message = trans('messages.LoginSuccess');
            }else{
                $response->IsSuccess = false;
                $response->Message = trans('messages.LoginFail');
            }
        }
        return $response;
    }

    public function OTPverified($otpmodel){
        $response= new ServiceResponse();
        $users=DB::Table('users')->where('UserID',$otpmodel->UserID)->where('OTP',$otpmodel->OTP)->first();
        if($users){
            $userentity=UserEntity::find($users->UserID);
            $userudpate=DB::Table('users')->where('UserID',$users->UserID)->update(array('IsVerified' => Constants::$Value_True));
            $response->Data=$users;
            $response->IsSuccess = true;
            $response->Message = trans('messages.OTPverified');
        }
        else{
            $response->IsSuccess = false;
            $response->Message = trans('messages.OTPincorrect');
        }
        return $response;
    }

    public function Forgot($forgotmodel){
        $response= new ServiceResponse();

    }


}