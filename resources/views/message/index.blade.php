@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.all_messages') }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.sn') }}</th>
                            <th>{{ __('text.word_title') }}</th>
                            <th>{{ __('text.word_author') }}</th>
                            <th>{{ __('text.word_date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                        @foreach(\App\SMS::orderBy('id','DESC')->get() as $message)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$message->title}}</td>
                                <td>{{$message->sender->name}}</td>
                                <td>{{$message->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-outline-primary text-capitalize" href="#">{{ __('text.word_view') }}</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
