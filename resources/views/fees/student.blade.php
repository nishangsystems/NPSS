@extends('layout.base')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All @if(request('action')=='scholarship' || request('action') =='giftscholarship') {{"Scholarships"}}  @elseif(request('action')=='owing') {{"UnCompleted Fee"}}  @else  {{"Completed Fee"}}   @endif</h3>
                </div>
            </div>

            <form class="mg-b-20"  method="get" action="">
                <input type="hidden" name="action" value="{{request('action')}}">
                <div class="row gutters-8">
                    <div class="col-lg-3  mt-1">
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">@if(request('action')=='scholarship') {{"Scholarships"}}  @elseif(request('action')=='owing') {{"UnCompleted Fee"}}  @else  {{"Completed Fee"}}   @endif</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('fee.student')}}?action=owing">UnCompleted Fee</a>
                                <a class="dropdown-item" href="{{route('fee.student')}}?action=scholarship">Scholarships</a>
                                <a class="dropdown-item" href="{{route('fee.student')}}?action=completed">Completed Fee</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  mt-1">
                        <select required name="year" class="select2">
                            <option>Select Year</option>
                            @foreach(\App\Session::all() as $class)
                                <option  {{$year==$class->id?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4  mt-1">
                        <select name="class" class="select2">
                            <option {{request('class')==0?'selected':''}} value="0">ALL Class</option>
                            @foreach(\App\ClassSection::all() as $class)
                                <option {{request('class')==$class->id?'selected':''}} value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-1 mt-1">
                        <button type="submit" class="text-white btn-fill-sm btn-gradient-yellow btn-hover-bluedark">Query</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Amount Payed</th>
                        <th>Amount Owing</th>
                        <th>Scholarship</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{($student->class($year))?$student->class($year)->byLocale()->name:''}}</td>
                                <td>{{$student->totalPaid($year)}}</td>
                                <td>{{$student->dept($year)}}</td>
                                <td>{{$student->scholarship($year)}}</td>
                                <td>
                                    @if(request('action')=='reciept')
                                        <a class="btn btn-primary" href="{{route('fee.print')}}?student={{$student->slug}}&action=print"><i class="fas fa-print"></i> View receipt </a>
                                    @elseif(request('action')=='scholarship' || request('action') =='giftscholarship')
                                        <a class="btn btn-primary" href="{{route('fee.scholarship')}}?student={{$student->slug}}"><i class="fas fa-edit"></i> Scholarship</a>
                                    @else
                                        <a class="btn btn-primary" href="{{route('fee.collect')}}?student={{$student->slug}}"><i class="fas fa-plus"></i> Collect Fee</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script>

    </script>
@endsection
