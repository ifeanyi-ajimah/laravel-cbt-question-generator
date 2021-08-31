<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> CREATE QUESTIONS HERE </div>

                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group m-3">
                                <label for="exampleInputEmail1"> Title </label>
                                <input type="text" v-model="fields.title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter post title">
                                <p class="myalert" v-if="errors && errors.title"> {{ errors.title[0]}} </p>
                            </div>
                           <div>
                            <select class="form-control m-3" v-model="fields.questioncategory_id">
                            <option value=""> Select Category </option>
                            <option v-for="(category , index) in categories" :key="index" :value="category.id"> {{ category.name }} </option>
                            </select>
                             <p class="myalert" v-if="errors && errors.questioncategory_id"> {{ errors.questioncategory_id[0]}} </p>
                           </div>
                           <div class="form-group m-3">
                                <label for="exampleInputEmail1"> Option A </label>
                                <input type="text" v-model="fields.option_a" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter option a">
                                <p class="myalert" v-if="errors && errors.option_a"> {{ errors.option_a[0]}} </p>
                            </div>
                           <div class="form-group m-3">
                                <label for="exampleInputEmail1"> Option B </label>
                                <input type="text" v-model="fields.option_b" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter option b">
                                <p class="myalert" v-if="errors && errors.option_b"> {{ errors.option_b[0]}} </p>
                            </div>
                           <div class="form-group m-3">
                                <label for="exampleInputEmail1"> Option C </label>
                                <input type="text" v-model="fields.option_c" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter option c ">
                                <p class="myalert" v-if="errors && errors.option_c"> {{ errors.option_c[0]}} </p>
                            </div>
                           <div class="form-group m-3">
                                <label for="exampleInputEmail1"> Option D </label>
                                <input type="text" v-model="fields.option_d" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter option d">
                                <p class="myalert" v-if="errors && errors.option_d"> {{ errors.option_d[0]}} </p>
                            </div>
        
                            

                            <input type="submit" :disabled="form_submitting" class="btn btn-primary" :value="form_submitting ? 'Saving post...' : 'Save' "/> 
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                categories : {},
                fields:{
                    title: '',
                    questioncategory_id :'',
                    option_a : '',
                    option_b : '',
                    option_c : '',
                    option_d : '',
                },
                errors:{},
                form_submitting: false,

            }
        },
        methods:{

            getCategories(){
            axios.get('/api/questioncategory')
            .then(response => {
               // console.log( response.data )
                this.categories = response.data.data
            })
            .catch(error => {
            })
           },

           submitForm(){
               this.form_submitting = true 
             
            
            axios.post('/api/question', this.fields )
            .then(response => {
                console.log(response.data)
                this.$swal('Queston added successfully');
               this.$router.push('/');
               this.form_submitting = false
                // this.categories = response.data.data
            })
            .catch(error => {
               
                if( error.response.status == 422 )
                {
                      this.$swal({icon: 'error', 'title': 'error occured'})
                    this.errors = error.response.data.errors;
                }
                this.form_submitting = false 
            })

           },
          

        },

        mounted() {
            this.getCategories();
        }
    }
</script>

<style >
    
    .myalert{
        color: red;
    }

</style>