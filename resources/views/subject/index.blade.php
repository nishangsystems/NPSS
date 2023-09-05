@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/datepicker.min.css">
@endsection

@section('section')
    <div class="row">
    <div class="col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title text-capitalize">
                        <h3>{{$title}}</h3>
                    </div>
                    <div class="dropdown">
                       @if(\Auth::user()->can('create_subject'))
                            <a href="{{route('subject.create')}}" class="fw-btn-fill btn-gradient-yellow">{{ __('text.add_subject') }}</a>
                       @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead class="text-capitalize">
                        <tr>
                           <th>{{ __('text.sn') }}</th>
                            <th>{{ __('text.subject_name') }}</th>
                            <th>{{ __('text.subject_code') }}</th>
                            <th>{{ __('text.word_section') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$subject->byLocale()->name}}</td>
                                    <td>{{$subject->id}}</td>
                                    <td>{{$subject->section->byLocale()->name}}</td>
                                    <td class="text-capitalize">
                                        <a class="btn btn-success" href="{{route('subject.edit', $subject->slug)}}"><i
                                                class="fas fa-edit"></i> {{ __('text.word_edit') }}</a>

                                        <a onclick="event.preventDefault();
                                            document.getElementById('delete{{$subject->id}}').submit();" class=" btn text-white btn-danger"><i
                                                class="fas"></i> {{ __('text.word_delete') }}</a>
                                        <form id="delete{{$subject->id}}" action="{{route('subject.destroy', $subject->slug)}}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </form>
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
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/js')}}/select2.min.js"></script>
    <script src="{{asset('public/assets/js')}}/datepicker.min.js"></script>
@endsection
