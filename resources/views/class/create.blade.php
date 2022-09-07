@extends('layout.base')

@section('section')
    <div class="row">
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Create Class</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="post" action="{{route('class.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-6 form-group">
                                <label>Class Name *</label>
                                <input type="text" required value="{{old('name')}}" name="name"  class="form-control">
                            </div>

                            <div class="col-6 form-group">
                                <label>Maximum Per Class *</label>
                                <input type="text" value="{{old('limit')}}" name="limit"  class="form-control">
                            </div>

                            <div class="col-6 form-group">
                                <label>Abbreviation *</label>
                                <input type="text" value="{{old('abbreviations')}}" name="abbreviations"  class="form-control">
                            </div>

                            <div class="col-6 form-group">
                                <label>Select Section *</label>
                                <select name="section_id" class="select2">
                                    <option value="0">Please Select Section</option>
                                    @foreach(\App\Section::all() as $class)
                                        <option value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
