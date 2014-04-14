<?php

class UserSchedule extends Model
{
	public static $_table = 'users_schedules';

	public function users ()
	{
		return $this->has_many('User');
	}

	public function schedules ()
	{
		return $this->has_many('Schedule');
	}

}
