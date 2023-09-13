<template>
<v-container fluid>
    <v-row>
        <v-col>
            <v-data-table
            :headers="headers"
            :items="products"
            :sort-by="[{ key: 'calories', order: 'asc' }]"
            >
            <template v-slot:top>
                <v-toolbar
                flat
                >
                <v-toolbar-title>Product's List</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog
                    v-model="dialog"
                    max-width="500px"
                >
                    <template v-slot:activator="{ props }">
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-bind="props"
                    >
                        New Item
                    </v-btn>
                    </template>
                    <v-card>
                    <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                    </v-card-title>
        
                    <v-card-text>
                        <v-container>
                        <v-row>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                                v-model="editedItem.name"
                                label="Dessert name"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                                v-model="editedItem.calories"
                                label="Calories"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                                v-model="editedItem.fat"
                                label="Fat (g)"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                                v-model="editedItem.carbs"
                                label="Carbs (g)"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                            md="4"
                            >
                            <v-text-field
                                v-model="editedItem.protein"
                                label="Protein (g)"
                            ></v-text-field>
                            </v-col>
                        </v-row>
                        </v-container>
                    </v-card-text>
        
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="close"
                        >
                        Cancel
                        </v-btn>
                        <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="save"
                        >
                        Save
                        </v-btn>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                    <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">OK</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                size="small"
                class="me-2"
                @click="editItem(item)"
                >
                mdi-pencil
                </v-icon>
                <v-icon
                size="small"
                @click="deleteItem(item)"
                >
                mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn
                color="primary"
                @click="getAllProducts()"
                >
                Reset
                </v-btn>
            </template>
            </v-data-table>
            </v-col>
        </v-row>
    </v-container> 
</template>
  
  <script setup>
    import { computed, nextTick, ref, watch, onMounted } from 'vue'
    import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
    const dialog = ref(false)
    const dialogDelete = ref(false)
    const headers = ref([
      { title: 'Name',key: 'name', sortable: false },
      { title: 'Category', key: 'category.name' },
      { title: 'Description', key: 'description' , sortable: false },
      { title: 'Price', key: 'price' },
      { title: 'Size', key: 'size.name' },
      { title: 'quantity_in_stock', key: 'quantity_in_stock' },
      { title: 'Actions', key: 'actions', sortable: false },
    ])
    const products = ref([])
    const editedIndex = ref(-1)
    const editedItem = ref({
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    })
    const defaultItem = ref({
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    })
    const formTitle = computed(() => {
      return editedIndex.value === -1 ? 'New Item' : 'Edit Item'
    })
    // 
    function getAllProducts(){
        axios.get('products/')
        .then(response => {
            console.log(response.data);
            products.value = response.data?.products
        } )
        .catch(error => {
            console.error(error);
        });
    }
    onMounted(()=>{
        getAllProducts()
    })
    function editItem (item) {
      editedIndex.value = products.value.indexOf(item)
      editedItem.value = Object.assign({}, item)
      dialog.value = true
    }
    function deleteItem (item) {
      editedIndex.value = products.value.indexOf(item)
      editedItem.value = Object.assign({}, item)
      dialogDelete.value = true
    }
    function deleteItemConfirm () {
      products.value.splice(editedIndex.value, 1)
      closeDelete()
    }
    function close () {
      dialog.value = false
      nextTick(() => {
        editedItem.value = Object.assign({}, defaultItem.value)
        editedIndex.value = -1
      })
    }
    function closeDelete () {
      dialogDelete.value = false
      nextTick(() => {
        editedItem.value = Object.assign({}, defaultItem.value)
        editedIndex.value = -1
      })
    }
    function save () {
      if (editedIndex.value > -1) {
        Object.assign(products.value[editedIndex.value], editedItem.value)
      } else {
        products.value.push(editedItem.value)
      }
      close()
    }
    watch(dialog, val => {
      val || close()
    })
    watch(dialogDelete, val => {
      val || closeDelete()
    })
  </script>
  
