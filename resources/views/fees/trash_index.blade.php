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
                    <h3>{{ __('text.trashed_fees') }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_amount') }}</th>
                            <th>{{ __('text.deleted_by') }}</th>
                            <th>{{ __('text.academic_year') }}</th>
                            <th>{{ __('text.word_date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fees as $fee)
                            <tr>
                                <td>{{$fee->student->name??null}}</td>
                               
                                <td>{{$fee->amount??null}}</td>
                                <td>{{$fee->deletedBy->name??null}}</td>
                                <td>{{$fee->session->name??null}}</td>
                                <td>{{$fee->created_at->format('d/m/Y')}}</td>
                                <td class="text-capitalize">


                                    <form action="{{route('fee.restore', $fee->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class=" btn text-white btn-info"><i class="fas"></i> {{ __('text.word_restore') }}</button>
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
