<?php

namespace App\Http\Controllers;


use App\Notifications\TicketAssignedNotification;
use App\Project;
use App\SupportTicket;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmployeeAssignedController extends Controller {

	public function employeeTicketAssigned(Request $request, SupportTicket $ticket)
	{
		if (auth()->user()->can('assign-ticket'))
		{
			$employees = $request->input('employee_id');
			$ticket->assignedEmployees()->sync($employees);
			$notificable = User::where('role_users_id', 1)
				->orWhere('id', $ticket->employee->id)
				->orWhereIn('id', $employees)
				->get();
			Notification::send($notificable, new TicketAssignedNotification($ticket));

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}

	public function employeeProjectAssigned(Request $request, Project $project)
	{
		if (auth()->user()->can('assign-project'))
		{
			$employees = $request->input('employee_id');
			$project->assignedEmployees()->sync($employees);

			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}

	public function employeeTaskAssigned(Request $request, Task $task)
	{
		if (auth()->user()->can('assign-task'))
		{
			$employees = $request->input('employee_id');
			$task->assignedEmployees()->sync($employees);

			return response()->json(['success' => __('Data Added successfully.')]);
		}
		return response()->json(['success' => __('You are not authorized')]);
	}
}
