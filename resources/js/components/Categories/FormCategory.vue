<template>
    <div>
         <div class="card shadow-lg">
     <div class="card-header">
     <h1 class="card-title" v-if="formType=='create'">Ajouter une catégorie</h1>
     <h1 class="card-title" v-if="formType=='edit'">Editer la categorie</h1>
     </div>
     <div class="card-body">
        <div class="card p-3">
    <div class="mb-3">
      <label for="name" class="form-label">Nom de la categorie</label>
      <input type="text" class="form-control" id="name_cat" name="name_cat" v-model="category.name_cat"
      />
    </div>
    <div class="mb-3">
      <label for="description" class="form-label"><Datag>Description</Datag></label>
      <input type="text" class="form-control" id="description" name="description" v-model="category.description"/>
    </div>
    <div class="m-3">
      <button class="btn btn-success" v-if="formType=='create'" @click="createCategory" >Creer</button>
      <button class="btn btn-success" v-if="formType=='edit'" @click="editCategory" >Editer</button>
       <button @click="changeComponent('list')" class="btn btn-danger">Liste</button>
    </div>
  </div>
     </div>
     </div>
    </div>
</template>
<script>
import changeComponent from '../../mixin/changeComponent';
export default {
    name:'formcategory',
    mixins : [changeComponent],
    data() {
        return {
          category:{},  
        };
    },
  inject: ['categoryId','formType'],
    mounted() {
        
    },
   async beforeMount(){
    if(this.categoryId!=0)
      await this.getCategorybyId();
    },

    methods: {
        async createCategory(){
           await axios.post('/api/v1/categories',this.category).then(response=>{
            console.log(response.data.message);
            }).catch(({response:{data}})=>{
                console.log(data.message)
            });
           this.changeComponent('list',0);
        },
        async editCategory(){
           await axios.put('/api/v1/categories/'+this.categoryId,this.category).then(response=>{
                console.log(response.data.message);
            }).catch(({response:{data}})=>{
                console.log(data.message)
            });
            this.$buefy.toast.open("Catégorie éditée avec succès !");
           this.changeComponent('list',0);
        },
         async getCategorybyId(){
         await axios.get('/api/v1/categories/'+this.categoryId).then(response => {
         this.category=response.data.data;
      })
      .catch(error => {
        //alert(error);
        console.log(error)
      })
      //.finally(() => this.loading = false)
        },

    },
};
</script>
<style>
