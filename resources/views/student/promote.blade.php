@extends('layout.base')

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/datepicker.min.css">
    <style>
        table.dataTable thead th, table.dataTable thead td {
            padding: 10px 10px;
            border-bottom: 1px solid #111;
        }
    </style>
@endsection

@section('section')
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.promote_student') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="get"  action="{{route('student.promote')}}">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.select_class') }}</label>
                        <select class="select2" name="class" required>
                            @foreach(\App\Classes::get() as $class)
                                <option {{request('class') == $class->id?'selected':''}} value="{{$class->id}}">{{$class->section->name}} - {{$class->byLocale()->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.academic_year') }}</label>
                        <select class="select2"  name="year" required>
                            @foreach(\App\Session::get() as $class)
                                <option {{request('year') == $class->id?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.next_academic_year') }}</label>
                        <select class="select2" name="next_year" required>
                            @foreach(\App\Session::get() as $class)
                                <option {{request('next_year') == $class->id?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('text.word_next') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.check_student_to_promote') }} </h3>
                </div>
            </div>
            @if(request('class') && request('year') && request('next_year')  && count($students) != 0)

                <form class="table-responsive"  method="post"  action="{{route('student.promote')}}">
                    @csrf
                    <input type="hidden" value="{{request('year')}}" name="year">
                    <input type="hidden" value="{{request('next_year')}}" name="next_year">
                    <input type="hidden" value="{{request('class')}}" name="class">
                    <table class="table display data-table text-nowrap">
                        <thead>
                        <tr class="text-capitalize">
                            <th>
                                 <input type="checkbox" onClick="toggle(this)"  id="students" >
                            </th>
                            <th>#</th>
                            <th>{{ __('text.student_matricule') }}</th>
                            <th>{{ __('text.student_name') }}</th>
                        </tr>
                        </thead>
                        <tr id="body">
                        @foreach($students as $k=>$student)
                           @if(!isMember($student, \App\Classes::find(request('class'))->parent->students(request('next_year'))))
                                <tr>
                                    <td>
                                        <input type="checkbox"  value="{{$student->student_id}}" id="student{{$student->student_id}}" name="students[]">
                                    </td>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$student->matricule}}</td>
                                    <td>{{$student->name}}</td>
                                </tr>
                           @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-capitalize">{{ __('text.word_promote') }}</button>
                    </div>
                </form>

            @endif
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/js')}}/select2.min.js"></script>
    <script src="{{asset('public/assets/js')}}/datepicker.min.js"></script>
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('students[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection
