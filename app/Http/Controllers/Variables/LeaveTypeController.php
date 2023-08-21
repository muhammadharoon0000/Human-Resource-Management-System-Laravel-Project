<?php


namespace App\Http\Controllers\Variables;


use App\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController {

	public function index()
	{

		if (request()->ajax())
		{
			return datatables()->of(LeaveType::select('id', 'leave_type','allocated_day')->get())
				->setRowId(function ($leave_type)
				{
					return $leave_type->id;
				})
				->addColumn('action', function ($data)
				{
					if (auth()->user()->can('user-edit'))
					{
                        $button = "";
                        if (!($data->leave_type=="Manual")) {
                            $button .= '<button type="button" name="edit" id="' . $data->id . '" class="leave_edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="' . $data->id . '" class="leave_delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
                        }
						return $button;
					}
                    else
					{
						return '';
					}
				})
				->rawColumns(['action'])
				->make(true);

		}

	}

	public function store(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('user-add'))
		{
			$validator = Validator::make($request->only('leave_type','allocated_day'),
				[
					'leave_type' => 'required|unique:leave_types',
					'allocated_day' => 'nullable|numeric',
				]
//				,
//				[
//					'leave_type.required' => 'Leave name can not be empty',
//					'leave_type.unique'  => 'Leave name already exist',
//					'allocated_day.numeric' => 'day must be a number',
//				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];

			$data['leave_type'] = $request->get('leave_type');
			$data['allocated_day'] = $request->get('allocated_day');

			LeaveType::create($data);

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return abort('403', __('You are not authorized'));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(request()->ajax())
		{
			$data = LeaveType::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('user-edit'))
		{
			$id = $request->get('hidden_leave_id');

			$validator = Validator::make($request->only('leave_type_edit'),
				[
					'leave_type_edit' => 'required|unique:leave_types,leave_type,'.$id,
					 'allocated_day' => 'nullable|numeric'
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];

			$data['leave_type'] = $request->get('leave_type_edit');
			$data['allocated_day'] = $request->get('allocated_day_edit');


			LeaveType::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);
		} else
		{

			return abort('403', __('You are not authorized'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
		$logged_user = auth()->user();

		if ($logged_user->can('user-delete'))
		{
			LeaveType::whereId($id)->delete();
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return abort('403',__('You are not authorized'));
	}

}
