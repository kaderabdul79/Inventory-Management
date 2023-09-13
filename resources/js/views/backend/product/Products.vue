<template>
    <div id="products">  
        <v-container fluid>
            <v-row>{{ products }}
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between">
                        <h2 class="">List of Products</h2>
                        <div><v-btn :to="{name: 'createProduct'}" color="primary" class="">Add New</v-btn></div>
                    </v-sheet>
                    <v-table
                    fixed-header
                    height="600px"
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
                        <td>{{ product.quantity_in_stock }}</td>  
                        <td>{{ product.category.name }}</td>  
                        <td>{{ product.size.name }}</td>  
                        <td>{{ product.brand.name }}</td>  
                        <td>
                            <v-btn :to="{name: 'viewProduct',params: {id: product.id}}" color="success">View</v-btn>
                            <v-btn :to="{name: 'editProduct',params: {id: product.id}}" class="mr-3" color="success">Edit</v-btn>
                            <v-btn @click="deleteProduct(product.id)" color="red-darken-1">Delete</v-btn>
                        </td>
                    </tr>
                    </tbody>
                </v-table>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
import { useNotification } from "@kyvg/vue3-notification";
const notification = useNotification()
const products = ref([])         

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
// delete a Product
    function deleteProduct(id){
        axios.delete('products/'+id)
        .then(response => {
            notification.notify({title: "Product Deleted",});
            getAllProducts()
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>

<style scoped>

</style>