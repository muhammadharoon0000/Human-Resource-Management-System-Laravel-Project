@extends('layout.main')
@section('content')



    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


        <div class="container-fluid mb-3">
            @can('store-job_interview')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i
                            class="fa fa-plus"></i> {{__('Add Interview')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="job_interview-table" class="table ">
                <thead>
                <tr>
                    <th>{{__('Job Title')}}</th>
                    <th>{{__('Interview Place')}}</th>
                    <th>{{__('Interview Date & Time')}}</th>
                    <th>{{__('Added By')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
                </thead>

            </table>
        </div>
    </section>



    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Interview')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>
                    <span id="store_logo"></span>

                    <form autocomplete="off" method="post" id="sample_form" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="job_id">{{__('Job Title')}} *</label>
                                <select name="job_id" id="job_id" required class="form-control selectpicker candidate"
                                        data-live-search="true" data-live-search-style="contains"
                                        title="{{__('Selecting',['key'=>__('Job Title')])}}...">
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->job_title}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="candidate_id">{{trans('file.Candidates')}} *</label>
                                <select name="candidate_id[]" id="candidate_id" required
                                        class="selectpicker form-control"
                                        data-live-search="true" data-live-search-style="contains" multiple
                                        title='{{__('Selecting',['key'=>trans('file.Candidates')])}}...'>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="interview_place">{{__('Interview Place')}} *</label>
                                <input type="text" name="interview_place" id="interview_place" required
                                       class="form-control"
                                       placeholder="{{__('Interview Place')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="interview_date">{{__('Interview Date')}}</label>
                                <input type="text" name="interview_date" id="interview_date" class="form-control date"
                                       placeholder="{{__('Interview Date')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="interview_time">{{__('Interview Time')}}</label>
                                <input type="text" name="interview_time" id="interview_time" required
                                       class="form-control time"
                                       placeholder="{{__('Interview Time')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="employee_id">{{trans('file.Interviewers')}} *</label>
                                <select name="employee_id[]" id="employee_id" required class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="contains" multiple
                                        title='{{__('Selecting',['key'=>trans('file.Interviewers')])}}...'>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('file.Description')}}</label>
                                    <textarea required class="form-control" id="description" name="description"
                                              rows="3"></textarea>
                                </div>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                           value="{{trans('file.Submit')}}"/>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="interview_model" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true"
        >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{__('Interview Info')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table  table-bordered">

                                    <tr>
                                        <th>{{__('Job Description')}}</th>
                                        <td id="show_job_description"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Employer')}}</th>
                                        <td id="show_job_employer"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Interview Place')}}</th>
                                        <td id="show_interview_place"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Interview Date')}}</th>
                                        <td id="show_interview_date"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Interview Time')}}</th>
                                        <td id="show_interview_time"></td>
                                    </tr>


                                    <tr>
                                        <th>{{__('Selected Candidates')}}</th>
                                        <td id="show_candidates"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Interviewers')}}</th>
                                        <td id="show_interviewers"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Description')}}</th>
                                        <td id="show_description"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Added By')}}</th>
                                        <td id="show_added_by"></td>
                                    </tr>

                                </table>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('file.Close')}}</button>
            </div>
        </div>
    </div>




    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{trans('file.Confirmation')}}</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center">{{__('Are you sure you want to remove this data?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{trans('file.OK')}}'
                    </button>
                    <button type="button" class="close btn-default"
                            data-dismiss="modal">{{trans('file.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>




@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        var date = $('.date');
        date.datepicker({
            format: '{{ env('Date_Format_JS')}}',
            autoclose: true,
            todayHighlight: true
        });


        $(document).ready(function () {


            let table_table = $('#job_interview-table').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('job_interviews.index') }}",
                },

                columns: [

                    {
                        data: 'job_description',
                        name: 'job_description',
                    },
                    {
                        data: 'interview_place',
                        name: 'interview_place',
                    },
                    {
                        data: 'interview_date',
                        name: 'interview_date',
                    },
                    {
                        data: 'added_by',
                        name: 'added_by',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],


                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ {{__("records per page")}}',
                    "info": '{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)',
                    "search": '{{trans("file.Search")}}',
                    'paginate': {
                        'previous': '{{trans("file.Previous")}}',
                        'next': '{{trans("file.Next")}}'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [4],
                    },

                ],


                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });
            new $.fn.dataTable.FixedHeader(table_table);
        });


        tinymce.init({
            selector: 'textarea',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            height: 130,

            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },

            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            branding: false
        });


        $('#create_record').on('click', function () {

            $('.modal-title').text('{{__('Add interview')}}');
            $('#action_button').val('{{trans("file.Add")}}');
            $('#action').val('{{trans("file.Add")}}');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('job_interviews.store') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('select').selectpicker('refresh');
                        $('#job_interview-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });

        });



        $(document).on('click', '.details', function () {

            let id = $(this).attr('id');
            $('#form_result').html('');

            let target = '{{route('job_interviews.index')}}/' + id;

            $.ajax({
                url: target,
                dataType: "json",
                success: function (result) {

                    function htmlDecode(input){
                        var e = document.createElement('div');
                        e.innerHTML = input;
                        return e.childNodes.length == 0 ? "" : e.childNodes[0].nodeValue;
                    }

                    $('#show_job_description').html(result.data.job_title
                        + '<br><h6>' + result.data.short_description + '</h6>');
                    $('#show_job_employer').html(result.data.job_employer
                        + '<br><h6>' + result.data.company_name + '</h6>');
                    $('#show_interview_place').html(result.data.interview_place);
                    $('#show_interview_date').html(result.data.interview_date);
                    $('#show_interview_time').html(result.data.interview_time);
                    $('#show_candidates').html(result.candidates);
                    $('#show_interviewers').html(result.interviewers);
                    $('#show_description').html(htmlDecode(result.data.description));
                    $('#show_added_by').html(result.data.added_by);

                    $('#interview_model').modal('show');
                    $('.modal-title').text("{{__('Meeting Info')}}");
                }
            });
        });


        let delete_id;

        $(document).on('click', '.delete', function () {
            delete_id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text('{{__('DELETE Record')}}');
            $('#ok_button').text('{{trans('file.OK')}}');

        });


        $('.close').on('click', function () {
            $('#sample_form')[0].reset();
            $('select').selectpicker('refresh');
            $('#job_interview-table').DataTable().ajax.reload();
        });

        $('#ok_button').on('click', function () {
            let target = "{{ route('job_interviews.index') }}/" + delete_id + '/delete';
            $.ajax({
                url: target,
                beforeSend: function () {
                    $('#ok_button').text('{{trans('file.Deleting...')}}');
                },
                success: function (data) {
                    let html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    setTimeout(function () {
                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#job_interview-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });


        $('.candidate').change(function () {
            if ($(this).val() !== '') {
                let value = $(this).val();
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamic_candidate') }}",
                    method: "POST",
                    data: {value: value, _token: _token},
                    success: function (result) {
                        $('select').selectpicker("destroy");
                        $('#candidate_id').html(result);
                        $('select').selectpicker();

                    }
                });
            }
        });
    })(jQuery);
</script>
@endpush
