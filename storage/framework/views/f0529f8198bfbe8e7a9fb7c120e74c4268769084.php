<?php $__env->startSection('content'); ?>

    <section>

        <div class="container-fluid"><span id="general_result"></span></div>

        <div class="container-fluid mb-3">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('store-user')): ?>
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i> <?php echo e(__('Add User')); ?>

                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php if(auth()->user()->role_users_id == 1): ?>
                                <a class="dropdown-item" href="#" name="create_record" id="create_record">Add Admin</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo e(url('/staff/employees')); ?>#formModal">Add Employee</a>
                                <a class="dropdown-item" href="<?php echo e(url('/project-management/clients')); ?>#formModal">Add Client</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-user')): ?>
                        <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i
                                    class="fa fa-minus-circle"></i> <?php echo e(__('Bulk delete')); ?>

                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="user-table" class="table ">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th><?php echo e(__('User')); ?></th>
                        <th><?php echo e(trans('file.Contact')); ?></th>
                        <th><?php echo e(__('Login Info')); ?></th>
                        <th><?php echo e(trans('file.status')); ?></th>
                        <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add User')); ?></h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label><?php echo e(__('First Name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" id="first_name" placeholder="<?php echo e(__('First Name')); ?>"
                                           required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo e(__('Last Name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" id="last_name" placeholder="<?php echo e(__('Last Name')); ?>"
                                           required class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Username')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username"
                                           placeholder="<?php echo e(__('Unique Value',['key'=>trans('file.Name')])); ?>"
                                           required class="form-control" value="<?php echo e(old('username')); ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Email')); ?> <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="example@example.com" required
                                           class="form-control" value="<?php echo e(old('email')); ?>">

                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Phone')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_no" id="contact_no"
                                           placeholder="<?php echo e(trans('file.Phone')); ?>" required
                                           class="form-control" value="<?php echo e(old('contact_no')); ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Password')); ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                               placeholder="<?php echo e(__('min:4 characters')); ?>"
                                               required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo e(__('Confirm Password')); ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="confirm_pass" type="password"
                                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="password_confirmation" placeholder="<?php echo e(__('Re-type Password')); ?>"
                                               required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="profile_photo" class=""><strong><?php echo e(__('Image')); ?></strong></label>
                                    <input type="file" id="profile_photo"
                                           class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="profile_photo" placeholder="<?php echo e(__('Upload',['key'=>trans('file.Photo')])); ?>">
                                </div>
                                <div class="col-md-6 form-group" align="center">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_active"
                                                   id="is_active_add"
                                                   value="1" checked>
                                            <label class="custom-control-label"
                                                   for="is_active_add"><?php echo e(trans('file.Active')); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="hidden" name="action" id="action"/>
                                            <input type="hidden" name="hidden_id" id="hidden_id"/>
                                            <button type="submit" name="action_button" id="action_button"
                                                    class="btn btn-primary btn-block"><?php echo e(__('Add User')); ?></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Edit')); ?></h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <span id="form_result_edit"></span>
                        <span id="store_profile_photo"></span>
                        <form method="post" id="form_edit" class="form-horizontal" enctype="multipart/form-data">

                            <?php echo csrf_field(); ?>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label><?php echo e(__('First Name')); ?> *</label>
                                    <input type="text" name="first_name" id="first_name_edit" placeholder="<?php echo e(__('First Name')); ?>"
                                           required class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo e(__('Last Name')); ?> *</label>
                                    <input type="text" name="last_name" id="last_name_edit" placeholder="<?php echo e(__('Last Name')); ?>"
                                           required class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Username')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="username" id="username_edit"
                                           placeholder="<?php echo e(__('Unique Value',['key'=>trans('file.Name')])); ?>"
                                           required class="form-control">
                                </div>



                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Email')); ?> <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email_edit" placeholder="example@example.com"
                                           required class="form-control">
                                </div>


                                <div class="col-md-6 form-group">
                                    <label><?php echo e(trans('file.Phone')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_no" id="contact_no_edit"
                                           placeholder="<?php echo e(trans('file.Phone')); ?>" required
                                           class="form-control" value="<?php echo e(old('contact_no')); ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo e(trans('file.Password')); ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password_edit"
                                               placeholder="<?php echo e(__('min:4 characters')); ?>">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo e(__('Confirm Password')); ?> <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="confirm_pass_edit" type="password"
                                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="password_confirmation" placeholder="<?php echo e(__('Re-type Password')); ?>">

                                    </div>
                                </div>

                                <div class="col-md-6 form-group ">
                                    <label for="profile_photo_edit" class=""><strong><?php echo e(__('Image')); ?></strong></label>
                                    <input type="file" id="profile_photo_edit"
                                           class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="profile_photo"
                                           placeholder="<?php echo e(__('Upload',['key'=>trans('file.Photo')])); ?>">
                                    <span id="store_profile_photo"></span>
                                </div>


                                <div class="col-md-6 form-group">
                                    <br>
                                        <div class="col-sm-3 form-group custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_active"
                                                   id="is_active_edit" value="1" checked>
                                            <label class="custom-control-label"
                                                   for="is_active_edit"><?php echo e(trans('file.Active')); ?></label>
                                        </div>
                                </div>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="action" id="action_edit"/>
                                            <input type="hidden" name="hidden_id" id="hidden_id_edit"/>
                                            <input type="submit" name="action_button" id="action_button_edit"
                                                   class="btn btn-primary btn-block" value="<?php echo e(trans('file.Edit')); ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="registrationFormAlert" id="divCheckPasswordMatch_edit">
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title"><?php echo e(trans('file.Confirmation')); ?></h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center"><?php echo e(__('Are you sure you want to remove this data?')); ?></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button"
                                class="btn btn-danger"><?php echo e(trans('file.OK')); ?></button>
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo e(trans('file.Cancel')); ?></button>
                    </div>
                </div>
            </div>
        </div>

    </section>



<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

    (function($) {
        "use strict";

        $(document).ready(function () {
            var table_table = $('#user-table').DataTable({
                initComplete: function () {
                    this.api().columns([1,5]).every(function () {
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
                    url: "<?php echo e(route('users-list')); ?>",
                },

                columns: [
                    {
                        data: 'id',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'contacts',
                        name: 'contacts',
                    },
                    {
                        data: 'login_info',
                        name: 'login_info'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function (data) {
                            if (data == '1') {
                                return "<td><div class = 'badge badge-success'><?php echo e(trans('file.Active')); ?></div>"
                            } else {
                                return "<td><div class = 'badge badge-danger'><?php echo e(trans('file.Inactive')); ?></div>"
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],

                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ <?php echo e(__('records per page')); ?>',
                    "info": '<?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)',
                    "search": '<?php echo e(trans("file.Search")); ?>',
                    'paginate': {
                        'previous': '<?php echo e(trans("file.Previous")); ?>',
                        'next': '<?php echo e(trans("file.Next")); ?>'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [0],
                        "className": "text-left"
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>'
                        },
                        'targets': [0]
                    }
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

        $('#create_record').on('click', function () {
            $('.modal-title').text('<?php echo e(__('Add User')); ?>');
            $('#action_button').val('<?php echo e(trans('file.Add')); ?>');
            $('#action').val('<?php echo e(trans('file.Add')); ?>');
            $('select').selectpicker('refresh');
            $('#store_profile_photo').html('');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo e(route('add-user')); ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    let html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (let count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                    $(".alert").slideDown(300).delay(5000).slideUp(300);
                }
            })
        });

        $('#form_edit').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "<?php echo e(route('update-user')); ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    let html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (let count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        setTimeout(function () {
                            $('#editModal').modal('hide');
                            $('#user-table').DataTable().ajax.reload();
                            $('#form_edit')[0].reset();
                            $('.selectpicker').selectpicker('refresh');
                        }, 2000);
                    }
                    $('#form_result_edit').html(html).slideDown(100).delay(3000).slideUp(100);

                }
            });
        });


        $(document).on('click', '.edit', function () {

            let id = $(this).attr('id');
            $('#form_result_edit').html('');

            let target = "<?php echo e(url('/user/edit')); ?>/" + id;

            $.ajax({
                url: target,
                dataType: "json",
                success: function (html) {

                    $('#first_name_edit').val(html.data.first_name);
                    $('#last_name_edit').val(html.data.last_name);
                    $('#username_edit').val(html.data.username);
                    $('#email_edit').val(html.data.email);
                    $('#role_id_edit').selectpicker('val', html.data.role_users_id);
                    $('#contact_no_edit').val(html.data.contact_no);
                    if (html.data.is_active == 1) {
                        $('#is_active_edit').prop('checked', true);
                    } else {
                        $('#is_active_edit').prop('checked', false);
                    }


                    if (html.data.profile_photo == null) {
                        $('#store_profile_photo').html("<img src=<?php echo e(URL::to('/public')); ?>/logo/avatar.jpg" + " width='100'  class='rounded-circle' />");
                        $('#store_profile_photo').append("<input type='hidden' name='hidden_image' value='" + html.data.profile_photo + "'  />");
                    } else {
                        $('#store_profile_photo').html("<img src=<?php echo e(URL::to('/public')); ?>/uploads/profile_photos/" + html.data.profile_photo + " width='100'  class='rounded-circle' />");
                        $('#store_profile_photo').append("<input type='hidden' name='hidden_image' value='" + html.data.profile_photo + "'  />");
                    }

                    $('#hidden_id_edit').val(html.data.id);
                    $('#action_button_edit').val('<?php echo e(trans('file.Edit')); ?>');
                    $('#action_edit').val('<?php echo e(trans('file.Edit')); ?>');
                    $('#editModal').modal('show');
                }
            })
        });

        let lid;

        $(document).on('click', '.delete', function () {
            lid = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text('<?php echo e(__('DELETE Record')); ?>');
            $('#ok_button').text('<?php echo e(trans('file.OK')); ?>');
        });

        $(document).on('click', '#bulk_delete', function () {
            let table = $('#user-table').DataTable();
            let id = [];
            id = table.rows({selected: true}).ids().toArray();
            if (id.length > 0) {
                if (confirm('<?php echo e(__('Delete Selection',['key'=>trans('file.User')])); ?>')) {
                    $.ajax({
                        url: '<?php echo e(route('delete_by_selection')); ?>',
                        method: 'POST',
                        data: {
                            userIdArray: id
                        },
                        success: function (data) {
                            let html;
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                            }
                            if (data.error) {
                                html = '<div class="alert alert-danger">' + data.error + '</div>';
                            }
                            let table = $('#user-table').DataTable();
                            table.ajax.reload();
                            table.rows('.selected').deselect();
                            if (data.error) {
                                html = '<div class="alert alert-danger">' + data.error + '</div>';
                            }
                            $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }

                    });
                }
            } else {
                alert('<?php echo e(__('Please select atleast one checkbox')); ?>');
            }

        });


        $('.close').on('click', function () {
            $('#form_edit')[0].reset();
            $('#user-table').DataTable().ajax.reload();
            $('#sample_form')[0].reset();
        });

        $('#ok_button').on('click', function () {
            let target = "<?php echo e(url('/user/delete')); ?>/" + lid;
            $.ajax({
                url: target,
                beforeSend: function () {
                    $('#ok_button').text('<?php echo e(trans('file.Deleting...')); ?>');
                },
                success: function (data) {
                    let html;
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    setTimeout(function () {
                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#user-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });


        $('#confirm_pass').on('input', function () {

            if ($('input[name="password"]').val() != $('input[name="password_confirmation"]').val())
                $("#divCheckPasswordMatch").html('<?php echo e(__('Password does not match! please type again')); ?>');
            else
                $("#divCheckPasswordMatch").html('<?php echo e(__('Password matches!')); ?>');

        });

        $('#toggle').on('click', function (e) {
            e.preventDefault();
            $('#show_hide').toggle();
        });

    })(jQuery);

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\peoplepro\resources\views/all_user/index.blade.php ENDPATH**/ ?>