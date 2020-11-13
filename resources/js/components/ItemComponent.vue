<template>
  <div class="item">
    <h3 v-on:click="updateShowForm">Items</h3>
      <div class="item">
        <form @submit.prevent="addItem" v-show="showForm">
          <label for="en_name">English Name:</label>
          <input type="text" name="en_name" v-model="newItem.en_name">
          <label for="es_name">Spanish Name:</label>
          <input type="text" name="es_name" v-model="newItem.es_name">
          <label for="en_description">English Description:</label>
          <textarea name="en_description" v-model="newItem.en_description"></textarea>
          <label for="es_description">Spanish Description:</label>
          <textarea name="es_description" v-model="newItem.es_description"></textarea>
          <label for="price">Price:</label>
          <input type="text" name="price" v-model="newItem.price">
          <label for="sort_order">Sort Order:</label>
          <input type="text" name="sort_order" v-model="newItem.sort_order">
          <label for="choices">Number of Choices:</label>
          <input type="text" name="choices" v-model="newItem.no_of_choices">
          <label for="instructions">Instructions</label>
          <input type="checkbox" name="instructions" v-model="newItem.instructions">
          <button type="submit" class="btn-sm btn-primary">Add Item</button>
        </form>

          <span v-for="item in items" v-bind:key=item.id>
            <form @submit.prevent>
              <label for="en_name">English Name:</label>
              <input type="text" name="en_name" v-model="item.en_name">          
              <label for="es_name">Spanish Name:</label>
              <input type="text" name="es_name" v-model="item.es_name">          
              <label for="en_description">English Description:</label>
              <textarea name="en_description" v-model = "item.en_description"></textarea>
              <label for="es_description">Spanish Description:</label>
              <textarea name="es_description" v-model = "item.es_description"></textarea>
              <label for="price">Price:</label>
              <input type="text" name="price" v-model="item.price">
              <label for="sort_order">Sort Order:</label>
              <input type="text" name="sort_order" v-model="item.sort_order">
              <label for="choices">Number of Choices:</label>
              <input type="text" name="choices" v-model="item.no_of_choices">
              <label for="instructions">Instructions:</label>
              <input type="checkbox" name="instructions" v-model="item.instructions" true-value=1 false-value=0>
              <button v-on:click="updateItem(item)" class="btn-sm btn-primary">Update Item</button>
            <button v-on:click="deleteItem(item.id)" class="btn-sm btn-danger" >Delete Item</button>
            </form> 
            <choice-component v-bind:item_id="item.id" 
            v-bind:choices="item.choices" 
            v-bind:url="url"
            v-on:update="update"/>
            <option-component v-bind:item_id="item.id" 
            v-bind:options="item.options" 
            v-bind:url="url"
            v-on:update="update"/>  
          </span>                     
          </div>  
    
  </div> 
</template>

<script>
import selection_component from './SelectionComponent.vue'
import choice_component from './ChoiceComponent.vue'
import option_component from './OptionComponent.vue'

export default {
  components: {
    'choice-component': choice_component,
    'selection-component': selection_component,
    'option-component': option_component,
    },    
    props: ['items', 'category_id', 'showItems', 'url'], 
  data () {
    return {
      showForm: false,
      newItem: {
        id: '',
        category_id: '',
        es_name:'',
        en_name:'',
        es_description:'',
        en_description:'',
        price: '',
        no_of_choices:0,
        instructions: false,        
        sort_order:0,        
      },
    }
  },
  methods: {
    updateItem: async function(item) {
      try {
        console.log('update');
        let resp = await fetch(this.url+"/item/"+item.id, 
        {
          "method": "PUT",
            body: JSON.stringify({
              "en_name": item.en_name,
              "es_name": item.es_name,
              "en_description": item.en_description,
              "es_description": item.es_description,
              "sort_order": item.sort_order,
              "no_of_choices": item.no_of_choices,
              "price": item.price,
              "instructions": item.instructions,
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
    deleteItem: async function(id) {
      try {
        let resp = await fetch(this.url+"/item/"+id, 
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
    addItem: async function() {
      try {
        let resp = await fetch(this.url+"/item/", 
        {
          "method": "POST",
            body: JSON.stringify({
              "category_id": this.category_id,
              "en_name":this.newItem.en_name,
              "es_name":this.newItem.es_name,
              "en_description":this.newItem.en_description,
              "es_description":this.newItem.es_description,
              "price":this.newItem.price,
              "no_of_choices":this.newItem.no_of_choices,
              "instructions":this.newItem.instructions,
              "sort_order":this.newItem.sort_order,
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.newItem.en_name = '';
          this.newItem.es_name = '';
          this.newItem.sort_order = 0;
          this.newItem.en_description='';
          this.newItem.es_description='';
          this.newItem.price = '';
          this.newItem.instructions = false;
          this.newItem.no_of_choices=0;
          this.showForm = !this.showForm;
          this.$emit('update');
        }
      } catch(err) {
        console.log(err);
      }
    },
    update() {
      this.$emit('update');
    },
    updateShowForm(){
      this.showForm = !this.showForm;
    },
  },
  created() {

  },
}
</script>
<style lang="scss" scoped>
  .item {
    background-color:rgb(207, 235, 235);
  } 
</style>