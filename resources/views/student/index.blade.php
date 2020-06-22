@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/datepicker.min.css">
@endsection


@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                   @if(request('class'))
                        <h3>{{ "All Student in ". \App\Classes::find(request('class'))->byLocale()->name }}</h3>
                    @else
                        <h3>All Students Data</h3>
                   @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Parents</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}} </td>
                                <td>{{$student->gender}}</td>
                                <td>{{($student->class(getYear()) != null)?$student->class(getYear())->name:''}}</td>
                                <td>{{($student->parent() != null)?$student->parent()->first_name:''}} {{($student->parent() != null)?$student->parent()->last_name:''}}</td>
                                <td>

                                     <a class="btn btn-primary" href="{{route('student.show', $student->slug)}}"><i
                                                    class="fas fa-eye"></i> View</a>
                                    @if(\Auth::user()->hasRole('admin'))
                                        <a class="btn btn-success" href="{{route('student.edit', $student->slug)}}"><i
                                                class="fas fa-edit"></i> Edit</a>

                                        <a onclick="event.preventDefault();
												document.getElementById('delete').submit();" class=" btn text-white btn-danger"><i
                                                class="fas"></i> Delete</a>


                                        <form id="delete" action="{{route('student.destroy', $student->slug)}}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Student Table Area End Here -->
@endsection
@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/select2.min.js"></script>
    <script src="{{asset('assets/js')}}/datepicker.min.js"></script>
@endsection
