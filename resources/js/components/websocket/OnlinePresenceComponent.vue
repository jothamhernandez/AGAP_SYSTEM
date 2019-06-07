<template>
    <div class="online-presence">
        <span>Users Online: {{connected}}</span>
    </div>
</template>

<script>
import io from 'socket.io-client';

export default {
    data(){
        return {
            socket: null,
            connected: 0,
        }
    },
    props: {
        user: String
    },
    mounted(){
        this.socket = io.connect('https://www.pinwheel-developers.com:8080');
        // this.socket = io.connect('http://192.168.10.10:8080');
        this.socket.on('connected', (data)=>{
            console.log(data);
            this.socket.emit('connected', {data: this.user});
            this.connected = data.connected;

            
        });

        this.socket.on('link start', function(data){
            console.log(data);
            this.connected = data.connected;
        });

        this.socket.on('new connection', (data)=>{
            console.log(data);
            this.connected = data.connected;
        });

        this.socket.on('user disconnect', (data)=>{
            this.connected = data.connected;
            console.log(data);
        });
    }
}
</script>

<style scoped>
    span {
        display: block;
    }
    .online-presence{
        position: fixed;
        background-color: gold;
        color: #00814a;
        padding: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        min-width: 100px;
        bottom: 0px;
        right: 50px;
    }
</style>
