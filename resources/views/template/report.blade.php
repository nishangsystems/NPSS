@extends('layout.template')
@section('content')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div class="card">
        <div class="card-body">
            <table class="table text-nowrap text-capitalize">
                <thead>
                <tr>
                    <th>{{ __('text.word_module') }}</th>
                    <th>{{__('text.word_amount')}}</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ __('text.fee_collection') }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>{{ __('text.fee_collection') }}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>{{ __('text.word_scholarships') }}</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
