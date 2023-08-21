<?php

namespace App\Http\Controllers\Variables;
use App\Http\Controllers\Controller;
use App\TaxType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxTypeController extends Controller
{
	public function index()
	{

		if (request()->ajax())
		{
			return datatables()->of(TaxType::get())
				->setRowId(function ($tax_type)
				{
					return $tax_type->id;
				})
				->addColumn('action', function ($data)
				{
					if (auth()->user()->can('user-edit'))
					{
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="tax_edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="tax_delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

						return $button;
					} else
					{
						return '';
					}
				})
				->rawColumns(['action'])
				->make(true);

		}
		return view('projects.tax_type.tax_type');

	}

	public function store(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('user-add'))
		{
			$validator = Validator::make($request->only('name', 'rate','type', 'description'),
				[
					'name' => 'required',
					'rate' => 'required|numeric',
					'type' => 'required',
				]
//				,
//				[
//					'name.required' => 'Name can not be empty',
//					'rate.required' => 'Rate can not be empty',
//					'rate.numeric' => 'Rate must be a number',
//					'type.required' => 'Type can not be empty',
//				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['name'] = $request->get('name');
			$data['rate'] = $request->get('rate');
			$data['type'] = $request->get('type');
			$data['description'] = $request->get('description');

			TaxType::create($data);

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
		if (request()->ajax())
		{
			$data = TaxType::findOrFail($id);

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
			$id = $request->get('hidden_tax_id');

			$validator = Validator::make($request->only('name_edit', 'rate_edit','type_edit', 'description_edit'),
				[
					'name_edit' => 'required',
					'rate_edit' => 'required|numeric',
					'type_edit' => 'required',
				]
//				,
//				[
//					'name_edit.required' => 'Name can not be empty',
//					'rate_edit.required' => 'Rate can not be empty',
//					'rate_edit.numeric' => 'Rate must be a number',
//					'type_edit.required' => 'Type can not be empty',
//				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['name'] = $request->get('name_edit');
			$data['rate'] = $request->get('rate_edit');
			$data['type'] = $request->get('type_edit');
			$data['description'] = $request->get('description_edit');


			TaxType::whereId($id)->update($data);

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
			TaxType::whereId($id)->delete();

			return response()->json(['success' => __('Data is successfully deleted')]);
		}

		return abort('403', __('You are not authorized'));
	}
}
