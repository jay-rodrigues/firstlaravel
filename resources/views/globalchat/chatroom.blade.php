@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="chat-panel">
                    <div id="chat-box"> </div>
                    <div class="user-panel">
                        <input type="text" name="name" id="name" placeholder="Enter Name" maxlength="15"/>
                        <input type ="text" name="message" id="message" placeholder="Enter Message" maxlength="100" />
                        <button id="send-message" onclick="sendMessage()">Send</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('js/app.js') }}"></script>
<script>




    function sendMessage(){
        console.log("Test fired");
        Echo.event(new OutputToLog("test"));
        // let message = document.getElementById("message");
        // channel.bind("pusher:subcription_succeeded", ()=> {
        //     var triggered = channel.trigger("client-OutputToLog", {
        //         your: message,
        //     });
        // });
    }
    Echo.channel('log')
        .listen('OutputToLog', (e) => {
            console.log(e.message);
            let msgBox = document.getElementById("chat-box");
            let displayMessage = document.createElement("div");
            displayMessage.innerHTML = e.message
            msgBox.appendChild(displayMessage);
        })
</script>
