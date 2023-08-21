<?php

namespace App\Console\Commands;

use App\User;
use App\Employee;
use App\department;
use App\EmployeeDocument;
use App\Notifications\DocumentExpiry;
use App\Notifications\EmployeeDocumentExpiryNotifyToAdmin;
use App\Notifications\EmployeeDocumentExpiryNotifyToDeptartmentHead;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class DocumentExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any document is being expired(3 days remaining)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

		$document_employee = EmployeeDocument::with('employee','DocumentType')
			->where('expiry_date','=',now()->addDays(3)->format('Y-m-d'))
			->where('is_notify','=',1)
			->get();



		if($document_employee->isNotEmpty())
		{
			foreach ($document_employee as $key=> $document)
			{
				$when = now()->addSeconds(30);
				Notification::route('mail', $document->employee->email)
					->notify((new DocumentExpiry(
						$document->document_title,
						$document->expiry_date,
						$document->DocumentType->document_type))->delay(($when)));

                //Send to department-head
                $department = department::with('DepartmentHead:id,email')->where('id',$document->employee->department_id)->first();
                $data[$key]['document_title'] = $document->document_title;
                $data[$key]['expiry_date']     = $document->expiry_date;
                $data[$key]['document_type']   = $document->DocumentType->document_type;
                $data[$key]['department_head-email'] = $department->DepartmentHead->email;

                Notification::route('mail', $data[$key]['department_head-email'])
					->notify((new EmployeeDocumentExpiryNotifyToDeptartmentHead(
						$data[$key]['document_title'],
                        $data[$key]['expiry_date'],
                        $data[$key]['document_type']))->delay(($when)));


                //New
                $notifiable = User::where('role_users_id',1)->get();
                foreach ($notifiable as $item) {
                    $item->notify(new EmployeeDocumentExpiryNotifyToAdmin());
                }
            }


		}
		else
		{
			return '';
		}
        $this->info('Successfully sent.');
    }
}


//Employee Document Expiry Notification send to employee through mail

//Employee Document Expiry Notification send to Dept.Head through mail

//Employee Document Expiry Notification send to Admin through the system default notification
