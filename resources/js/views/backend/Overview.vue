<template>
    <div id="overview">
        <v-container fluid>
            <v-row>
                <v-col cols="4">
                <v-sheet class="bg-blue-lighten-1  py-5 pl-2 rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Total Products</div>
                    <span class="text-h4">{{ overviewsOfData.products }}</span>
                </v-sheet>
                </v-col>
                <v-col cols="4">
                <v-sheet class="bg-deep-purple-accent-1  py-5 pl-2 bl-2-red rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">The Brands with us</div>
                    <span class="text-h4">{{ overviewsOfData.brands }}</span>
                </v-sheet>
                </v-col>
                <v-col cols="4">
                <v-sheet class="bg-teal py-5 pl-2 bl-2-red rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Total Categories</div>
                    <span class="text-h4">{{ overviewsOfData.categories }}</span>
                </v-sheet>
                </v-col>
                <v-col cols="4">
                <v-sheet class="bg-grey py-5 pl-2 bl-2-red rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Stocks of Item</div>
                    <span class="text-h4">{{ overviewsOfData.stocks }}</span>
                </v-sheet>
                </v-col>
                <v-col cols="4"> 
                <v-sheet class="bg-grey-lighten-3 py-5 pl-2 bl-2-red rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Available Size</div>
                    <span class="text-h4">{{ overviewsOfData.sizes }}</span>
                </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
const overviewsOfData = ref([])   
// 
function getAnOverviewTotalApplication(){
    axios.get('overview')
        .then(response => {
            console.log(response);
            overviewsOfData.value = response.data?.overviews
        } )
        .catch(error => {
            console.error(error);
    });
}

onMounted(()=>{
    getAnOverviewTotalApplication()
})
</script>

<style scoped>

</style>