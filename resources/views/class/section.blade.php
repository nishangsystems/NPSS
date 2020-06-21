@extends('layout.base')

@section('section')
    <div class="row">
        @if(\Auth::user()->can('create_class'))
            <div class="col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add Class Section to {{$class->byLocale()->name}}</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="post" action="{{route('class.store')}}">
                            @csrf
                            <input type="hidden" name="class" value="{{$class->id}}">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Class Name *</label>
                                    <input type="text" value="{{old('name')}}" name="name" placeholder="{{$class->byLocale()->name}} A" class="form-control">
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         @endif
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Classes</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Student</th>
                                <th>Teacher</th>
                                <th>Subjects</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach($classes as $class)
                                   <tr>
                                       <td>{{$class->name}}</td>
                                       <td>{{$class->students(getYear())->count()}}</td>
                                       <td>{{$class->teachers(getYear())->count()}}</td>
                                       <td>{{$class->subjects()->count()}}</td>
                                       <td align="right">

                                            @if(!(request('action') == 'student'))
                                               <a class="btn btn-secondary" href="{{route('class.teacher',$class->id)}}"><i
                                                       class="fas fa-user text-dark-pastel-green"></i>  Teachers</a>
                                               <a class="btn btn-success" href="{{route('subject.index')}}?class={{$class->id}}"><i
                                                       class="fas fa-book text-orange-peel"></i>  Subject</a>
                                            @else
                                               <a class="btn btn-primary" href="{{route('student.index')}}?class={{$class->id}}"><i
                                                       class="fas fa-graduation-cap text-orange-red"></i>  Student</a>
                                            @endif

{{--                                           @if(\Auth::user()->hasRole('admin'))--}}
{{--                                                    <a class="btn btn-primary" href="{{route('class.edit', $class->id)}}?class={{$class->id}}"><i--}}
{{--                                                            class="fas fa-graduation-cap text-orange-red"></i>  Edit</a>--}}

{{--                                               <a onclick="event.preventDefault();--}}
{{--												document.getElementById('delete').submit();" class=" btn btn-danger text-white"><i--}}
{{--                                                       class="fas fa-trash"></i> Delete</a>--}}

{{--                                               <form id="delete" action="{{route('class.destroy', $class->id)}}" method="POST" style="display: none;">--}}
{{--                                                   @method('DELETE')--}}
{{--                                                   {{ csrf_field() }}--}}
{{--                                               </form>--}}
{{--                                           @endif--}}
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
@endsection

