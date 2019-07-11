<template>
    <div class="col-md-12" v-if="user">
        <div class="card card-default">
            <div class="card-header agap-primary-color">
                Personal Information
            </div>
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <p class="small text-right"><span style="color: red;">*</span> All information that will given by the user will be verified by AGAP staff and will be used as your information for your future transactions with AGAP. <br>Kindly complete the form with all honesty.</p>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">First Name:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="first_name" v-model="user.first_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Last Name:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="last_name" v-model="user.last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Middle Name:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="middle_name" v-model="user.middle_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Birthdate:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="birthdate" v-model="user.birthdate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Gender:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-control">
                                <span>
                                    <input type="radio" value="male" name="gender" :checked="user.gender == 'male'" v-model="user.gender"> Male
                                </span>
                                <span>
                                    <input type="radio" value="female" name="gender" :checked="user.gender == 'female'" v-model="user.gender"> Female
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Department:</label>
                        </div>
                        <div class="col-md-9">
                            <select name="agency_id" id="" class="form-control" v-model="form.department">
                                <option value="">--SELECT--</option>
                                <option v-for="department in departments" :key="department.id" :value="department.id" :selected="department.id == form.department.id">{{department.display_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Agency:</label>
                        </div>
                        <div class="col-md-9">
                            <select name="agency_id" id="" class="form-control" v-model="user.agency_id">
                                <option value="">--SELECT--</option>
                                <option v-for="agency in agencyList" :key="agency.id" :value="agency.id" :selected="agency.id == user.agency_id">{{agency.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label text-right">
                            <label for="">Lower Level Operating Unit (LLOU):</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="llou" v-model="user.llou">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right" @click="updateInfo">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <message-box v-if="response" :response="response" v-on:close="response = null"></message-box>
    </div>
</template>

<script>
export default {
    computed:{
        agencyList: function(){
            return this.agencies.filter(agency=>{
                return agency.department_id == this.form.department;
            });
        }
    },
    data(){
        return {
            response: null,
            form: {
                department: null
            },
            user: null,
            agencies: [
                {
                    id: 1,
                    name: "Sample Name",
                    department_id: 2
                }
            ],
            departments: [
                {
                    id: 1,
                    name: "title"
                },
                {
                    id: 2,
                    name: "title 2"
                }
            ]
        }
    },
    mounted(){
        axios.get('/api/v1/user').then( data =>{
            axios.get(`/api/v1/user/info/${data.data.id}`).then( info =>{
                
                this.user = info.data;
                this.form.department = (this.user.agency) ? this.user.agency.department.id : 0;
            });
        });
        axios.get('/api/v1/department').then( data => {
            this.departments = data.data;
        });
        axios.get('/api/v1/agency').then(data => {
            this.agencies = data.data;
        });
    },
    methods: {
        updateInfo(){
            axios.put(`/api/v1/user/info/${this.user.id}`, this.user).then(response => {
                console.log(response);
                this.response = "Your information has been successfully updated";
            }).catch(error =>{
                this.response = "There has been an error on updating your information";
            });
        }
    }
}
</script>

<style>

</style>
