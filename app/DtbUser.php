<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class DtbUser extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens,Notifiable;
	protected $fillable = [

        'first_name',
        'email','api_token', 'password','role',
      
	];

	protected $hidden = [
        'password', 'remember_token',
    ];
	public function getCreated_timestampAttribute()
	{
	    return $this->created_at->timestamp();
	}

    public function verifyUser()
	{
    	  return $this->hasOne('App\VerifyUser', 'user_id');
	}   

	public function dtbissue()
	{
	  return $this->hasOne('App\DtbIssue', 'user_id');
	}	

	public function teamuser()
	{
	  return $this->hasOne('App\DtbDevelopTeamUser', 'user_id');
	}	

	public function usersproject()
	{
	  return $this->hasOne('App\DtbUsersProject', 'user_id');
	}

	public function roles(){
		return $this->belongsTo('App\MtbRole', 'role', 'id');
	}

	public function plans(){
		return $this->belongsTo('App\FitnessMemberPackage', 'plan_type', 'id');
	}

	public function language(){
		return $this->belongsTo('App\MtbLanguage', 'language_id', 'id');
	}

	public function timezone(){
		return $this->belongsTo('App\MtbTimezone', 'timezone_id', 'id');
	}

	public static function registration($request){

		$develop_group = new DtbDevelopGroup;
		$develop_group->space_name = $request->space_name;
		$data = $develop_group->save();
		$last_developer_id = $develop_group->id;

		if($data){
			$user = new DtbUser;
	        $user->name = $request->name;
			$user->email = $request->email;
			$user->password = md5($request->password);
			$user->developer_id = $last_developer_id;
			$user->role = 0;   
			$result = $user->save();
			$LastInsertId = $user->id;

			if($result){
				$verifyusers = new VerifyUser;
				$verifyusers->user_id = $LastInsertId;
				$verifyusers->token = sha1(time());
				$result = $verifyusers->save();
			}

			return $user;
		}
    }

    public static function addUser($request){

		$cloud_front_path="";
		$userImageFile = "";
		if ($request->hasFile('userImage')) {
// 		    $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
		    $cloud_front_path = 'https://'.env('AWS_URL') . '/';
			$userImageFile = Storage::disk('s3')->put('users', $request->userImage);
		}

		$password = '123456';
		$developer_id = Session::get('developer_id');
		$user = new DtbUser;
		$user->ud_id = $request->ud_id;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = md5($password);
		$user->developer_id = $developer_id;
		$user->role = $request->role;
		$user->icon_image_path = $cloud_front_path.$userImageFile;
		$user->language_id = $request->language_id;
		$user->timezone_id = $request->timezone_id;  
		$user->verified = 1;
		$result = $user->save();
		$LastInsertId = $user->id;

		if(!empty($request->team_id)){
			if($result){
				$data = new DtbDevelopTeamUser;
				$data->team_id = $request->team_id;
				$data->user_id = $LastInsertId;
				$results = $data->save();
			}
		}

		if(!empty($request->projects)){
		    if($result){
				for($x=0; $x<count($request->projects); $x++){
					$data = new DtbUsersProject;
					$data->project_id = $request->projects[$x];
					$data->user_id = $LastInsertId;
					$results = $data->save();
				}
				
			}
		}
		
		return $user;
		
    }

    public static function updateUser($request, $id){

		$cloud_front_path = "";
		$userImageFile = "";
		if ($request->hasFile('userImage')) {
// 			$url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
			$cloud_front_path = 'https://'.env('AWS_URL') . '/';
			$userImageFile = Storage::disk('s3')->put('users', $request->userImage);
		}
		else{
			$user = DtbUser::find($id);
            $userImageFile = $user->icon_image_path;
		}

	    $developer_id = Session::get('developer_id');
		$user = DtbUser::find($id);
		$user->ud_id = $request->ud_id;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->developer_id = $developer_id;
		$user->role = $request->role;
		$user->icon_image_path = $cloud_front_path.$userImageFile;
		$user->language_id = $request->language_id; 
		$user->timezone_id = $request->timezone_id;   
		$result = $user->update();
		
        if(!empty($request->team_id)){
			if($result){
				DtbDevelopTeamUser::where('user_id',$id)->delete();
				$userTeams = new DtbDevelopTeamUser;
				$userTeams->team_id = $request->team_id;
				$userTeams->user_id = $id;
				$userTeams->save();
			}
		}

		
		if(!empty($request->projects)){
		    if($result){
		    	$deleteUserProjects = DtbUsersProject::where('user_id',$id)->delete();
			    	for($x=0; $x<count($request->projects); $x++){
						$data = new DtbUsersProject;
						$data->project_id = $request->projects[$x];
						$data->user_id = $id;
						$results = $data->save();
					}
		    }
		}
		
		return $user;
		
    }

   public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }
    //Update last access URL
    public static function updateUserLastAccessUrl($request){
        
        $user = DtbUser::find($request->id);
        $user->url1 = $request->url1;
        $user->update();

        return $user;
        
	}
	
	public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }


    public static function addCustomer($request){

    	if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/users');
            $upload->move($destinationPath, $upload_name);
            $user_image = '/uploads/users/'.$upload_name;
            
        }
        else{
        	$user_image = '';
        }

        if(isset($request->invitation)){
        	$invite_status = $request->invitation;
        }
        else{
        	$invite_status = 0;
        }

		$password = '123456';
		$user = new DtbUser;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->current_address = $request->current_address;
		$user->gender = $request->gender;
		$user->zipcode = $request->zipcode;
		$user->mobile = $request->mobile;
		$user->city = $request->city;
		$user->country = $request->country;
		$user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
		$user->email = $request->email;
		//$user->password = md5($password);
		$user->password = bcrypt($password);
		$user->role = 2;
		$user->invite_status = $invite_status;
		$user->icon_image_path = $user_image;
		//$user->icon_image_path = $cloud_front_path.$userImageFile;
		$user->verified = 1;
		$result = $user->save();
		$LastInsertId = $user->id;

		// if(!empty($request->team_id)){
		// 	if($result){
		// 		$data = new DtbDevelopTeamUser;
		// 		$data->team_id = $request->team_id;
		// 		$data->user_id = $LastInsertId;
		// 		$results = $data->save();
		// 	}
		// }

		return $user;
		
    }

    public static function editCustomer($request, $id){

    	$user = DtbUser::find($id);

    	if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/users');
            $upload->move($destinationPath, $upload_name);
            $user_image = '/uploads/users/'.$upload_name;
            
        }
        else{

        	$user_image = $user->icon_image_path;
        }
        

		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->current_address = $request->current_address;
		$user->gender = $request->gender;
		$user->zipcode = $request->zipcode;
		$user->mobile = $request->mobile;
		$user->city = $request->city;
		$user->country = $request->country;
		$user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
		$user->email = $request->email;
		$user->icon_image_path = $user_image;
		$result = $user->update();
		// $LastInsertId = $user->id;

		// if(!empty($request->team_id)){
		// 	if($result){
		// 		$data = new DtbDevelopTeamUser;
		// 		$data->team_id = $request->team_id;
		// 		$data->user_id = $LastInsertId;
		// 		$results = $data->save();
		// 	}
		// }

		return $user;
		
    }

    public static function addCoach($request){

    	if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/users');
            $upload->move($destinationPath, $upload_name);
            $user_image = '/uploads/users/'.$upload_name;
            
        }
        else{
        	$user_image = '';
        }

		$password = '123456';
		$user = new DtbUser;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->current_address = $request->current_address;
		$user->gender = $request->gender;
		$user->zipcode = $request->zipcode;
		$user->mobile = $request->mobile;
		$user->city = $request->city;
		$user->country = $request->country;
		$user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
		$user->email = $request->email;
		$user->password = md5($password);
		$user->role = 1;
		$user->icon_image_path = $user_image;
		//$user->icon_image_path = $cloud_front_path.$userImageFile;
		$user->verified = 1;
		$result = $user->save();
		$LastInsertId = $user->id;

		// if(!empty($request->team_id)){
		// 	if($result){
		// 		$data = new DtbDevelopTeamUser;
		// 		$data->team_id = $request->team_id;
		// 		$data->user_id = $LastInsertId;
		// 		$results = $data->save();
		// 	}
		// }

		return $user;
		
    }

    public static function editCoach($request, $id){

    	$user = DtbUser::find($id);

    	if ($request->hasFile('upload_document')) {
            $upload = $request->file('upload_document');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/users');
            $upload->move($destinationPath, $upload_name);
            $user_image = '/uploads/users/'.$upload_name;
            
        }
        else{

        	$user_image = $user->icon_image_path;
        }
        

		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->current_address = $request->current_address;
		$user->gender = $request->gender;
		$user->zipcode = $request->zipcode;
		$user->mobile = $request->mobile;
		$user->city = $request->city;
		$user->country = $request->country;
		$user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
		$user->email = $request->email;
		$user->icon_image_path = $user_image;
		$result = $user->update();
		

		return $user;
		
    }


    

	public function generateTwoFactorCode()
{
    $this->timestamps = false;
    $this->two_factor_code = rand(100000, 999999);
    $this->two_factor_expires_at = now()->addMinutes(10);
    $this->save();
}

    

}
