<?php 
namespace DataProviders;

Interface ISecurityDataProvider {

    public function Signup($userModel);
    public function postAuthenticate($userModel);
    public function OTPverified($otpmodel);
}
