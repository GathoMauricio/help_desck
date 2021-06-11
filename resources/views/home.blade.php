@extends('layouts.app')
@section('page_title','')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget quam fringilla nisl scelerisque vestibulum. Sed nibh lectus, bibendum pulvinar orci non, cursus venenatis tortor. Curabitur vitae sapien sit amet magna semper pharetra eu eu est. Ut eu leo lacus. Etiam venenatis, tellus sit amet eleifend ullamcorper, nibh magna consectetur sem, id mattis orci enim eu felis. Aliquam rutrum lorem lacus, sit amet efficitur est consequat id. Integer et iaculis odio. Sed venenatis rutrum volutpat. Praesent dictum magna enim, a feugiat sem iaculis a. Fusce vulputate lectus non dictum mollis. In faucibus purus et hendrerit volutpat. Integer congue orci tortor, et pulvinar felis dapibus vel. Duis ac elementum est. Donec non mi gravida, aliquet diam eu, semper sapien. Maecenas blandit urna lorem, vel suscipit nisi varius eu. Nam tempus justo id aliquam ullamcorper.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
