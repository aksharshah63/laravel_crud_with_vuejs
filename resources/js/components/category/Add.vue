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
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create" ref="add">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-1" label="Title" label-for="input-1"></b-form-group>
                                    <b-form-input id="input-1" v-model="category.title" placeholder="Enter Title" name="title" required></b-form-input>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <b-form-group id="input-group-2" label="Description" label-for="input-2"></b-form-group>
                                    <b-form-input id="input-2" v-model="category.description" placeholder="Enter Description" name="description" required></b-form-input>
                                </div>
                            </div>
                            <div class="col-12">
                                 <b-button type="submit" variant="primary">Save</b-button>
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
    name:"add-category",
    data(){
        return {
            category:{
                title:"",
                description:""
            },
            error:[]
        }
    },
    methods:{
        async create(){
            this.error=[];
            for(const item in this.category)
			{
				if(this.category[item]=="" || this.category[item].length==0)
				{
					this.error.push(item)
				}
			}
            if(this.error.length==0)
            {
                var data ={
                    'title' : this.$refs.add.title.value,
                    'description' : this.$refs.add.description.value,
                }
                if((localStorage.getItem("accesstoken")))
                {
                    var config = {
                    method: "post",
                    url: "/api/category",
                    headers: {
                         Authorization: "Bearer " + localStorage.getItem("accesstoken"),
                        "Content-Type": "application/json",
                    },
                    data: data
                    };
                    axios(config).then(function (response) {
                        if(response.data.status=='success')
                        {
                            window.location.href = "/category"
                        }
                        
                    }).catch(error=>{
                    window.location.href = "/category/add"
                    });
                }
                else
                {
                    window.location.href = "/user_register"
                }
                
                // await this.axios.post('/api/category',this.category).then(response=>{
                //     this.$router.push({name:"categoryList"})
                // }).catch(error=>{
                //     console.log(error)
                // })
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