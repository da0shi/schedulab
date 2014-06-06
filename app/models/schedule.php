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

	public static function create ($data) 
	{
		$errorMssgs = array('hasError' => false);
		if (strlen($data['title']) == 0) {
			$errorMssgs['empty-title'] = 'タイトルが空です';
			$errorMssgs['hasError'] = true;
		}

		if (isset($data['allday'])) {
			$data['allday'] = true;
			$stime = '00:00';
			$etime = '00:00';
		} else {
			$data['allday'] = false;
			$stime = $data['startTime'];
			$etime = $data['endTime'];
		}

		if ($data['allday']) {
			if (strlen($data['startDate']) == 0 || strlen($data['endDate']) == 0) {
				$errorMssgs['empty-date'] = '日付を入力してください';
				$errorMssgs['hasError'] = true;
			}
		} else {
			if (strlen($data['startDate']) == 0 || strlen($data['startTime']) == 0 
				|| strlen($data['endDate']) == 0 || strlen($data['endTime']) == 0) {
				$errorMssgs['empty-date'] = '日付を入力してください';
				$errorMssgs['hasError'] = true;
			}
		}

		$start = $data['startDate'] . " "  . $stime;
		$end = $data['endDate'] . " "  . $etime;
		if (strtotime($start) > strtotime($end)) {
			$errorMssgs['invalid-date'] = '日付が不正です';
			$errorMssgs['hasError'] = true;
		}
		
		if ($errorMssgs['hasError']) return $errorMssgs;
		
		$schedule = Model::factory('Schedule')->create();
		$schedule->user_id = $data['user_id'];
		$schedule->title = $data['title'];
		$schedule->description = $data['detail'];
		$schedule->is_allday = (int)$data['allday'];
		$schedule->start_at = $start;
		$schedule->end_at = $end;
		$schedule->created_at = date('Y-m-d H:i:s');
		$schedule->updated_at = date('Y-m-d H:i:s');
		return $schedule->save();
	}

}
