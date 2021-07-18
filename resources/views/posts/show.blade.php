@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div class="d-flex">
                        <div class="font-weight-bold pr-3"><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                        @if(auth()->user()->id != $post->user->id)
                            <follow-button-post user-id="{{$post->user->id}}" follows="{{ $follows }}"></follow-button-post>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            <p>
                <span class="font-weight-bold pr-1">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span>
                {{ $post->caption }} /
                <div>{{ $post->description }}</div>
            </p>
        </div>
    </div>
</div>
@endsection
