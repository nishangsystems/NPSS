@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.all_system_users') }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead class="text-capitalize">
                    <tr>
                        <th>{{ __('text.word_photo') }}</th>
                        <th>{{ __('text.word_name') }}</th>
                        <th>{{ __('text.word_gender') }}</th>
                        <th>{{ __('text.word_role') }}</th>
                        <th>{{ __('text.word_address') }}</th>
                        <th>{{ __('text.word_phone') }}</th>
                        <th>{{ __('text.word_email') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center"><img src="{{route('image.render', $user->photo?$user->photo:' ')}}" width="30"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->roles->first()->name}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-capitalize">
                                @if(request('type') == 'assign_parent')
                                    <a class="btn btn-primary" href="{{route('parent.assign',$user->slug)}}"><i
                                            class="fas fa-cogs"></i> {{ __('text.assign_student') }}</a>
                                @elseif(request('action') == 'password')
                                    <a class="btn btn-danger text-white" href="{{route('user.password.change',$user->slug)}}"><i
                                            class="fas fa-lock"></i> {{ __('text.change_password') }}</a>
                                @else
                                    <a class="btn btn-primary" href="{{route('roles.assign')}}?user={{$user->slug}}"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i> {{ __('text.word_edit') }}</a>
                                    <a class="btn btn-success" href="{{route('user.show',$user->slug)}}"><i
                                            class="fa fa-eye text-orange-peel"></i> {{ __('text.word_view') }}</a>
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
