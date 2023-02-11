@extends('layout')

@section('content')
    @include('navbar')
    <div class="w-full content mt-50 container is-max-widescreen">
        <user-table
            title="List of Users"
        />
    </div>

@endsection