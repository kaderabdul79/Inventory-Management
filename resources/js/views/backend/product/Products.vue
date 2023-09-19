<template>
    <div id="products">  
        <v-container fluid>
            <v-row>
                <!-- {{ filteredProducts }}{{ searchQuery }} -->
                 <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between px-6 py-2">
                        <v-row>
                            <v-col><h2 class="">List of Products</h2></v-col>
                            <v-col><v-text-field v-model="searchQuery" @input="searchProducts" label="Search Product" prepend-inner-icon="mdi-magnify"></v-text-field></v-col>
                            <v-col class="text-end"><v-btn :to="{name: 'createProduct'}" color="primary">Add New</v-btn></v-col>
                        <div></div>
                        </v-row>
                    </v-sheet>
                    <v-table
                    fixed-header
                    height="500px"
                >
                    <thead class="">
                    <tr>
                        <th class="text-center">
                            Id
                        </th>
                        <th class="text-center">
                            Name
                        </th>
                        <th class="text-center">
                            Price
                        </th>
                        <th class="text-center">
                            quantity_in_stock
                        </th>
                        <th class="text-center">
                            Category
                        </th>
                        <th class="text-center">
                            Size
                        </th>
                        <th class="text-center">
                            Brand
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr
                        v-for="product in products"
                        :key="product.id"
                    > 
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>                        
                        <td :class="{ 'text-red': product.quantity_in_stock < 50 }">{{ product.quantity_in_stock }}</td>  
                        <td :class="{ 'text-green': product.category.is_active, 'text-red': !product.category.is_active }">{{ product.category.name }}</td>  
                        <td :class="{ 'text-green': product.size.is_active, 'text-red': !product.size.is_active }">{{ product.size.name }}</td>  
                        <td :class="{ 'text-green': product.brand.is_active, 'text-red': !product.brand.is_active }">{{ product.brand.name }}</td>  
                        <td>
                            <v-btn :to="{name: 'viewProduct',params: {id: product.id}}" class="mr-3"  color="success">View</v-btn>
                            <v-btn :to="{name: 'editProduct',params: {id: product.id}}" class="mr-3" color="warning">Edit</v-btn>
                            <v-btn @click="deleteProduct(product.id)" color="danger">Delete</v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
                </v-col>
            </v-row>
                    <!-- pagination -->
                    <v-sheet class="w-100 mt-2 d-flex justify-space-between">
                        <div class="d-block"></div>
                        <TailwindPagination class="d-inline-block"
                        :data="product"
                        @pagination-change-page="getAllProducts"
                        />
                    </v-sheet>
                    <!--  -->
        </v-container>
    </div>
</template>

<script setup>
import { ref,onMounted,computed } from 'vue';
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
import { useNotification } from "@kyvg/vue3-notification";
import { TailwindPagination } from 'laravel-vue-pagination';
// 
const searchQuery = ref("")
const filteredProducts = ref([])
const notification = useNotification()
const products = ref([])     

const product = ref({})        
const totalPages = ref(1)  
const perPage = ref(8) 
// its must need to fixed
function searchProducts() {
            axios.get(`products/search?query=${searchQuery.value}`)
                .then(response => {
                    console.log(response);
                    // filteredProducts.value = response.data?.products;
                })
                .catch(error => {
                    console.error(error);
                });
}

function getAllProducts (page = 1) {
  axios.get(`products?page=${page}&perPage=${perPage.value}`)
        .then(response => {
            // console.log(response.data);
            products.value = response.data?.products?.data
            product.value = response.data?.products
            totalPages.value =response.data?.products?.last_page;
        } )
        .catch(error => {
            console.error(error);
        });
    } 
    onMounted(()=>{
        getAllProducts()
    })

// delete a Product
    function deleteProduct(id){
        axios.delete('products/'+id)
        .then(response => {
            // notification.notify({title: "Product Deleted",});
            getAllProducts()
            console.log(response);
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>
<style scoped>
nav.d-inline-block button svg {
    display: none;
}
</style>