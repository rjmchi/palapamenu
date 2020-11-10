<template>
  <div class="category">
    <h3 v-on:click="updateShowForm">Category</h3>
    <form @submit.prevent="addCategory" v-show="showForm">
      <label for="en_name">English Name:</label>
      <input type="text" name="en_name" v-model = newCategory.en_name placeholder="English Name">
      <label for="es_name">Spanish Name:</label>
      <input type="text" name="es_name" v-model = newCategory.es_name placeholder="Spanish Name">
      <label for="sort_order">Sort Order:</label>
      <input type="text" name="sort_order" v-model = newCategory.sort_order>
      <label for="en_description">English Description:</label>
      <textarea name="en_description" v-model = newCategory.en_description placeholder="English Description"></textarea>
      <label for="es_description">Spanish Description:</label>
      <textarea name="es_description" v-model = newCategory.es_description placeholder="Spanish Description"></textarea>
      <button type="submit" class="btn-sm btn-primary">AddCategory</button>
    </form>

    <span v-for="category in categories" v-bind:key=category.id>
      <form @submit.prevent>
        <label for="en_name">English Name:</label>
        <input type="text" name="en_name" v-model=category.en_name>  
        <label for="es_name">Spanish Name:</label>
        <input type="text" name="es_name" v-model=category.es_name>
        <label for="sort_order">Sort Order:</label>
        <input type="text" name="sort_order" v-model=category.sort_order>
        <label for="en_description">English Description:</label>
        <textarea name="en_description" v-model="category.en_description"></textarea>
        <label for="es_description">Spanish Description:</label>
        <textarea name="es_description" v-model="category.es_description"></textarea>
        <button v-on:click="updateCategory(category)" class="btn-sm btn-primary">Update Category</button>
        <button v-on:click="deleteCategory(category.id)" class="btn-sm btn-danger" >Delete Category</button>
      </form>
      
      <item-component v-bind:items="category.items" v-bind:category_id="category.id" v-on:update="update"/>
    </span>
  </div> 
</template>

<script>
import item_component from './ItemComponent.vue'

export default {
  components: {
    'item-component': item_component,
    },    
    props: ['categories', 'menu_id'],
  data () {
    return {
      showForm: false,
      newCategory: {
        id: '',
        menu_id: '',
        es_name:'',
        en_name:'',
        es_description:'',
        en_description:'',        
        sort_order:0,        
      },
    }
  },
  methods: {
    updateShowForm() {
      this.showForm = !this.showForm;
    },
    updateCategory: async function(category) {
      try {
        console.log('update category');
        let resp = await fetch('http://localhost:8000/api/category/'+category.id, 
        {
          "method": "PUT",
            body: JSON.stringify({
              "en_name": category.en_name,
              "es_name": category.es_name,
              "en_description": category.en_description,
              "es_description": category.es_description,
              "sort_order": category.sort_order
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.$emit('update');
        }
      } catch(err) {
        console.log(err);
      }
    },
    deleteCategory: async function(id) {
      try {
        let resp = await fetch('http://localhost:8000/api/category/'+id, 
        {
          "method": "DELETE",
        });
        if (resp.ok) {
          resp = await resp.json();
          this.$emit('update');
        }
      } catch(err) {
        console.log(err);
      }
    },
    addCategory: async function() {
      try {
        let resp = await fetch('http://localhost:8000/api/category', 
        {
          "method": "POST",
            body: JSON.stringify({
              "en_name":this.newCategory.en_name,
              "es_name":this.newCategory.es_name,
              "en_description": this.newCategory.en_description,
              "es_description": this.newCategory.es_description,             
              "sort_order":this.newCategory.sort_order,
              "menu_id":this.menu_id
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.newCategory.en_name = '';
          this.newCategory.es_name = '';
          this.newCategory.en_description = '';
          this.newCategory.es_description = '';
          this.newCategory.sort_order = 0;
          this.showForm = false;
          this.$emit('update');
        }
      } catch(err) {
        console.log(err);
      }
    },
    update() {
      this.$emit('update');
    },
  },
  created() {

  },
}
</script>

<style lang="scss" scoped>
  .category {
    background-color:rgb(245, 234, 234);
  } 
</style>