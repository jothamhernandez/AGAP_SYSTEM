<template>
    <div class="blackbox" v-if="open">
        <div class="card card-default slide">
            <div class="card-header">
                Instruction
            </div>
            <div class="card-body">
                <div class="slide-container">
                    <!-- <div v-for="(slide, index) in slides" :key="index"> -->
                        <img  class="img img-fluid" :src="slides[selected].image" alt="">
                        <p>{{slides[selected].message}}</p>
                    <!-- </div> -->
                </div>
            </div>
            <div class="card-footer">
                <div class="slide-control">
                    <button class="btn btn-primary" @click="controlHandler(0)" v-if="selected > 0 ">Prev</button>
                    <button class="btn btn-primary" @click="controlHandler(1    )" v-if="selected < slides.length - 1">Next</button>
                    <button class="btn btn-success float-right" v-if="done" @click="doneInstruction">Done</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            selected: 0,
            done: false,
            open: true,
            slides: [
                {
                    image:'/imgs/instruction/1.jpg',
                    message: "Step 1: After registration, please complete your information to be able to register on events. In case you can't see the account information panel, try to re-login."
                },
                {
                    image:'/imgs/instruction/2.jpg',
                    message: "Step 2: Also, Check your email address to verify that your email address is active."
                },
                {
                    image:'/imgs/instruction/3.jpg',
                    message: "Step 3: After completing your information and verifying your email, the \"Events\" tab will appear on the header and will be accessible, You will be able to view one event under the \"Events\" section."
                },
                {
                    image:'/imgs/instruction/4.jpg',
                    message: "Step 4: Viewing one event will show you the details about the event. Click Register Beside the price you want to be part of the list that will be attending the event."
                },
                {
                    image:'/imgs/instruction/5.jpg',
                    message: "Step 5: After doing the initiative to register. The system will require you to upload the proof of your payment before the system recognize you as paid attendee."
                },
                {
                    image:'/imgs/instruction/6.jpg',
                    message: "Step 6: The system will show you the file you are going to upload to be verified. Click upload to proceed."
                },
                {
                    image:'/imgs/instruction/7.jpg',
                    message: "Step 7: Waiting for the file to be verified, you will have the status of \"Pending\". "
                },
                {
                    image:'/imgs/instruction/8.jpg',
                    message: "Step 8: After the admin verified your proof of payment, You will received on your email the verification that you paid for the event."
                },
                {
                    image:'/imgs/instruction/9.jpg',
                    message: "Step 9: If you look on the events tab. It will show you the event you're already paid. "
                }
            ]
        }
    },
    mounted(){

    },
    methods: {
        controlHandler(direction){
            if(direction){
                this.selected++;
            } else {
                this.selected--;
            }
            if(this.selected >= this.slides.length){
                this.selected = 0;
            }
            if(this.selected < 0){
                this.selected = this.slides.length - 1;
            }

            if(this.selected == this.slides.length -1){
                this.done = true;
            }
        },
        doneInstruction(){
            axios.post('/api/v1/done-instruction',{}).then( r =>{
                this.open = false;
            });
        }
    }
}
</script>

<style scoped>
    .slide {
        width: 60%;
    }
</style>
