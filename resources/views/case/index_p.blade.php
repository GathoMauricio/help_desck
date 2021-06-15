@extends('layouts.app')
@section('page_title','Casos pendientes')
@section('content')
@livewire('case-component', ['status_case' => 1])
@endsection