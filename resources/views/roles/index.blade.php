@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection


@section('section')
    <div>
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 text-capitalize">
                        <div class="item-title">
                            <h3>{{ __('text.user_roles') }}</h3>
                        </div>

                       <div>
                           <a href="{{route('roles.create')}}" class="ml-auto fw-btn-fill btn-gradient-yellow">{{ __('text.add_role') }}</a>
                       </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                            <tr class="text-capitalize">
                                <th>{{ __('text.word_name') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->byLocale()->name}}</td>
                                    <td align="right" class="text-capitalize">
                                        <a class="btn btn-success" href="{{route('roles.edit',$role->slug)}}?role={{$role->slug}}"><i
                                                class="fas fa-edit"></i> {{ __('text.word_edit') }}</a>
                                        <a class="btn btn-primary" href="{{route('user.index')}}?role={{$role->slug}}"><i
                                                class="fas fa-user"></i> {{ __('text.word_users') }}</a>
                                        <a class="btn btn-danger" href="{{route('roles.permissions')}}?role={{$role->slug}}"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i> {{ __('text.word_permissions') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- All Transport List Area End Here -->
    </div>
    <!-- All Subjects Area End Here -->
@endsection
