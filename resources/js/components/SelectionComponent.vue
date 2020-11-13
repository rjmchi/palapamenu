<template>
  <div class="selection">
    <p>Selections</p>
    <form @submit.prevent="addSelection">
      <label for="en_name">English Name:</label>
      <input type="text" name="en_name" v-model="newSelection.en_name">
      <label for="es_name">Spanish Name:</label>
      <input type="text" name="es_name" v-model="newSelection.es_name">
      <button type="submit" class="btn-sm btn-primary">New Selection</button>
    </form>
    <span v-for="selection in selections" v-bind:key=selection.id>
      <form @submit.prevent>
        <label for="en_name">English Name:</label>
        <input type="text" name="en_name" v-model="selection.en_name">          
        <label for="es_name">Spanish Name:</label>
        <input type="text" name="es_name" v-model="selection.es_name">          
        <button v-on:click="updateSelection(selection)" class="btn-sm btn-primary">Update Selection</button>
        <button v-on:click="deleteSelection(selection.id)" class="btn-sm btn-danger" >Delete Selection</button>
      </form>      
    </span>
  </div> 
</template>

<script>

export default {
    props: ['selections', 'item_id'],
  data () {
    return {
      newSelection: {
        id: '',
        item_id: '',
        es_name:'',
        en_name:'',
      },  
    }
  },
  methods: {
    updateSelection: async function(selection) {
      try {
        console.log('update');
        let resp = await fetch(this.url+"/selection/"+selection.id, 
        {
          "method": "PUT",
            body: JSON.stringify({
              "en_name": selection.en_name,
              "es_name": selection.es_name,
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
    deleteSelection: async function(id) {
      try {
        let resp = await fetch(this.url+"/selection/"+id, 
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
    addSelection: async function() {
      try {
        let resp = await fetch(this.url+"/selection/", 
        {
          "method": "POST",
            body: JSON.stringify({
              "item_id":this.item_id,
              "en_name":this.newSelection.en_name,
              "es_name":this.newSelection.es_name,
            }),
            headers: {
              "Content-type": "application/json"
            }
        });
        if (resp.ok) {
          resp = await resp.json();
          console.log(resp);
          this.newSelection.en_name = '';
          this.newSelection.es_name = '';
          this.$emit('update');
        }
      } catch(err) {
        console.log(err);
      }
    },
    update() {
      this.$emit('update');
    },  },
  created() {

  },
}
</script>
<style lang="scss" scoped>
  .selection {
    background-color:#ccc;
  } 
</style>