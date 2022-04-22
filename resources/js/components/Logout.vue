<template>
    <div class="row">
        <div class="text-left">
            <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
        </div>
    </div>
</template>
<script>
export default {
    name:"Logout",
    methods:{
        logout()
        {
            var config = {
                  method: "post",
                  url: "/logout",
            };
             axios(config).then(function (response) {
                    localStorage.removeItem('accesstoken')
                    localStorage.removeItem('user_name')
                        window.location.href = "/user_login"
                    }, function() {
                        console.log('failed');
                    });
        }
    }
}
</script>