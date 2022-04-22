<template>
    <div class="container p-5">
      <div class="col-md-12">
       <h1 class="mb-3">Register</h1>
        <form v-on:submit.prevent="create_user">
          <div class="mb-3">
            <b-form-group id="input-group-1" label="Enter Name" label-for="input-1" class="form-label"></b-form-group>
            <b-form-input id="input-1" v-model="form.name" placeholder="Enter Username" name="name" class="form-control" required></b-form-input>
          </div>
          
         <div class="mb-3">
           <b-form-group id="input-group-2" label="Enter Email" label-for="input-2" class="form-label"></b-form-group>
            <b-form-input type="email" id="input-2" v-model="form.email" placeholder="Enter Email" name="email" class="form-control" required></b-form-input>
          </div>

           <div class="mb-3">
            <b-form-group id="input-group-3" label="Enter Password" label-for="input-3" class="form-label"></b-form-group>
            <b-form-input type="password" id="input-3" v-model="form.password" placeholder="Enter Password" name="password" class="form-control" required></b-form-input>
          </div>

          <div class="mb-3">
            <b-form-group id="input-group-4" label="Enter Confirm Password" label-for="input-4" class="form-label"></b-form-group>
            <b-form-input type="password" id="input-4" v-model="form.password_confirmation" placeholder="Enter Confirm Password" name="password_confirmation" class="form-control" required></b-form-input>
          </div>
          <button type="submit" class="btn btn-primary mt-5">Submit</button>
    </form>
    </div>
    </div>
</template>

<script>

//importing modules
import Swal from 'sweetalert2'
export default {
  data(){
  return {
    form:{
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
      
    }
  }
},
  methods:{
     //user register function and api call
     create_user()
     {
        var config = {
            method: "post",
            url: "/api/user_register",
            data: this.form,
        };
        axios(config).then(function (response) {
            if(response.data.error)
            {
              Swal.fire({ title: 'Oh', text: 'Email is Required or Email is already taken', icon: 'warning', });
            }
            else
            {
                //success message alert
                Swal.fire({
                title: 'Hurry',
                text:   "User has been registered successfully",
                icon: 'success',
              });
              localStorage.setItem('accesstoken', response.data.access_token)
              window.location.href = "/user_login"
            }
        });
      }
  }
  
}
</script>