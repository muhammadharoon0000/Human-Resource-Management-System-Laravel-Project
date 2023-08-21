@extends('layout.main')
@section('content')


    <section>




        <div class="card animated fadeInRight mr-5 ml-5">
            <div class="card-header  with-border">
                <h3 class="card-title">{{__('Import CSV file only')}}</h3>
                @include('shared.flash_message')
               <div id="form_result"></div>
            </div>
            <div class="card-body">
                <p class="card-text">The first line in downloaded csv file should remain as it is. Please do not change
                    the order of columns in csv file.</p>
                <p class="card-text">The correct column order is (First Name, Last Name, Username, Email, Password,Date of Joining, Gender, Date of Birth, Contact Number, Address, City, Zip, County, Company, Department, Designation, Shift Name, Role Name). Remember, the date format should be (dd-mm-yyyy) and the company, department, designation, shift and role name must be matched with your existing data. You must follow the csv file, otherwise you will get an error while importing the csv file.</p>
                <h6><a href="{{url('public/sample_file/sample_employee.csv')}}" class="btn btn-primary"> <i
                                class="fa fa-download"></i> {{__('Download Sample File')}} </a></h6>
                <form action="{{ route('employees.importPost') }}" name="import_employee" id="import_employee" autocomplete="off" enctype="multipart/form-data"
                      method="post" accept-charset="utf-8">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <fieldset class="form-group">
                                    <label for="logo">{{trans('file.Upload')}} {{trans('file.File')}}</label>
                                    <input type="file" class="form-control-file" id="file" name="file"
                                           accept=".xlsx, .xls, .csv">
                                    <small>{{__('Please select csv or excel')}} file (allowed file size 2MB)</small>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="form-actions box-footer">
                            <button name="import_form" type="submit" class="btn btn-primary"><i
                                        class="fa fa fa-check-square-o"></i> {{trans('file.Save')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </section>


@endsection
