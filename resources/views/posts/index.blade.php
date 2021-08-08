@extends('layouts.app')

@section('content')
<div class="container" id="indexcontainer">
    @foreach($posts as $post)
    <div class="row pt-2">
        <div class="col-6 offset-3">
            <div>
                <p>
                    <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle" style="width: 7%">
                    <span class="font-weight-bold pl-2">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </a>
        </div>
    </div>
    <div class="row pt-2 pb-4">
        <div class="col-6 offset-3">
            <div>
                <p>
                    <span class="font-weight-bold pr-1">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var channel = Echo.channel('followingnewpost'+'{!! Auth::user()->id !!}');
    channel.listen('.following-new-post', function(data) {
        // const span = document.createElement('span');
        $('#indexcontainer').prepend(`
            <div class="row pt-2">
            <div class="col-6 offset-3">
                <div>
                    <p>
                        <img src="/storage/`+data.user_data.profile.image+`" class="rounded-circle" style="width: 7%">
                        <span class="font-weight-bold pl-2">
                            <a href="/profile/`+data.user_data.id+`">
                                <span class="text-dark">`+data.user_data.username+`</span>
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/`+data.post_data.id+`">
                    <img src="/storage/`+data.post_data.image+`" class="w-100">
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <p>
                        <span class="font-weight-bold pr-1">
                            <a href="/profile/`+data.user_data.id+`">
                                <span class="text-dark">`+data.user_data.username+`</span>
                            </a>
                        </span>
                        `+data.post_data.description+`
                    </p>
                </div>
            </div>
        </div>
        `);
        // span.innerHTML = ;
        //  document.getElementById('indexcontainer').appendChild(span);
    });
</script>
@endsection
