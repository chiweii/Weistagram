@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/BMW_logo_%28gray%29.svg/2048px-BMW_logo_%28gray%29.svg.png" class="rounded-circle" style="max-width: 150px;">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{$user->username}}</h1>
                <a href="">NewPost</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>122</strong> posts </div>
                <div class="pr-5"><strong>10</strong> followers </div>
                <div class="pr-5"><strong>30</strong> following </div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#">{{$user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-4">
            <img src="https://image.u-car.com.tw/articleimage_1012570.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://image.u-car.com.tw/articleimage_1012570.jpg" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://image.u-car.com.tw/articleimage_1012570.jpg" class="w-100">
        </div>
    </div>
</div>
@endsection
