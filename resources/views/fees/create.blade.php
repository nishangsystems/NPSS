@extends('layout.base')

@section('title')
    Fee
@endsection


@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Collect Fee</h3>
                </div>
            </div>

            <form action="{{route('fee.collect.submit')}}" method="post" class="row form-group">
                @csrf
                <div class="form-group col-12">
                    <select class="select2 " name="student" required>
                          <option  value="{{$student->id}}">{{$student->name}}</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label>Amount</label>
                    <input type="text" name="amount" value="" required placeholder="Enter Amount" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label>Reference</label>
                    <input type="text" name="reference" required placeholder="Enter Payment Reference" class="form-control">
                </div>

                <div class="form-group col-6">
                    <label>Fee Type</label>
                    <select class=" select2" name="type" required>
                        <option value="">Type *</option>
                        @foreach(\App\FeeType::get() as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                        <select class=" select2" name="method" required>
                            <option value="">Payment Method *</option>
                            @foreach(\App\PaymentMethod::get() as $method)
                                <option value="{{$method->id}}">{{$method->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <select class="select2" name="year" required>
                            <option value="">Select Academic Year*</option>
                            @foreach(\App\Session::get() as $year)
                                <option {{($year->id == getYear())?'selected':''}} value="{{$year->id}}">{{$year->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 pull-right mt-4">
                        <button type="submit" class="btn-fill-md btn-gradient-yellow text-white">Save</button>
                    </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
