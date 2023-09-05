@extends('layout.base')

@section('title')
    {{ __('text.word_fee') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1 text-capitalize">
                <div class="item-title">
                    <h3>{{ __('text.todays_fee_collection') }}</h3>
                </div>
                <div class="dropdown">
                    <a href="{{route('fee.student')}}?action=fee" class="fw-btn-fill btn-gradient-yellow">{{ __('text.collect_fee') }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_amount') }}</th>
                            <th>{{ __('text.collected_by') }}</th>
                            <th>{{ __('text.academic_year') }}</th>
                            <th>{{ __('text.word_date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fees as $fee)
                            <tr>
                                <td>{{$fee->student->name}}</td>
                               
                                <td>{{$fee->amount}}</td>
                                <td>{{$fee->user->name}}</td>
                                <td>{{$fee->session->name}}</td>
                                <td>{{$fee->created_at->format('d/m/Y')}}</td>
                                <td class="text-capitalize">
                                    <a onclick="event.preventDefault();
												document.getElementById('delete').submit();" class=" btn text-white btn-danger"><i
                                            class="fas"></i> {{ __('text.word_delete') }}</a>


                                    <form id="delete" action="{{route('fee.delete')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="fee" value="{{$fee->id}}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
