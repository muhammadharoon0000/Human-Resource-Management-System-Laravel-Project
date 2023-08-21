<?php

namespace App\Http\Controllers;

use App\company;
use App\department;
use App\Employee;
use App\Notifications\EmployeeResignationNotify;
use App\Resignation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ResignationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$logged_user = auth()->user();
		$companies = company::select('id', 'company_name')->get();

		if ($logged_user->can('view-resignation'))
		{
			if (request()->ajax())
			{
				return datatables()->of(Resignation::with('company', 'employee', 'department')->get())
					->setRowId(function ($resignation)
					{
						return $resignation->id;
					})
					->addColumn('company', function ($row)
					{
						return $row->company->company_name ?? '';
					})
					->addColumn('department', function ($row)
					{
						return $row->department->department_name ?? '';
					})
					->addColumn('employee', function ($row)
					{
						return $row->employee->full_name;
					})
					->addColumn('action', function ($data)
					{
						$button = '<button type="button" name="show" id="' . $data->id . '" class="show_new btn btn-success btn-sm"><i class="dripicons-preview"></i></button>';
						$button .= '&nbsp;&nbsp;';
						if (auth()->user()->can('edit-resignation'))
						{
							$button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
							$button .= '&nbsp;&nbsp;';
						}
						if (auth()->user()->can('delete-resignation'))
						{
							$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
						}
							return $button;
					})
					->rawColumns(['action'])
					->make(true);
			}

			return view('core_hr.resignation.index', compact('companies'));
		}

		return abort('403', __('You are not authorized'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('store-resignation'))
		{
			$validator = Validator::make($request->only('description', 'company_id', 'department_id', 'employee_id', 'resignation_date', 'notice_date'
			),
				[
					'company_id' => 'required',
					'department_id' => 'required',
					'employee_id' => 'required',
					'resignation_date' => 'required',
					'notice_date' => 'required'
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];

			$data['employee_id'] = $request->employee_id;
			$data['company_id'] = $request->company_id;
			$data['department_id'] = $request->department_id;
			$data ['description'] = $request->description;
			$data ['resignation_date'] = $request->resignation_date;
			$data ['notice_date'] = $request->notice_date;

			Resignation::create($data);

			$notifiable = User::findOrFail($data['employee_id']);

			$notifiable->notify(new EmployeeResignationNotify($data['resignation_date']));

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return response()->json(['success' => __('You are not authorized')]);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id)
	{
		if (request()->ajax())
		{
			$data = Resignation::findOrFail($id);
			$company_name = $data->company->company_name ?? '';
			$first_name = $data->employee->first_name ?? '';
			$last_name = $data->employee->full_name ?? '';
			$employee_name = $first_name . ' ' . $last_name;
			$department = $data->department->department_name ?? '';

			return response()->json(['data' => $data, 'employee_name' => $employee_name, 'company_name' => $company_name, 'department' => $department]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (request()->ajax())
		{
			$data = Resignation::findOrFail($id);

			$departments = department::select('id', 'department_name')
				->where('company_id', $data->company_id)->get();

			$employees = Employee::select('id', 'first_name', 'last_name')->where('department_id', $data->department_id)->where('is_active',1)->where('exit_date',NULL)->get();


			return response()->json(['data' => $data, 'employees' => $employees, 'departments' => $departments]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('edit-resignation'))
		{
			$id = $request->hidden_id;

			$validator = Validator::make($request->only('description', 'company_id', 'department_id', 'employee_id', 'resignation_date', 'notice_date'
			),
				[
					'company_id' => 'required',
					'department_id' => 'required',
					'employee_id' => 'required',
					'resignation_date' => 'required',
					'notice_date' => 'required'
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];


			$data ['description'] = $request->description;
			$data ['resignation_date'] = $request->resignation_date;
			$data ['notice_date'] = $request->notice_date;


			$data['employee_id'] = $request->employee_id;
			$data ['company_id'] = $request->company_id;

			$data['department_id'] = $request->department_id;

			Resignation::find($id)->update($data);

			$notifiable = User::findOrFail($data['employee_id']);

			$notifiable->notify(new EmployeeResignationNotify($data['resignation_date']));


			return response()->json(['success' => __('Data is successfully updated')]);
		}
		return response()->json(['success' => __('You are not authorized')]);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('delete-resignation'))
		{
			Resignation::whereId($id)->delete();

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

		if ($logged_user->can('delete-resignation'))
		{

			$resignation_id = $request['resignationIdArray'];
			$resignation = Resignation::whereIn('id', $resignation_id);
			if ($resignation->delete())
			{
				return response()->json(['success' => __('Multi Delete', ['key' => trans('file.Resignation')])]);
			} else
			{
				return response()->json(['error' => 'Error, selected resignation can not be deleted']);
			}
		}

		return response()->json(['success' => __('You are not authorized')]);
	}
}
