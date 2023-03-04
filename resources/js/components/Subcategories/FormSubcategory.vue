<template>
    <div>
         <div class="card shadow-lg">
     <div class="card-header">
     <h1 class="card-title" v-if="formType=='create'">Ajouter une sous-catégorie</h1>
     <h1 class="card-title" v-if="formType=='edit'">Editer la categorie</h1>
     </div>
     <div class="card-body">
        <div class="card p-3">
    <div class="mb-3">
      <label for="name_subcat" class="form-label">Nom de la sous-catégorie</label>
      <input type="text" class="form-control" id="name_subcat" name="name_subcat" v-model="subcategory.name_subcat"
      />
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="text" class="form-control" id="description" name="description" v-model="subcategory.description"/>
    </div>
    <div class="mb-3" v-if="formType=='create'">
        <label for="description" class="form-label">Catégories</label>
        <b-field label="Simple">
            <b-select placeholder="Select a name" style="color:gray" v-model="category_id">
                <option
                    v-for="cat in categories"
                    :value="cat.id"
                    :key="cat.id">
                    {{ cat.name_cat}}
                </option>
            </b-select>
        </b-field>
    </div>
    <div class="m-3">
        <v-btn
        
 color="success"
 class="mr-4"
 ><span class="bg-success">Register</span>

 </v-btn>

      <button class="btn btn-success" v-if="formType=='create'" @click="createSubcategory" >Creer</button>
      <button class="btn btn-success" v-if="formType=='edit'" @click="editSubcategory" >Editer</button>
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
    name:'formsubcategory',
    mixins : [changeComponent],
    data() {
        return {
          subcategory:{}, 
          category_id:null, 
          categories:[],
        };
    },
  inject: ['subcategoryId','formType'],
    mounted() {
        
    },
   async beforeMount(){
    if(this.subcategoryId!=0){
      await this.getSubcategorybyId();
    }
    await  this.getAllCategories();
    },

    methods: {
        async createSubcategory(){
           await axios.post('/api/v1/categories/'+this.category_id+'/subcategories',this.subcategory).then(response=>{
            console.log(response.data.message);
            }).catch(({response:{data}})=>{
                console.log(data.message)
            });
           this.changeComponent('list',0);
        },
        async getAllCategories(){
            await axios
        .get("/api/v1/categories")
        .then((response) => {
          console.log(response.data.data);
          this.categories= response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
       // .finally(() => (this.activeLoading = false));
        },
        async editSubcategory(){
           await axios.put('/api/v1/subcategories/'+this.subcategoryId,this.subcategory).then(response=>{
                console.log(response.data.message);
            }).catch(({response:{data}})=>{
                console.log(data.message)
            });
            this.$buefy.toast.open("Subcatégorie éditée avec succès !");
           this.changeComponent('list',0);
        },
         async getSubcategorybyId(){
         await axios.get('/api/v1/subcategories/'+this.subcategoryId).then(response => {
         this.subcategory=response.data.data;
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
