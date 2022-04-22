<template>
    <div class="row">
        <div class="text-left">
            <Logout/>
            <h5>Welcome, {{user}}</h5>
        </div>
        <div class="text-center">
            <h1>Category List</h1>
        </div>
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"categoryAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="categories.data.length > 0">
                                <tr v-for="(category,key) in categories.data" :key="key">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.title }}</td>
                                    <td>{{ category.description }}</td>
                                    <td>
                                        <router-link :to='{name:"categoryView",params:{id:category.id}}' class="btn btn-primary">View</router-link>
                                        <router-link :to='{name:"categoryEdit",params:{id:category.id}}' class="btn btn-success">Edit</router-link>
                                        <b-button type="button" @click="deleteCategory(category.id)" variant="danger">Delete</b-button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Categories Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="paginate">
                <ul>
                    <li v-for="item in categories.last_page" :key="item" @click="pagination(item)">{{ item }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Logout from "../Logout.vue";
export default {
    name:"categories",
    components: {
		Logout,
	},
    data(){
        return {
            categories:[],
            item:1,
            user:'',
        }
    },
    mounted(){
        this.getCategories()
        this.user = localStorage.getItem('user_name')
    },
    methods:{
        async getCategories(item){
            await this.axios.get(`/api/category?page=${item}`,{
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                    "Content-Type": "application/json",
                }
            }).then(response=>{
                this.categories = response.data
                if(item!=1)
                {
                     this.$router.push({path:'/category',query:{page:item}});
                }
                else
                {
                    this.$router.push({path:'/category'});
                }
               
            }).catch(error=>{
                this.categories = []
                window.location.href = "/user_register"
            })
        },
        deleteCategory(id){
            if(confirm("Are you sure to delete this category ?")){
                this.axios.delete(`/api/category/${id}`,{
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                    "Content-Type": "application/json",
                }
            }).then(response=>{
                    this.getCategories()
                }).catch(error=>{
                })
            }
        },
        pagination(item)
        {
            this.getCategories(item)
        },
    }
}
</script>
<style>
.paginate {
    margin-top: 20px;
}
.paginate ul {
    display: flex;
    justify-content: center;
    align-items: center;
}
.paginate ul li {
    list-style: none;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid;
    cursor: pointer;
}
</style>