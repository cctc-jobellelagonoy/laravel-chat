@extends('layouts.chatview')
@section('content')
<div class="chat_window" id="chat-window">
   <div class="top_menu">
      <div class="buttons">
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit" class="close">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
               </svg>
            </button>
        </form>
      </div>
      <div class="title">AI Assistant</div>
   </div>

   <chat-messages :messages="messages"></chat-messages>

   <chat-form v-on:messagesent="addMessage" v-on:messagereceived="addReply" :user="{{ Auth::user() }}"></chat-form>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
   (function () {
      
      $(function () {
          scroll = function(){
            $messages = $('.messages');
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 1000);
          };
          scroll();

      });
   }.call(this));
</script>

@endsection