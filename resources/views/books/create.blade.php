@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Book Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.add_new_book') }}</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red text-capitalize"></i>{{ __('text.word_close') }}</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green text-capitalize"></i>{{ __('text.word_edit') }}</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel text-capitalize"></i>{{ __('text.word_refresh') }}</a>
                    </div>
                </div>
            </div>
            <form class="new-added-form">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.book_name') }} *</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_subject') }} *</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.writer_name') }} *</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.id_no') }}</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.publishing_date') }} *</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{__('text.upload_date')}} *</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-md-3 d-none d-xl-block form-group">

                    </div>
                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{__('text.word_save')}}</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('text.word_cancel') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add New Book Area End Here -->
@endsection


