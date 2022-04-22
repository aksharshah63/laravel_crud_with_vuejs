<template>
    <div class="row">
        <div class="col-12">
            <ul>
                <li v-for="item in error" :key="item">
                    {{item}} not valid
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-1" label="Title" label-for="input-1"></b-form-group>
                                    <b-form-input id="input-1" v-model="category.title" placeholder="Enter Title" required></b-form-input>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-2" label="Description" label-for="input-2"></b-form-group>
                                    <b-form-input id="input-2" v-model="category.description" placeholder="Enter Description" required></b-form-input>
                                </div>
                            </div>
                            <div class="col-12">
                                <b-button type="submit" variant="primary">Update</b-button>
                                <b-button type="reset" v-on:click="reset()" variant="danger">Reset</b-button>
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
    name:"update-category",
    data(){
        return {
            category:{
                title:"",
                description:"",
                _method:"patch"
            },
            error:[],
        }
    },
    mounted(){
        this.editCategory()
    },
    methods:{
        async editCategory(){
            await this.axios.get(`/api/category/${this.$route.params.id}/edit`,{
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                    "Content-Type": "application/json",
                }
            }).then(response=>{
                this.category.title = response.data.title
                this.category.description = response.data.description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            for(const item in this.category)
			{
				if(this.category[item]=="" || this.category[item].length==0)
				{
					this.error.push(item)
				}
			}
            if(this.error.length==0)
            {
                await this.axios.post(`/api/category/${this.$route.params.id}`,this.category,{
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                    "Content-Type": "application/json",
                }
            }).then(response=>{
                    this.$router.push({name:"categoryList"})
                }).catch(error=>{
                    console.log(error)
                })
            }
        },
        reset()
        {
            this.category.title='',
            this.category.description=''
        }
    }
}
</script>