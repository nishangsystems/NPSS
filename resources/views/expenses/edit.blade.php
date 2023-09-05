
@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add Expense Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.edit_expense') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('expenses.update', $expense->id)}}">
                @csrf
                <div class="row">
                    <div class="col-3 form-group">
                        <label class="text-capitalize">{{ __('text.word_amount') }}</label>
                        <input type="number"  value="{{old('amount', $expense->amount)}}"  name="amount" placeholder="" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_expense') }}</label>
                        <select name="expense_id" class="select2">
                            <option value="">{{ __('text.please_select') }}</option>
                            @foreach( \App\ExpenceType::get() as $exp)
                                <option {{(old('expense_id', $expense->expense_id)==$exp->id)?'selected':''}} value="{{$exp->id}}">{{$exp->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_status') }}</label>
                        <select name="status" class="select2">
                            <option value="">{{ __('text.please_select') }}</option>
                            @foreach( config('constants.EXPENSE_STATUS') as $name)
                                <option {{(old('status', $expense->status)==$name)?'selected':''}} >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_date') }}</label>
                        <input name="date" type="text" value="{{old('date', $expense->date)}}" placeholder="dd/mm/yy" class="form-control air-datepicker" data-position="bottom right">
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_motive') }}</label>
                        <textarea class="textarea form-control"  name="motive" id="form-message" rows="3">{{old('motive', $expense->motive)}}</textarea>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-capitalize">{{ __('text.word_save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



