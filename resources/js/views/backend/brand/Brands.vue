<template>
    <div id="brands">  
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between">
                        <h2 class="">List of Brands</h2>
                        <div><v-btn :to="{name: 'createBrand'}" color="primary" class="">Add New</v-btn></div>
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
                            Active
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr
                        v-for="brand in brands"
                        :key="brand.id"
                    > 
                        <td>{{ brand.id }}</td>
                        <td>{{ brand.name }}</td>
                        <td>{{ brand.is_active === 1 ? 'active' : 'inactive' }}</td>
                        <td>
                            <v-btn :to="{name: 'editBrand',params: {id: brand.id}}" class="mr-3" color="success">Edit</v-btn>
                            <v-btn @click="deleteBrand(brand.id)" color="red-darken-1">Delete</v-btn>
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
const brands = ref([])         

    function getAllBrands(){
        axios.get('brands')
        .then(response => {
            // console.log(response);
            brands.value = response.data?.brands
        } )
        .catch(error => {
            console.error(error);
        });
    }
    onMounted(()=>{
        getAllBrands()
    })
// delete a brand
    function deleteBrand(id){
        axios.delete('brands/'+id)
        .then(response => {
            notification.notify({title: "brand deleted",});
            getAllBrands()
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>

<style scoped>

</style>