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
		foreach (func_get_args() as $arg) {
			if (empty($arg)) {
				Session::setFlash('empty-value',
					'空の項目があります．');
				$isValid = false;
			}
		}
		if (strlen($password) < PASSWORD_LEN_MIN) {
			Session::setFlash('short-password',
				'パスワードが短すぎます');
			$isValid = false;
		}
		$user = Model::factory('User')
			->where_equal('email', $email)
			->find_one();
		if ($user) {
			Session::setFlash('duplicate-email',
				'このメールアドレスは不正か既に使われています');
			$isValid = false;
		}
		if (! $isValid) return false;
		
		$user = Model::factory('User')->create();
		$user->name = $username;
		$user->email = $email;
		$user->password = static::hashpasswd($password);
		$user->created_at = date('Y-m-d H:i:s');
		$user->updated_at = date('Y-m-d H:i:s');
		return $user->save();
	}

	protected static function hashpasswd ($password)
	{
		return hash('sha256', PASSWORD_SALT. $password);
	}
}
