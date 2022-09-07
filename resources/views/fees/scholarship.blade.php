@extends('layout.base')

@section('title')
   Scholarship
@endsection
@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
            
            </div>

            <form action="{{route('fee.scholarship.post')}}" method="post" class="row form-group">
                @csrf
                <div class="form-group col-12">
                    <select class="select2 " name="student" required>
                          <option  value="{{$student->id}}">{{$student->name}}</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label>Scholarship Amount</label>
                    <input type="text" name="amount" value="{{$student->scholarship(getYear())}}" required placeholder="Enter Amount" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label>Select Accademic Year</label>
                    <select class="select2" name="year" required>
                        <option value="">Select Academic Year*</option>
                        @foreach(\App\Session::get() as $y)
                            <option {{($y->id == old('year',getYear()))?'selected':''}} value="{{$y->id}}">{{$y->name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="col-12 pull-right mt-4">
                    <button type="submit" class="btn-fill-md btn-gradient-yellow text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
