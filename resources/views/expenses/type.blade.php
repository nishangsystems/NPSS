@extends('layout.base')

@section('title')
   Expense Type
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Expense Types</h3>
                </div>
                <div class="dropdown">
                    <button onclick="showAddModal()" class="fw-btn-fill btn-gradient-yellow">Add Type</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\ExpenceType::get() as $type)
                            <tr>
                                <td>{{$type->byLocale()->name}}</td>
                                <td>{{$type->byLocale()->description}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal"  role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" action="{{route('expenses.type.post')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Expense Type</h5>
                </div>
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label>Type Name</label>
                        <input type="text" name="name" placeholder="" class="form-control">
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
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        function  showAddModal() {
            $('#addModal').modal().show()
        }
    </script>
@endsection
