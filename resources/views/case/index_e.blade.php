@extends('layouts.app')
@section('page_title','Casos en progreso')
@section('content')
@livewire('case-component', ['status_case' => 2])
@endsection