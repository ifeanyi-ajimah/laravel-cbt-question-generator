<template>
<div class="container">

    <div class="row col-md-3">
    <select v-model="category_id" class="form-control col-md-3 ">
        <option value=" "> -  Select Category - </option>
        <option v-for="(category, index) in categories" :key="index" :value="category.id">
            {{ category.name }}
        </option>
    </select>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>
                <a class="listheader" href="#" > Question Title </a>
                </th>
            <th>
                <a class="listheader" href="#" > Question Options Text </a>
            </th>
            <th>
                <a class="listheader" href="#" > Created At  </a>
                 </th>
            <th>Action </th>
        </tr>
        </thead>

        <tbody>
            <tr v-for="(question , index) in questions.data" :key="index">
                <td> {{question.title}}</td>
                <td>
                     (a) {{question.option.option_a}} <br>
                    (b) {{question.option.option_b}} <br>
                    (c) {{question.option.option_c}} <br>
                    (d) {{question.option.option_d}} <br>

                </td>
                <td> {{ question.created_at }} </td>
                <td> 
                    <!-- <router-link :to="`/post/edit/${post.id}`" >  Edit </router-link> -->
                    <router-link class="btn btn-info btn-sm" :to="{ name: 'question.edit', params: {id: question.id } }" >  Edit </router-link>
                    <button @click="delete_question(index, question.id)" class="btn btn-danger btn-sm m-2"> Delete</button>
                </td>
            </tr>
        </tbody>

    </table>

     <div class="card-footer pb-0 pt-3">

         <pagination :data="questions" @pagination-change-page="getQuestions"></pagination>

        </div>
</div>
</template>


<script>

export default {
    name: 'question',

    data(){
        return{
            questions: {},
            categories:{},
            category_id : ' ',
            sort_field : 'created_at',
            sort_direction: 'desc',
        }
    },
    methods:{
        getQuestions(page = 1){
            axios.get('/api/question?page=' + page 
            + '&category_id=' + this.category_id

            )
            .then(response =>{
                console.log( response.data.data )
                this.questions = response.data
            })
            .catch(error => {

            })
        },

        getCategories(){
            axios.get('/api/questioncategory')
            .then(response => {
               // console.log( response.data )
                this.categories = response.data.data
            })
            .catch(error => {

            })
        },

        delete_question(index,id){
             this.$swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {

                console.log(index, id);
                axios.delete(`/api/question/${id}`)
                .then(response => {
                    this.questions.data.splice(index,1);
                    this.$swal('Question deleted successfully')
                })
                .catch(error =>{
                    this.$swal(' there was an error');
                })
            
             }
            })

        },
  

    },
    watch:{
        category_id(){
            this.getQuestions();
        }
    },

    created(){
        this.getQuestions();
        this.getCategories();
    }
}

</script>
<style scoped >
    
    .listheader{
        text-decoration: none;
    }
</style>






