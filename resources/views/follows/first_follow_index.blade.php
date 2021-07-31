@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 alert alert-light text-center">
            <h2>歡迎使用 Weistagram</h2>
            <p>追蹤其它人後，你就會在這裡看到他們發布的相片。</p>
        </div>
        <div class="col-10 offset-1 alert alert-info">
            <div class="carousel slide" data-ride="carousel" id="carousel_user">
                <ol class="carousel-indicators">
                    @foreach($users as $key => $user)
                        @if($key == 1)
                            <li data-target="#carousel_user" data-slide-to="{{$key}}" class="active"></li>
                        @else
                            <li data-target="#carousel_user" data-slide-to="{{$key}}"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($users as $key => $user)
                        <div class="carousel-item
                        @if($key == 1)
                          active">
                        @else
                            ">
                        @endif
                            <div class="d-flex justify-content-center mb-5">
                                <div class="card d-flex align-items-center" style="width: 18rem;">
                                  <img src="{{ $user->profile->profileImage() }}" class="card-img-top rounded-circle w-75 mt-3" style="height: 13rem;" alt="...">
                                  <div class="card-body text-center">
                                    <a href="/profile/{{$user->id}}"><h5 class="card-title">{{ $user->username }}</h5></a>
                                    <p class="card-text">{{ $user->profile->title }}</p>
                                    <follow-button-post user-id="{{$user->id}}" follows="{{ $user->follows }}"></follow-button-post>
                                  </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <a href="#carousel_user" class="carousel-control-prev" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a href="#carousel_user" class="carousel-control-next" data-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
