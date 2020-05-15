@extends('layout.base')

@section('section')
    <!-- Add Notice Area End Here -->
    <!-- All Notice Area Start Here -->
    <div>
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Add Session</h3>
                        </div>
                    </div>
                    <form class="mg-b-20" method="post" action="{{route('settings.sessionPost')}}">
                        @csrf
                        <div class="row gutters-8">
                            <div class="col-lg-6 col-12 form-group">
                                <input type="text" name="name" required placeholder="Session name" class="form-control">
                            </div>
                            <div class="col-lg-6 col-12 form-group">
                                <div>
                                    <button type="submit" class=" fw-btn-fill btn-gradient-yellow">save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="notice-board-wrap">
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Session::get() as $sequence)
                                    <tr>
                                        <td>{{$sequence->name}}</td>
                                        <td align="right">

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
        <!-- All Notice Area End Here -->
    </div>
@endsection
