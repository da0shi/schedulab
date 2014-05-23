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
		$errorMssgs = array('hasError' => false);
		foreach (func_get_args() as $arg) {
			if (empty($arg)) {
				$errorMssgs['empty-value'] = '空の項目があります．';
				$errorMssgs['hasError'] = true;
			}
		}
		if (strlen($password) < PASSWORD_LEN_MIN) {
			$errorMssgs['short-password'] = 'パスワードが短すぎます';
			$errorMssgs['hasError'] = true;
		}
		$user = Model::factory('User')
			->where_equal('email', $email)
			->find_one();
		if ($user) {
			$errorMssgs['duplicate-email'] =
				'このメールアドレスは不正か既に使われています';
			$errorMssgs['hasError'] = true;
		}
		if ($errorMssgs['hasError']) return $errorMssgs;
		
		$user = Model::factory('User')->create();
		$user->name = $username;
		$user->email = $email;
		$user->password = static::hashpasswd($password);
		$user->created_at = date('Y-m-d H:i:s');
		$user->updated_at = date('Y-m-d H:i:s');

		if ($user->save() === true) {
			return $user->id();
		} else {
			return false;
		}
	}

	protected static function hashpasswd ($password)
	{
		return hash('sha256', PASSWORD_SALT. $password);
	}
}
