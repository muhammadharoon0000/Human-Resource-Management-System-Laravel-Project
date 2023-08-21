@extends('translation::layout')

@section('body')


    <form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get">

        <div class="container-fluid mt-3 mb-3">

            <div class="d-flex">

                <a href="{{ route('languages.create') }}" class="btn btn-primary mr-1">
                    {{ __('Add') }}
                </a>
                <div class="w-20">
                    @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                </div>

                <div class=" ml-3 w-20">
                    <select class="form-control" id='lang_del'>
                        <option selected="selected" >Delete Language</option>
                        <option>--------------------------</option>
                        @foreach($languages as $lang)
                            <option value="{{$lang}}">{{$lang}}</option>
                        @endforeach
                  </select>
                </div>
                
            </div>
        </div>

        @if(count($translations))

            <div class="table-responsive">
                <table id="language-table" class="table ">

                    <thead>
                    <tr>
                        <th class="w-1/5 uppercase font-thin">{{ __('translation::translation.key') }}</th>

                        <th class="uppercase font-thin">{{ config('app.locale') }}</th>
                        <th class="uppercase font-thin">{{ $language }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($translations as $type => $items)

                        @foreach($items as $group => $translations)

                            @foreach($translations as $key => $value)

                                @if(!is_array($value[config('app.locale')]))
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value[config('app.locale')] }}</td>
                                        <td>
                                            <translation-input
                                                    initial-translation="{{ $value[$language] }}"
                                                    language="{{ $language }}"
                                                    group="{{ $group }}"
                                                    translation-key="{{ $key }}"
                                                    route="{{config('translation.ui_url') }}"
                                            >
                                            </translation-input>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach

                        @endforeach

                    @endforeach

                    </tbody>

                </table>
            </div>

        @endif

    </form>

    <script type="text/javascript">
        (function($) {
            "use strict";

            $(document).ready(function () {

                var dataSrc = [];

                var table = $('#language-table').DataTable({

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

                    'select': {style: 'multi', selector: 'td:first-child'},
                    'lengthMenu': [[100, 200, 500,-1], [100, 200, 500,"All"]],
                });

            });

            $(document).ready(function() {
                $("#lang_del").change(function(){
                    var proceed = confirm("Are You Sure To Delete ?");
                    if (proceed) {
                        var langVal = $('#lang_del :selected').text()
                        $.ajax({
                            url: "{{route('language.delete')}}",
                            method: "GET",
                            data: {langVal:langVal},
                            success: function (data) {
                                console.log(data);
                                if (data =='success') {
                                    window.location.href = "English";
                                }
                            }
                        })
                    }
                });
            });

        })(jQuery);
    </script>

@endsection




