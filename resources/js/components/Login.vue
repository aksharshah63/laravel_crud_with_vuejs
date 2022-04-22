<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="page-header">
              <h2>Login</h2>
            </div>
            <div class="col-md-12 text-center">
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul class="list-group">
                      <li v-for="error in errors" :key="error" class="list-group-item list-group-item-danger">{{ error }}</li>
                    </ul>
                </p>
            </div>
            <div class="col-md-6" v-if="loginfalse = true">
                <form @submit="checkForm" ref="form">
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input v-model="email" type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input v-model="password" type="password" class="form-control" id="password" placeholder="********" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
         data() {
            return {
                errors: [],
                state: {
                    email: '',
                    password: ''
                }
            }
        },
        // mounted()
        // {
        //   if(localStorage.getItem('accesstoken'))
        //   {
        //       window.location.href = "/category"
        //   }
        // },
        methods:{
        checkForm: function (e) 
        {
          this.errors = [];
          if (!this.email) {
            this.errors.push('Email required.');
          }
          if (!this.password) {
            this.errors.push('Password required.');
          }
          else
          {
            var data ={
              'email' : this.$refs.form.email.value,
              'password' : this.$refs.form.password.value,
            }
            var config = {
                  method: "post",
                  url: "/user_login",
                  data: data,
            };
             axios(config).then(function (response) {
                    if(response.data.status=='success')
                    {
                        localStorage.setItem('accesstoken', response.data.access_token)
                        localStorage.setItem('user_name', response.data.user)
                        window.location.href = "/category"
                    }
                    else
                    {
                       window.location.href = "/user_login"
                    }
            });
          }
          e.preventDefault();
        }
      }
    }
</script>