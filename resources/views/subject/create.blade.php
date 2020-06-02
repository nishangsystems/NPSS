@extends('layout.base')



@section('section')
    <div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Add New Subject</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="post" action="{{route('subject.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Subject Name *</label>
                                <input type="text" name="name" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Subject Type *</label>
                                <select name="type" class="select2">
                                    <option value="">Please Select</option>
                                    <option value="science">Science</option>
                                    <option value="arts">Arts</option>
                                    <option value="commercial">Commerce</option>
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Select Section *</label>
                                <select name="section" class="select2">
                                    <option value="0">Please Select Section</option>
                                    @foreach(\App\Section::all() as $class)
                                        <option value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Enter Code</label>
                                <input type="text" name="code" placeholder="" class="form-control">
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


