<template>
<div class="row justify-content-center">
        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <!-- loop through users array and display them -->
                        <li class="py-2" v-for="(user, index) in active" :key="index">
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

                active:[]
            }
        },
        mounted(){
            Echo.join('user-events')
                .here(user => {
                    this.active = user;
                })
                .joining(user => {
                    this.active.push(user);
                })
                .leaving(user => {
                    this.active = this.active.filter(u => u.id != user.id);
                });
        }
    }
</script>
