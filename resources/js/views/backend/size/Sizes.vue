<template>
    <div id="sizes">  
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between">
                        <h2 class="">List of sizes</h2>
                        <div><v-btn :to="{name: 'createSize'}" color="primary" class="">Add New</v-btn></div>
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
                        v-for="size in sizes"
                        :key="size.id"
                    > 
                        <td>{{ size.id }}</td>
                        <td>{{ size.name }}</td>
                        <td>{{ size.is_active === 1 ? 'active' : 'inactive' }}</td>
                        <td>
                            <v-btn :to="{name: 'editSize',params: {id: size.id}}" class="mr-3" color="success">Edit</v-btn>
                            <v-btn @click="deleteSize(size.id)" color="red-darken-1">Delete</v-btn>
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
const sizes = ref([])         

    function getAllSizes(){
        axios.get('sizes/')
        .then(response => {
            // console.log(response.data.sizes);
            sizes.value = response.data?.sizes
        } )
        .catch(error => {
            console.error(error);
        });
    }
    onMounted(()=>{
        getAllSizes()
    })
// delete a size
    function deleteSize(id){
        axios.delete('sizes/'+id)
        .then(response => {
            notification.notify({title: "size Deleted",});
            getAllSizes()
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>

<style scoped>

</style>