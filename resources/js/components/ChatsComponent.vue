<template>
   <div class ="row">
       <div class="col-8">
           <div class="card card-default">
               <div class="card-header">Messages</div>
               <div class="card-body p-0">
                   <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                       <!-- loop through messages array and display message with username -->
                       <li class="p-2" v-for="(message, index) in messages" :key="index">
                           <strong>{{ message.user.name }}</strong>
                           {{ message.message }}
                       </li>
                   </ul>
               </div>
               <input @keyup.enter="sendMessage" v-model="newMessage" type="text" name="message" placeholder="Enter your message.." class="form-control">
           </div>
           <!-- to do the user is typing check video https://www.youtube.com/watch?v=-9-OUYVC8sc&t=0s -->
            <!-- <span class="text-muted">user is typing</span> -->
       </div>

        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <!-- loop through users array and display them -->
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

   </div>
</template>

<script>
    export default {
        props:['user'],

        data() {
            return {
                messages: [],
                newMessage: '',
                users:[]
            }
        },
        mounted(){
            Echo.join('chat')
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                })
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                });
        },

        created() {
            this.fetchMessages();


        },

        methods: {
            // utilize the get method that was setup in routes web.php
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            //Pushes message in to array with user
            sendMessage(){
                this.messages.push({
                    user:this.user,
                    message: this.newMessage
                });
                //Accesses value stored in v-model newMessage
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            }
        }
    }
</script>
