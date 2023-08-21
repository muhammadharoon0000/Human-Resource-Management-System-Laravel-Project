<?php

namespace App\Http\Controllers;

use App\company;
use App\department;
use App\Employee;
use App\leave;
use App\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

//Notification
use App\Notifications\EmployeeLeaveNotification; //Mail
use App\Notifications\LeaveNotification; //Database
use App\Notifications\LeaveNotificationToAdmin; //Database
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
class LeaveController extends Controller {

	public function index()
	{

		$logged_user = auth()->user();
		$companies = company::select('id', 'company_name')->get();
		$leave_types = LeaveType::select('id', 'leave_type', 'allocated_day')->get();

		if ($logged_user->can('view-leave'))
		{
			if (request()->ajax())
			{
				return datatables()->of(leave::with('employee', 'department', 'LeaveType')->latest())
					->setRowId(function ($leave)
					{
						return $leave->id;
					})
					->addColumn('leave_type', function ($row)
					{
						return $row->LeaveType->leave_type ?? '';
					})
					->addColumn('department', function ($row)
					{
						return $row->department->department_name ?? '';
					})
					->addColumn('employee', function ($row)
					{
						return $row->employee->full_name ?? '';
					})
					->addColumn('action', function ($data)
					{
						$button = '<button type="button" name="show" id="' . $data->id . '" class="show_new btn btn-success btn-sm"><i class="dripicons-preview"></i></button>';
						$button .= '&nbsp;&nbsp;';
						if (auth()->user()->can('edit-leave'))
						{
							$button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
							$button .= '&nbsp;&nbsp;';
						}
						if (auth()->user()->can('delete-leave'))
						{
							$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
						}
						return $button;
					})
					->rawColumns(['action'])
					->make(true);
			}

			return view('timesheet.leave.index', compact('companies', 'leave_types'));
		}

		return abort('403', __('You are not authorized'));
	}

