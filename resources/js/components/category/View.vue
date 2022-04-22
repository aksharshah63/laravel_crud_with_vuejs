<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>View Category</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-1" label="Title" label-for="input-1"></b-form-group>
                                    <b-form-input id="input-1" v-model="category.title" readonly required></b-form-input>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-2" label="Description" label-for="input-2"></b-form-group>
                                    <b-form-input id="input-2" v-model="category.description" readonly required></b-form-input>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"view-category",
    data(){
        return {
            category:{
                title:"",
                description:"",
            }
        }
    },
    mounted(){
        this.showCategory()
    },
    methods:{
        async showCategory(){
            // await this.axios.get(`/api/category/${this.$route.params.id}`).then(response=>{
            //     const { title, description } = response.data
            //     this.category.title = title
            //     this.category.description = description
            // }).catch(error=>{
            //     console.log(error)
            // })
            await this.axios.get(`/api/category/${this.$route.params.id}`,{
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                    "Content-Type": "application/json",
                }
            }).then(response=>{
                const { title, description } = response.data
                this.category.title = title
                this.category.description = description
               
            }).catch(error=>{
                this.categories = []
                window.location.href = "/user_register"
            })
        }
    }
}
</script>