<template>
    <div class="blackbox">

        <div class="card card-default">
            <div class="card-header">
                Message
            </div>
            <div class="card-body">
                <p>{{response}}</p>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger" @click="closeBox">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        response: String
    },
    methods: {
        closeBox(){
            this.$emit('close');
        }
    }
}
</script>

<style>
    .blackbox {
        background-color: rgba(0,0,0,.5);
        position: fixed;
        min-width: 100vw;
        min-height: 100vh;
        top:0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
