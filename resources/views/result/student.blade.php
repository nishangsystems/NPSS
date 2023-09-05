@extends('layout.base')

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{$class?$class->class->name:''}}  {{$class?$class->section_id:''}} {{ __('text.student_result') }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_gender') }}</th>
                            <th>{{ __('text.fee_bal') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td class="text-capitalize">{{$student->gender}}</td>
                                <td>{{$student->dept(getYear())}}</td>
                                <td class="text-capitalize">
                                   @if(request('action') == 'recordmarks')
                                        <a class="btn btn-danger text-white" href="{{route('result.edit',$student->slug)}}">{{ __('text.edit_result') }}</a>
                                    @elseif(request('action') == 'print')
                                        <a class="btn btn-success text-white" href="{{route('result.session',$student->slug)}}?action=print">{{ __('text.word_print') }}</a>
                                    @endif
                                    @if(\Auth::user()->hasRole('admin') && $id != 'mine')
                                           <a class="btn btn-danger text-white" href="{{route('result.edit',$student->slug)}}">{{ __('text.edit_result') }}</a>
                                           <a class="btn btn-success text-white" href="{{route('result.session',$student->slug)}}">{{ __('text.view_results') }}</a>
                                   @endif

                                   @if($id == 'mine')
                                       <a class="btn btn-success text-white" href="{{route('result.session',$student->slug)}}">{{ __('text.view_results') }}</a>
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
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
