@extends('layout.base')

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.word_about') }} {{$student->name}}</h3>
                </div>
            </div>
            <div class="single-info-details">
                <div class="item-img">
                    <img src="{{route('image.render', $student->photo?$student->photo:' ')}}" alt="image">
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{$student->name}}</h3>
                        <div class="header-elements">
                            <ul>
                                <li><a href="{{route('student.edit', $student->slug)}}"><i class="far fa-edit"></i></a></li>
                                <li><a href="#"><i class="fas fa-print"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_name') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_gender') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->gender}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.parent_name') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->parents->count()>0?$student->parent->first()->name:''}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.date_of_birth') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->dob}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_email') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->email}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.admission_date') }}:</td>
                                <td class="font-medium text-dark-medium">{{\App\Session::find($student->admission_year)->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_class') }}:</td>
                                <td  class="font-medium text-dark-medium">{{($student->class($year) != null)?$student->class($year)->name:$student->class($student->admission_year)->name." , ".\App\Session::find($student->admission_year)->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_address') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->address}}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_phone') }}:</td>
                                <td class="font-medium text-dark-medium">{{$student->phone}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Details Area End Here -->
@endsection
