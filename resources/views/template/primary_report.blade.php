<div style="height:120px; width:95% " >
    <img src="{{asset('public/assets/img')}}/header.png" />
</div>
<h3>{{$title}}</h3>
<div class="heading-layout1">
    <div class="item-title d-flex-column w-100">
        <h5 class="mb-0"> {{$student->name}}</h5>
        <h5 class="mb-0"> {{$student->class($year->id)->name}}</h5>
    </div>
</div>
<div class="table-responsive pb-5">
    <table class="table my-3">
        <tbody>
        <tr class="text-capitalize">
            <th rowspan="2">{{ __('text.word_subjects') }}</th>
            @foreach(\App\Terms::get() as $term)
                <th colspan="{{$term->sequence->count()}}">{{$term->byLocale()->name}}</th>
                <th rowspan="2" style="width: 50px">{{ __('text.total_mark') }}</th>
                <th rowspan="2" style="width: 50px">{{ __('text.abbr_appr') }}</th>
            @endforeach
        </tr>

        <tr>
            @foreach(\App\Terms::get() as $term)
                @foreach($term->sequence as $sequence)
                    <th>{{substr($sequence->byLocale()->name,0,3)}} {{ __('text.word_month') }}</th>
                @endforeach
            @endforeach
        </tr>
        @foreach(\App\Section::find(2)->subjects as $subject)
            <tr>
                <th style="width: 160px;">{{$subject->byLocale()->name}}</th>
                @foreach(\App\Terms::get() as $term)
                    @foreach($term->sequence as $sequence)
                        <th>{{$student->mark($subject->id, $year->id, $sequence->id)}}</th>
                    @endforeach
                    <th>{{$student->termMark($subject->id, $year->id, $term->id)}}</th>
                    <th></th>
                @endforeach
            </tr>
        @endforeach

        <tr>
            <th class="font-bold text-capitalize" style="width: 160px;">{{ __('text.word_total') }}</th>
            @foreach(\App\Terms::get() as $term)
                @foreach($term->sequence as $sequence)
                    <th>{{$student->total($year->id, $sequence->id)}}</th>
                @endforeach
                <th>{{$student->termTotal($year->id, $term->id)}}</th>
                <th></th>
            @endforeach
        </tr>

        <tr>
            <th class="font-bold text-capitalize" style="width: 160px;">{{ __('text.word_average') }}</th>
            @foreach(\App\Terms::get() as $term)
                @foreach($term->sequence as $sequence)
                    <th>{{$student->average(getYear(), $term->id)}}</th>
                @endforeach
                <th>-</th>
                <th>-</th>
            @endforeach
        </tr>

        <tr>
            <th class="font-bold text-capitalize" style="width: 160px;">{{ __('text.word_position') }}</th>
            @foreach(\App\Terms::get() as $term)
                @foreach($term->sequence as $sequence)
                    <th>-</th>
                @endforeach
                <th>-</th>
                <th>-</th>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
