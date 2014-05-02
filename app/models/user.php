<?php

class User extends Model
{
	public static $_table = 'users';

	public function group ()
	{
		return $this->has_one('Group');
	}

	public function schedules ()
	{
		return $this->has_many('Schedule');
	}

	public function joins ()
	{
		return $this->has_many('UserSchedule');
	}

	public static function create ($username, $email, $password)
	{
		$isValid = true;
		if (strlen($password) < PASSWORD_LEN_MIN) {
			Session::flash('short-password',
				'パスワードが短すぎます');
			$isValid = false;
		}
		$user = Model::factory('User')
			->where_equal('email', $email)
			->find_one();
		if ($user) {
			Session::flash('duplicate-email',
				'このメールアドレスは既に使われています');
			$isValid = false;
		}
		if (! $isValid) return false;
		
		$user = Model::factory('User')->create();
		$user->name = $username;
		$user->email = $email;
		$user->password = static::hashpasswd($password);
		$user->save();
		return true;
	}

	protected static function hashpasswd ($password)
	{
		return hash('sha256', PASSWORD_SALT. $password);
	}
}
