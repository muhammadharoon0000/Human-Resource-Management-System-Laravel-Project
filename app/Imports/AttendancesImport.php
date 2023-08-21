<?php

namespace App\Imports;

use App\Attendance;
use App\Employee;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class AttendancesImport implements ToModel,WithHeadingRow, ShouldQueue,WithChunkReading,WithBatchInserts, WithValidation
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row)
	{

		$attendance_date = date(env('Date_Format'),strtotime($row['attendance_date']));



		try
		{
			$clock_in = new DateTime($row['clock_in']);
			$clock_out = new DateTime($row['clock_out']);
		} catch (\Exception $e)
		{
			dd ('Please check clock in and clock out');
		}




		$employee = Employee::with('officeShift')
			->select('id','office_shift_id')
			->whereEmail($row['email'])->first();




		$current_day_in =  strtolower(Carbon::now()->format('l')).'_in';
		$current_day_out =  strtolower(Carbon::now()->format('l')).'_out';



		try
		{
			$shift_in = new DateTime($employee->officeShift->$current_day_in);
			$shift_out = new DateTime($employee->officeShift->$current_day_out);
		} catch (\Exception $e)
		{
			dd ('Error In Shift In and Out Time');
		}


		if ($clock_in > $shift_in){
			$time_late = $shift_in->diff($clock_in)->format('%H:%I');
		}
		else{
			$time_late = '00:00';
		}
		if ($clock_out < $shift_out){
			$early_leaving = $shift_out->diff($clock_out)->format('%H:%I');
			$overtime = '00:00';
		}
		else {
			$overtime = $shift_out->diff($clock_out)->format('%H:%I');
			$early_leaving = '00:00';
		}

		$total_work = $clock_in->diff($clock_out)->format('%H:%I');

		try
		{

			return new Attendance([
				'employee_id' => $employee->id,
				'attendance_date' => $attendance_date,
				'clock_in' => $clock_in->format('H:i'),
				'clock_out' => $clock_out->format('H:i'),
				'clock_in_out' => 0,
				'time_late' => $time_late,
				'early_leaving' => $early_leaving,
				'overtime' => $overtime,
				'total_work' => $total_work
			]);
		}
		catch (\Exception $e)
		{
			dd ('Import Error');
		}
	}


	public function rules(): array
	{
		return [
			'email' => 'required',
			'clock_in' => 'required',
			'clock_out' => 'required',
			'attendance_date' => 'required',
		];
	}



	public function chunkSize(): int
	{
		return 500;
	}

	public function batchSize(): int
	{
		return 500;
	}
}
