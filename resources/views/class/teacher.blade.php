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
                        <h3>{{$class->class->byLocale()->name}}  {{$class->section_id}} {{ __('text.word_teachers') }}</h3>
                </div>
            </div>
            <div class="mg-b-20">
                <div class="row gutters-8 d-flex-column align-items-end">
                        <button type="button" onclick="showAddModal()"  class="btn-md btn-primary text-white text-capitalize">{{ __('text.add_teacher_to') }} {{$class->class->byLocale()->name}}  {{$class->section_id}}</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
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
                                <td>{{$user->gender}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <a class="btn btn-primary text-capitalize" href="{{route('user.show',$user->slug)}}"><i
                                            class="fa fa-eye text-red"></i> {{ __('text.word_view') }}</a>
                                    <button class="btn btn-danger text-capitalize" onclick="showRemoveModal({{$user->id}})"  ><i
                                            class="fa fa-trash text-orange-peel"></i>{{  __('text.remove_from') }} {{$class->class->byLocale()->name}} {{$class->section_id}}</button>

                                    <div class="modal fade" id="removeModal{{$user->id}}"  role="dialog" aria-labelledby="exampleModalLabel{{$user->id}}">
                                        <div class="modal-dialog bg-white" role="document">
                                            <form method="post" class="modal-content" action="{{route('class.teacher.add',$class->id)}}">
                                                @csrf
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="teacher" value="{{$user->id}}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel{{$user->id}}">{{ __('text.confirm_action') }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    {{__('text.word_remove')}} {{$user->name}}  {{ __('text.word_from') }} {{$class->class->byLocale()->name}} {{$class->section_id}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn-fill-sm btn-gradient-yellow text-white text-capitalize">{{ __('text.word_save') }}</button>
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
                <h5 class="modal-title text-capitalize" id="exampleModalLabel1">{{ __('text.add_teacher_to') }} {{$class->class->byLocale()->name}} {{$class->section_id}}</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <select class="select2" name="teacher" required>
                            <option value="">{{ __('text.please_select_teacher') }} *</option>
                            @foreach(\App\Role::whereSlug('teacher')->first()->users as $user)
                                @if(!$class->teacher->contains($user))
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-gradient-yellow text-white text-capitalize">{{ __('text.word_save') }}</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        function  showAddModal() {
            $('#addModal').modal().show()
        }

        function showRemoveModal(id){
            $('#removeModal'+id).modal().show()
        }
    </script>
@endsection
