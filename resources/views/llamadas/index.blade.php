@extends('layouts.app')
@section('content')
<index-llamada
    :pendientes="{{$pendientes}}"
    :realizados="{{$realizados}}"
    :no_realizados="{{$no_realizados}}"
    :llamadas="{{$llamadas}}"
    :prospecto="{{$prospecto}}"></index-llamada>
@endsection
