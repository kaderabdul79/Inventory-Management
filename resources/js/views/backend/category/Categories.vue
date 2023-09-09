<template>
    <div id="categories">  
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between">
                        <h2 class="">List of Categories</h2>
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
                        v-for="category in categories"
                        :key="category.id"
                    >
                    
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.is_active === 1 ? 'active' : 'inactive' }}</td>
                        <td>
                        <v-btn color="red-darken-1">Delete</v-btn>
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
const categories = ref([])         

    function getAllCategories(){
        axios.get('categories/')
        .then(response => {
            // console.log(response.data.categories);
            categories.value = response.data?.categories
        } )
        .catch(error => {
            console.error(error);
        });
    }
    onMounted(()=>{
        getAllCategories()
    })
</script>

<style scoped>

</style>