@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection

@section('section')
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="row w-100">
                <div class="col-12 form-group">
                    <label class="text-capitalize"> {{ __('text.search_student_and_change_class') }}</label>
                    <input type="text" placeholder="Type to search"   onchange="search(this.value)" on onkeypress="search(this.value)"  class="form-control border">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table display data-table text-nowrap">
                <thead>
                <tr class="text-capitalize">
                    <th>{{ __('text.word_matricule') }}</th>
                    <th>{{ __('text.word_name') }}</th>
                    <th>{{ __('text.word_class') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="body">

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function search(name) {
            if(name!=''){
                $.ajax({
                    type: "GET",
                    url: "{{route('search.student')}}",
                    dataType: 'JSON',
                    data: {
                        'param':name
                    },
                    success: function (response) {
                        let html = "";
                        items = response.data;
                        for (let i = 0; i < items.length; i++) {
                            item = items[i];
                            html += "<tr>"+
                                "<td>"+item.matricule+"</td>"+
                                "<td>"+item.name+"</td>"+
                                "<td>"+item.class+"</td>"+
                                "<td   align='right' >"+
                                "<a class='btn btn-primary' href='{{route('student.changeClass')}}/"+item.id+"'>{{ __('text.change_class') }}</a>"+
                                "</td>"+
                                "</tr>"
                        }
                        if(items.length == 0){
                            html += "<tr><td colspan='3' align='center'>{{ __('text.no_results_found') }}</td> </tr>"
                        }
                        $('#body').html(html);
                    },
                    error: function(e){
                    }
                });
            }
        }
    </script>
@endsection

