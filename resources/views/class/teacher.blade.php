@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                        <h3>{{$class->byLocale()->name}} Teachers</h3>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Email ..." class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-6 col-12  form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                    <div>
                        <button type="button" onclick="showAddModal()"  class="fw-btn-fill btn-primary text-white">Add Teacher to {{$class->byLocale()->name}}</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->first_name}} {{$user->last_name}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('user.show',$user->slug)}}"><i
                                                    class="fa fa-eye text-red"></i> View</a>
                                            <button class="dropdown-item" onclick="showRemoveModal({{$user->id}})"  ><i
                                                    class="fa fa-trash text-orange-peel"></i> Remove {{$user->first_name}} {{$user->last_name}} From {{$class->byLocale()->name}}</button>


                                        </div>
                                    </div>
                                    <div class="modal fade" id="removeModal{{$user->id}}"  role="dialog" aria-labelledby="exampleModalLabel{{$user->id}}">
                                        <div class="modal-dialog bg-white" role="document">
                                            <form method="post" class="modal-content" action="{{route('class.teacher.add',$class->id)}}">
                                                @csrf
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="teacher" value="{{$user->id}}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{$user->id}}">Confirm Action</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Remove {{$user->first_name}} {{$user->last_name}} from {{$class->byLocale()->name}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn-fill-sm btn-gradient-yellow text-white">Save</button>
                                                </div>
                                            </form>
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

    <div class="modal fade" id="addModal"  role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" action="{{route('class.teacher.add',$class->id)}}">
                @csrf
                <input type="hidden" name="action" value="add">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Teacher to {{$class->byLocale()->name}}</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label>Gender *</label>
                        <select class="select2" name="teacher" required>
                            <option value="">Please Select Teacher *</option>
                            @foreach(\App\Role::whereSlug('teacher')->first()->users as $user)
                                @if(!$class->teachers(getYear())->contains($user))
                                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-gradient-yellow text-white">Save</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        function  showAddModal() {
            $('#addModal').modal().show()
        }

        function showRemoveModal(id){
            $('#removeModal'+id).modal().show()
        }
    </script>
@endsection
