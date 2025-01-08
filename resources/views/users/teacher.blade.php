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
                   @if(request('class'))
                        <h3>{{\App\Classes::find(request('class'))->byLocale()->name}} {{ __('text.word_teachers') }}</h3>
                    @else
                        <h3>{{ __('text.all_teachers_data') }}</h3>
                   @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead class="text-capitalize">
                    <tr>
                        <th>{{ __('text.word_name') }}</th>
                        <th>{{ __('text.word_class') }}</th>
                        <th>{{ __('text.word_gender') }}</th>
                        <th>{{ __('text.word_address') }}</th>
                        <th>{{ __('text.word_phone') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->class(getYear())?$user->class(getYear())->name:'No class assigned'}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td class="text-capitalize">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('user.edit',$user->slug)}}"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>{{ __('text.word_edit') }}</a>
                                            <a class="dropdown-item" href="{{route('user.show',$user->slug)}}"><i
                                                    class="fa fa-trash text-red"></i> {{ __('text.word_view') }}</a>

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
@endsection
@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
