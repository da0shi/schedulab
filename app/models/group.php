<?php

class Group extends Model
{
	public static $_table = 'groups';

	public function users ()
	{
		return $this->has_many('User');
	}
}