	public function store(Request $request)
	{
		if(auth()->user()->can('store-leave') || auth()->user())
		{
			//return response()->json($request->diff_date_hidden);

			$validator = Validator::make($request->only('leave_type', 'company_id', 'department_id', 'employee_id', 'start_date', 'end_date','status'),
				[
					'company_id' => 'required',
					'department_id' => 'required',
					'employee_id' => 'required',
					'leave_type' => 'required',
					'status' => 'required',
					'start_date' => 'required',
					'end_date' => 'required|after_or_equal:start_date'
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$leave = LeaveType::findOrFail($request->leave_type);


			$employee = leave::where('employee_id', $request->employee_id)
				->where('leave_type_id', $request->leave_type);

			if ($employee->exists())
			{
				$total = 0;
				$employee_leaves = $employee->get();

				foreach ($employee_leaves as $employee_leave)
				{
					$total = $total + $employee_leave->total_days;
				}
				$total = $total + $request->diff_date_hidden;

				if ($leave->allocated_day != null && $leave->allocated_day < $total)
				{
					return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days for this employee')]);
				}
			} else
			{
				if ($leave->allocated_day != null && $leave->allocated_day < $request->diff_date_hidden)
				{
					return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days,You can select manual')]);
				}
			}


			$data = [];

			$data['employee_id'] = $request->employee_id;
			$data['company_id'] = $request->company_id;
			$data['department_id'] = $request->department_id;
			$data['leave_type_id'] = $request->leave_type;
			$data ['leave_reason'] = $request->leave_reason;
			$data ['remarks'] = $request->remarks;
			$data ['status'] = $request->status;
			$data ['is_half'] = $request->is_half;
			$data ['is_notify'] = $request->is_notify;
			$data ['start_date'] = $request->start_date;
			$data ['end_date'] = $request->end_date;
			$data['total_days'] = $request->diff_date_hidden;


			//Employee Remaining Leave --- Start
			$employee_leave_info = Employee::find($request->employee_id);
			if ($request->diff_date_hidden > $employee_leave_info->remaining_leave)
			{
				return response()->json([ 'remaining_leave' =>"The employee's remaining leaves are insufficient"]);
			}
			elseif($request->status=='approved')
			{
				$employee_leave_info->remaining_leave = $employee_leave_info->remaining_leave - $request->diff_date_hidden;
				$employee_leave_info->update();
			}
			//Employee Remaining Leave  --- End


			$leave = leave::create($data);

			if($leave->is_notify==1)
			{
				$text = "A new leave-notification has been published";
				$notifiable = User::findOrFail($data['employee_id']);
				$notifiable->notify(new LeaveNotification($text)); //To Employee
			}
			elseif ((Auth::user()->role_users_id !=1 ) && ($leave->is_notify==NULL))
			{
				$notifiable = User::where('role_users_id',1)->get();
				foreach ($notifiable as $item) {
					$item->notify(new LeaveNotificationToAdmin());
				}

				//Mail
				// $department = department::with('DepartmentHead:id,email')->where('id',$request->department_id)->first();
				// Notification::route('mail', $department->DepartmentHead->email)
				// 				->notify(new EmployeeLeaveNotification(
				// 					$leave->employee->full_name,
				// 					$leave->total_days,
				// 					$leave->start_date,
				// 					$leave->end_date,
				// 					$leave->leave_reason,
				// 				));
			}

			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}

	public function show($id)
	{
		if (request()->ajax())
		{
			$data = leave::findOrFail($id);
			$company_name = $data->company->company_name ?? '';
			$employee_name = $data->employee->full_name;
			$department = $data->department->department_name ?? '';
			$leave_type_name = $data->LeaveType->leave_type ?? '';

			$start_date_name = $data->start_date;
			$end_date_name = $data->end_date;


			return response()->json(['data' => $data, 'employee_name' => $employee_name, 'company_name' => $company_name, 'department' => $department, 'leave_type_name' => $leave_type_name,
				'start_date_name' => $start_date_name, 'end_date_name' => $end_date_name]);
		}
	}

	public function edit($id)
	{
		if (request()->ajax())
		{
			$data = leave::findOrFail($id);

			$departments = department::select('id', 'department_name')
				->where('company_id', $data->company_id)->get();

			$employees = Employee::select('id', 'first_name', 'last_name')->where('department_id', $data->department_id)->where('is_active',1)->where('exit_date',NULL)->get();

			return response()->json(['data' => $data, 'employees' => $employees, 'departments' => $departments]);
		}
	}

	public function update(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('edit-leave'))
		{
			$id = $request->hidden_id;

			$validator = Validator::make($request->only('leave_type', 'company_id', 'department_id', 'employee_id', 'start_date', 'end_date',
				'leave_reason', 'remarks', 'status', 'is_half', 'is_notify', 'diff_date_hidden', 'leave_type_hidden', 'employee_id_hidden'
			),
				[
					'company_id' => 'required',
					'department_id' => 'required',
					'employee_id' => 'required',
					'leave_type' => 'required',
					'status' => 'required',
					'start_date' => 'required',
					'end_date' => 'required|after_or_equal:start_date',
					'diff_date_hidden' => 'nullable|numeric'
				]
			);

			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];
			global $employee_id;

			$data ['leave_reason'] = $request->leave_reason;
			$data ['remarks'] = $request->remarks;
			$data ['is_half'] = $request->is_half;
			$data ['is_notify'] = $request->is_notify;
			$data ['start_date'] = $request->start_date;
			$data ['end_date'] = $request->end_date;


			if ($request->diff_date_hidden != null)
			{
				$data['total_days'] = $request->diff_date_hidden;
			}

			if ($request->employee_id)
			{
				$employee_id = $request->employee_id;
				$data['employee_id'] = $employee_id;
			} else
			{
				$employee_id = $request->employee_id_hidden;
			}
			if ($request->company_id)
			{
				$data ['company_id'] = $request->company_id;
			}

			if ($request->department_id)
			{
				$data ['department_id'] = $request->department_id;
			}
			if ($request->status)
			{
				$data ['status'] = $request->status;
			}

			if ($request->leave_type)
			{
				$leave = LeaveType::findOrFail($request->leave_type);

				$employee = leave::where('id', '!=', $id)
					->where('employee_id', $employee_id)->where('leave_type_id', $request->leave_type);

				if ($employee->exists())
				{
					$total = 0;
					$employee_leaves = $employee->get();


					foreach ($employee_leaves as $employee_leave)
					{
						$total = $total + $employee_leave->total_days;
					}
					$total = $total + $request->diff_date_hidden;

					// $total_days_count = $employee_leaves->sum('total_days');
					// $total = $total + $request->diff_date_hidden;


					if ($leave->allocated_day != null && $leave->allocated_day < $total)
					{
						return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days for this employee')]);
					}
				}
				else
				{
					if ($leave->allocated_day != null && $leave->allocated_day < $request->diff_date_hidden)
					{
						return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days,You can select manual')]);
					}
				}
				$data['leave_type_id'] = $request->leave_type;
			}

            else
			{
				$leave = LeaveType::findOrFail($request->leave_type_hidden);
				$employee = leave::where('id', '!=', $id)
					->where('employee_id', $employee_id)->where('leave_type_id', $request->leave_type_hidden);

				if ($employee->exists())
				{
					$total = 0;
					$employee_leaves = $employee->get();

					foreach ($employee_leaves as $employee_leave)
					{
						$total = $total + $employee_leave->total_days;
					}
					$total = $total + $request->diff_date_hidden;

					if ($leave->allocated_day != null && $leave->allocated_day < $total)
					{
						return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days for this employee')]);
					}
				}
                else
                {
					if ($leave->allocated_day != null && $leave->allocated_day < $request->diff_date_hidden)
					{
						return response()->json(['limit' => __('Allocated quota for this leave type is less then requested days,You can select manual')]);
					}
				}
				$data['leave_type_id'] = $request->leave_type_hidden;
			}

			//Employee Remaining Leave --- Start
			$employee_leave_info = Employee::find($employee_id);
			if ($request->diff_date_hidden > $employee_leave_info->remaining_leave)
			{
				return response()->json([ 'remaining_leave' =>"The employee's remaining leaves are insufficient"]);
			}
			elseif($request->status=='approved')
			{
				$employee_leave_info->remaining_leave = $employee_leave_info->remaining_leave - $request->diff_date_hidden;
				$employee_leave_info->update();
			}
			//Employee Remaining Leave  --- End


			leave::find($id)->update($data);

			if ($data['is_notify']!=NULL)
			{
				$text = "A leave-notification has been updated";
				$notifiable = User::findOrFail($data['employee_id']);
				$notifiable->notify(new LeaveNotification($text)); //To Employee
			}
			return response()->json(['success' => __('Data is successfully updated')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}

	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('delete-leave'))
		{
			leave::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}

	public function delete_by_selection(Request $request)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('delete-leave'))
		{

			$leave_id = $request['leaveIdArray'];
			$leave = leave::whereIn('id', $leave_id);
			if ($leave->delete())
			{
				return response()->json(['success' => __('Multi Delete', ['key' => trans('file.Leave')])]);
			} else
			{
				return response()->json(['error' => 'Error, selected leaves can not be deleted']);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function calendarableDetails($id)
	{
		if (request()->ajax())
		{
			$data = Leave::with('company:id,company_name',
				'LeaveType:id,leave_type', 'employee:id,first_name,last_name')->findOrFail($id);

			$new = [];

			$new['Company'] = $data->company->company_name;
			$new['Employee'] = $data->employee->full_name;
			$new['Arrangement Type'] = $data->LeaveType->leave_type;
			$new['Start Date'] = $data->start_date;
			$new['End Date'] = $data->end_date;
			$new['Leave Reason'] = $data->leave_reason;
			$new['Remarks'] = $data->remarks;
			$new['Status'] = 'Approved';

			return response()->json(['data' => $new]);
		}
	}
}
