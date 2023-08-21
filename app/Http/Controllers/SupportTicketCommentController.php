<?php

namespace App\Http\Controllers;

use App\Employee;
use App\SupportTicket;
use App\TicketComments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SupportTicketCommentController extends Controller {

	public function index()
	{
		if (request()->ajax())
		{
			return datatables()->of(TicketComments::with('user:id,username')->get())
				->setRowId(function ($comment)
				{
					return $comment->id;
				})
				->addColumn('user', function ($row)
				{
					$username = $row->user->username;

					try
					{
						$department_name = Employee::where('employee_id', $row->user->id)->select('department_name')->first();
					} catch (Exception $e)
					{
						$department_name = trans('file.Admin');
					}

					$department_name = empty($department_name) ? '' : $department_name;

					return $username . ' (' . $department_name . ')';

				})
				->addColumn('action', function ($data)
				{

					$button = '<button type="button" name="delete" id="' . $data->id . '" class="delete-comment btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

					return $button;

				})
				->rawColumns(['action'])
				->make(true);

		}
	}


	public
	function store(Request $request, SupportTicket $ticket)
	{

		$validator = Validator::make($request->only('ticket_comments'),
			[
				'ticket_comments' => 'required',
			]
		);


		if ($validator->fails())
		{
			return response()->json(['errors' => $validator->errors()->all()]);
		}

		$data = [];

		$data['ticket_comments'] = $request->get('ticket_comments');
		$data['user_id'] = auth()->user()->id;
		$data ['ticket_id'] = $ticket->id;

		TicketComments::create($data);

		return response()->json(['success' => __('Data Added successfully.')]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public
	function destroy($id)
	{

		TicketComments::whereId($id)->delete();

		return response()->json(['success' => __('Data is successfully deleted')]);
	}
}
