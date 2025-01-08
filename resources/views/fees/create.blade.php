@extends('layout.base')

@section('title')
    {{ __('text.word_fee') }}
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.collect_fee') }}</h3>
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
                    <label class="text-capitalize">{{ __('text.word_amount') }}</label>
                   <div class="d-flex form-control justify-content-between align-items-center">
                       <input type="text" onkeyup="updateBal()" id="amount" name="amount" class="border-0 bg-transparent" value="{{old('amount')}}" max="{{$student->dept($year)}}" required placeholder="Enter Amount" >
                       <span id="balance" class="font-bold text-nowrap">/ XAF {{$student->dept($year)}}</span>
                   </div>
                </div>
                <div class="form-group col-6">
                    <label class="text-capitalize">{{ __('text.word_reference') }}</label>
                    <input type="text" value="{{old('reference')}}"  name="reference" placeholder="Enter Payment Reference" class="form-control">
                </div>

                <div class="form-group col-6">
                    <label class="text-capitalize">{{ __('text.fee_type') }}</label>
                    <select class=" select2" name="type" required>
                        @foreach(\App\FeeType::get() as $type)
                            <option  {{(old('type') == $type->id)?'selected':''}} value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                        <select class=" select2" name="method" required>
                            <option value="">{{ __('text.payment_method') }} *</option>
                            @foreach(\App\PaymentMethod::get() as $method)
                                <option {{(old('method') == $method->id)?'selected':''}} value="{{$method->id}}">{{$method->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <select class="select2" name="year" required>
                            <option value="">{{ __('text.select_academic_year') }}*</option>
                            @foreach(\App\Session::get() as $y)
                                <option {{($y->id == $year)?'selected':''}} value="{{$y->id}}">{{$y->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 pull-right mt-4">
                        <button type="submit" class="btn-fill-md btn-gradient-yellow text-white text-capitalize">{{ __('text.word_save') }}</button>
                    </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function updateBal(){
            input = $('#amount');
            balance = $('#balance');
            amount = {{$student->dept($year)}} - input.val();
            balance.html('/ XAF '+amount);
            if(amount < 0){
                balance.addClass('text-red')
            }else{
                balance.removeClass('text-red')
            }
        }
    </script>
@endsection
