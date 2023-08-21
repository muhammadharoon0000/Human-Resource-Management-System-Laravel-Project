@extends('layout.main') @section('content')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif
    @if(session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{__('Mail Setting')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            <form method="POST"  id="mail_settings_form" action="{{route('setting.mailStore')}}" >
                                @csrf

                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{__('Mail Host')}} *</strong></label>
                                        <input type="text" name="mail_host" class="form-control" value="{{env('MAIL_HOST')}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{__('Mail Address')}} *</strong></label>
                                        <input type="text" name="mail_address" class="form-control" value="{{env('MAIL_FROM_ADDRESS')}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{__('Mail From Name')}} *</strong></label>
                                        <input type="text" name="mail_name" class="form-control" value="{{env('MAIL_FROM_NAME')}}" required />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{__('Mail Port')}} *</strong></label>
                                        <input type="text" name="port" class="form-control" value="{{env('MAIL_PORT')}}" required />
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Password')}} *</strong></label>
                                        <input type="password" name="password" class="form-control" value="" required />
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Encryption')}} *</strong></label>
                                        <input type="text" name="encryption" class="form-control" value="{{env('MAIL_ENCRYPTION')}}" required />
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        $("ul#setting").siblings('a').attr('aria-expanded','true');
        $("ul#setting").addClass("show");
        $("ul#setting #mail-setting-menu").addClass("active");

        $('.selectpicker').selectpicker({
            style: 'btn-link',
        });
    })(jQuery);
</script>
@endpush
