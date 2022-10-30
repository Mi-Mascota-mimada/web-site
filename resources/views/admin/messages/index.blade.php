@extends('layouts.admin')

@section('content')

<div class="container">
<div class="inbox_msg">
    <div class="inbox_people">
        <div class="headind_srch">
        <div class="recent_heading">
            <h4>Recent</h4>
        </div>
        <div class="srch_bar">
            <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> 
            </div>
        </div>
        </div>
        <div class="inbox_chat">
            @forelse ($allMessages as $key => $myMessage)              
                    <div class="chat_list" id="{{$key}}" onclick="selectMessage('{{$key}}')"> 
                        <div class="chat_people">
                            <div class="chat_ib">
                                <h3 class="text-dark">{{$myMessage[0]->name}} </h3>
                                <p class="chat_date">{{$myMessage[0]->created_at->format('F l jS Y h:i A')}}</p>
                                <p class="text-black">Cel: {{$myMessage[0]->cel}}</p>
                                <p class="text-black">Email: {{$key}}</p>
                            </div>
                        </div>
                    </div>              
            @empty
                <p>There's not messages</p>
            @endforelse            
        </div>
    </div>
<div class="mesgs">
    <div id="msg_history" class="msg_history">        
        <div class="msg-main">
            <p class="msg_p">Select a Message </p>
            <span class="msg_icon"><i class="mdi mdi-facebook-messenger text-primary"></i></span>
        </div>
    </div>
</div>
</div>
</div>
          
@endsection

