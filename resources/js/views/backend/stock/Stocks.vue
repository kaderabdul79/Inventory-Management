<template>
    <div id="stocks">  
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-sheet class="d-flex justify-space-between px-12 py-2">
                        <h2 class="">List of Stock Items</h2>
                        <div><v-btn :to="{name: 'createStocks'}" color="primary" class="">Add New</v-btn></div>
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
                            Product Name
                        </th>
                        <th class="text-center">
                            Quantity
                        </th>
                        <th class="text-center">
                            Location
                        </th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr
                        v-for="stock in stocks"
                        :key="stock.id"
                    > 
                        <td>{{ stock.id }}</td>
                        <td>{{ stock.product.name }}</td>
                        <td>{{ stock.quantity }}</td>
                        <td>{{ stock.location }}</td>
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
const stocks = ref([])         

    function getAllStocks(){
        axios.get('stocks')
        .then(response => {
            console.log(response.data?.stocks);
            stocks.value = response.data?.stocks
        } )
        .catch(error => {
            console.error(error);
        });
    }
    onMounted(()=>{
        getAllStocks()
    })

</script>

<style scoped>

</style>