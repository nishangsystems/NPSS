@extends('layout.base')

@section('section')
    <div class="row">
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 d-flex justify-content-between">
                        <div class="item-title">
                            <h3>{{$clas->section->name}} - {{$clas->name}}</h3>
                        </div>
                        <form  action="" class="row w-100">
                            @csrf
                            <div class="col-md-4 form-group">
                                <select class="select2"  value="{{old('admission_year')}}"  required name="year">
                                    <option>{{ __('text.change_academic_year') }}</option>
                                    @foreach(\App\Session::all() as $class)
                                        <option {{($class->id == $year)?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label></label>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-capitalize">{{ __('text.word_get') }}</button>
                            </div>
                        </form>
                        <button onclick="ShowClassModal()" class="btn btn-lg btn-success text-capitalize">{{ __('text.edit_class') }}</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead class="text-capitalize">
                                <tr>
                                    <th>{{ __('text.word_name') }}</th>
                                    <th>{{ __('text.word_student') }}</th>
                                    <th>{{ __('text.word_teacher') }}</th>
                                    <th>{{ __('text.word_subjects') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($classes as $class)
                                   <tr>
                                       <td>{{$class->class->name}} {{$class->section_id}}</td>
                                       <td>{{$class->student->count()}}</td>
                                       <td>{{$class->teacher->count()}}</td>
                                       <td>{{$class->class->subjects()->count()}}</td>
                                       <td align="right" class="text-capitalize">
                                            @if(!(request('action') == 'student'))
                                               <a class="btn btn-secondary" href="{{route('class.teacher',$class->id)}}"><i
                                                       class="fas fa-user text-dark-pastel-green"></i>  {{ __('text.word_teachers') }}</a>
                                               <a class="btn btn-success" href="{{route('subject.index')}}?class={{$class->id}}"><i
                                                       class="fas fa-book text-orange-peel"></i>  {{ __('text.word_subject') }}</a>
                                            @else
                                               <a class="btn btn-primary" href="{{route('student.index')}}?class={{$class->id}}"><i
                                                       class="fas fa-graduation-cap text-orange-red"></i>  {{ __('text.word_student') }}</a>
                                            @endif
                                       </td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="classModal"  role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" action="{{route('class.update', $clas->id)}}">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="exampleModalLabel1">{{ __('text.enter_class_details') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.class_name') }} *</label>
                        <input type="text" value="{{old('name')?old('name'):$clas->name}}" name="name" placeholder="{{$clas->name}}" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_abbreviation') }} *</label>
                        <input type="text" value="{{old('abbreviations')?old('abbreviations'):$clas->abbreviations}}" name="abbreviations" placeholder="{{$clas->abbreviations}}" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.class_limit') }} *</label>
                        <input type="text" value="{{old('limit')?old('limit'):$clas->limit}}" name="limit" placeholder="{{$clas->limit}}" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-gradient-yellow text-white text-capitalize">{{ __('text.word_save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function ShowClassModal(){
            $('#classModal').modal().show()
        }
    </script>
@endsection

