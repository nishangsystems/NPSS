@extends('layout.base')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/datepicker.min.css">
@endsection

@section('section')
    <div class="row">
        @if(\Auth::user()->can('create_class'))
            <div class="col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add Class</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="post" action="{{route('class.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Class Name *</label>
                                    <input type="text" value="{{old('name')}}" name="name" placeholder="" class="form-control">
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach(\App\Classes::get() as $class)
                                   <tr>
                                       <td>{{$class->name}}</td>
                                       <td>{{$class->student}}</td>
                                       <td>0</td>
                                       <td align="right">
                                           <div class="dropdown">
                                               <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                  aria-expanded="false">
                                                   <span class="flaticon-more-button-of-three-dots"></span>
                                               </a>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                   <a class="dropdown-item" href="#"><i
                                                           class="fas fa-graduation-cap text-orange-red"></i>  Student</a>
                                                   <a class="dropdown-item" href="#"><i
                                                           class="fas fa-user text-dark-pastel-green"></i>  Teachers</a>
                                                   <a class="dropdown-item" href="{{route('subject.index')}}?class={{$class->id}}"><i
                                                           class="fas fa-book text-orange-peel"></i>  Subject</a>
                                               </div>
                                           </div>
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
@section('script')
    <script src="{{asset('assets/js')}}/select2.min.js"></script>
    <script src="{{asset('assets/js')}}/datepicker.min.js"></script>
@endsection
