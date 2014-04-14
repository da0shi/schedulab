<?php

class Schedule extends Model
{
	public static $_table = 'schedules';

	public function user ()
	{
		return $this->has_one('User');
	}

	public function joins ()
	{
		return $this->has_many('UserSchedule');
	}
}
