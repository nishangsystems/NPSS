@extends('layout.base')

@section('title')
    {{ __('text.word_fee') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.class_fee') }}</h3>
                </div>
                <div class="dropdown">
                    <button onclick="showEditModal()" class="fw-btn-fill btn-gradient-yellow">{{ __('text.edit_class_fee') }}</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            @foreach(\App\FeeType::get() as $type)
                                <th>{{$type->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Classes::get() as $class)
                        <tr>
                            <td>{{$class->section->name}} {{$class->byLocale()->name}}</td>
                            @foreach(\App\FeeType::get() as $type)
                                <th>{{getClassFee($class->id, getYear(), $type->id)}}</th>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal"  role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" action="{{route('class.fee.update')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">{{ __('text.edit_class_fee') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>{{ __('text.word_name') }}</th>
                                        @foreach(\App\FeeType::get() as $type)
                                            <th>{{$type->name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Classes::get() as $class)
                                    <tr>
                                        <input type="hidden" name="class[]" value="{{$class->id}}"/>
                                        <td>{{$class->section->name}} {{$class->byLocale()->name}}</td>
                                        @foreach(\App\FeeType::get() as $type)
                                            <th><input name="fee_{{$class->id}}_{{$type->id}}"  class="form-control" value="{{getClassFee($class->id, getYear(), $type->id)}}"/></th>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-fill-md btn-gradient-yellow text-white text-capitalize">{{ __('text.word_save') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        function  showEditModal() {
            $('#editModal').modal().show()
        }
    </script>
@endsection
