@extends('layout.layout')

@section('content')
<div class="chat-container">
    <div class="message bot">

    </div>
</div>
<form action="{{ route('chatgpt.generate') }}" method="POST">
    @csrf
<input type="text" id="user-input" name="prompt_data" placeholder="Type your message...">
<button class="btn btn-success btn-sm">Send</button>
</form>

@endsection
