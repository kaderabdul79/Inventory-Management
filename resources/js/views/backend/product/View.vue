<template>
    <div class="viewproduct">{{ form }}
        <v-container fluid>
            <v-row>{{ product }}
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between">
                        <h2 class="">Product Detail's</h2>
                        <div><v-btn :to="{name: 'products'}" color="primary" class="">Back to Product's</v-btn></div>
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
                            Description
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
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr
                        v-if="product"
                    > 
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}</td>                        
                        <td>{{ product.quantity_in_stock }}</td>  
                        <td>{{ product.category?.name }}</td>  
                        <td>{{ product.size?.name }}</td>  
                        <td>{{ product.brand?.name }}</td>
                    </tr>
                    </tbody>
                </v-table>
                </v-col>
            </v-row>
        </v-container>  
    </div>
</template>

<script setup>
import {ref,onMounted} from 'vue'
const props = defineProps(['id']);
import {useRouter} from 'vue-router'
const router = useRouter()
import axios from 'axios'
const product = ref({})
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
       
    function getProduct(){
        axios.get('products/'+props.id)
        .then(response => {
            product.value = response.data.product
            console.log(response.data.product);
        } )
        .catch(error => {
            console.log(error);
        });
    }
    onMounted(()=>{
        getProduct()
    })

</script>

<style scoped>

</style>