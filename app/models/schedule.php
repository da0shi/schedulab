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

	public static function create ($args) 
	{
		$errorMssgs = array('hasError' => false);
		if (strlen($args['title']) == 0) {
			$errorMssgs['empty-title'] = 'タイトルが空です';
			$errorMssgs['hasError'] = true;
		}
		if (isset($args['allday'])) {
			$args['allday'] = false;
			if (strlen($args['startDate']) == 0 || strlen($args['endDate']) == 0) {
				$errorMssgs['empty-date'] = '日付を入力してください';
				$errorMssgs['hasError'] = true;
			}
		} else {
			$args['allday'] = true;
			if (strlen($args['startDate']) == 0 || strlen($args['startTime']) == 0 || strlen($args['endDate']) == 0 || strlen($args['endTime']) == 0) {
				$errorMssgs['empty-date'] = '日付を入力してください';
				$errorMssgs['hasError'] = true;
			}
		}

		$start = $args['startDate'] . " "  . $args['startTime'];
		$end = $args['endDate'] . " "  . $args['endTime'];
		if (strtotime($start) > strtotime($end)) {
			$errorMssgs['invalid-date'] = '日付が不正です';
			$errorMssgs['hasError'] = true;
		}
		
		if ($errorMssgs['hasError']) return $errorMssgs;
		
		$schedule = Model::factory('Schedule')->create();
		$schedule->user_id = $args['user_id'];
		$schedule->title = $args['title'];
		$schedule->description = $args['detail'];
		$schedule->is_allday = $args['allday'];
		$schedule->start_at = $start;
		$schedule->end_at = $end;
		$schedule->created_at = date('Y-m-d H:i:s');
		$schedule->updated_at = date('Y-m-d H:i:s');
		return $schedule->save();
	}

}
