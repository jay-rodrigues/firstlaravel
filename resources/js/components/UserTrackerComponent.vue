<template>


</template>
<script>
export default {
        props:['user'],

        data() {
            return {

                activeusers:[]
            }
        },
        mounted(){
            Echo.join('user-events')
                .here(user => {
                    this.activeusers = user;
                })
                .joining(user => {
                    this.activeusers.push(user);
                })
                .leaving(user => {
                    this.activeusers = this.activeusers.filter(u => u.id != user.id);
                });
        }
}
</script>
