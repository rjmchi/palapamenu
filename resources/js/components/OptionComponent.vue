<template>
  <div class="option" >
    <h3 v-on:click="updateShowForm">Options</h3>
      <form @submit.prevent="addOption" v-show="showForm">
        <label for="en_name">English Name:</label>
          <input type="text" name="en_name" v-model="newOption.en_name">
          <label for="es_name">Spanish Name:</label>
          <input type="text" name="es_name" v-model="newOption.es_name">
          <label for="price">Price:</label>
          <input type="text" name="price" v-model="newOption.price">
          <label for="sort_order">Sort Order:</label>
          <input type="text" name="sort_order" v-model="newOption.sort_order">
          <label for="instructions">Instructions</label>
          <input type="checkbox" name="instructions" v-model="newOption.instructions">
          <button type="submit" class="btn-sm btn-primary">New Option</button>
        </form>
    <span v-for="option in options" v-bind:key=option.id>
      <form @submit.prevent>
        <label for="en_name">English Name:</label>
        <input type="text" name="en_name" v-model="option.en_name">          
        <label for="es_name">Spanish Name:</label>
        <input type="text" name="es_name" v-model="option.es_name">          
        <label for="price">Price:</label>
        <input type="text" name="price" v-model="option.price">
        <label for="sort_order">Sort Order:</label>
        <input type="text" name="sort_order" v-model="option.sort_order">
        <label for="instructions">Instructions: </label>
        <input type="checkbox" name="instructions" v-model="option.instructions"  true-value=1 false-value=0>
      <button v-on:click="updateOption(option)" class="btn-sm btn-primary">Update Option</button>
          <button v-on:click="deleteOption(option.id)" class="btn-sm btn-danger" >Delete Option</button>
      </form> 
    </span>
  </div> 
</template>

<script>

export default {
    props: ['options', 'item_id', 'showOptions'],
  data () {
    return {
      showForm: false,
      newOption: {
        id: '',
        item_id: '',
        es_name:'',
        en_name:'',
        price:'',
        instructions: false,
        sort_order:0,        
      },
    }
  },
  methods: {
    updateOption: async function(option) {
      console.log('update');
      try {
        let resp = await fetch('http://localhost:8000/api/option/'+option.id, 
        {
          "method": "PUT",
            body: JSON.stringify({
              "en_name": option.en_name,
              "es_name": option.es_name,
              "sort_order": option.sort_order,
              "price":option.price,
              "instructions":option.instructions,
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
    deleteOption: async function(id) {
      try {
        let resp = await fetch('http://localhost:8000/api/option/'+id, 
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
    addOption: async function() {
      try {
        let resp = await fetch('http://localhost:8000/api/option', 
        {
          "method": "POST",
            body: JSON.stringify({
              "item_id": this.item_id,
              "en_name":this.newOption.en_name,
              "es_name":this.newOption.es_name,
              "sort_order":this.newOption.sort_order,
              "price": this.newOption.price,
              "instructions":this.newOption.instructions,
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.newOption.en_name = '';
          this.newOption.es_name = '';
          this.newOption.sort_order = 0;
          this.newOption.price = 0;
          this.newOption.instructions=false;
          this.showForm=false;
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
  .option {
    background-color:rgb(215, 241, 223);
    padding:5px;
  } 
</style>