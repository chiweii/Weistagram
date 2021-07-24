@component('mail::message')
你有一個新的追蹤者 {{ $follower_data->username }}

@component('mail::button', ['url' => url('/profile/'.$follower_data->id)])
查看追蹤者的簡介檔案
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
