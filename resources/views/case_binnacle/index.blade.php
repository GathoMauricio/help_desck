@extends('layouts.app')
@section('page_title','Bitácoras del caso '.$case->num_case)
@section('content')
@livewire('case-binnacle-component',['case_id',request()->id])
@endsection