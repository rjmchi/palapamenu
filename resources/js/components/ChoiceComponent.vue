<template>
  <div class="choice">
    <h3 v-on:click="updateShowForm">Choices</h3>
      <form @submit.prevent="addChoice" v-show="showForm">
        <label for="en_name">English Name:</label>
          <input type="text" name="en_name" v-model="newChoice.en_name">
          <label for="es_name">Spanish Name:</label>
          <input type="text" name="es_name" v-model="newChoice.es_name">
          <label for="sort_order">Sort Order:</label>
          <input type="text" name="sort_order" v-model="newChoice.sort_order">
          <label for="instructions">Instructions</label>
          <input type="checkbox" name="instructions" v-model="newChoice.instructions">
          <button type="submit" class="btn-sm btn-primary">New Choice</button>
        </form>
    <span v-for="choice in choices" v-bind:key=choice.id>
      <form @submit.prevent>
        <label for="en_name">English Name:</label>
        <input type="text" name="en_name" v-model="choice.en_name">          
        <label for="es_name">Spanish Name:</label>
        <input type="text" name="es_name" v-model="choice.es_name">          
        <label for="sort_order">Sort Order:</label>
        <input type="text" name="sort_order" v-model="choice.sort_order">
        <label for="instructions">Instructions</label>
        <input type="checkbox" name="instructions:" v-model="choice.instructions"  true-value=1 false-value=0>
        <button v-on:click="updateChoice(choice)" class="btn-sm btn-primary">Update Choice</button>
        <button v-on:click="deleteOption(choice.id)" class="btn-sm btn-danger" >Delete Option</button>
      </form>     
    </span>
  </div> 
</template>

<script>

export default {
    props: ['choices', 'item_id'],
  data () {
    return {
      showForm:false,
      newChoice: {
        id: '',
        item_id: '',
        es_name:'',
        en_name:'',
        instructions: '',
        sort_order:0,        
      },
    }
  },
  methods: {
    updateChoice: async function(choice) {
      try {
        console.log('update');
        let resp = await fetch('http://localhost:8000/api/choice/'+choice.id, 
        {
          "method": "PUT",
            body: JSON.stringify({
              "en_name": choice.en_name,
              "es_name": choice.es_name,
              "sort_order": choice.sort_order,
              "price": choice.price,
              "instructions": choice.instructions,
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
    delete: async function(id) {
      try {
        let resp = await fetch('http://localhost:8000/api/choice/'+id, 
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
    addChoice: async function() {
      try {
        let resp = await fetch('http://localhost:8000/api/choice', 
        {
          "method": "POST",
            body: JSON.stringify({
              "item_id": this.item_id,
              "en_name":this.newChoice.en_name,
              "es_name":this.newChoice.es_name,
              "sort_order":this.newChoice.sort_order,
              "price":this.newChoice.price,
              "instructions":this.newChoice.instructions,
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.newChoice.en_name = '';
          this.newChoice.es_name = '';
          this.newChoice.sort_order = 0;
          this.newChoice.price = 0;
          this.newChoice.instructions = false;
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
  .choice {
    background-color:rgb(233, 211, 233);
  } 
</style>