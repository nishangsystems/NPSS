@extends('layout.base')
@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.all_fee_collections') }}</h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_class') }}</th>
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
                            <td>{{($fee->student->class($fee->session->id))?$fee->student->class($fee->session->id)->byLocale()->name:''}}</td>
                            <td>{{$fee->amount}}</td>
                            <td>{{$fee->user->first_name}} {{$fee->user->last_name}}</td>
                            <td>{{$fee->session->name}}</td>
                            <td>{{$fee->created_at->format('d/m/Y')}}</td>
                            <td>

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
