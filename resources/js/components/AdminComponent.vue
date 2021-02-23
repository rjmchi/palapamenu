<template>
    <div>
        <div class="menu">
            <button v-on:click="addMenu" class="btn-sm btn-primary">
                Add Menu
            </button>
            <input
                type="text"
                name="es_name"
                v-model="newMenu.es_name"
                placeholder="Spanish Name"
            />
            <input
                type="text"
                name="en_name"
                v-model="newMenu.en_name"
                placeholder="English Name"
            />
            <input type="text" name="sort_order" v-model="newMenu.sort_order" />

            <span v-for="menu in menus" v-bind:key="menu.id">
                <form @submit.prevent>
                    <label for="en_name">English Name:</label>
                    <input type="text" name="en_name" v-model="menu.en_name" />
                    <label for="es_name">Spanish Name:</label>
                    <input type="text" name="es_name" v-model="menu.es_name" />
                    <label for="sort_order">Sort Order: </label>
                    <input
                        type="text"
                        name="sort_order"
                        v-model="menu.sort_order"
                    />
                    <button
                        v-on:click="updateMenu(menu)"
                        class="btn-sm btn-primary"
                    >
                        Update Menu
                    </button>
                    <button
                        v-on:click="deleteMenu(menu.id)"
                        class="btn-sm btn-danger"
                    >
                        Delete Menu
                    </button>
                    <category-component
                        v-bind:menu_id="menu.id"
                        v-bind:categories="menu.categories"
                        v-bind:url="url"
                        v-on:update="update"
                    />
                </form>
            </span>
        </div>
    </div>
</template>

<script>
import category_component from "./CategoryComponent.vue";

export default {
    components: {
        "category-component": category_component
    },
    data() {
        return {
            menus: [],
            newMenu: {
                id: "",
                es_name: "",
                en_name: "",
                sort_order: 0
            },
            // url: "http://www.lospalmarespalapa.com/api",
            url: "/api",
        };
    },
    methods: {
        showCategory() {
            this.showCategories = !this.showCategories;
            console.log("show");
        },
        updateMenu: async function(menu) {
            try {
                console.log("update");
                let resp = await fetch(
                    this.url+"/menu/" + menu.id,
                    {
                        method: "PUT",
                        body: JSON.stringify({
                            en_name: menu.en_name,
                            es_name: menu.es_name,
                            sort_order: menu.sort_order
                        }),
                        headers: {
                            "Content-type": "application/json"
                        }
                    }
                );
                if (resp.ok) {
                    resp = await resp.json();
                    console.log(resp);
                    this.fetchMenus();
                }
            } catch (err) {
                console.log(err);
            }
        },
        deleteMenu: async function(id) {
            try {
                let resp = await fetch(this.url+"/menu/"  + id, {
                    method: "DELETE"
                });
                if (resp.ok) {
                    resp = await resp.json();
                    this.fetchMenus();
                }
            } catch (err) {
                console.log(err);
            }
        },
        addMenu: async function() {
            try {
                let resp = await fetch(this.url+"/menu/" , {
                    method: "POST",
                    body: JSON.stringify({
                        en_name: this.newMenu.en_name,
                        es_name: this.newMenu.es_name,
                        sort_order: this.newMenu.sort_order
                    }),
                    headers: {
                        "Content-type": "application/json"
                    }
                });
                if (resp.ok) {
                    resp = await resp.json();
                    console.log(resp);
                    this.newMenu.en_name = "";
                    this.newMenu.es_name = "";
                    this.newMenu.sort_order = 0;
                    this.fetchMenus();
                }
            } catch (err) {
                console.log(err);
            }
        },
        fetchMenus: async function() {
            try {
                let resp = await fetch(this.url+"/menu/" , { method: "GET" });
                console.log(resp.status);
                if (resp.ok) {
                    resp = await resp.json();
                    this.menus = resp.data;
                }
            } catch (err) {
                console.log(err);
            }
        },
        update() {
            this.fetchMenus();
        }
    },
    created() {
        this.fetchMenus();
    }
};
</script>

<style lang="scss" scoped>
.menu {
    border: 1px solid rgb(83, 80, 83);
    background-color: rgb(241, 241, 220);
}
</style>
