<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserEntity extends Eloquent implements UserInterface,   RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	public $table = 'users';
	public $primaryKey = 'UserID';
	public $incrementing = 'UserID';
	//public $timestamps = false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


	//protected $hidden = array('Password', 'Remember_Token');

    public $Model_Types = array(
        'UserID'=>'int',
        'FirstName'=>'string',
        'Email'=>'string',
        'Password'=>'string',
        'IsEnable'=>'int',
        'Mobile'=>'string',
        'City'=>'string',
        'State'=>'string',
        'FbID'=>'int',
        'DeviceID'=>'int',
        'IsAndroid'=>'int',
        'IsSocial'=>'int',
        'Photo'=>'string',
        'GoogleID'=>'int',
        'IsVerified'=>'int',
    );

    public static $userprofileUpdate_rules = array(
        'UserID'=>'required',
        'FirstName'=>'required|max:50',
        'LastName'=>'required|max:50',
        'Email'=>'required|email|max:50',
        //'Mobile'=>'required|max:10'
        //'TempPassword'=> 'regex:/^(?=(.*\d){1})(?=.*[a-zA-Z])[0-9a-zA-Z\W]{8,15}$/',
       // 'ConfirmPassword' => 'same:TempPassword'
    );

    public static $addUser_rules = array(
        'FirstName'=>'required|max:50',
        'LastName'=>'required|max:50',
        //'Email'=>'required|email|max:50'
        //'TempPassword'=> 'regex:/^(?=(.*\d){1})(?=.*[a-zA-Z])[0-9a-zA-Z\W]{8,15}$/',//'regex[a-z]|Between:8,15',
        //'ConfirmPassword' => 'same:TempPassword'
    );

    public static $niceNameArray = array(
        'UserID'=>'User ID',
        'FirstName'=>'First Name',
        'LastName'=>'Last Name',
        //'TempPassword'=>'Password',
        //'ConfirmPassword'=>'Confirm Password',
        'Password'=>'Password',
        //'Email'=>'Email',
        //'Mobile'=>'Mobile',
        'IsEnable'=>'IsEnable'
        //'ImagePath'=>'ImagePath',
    );

}
