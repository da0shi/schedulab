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
}
