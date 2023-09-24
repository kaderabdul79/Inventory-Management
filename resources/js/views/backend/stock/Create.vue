<template>
    <div id="createstock">
        <v-container fluid>
            <!-- {{ stockData }} -->
            <v-row>
                <v-col cols="6" xs="12" offset="3">
                    <v-sheet class="px-4 py-2">
                        <v-sheet class="text-h4 py-2 text-center">Add Stock</v-sheet>
                        <v-form @submit.prevent="addNewStock">
                            Select Product
                            <select id="brandDropdown" v-model="stockData.product_id">
                                <option v-for="product in products" :key="product.id" :value="product.id">
                                    {{ product.name }}
                                <p>Size: {{ product.size.name }}</p>
                                </option>
                            </select>
                            <div class="text-subtitle-2 text-red" v-if="stockData.errors.has('product_id')" v-html="stockData.errors.get('product_id')" />
                            <!-- quantity -->
                            <v-text-field v-model="stockData.quantity" label="Quantity" variant="outlined"></v-text-field> 
                            <div class="text-subtitle-2 text-red" v-if="stockData.errors.has('quantity')" v-html="stockData.errors.get('quantity')" />
                            <!-- location -->
                            <v-text-field v-model="stockData.location" label="Location" variant="outlined"></v-text-field> 
                            <div class="text-subtitle-2 text-red" v-if="stockData.errors.has('location')" v-html="stockData.errors.get('location')" />
                            <v-btn type="submit" :disabled="stockData.busy" color="success" block>Submit</v-btn>
                        </v-form>
                        <v-sheet>
                        </v-sheet>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import Form from 'vform'
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router'  
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
import { useNotification } from "@kyvg/vue3-notification";
const notification = useNotification()
const router = useRouter()
const stockData = ref(new Form(
    {
        product_id: null,
        size_id: 2,
        quantity: null,
        location: '',
    }
));
// get all sizes
const sizes = ref([])         

    function getAllSizes(){
        axios.get('sizes/')
        .then(response => {
            // console.log(response.data.sizes);
            sizes.value = response.data?.sizes
            // console.log(sizes.value);
        } )
        .catch(error => {
            console.error(error);
    });
 }
 function getSizeName(sizeId){
    const size = sizes.value.find(size => size.id === sizeId);
    return size ? size.name : 'Size not found';
 }
// 
const products = ref([])
function getAllProducts (page = 1) {

  axios.get('products')
        .then(response => {
            // console.log(response.data.products);
            products.value = response.data?.products?.data
        } )
        .catch(error => {
            console.error(error);
        });
    } 

// 
function addNewStock() {
    axios.post('stocks/', {
        product_id: stockData.value.product_id,
        size_id: stockData.value.size_id,
        quantity: stockData.value.quantity,
        location: stockData.value.location,
    })
        .then(response => {
            notification.notify({title: "The Produt has been stocked🎉",});
            // setTimeout(()=>{
            //     router.push({name: "stocks"})
            // },2000)
            console.log(response.data);
        })
        .catch(error => {
            stockData.value.errors.errors = error.response.data.errors;
            console.error(error);
        });
}
onMounted(()=>{
   getAllSizes()
   getAllProducts()
})
</script>

<style scoped>
#brandDropdown {
  appearance: none;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  cursor: pointer;
  width: 100%;
}
#brandDropdown::after {
  content: '';
  position: absolute;
  top: 50%;
  right: 10px;
  transstockData: translateY(-50%);
  pointer-events: none;
}
#brandDropdown option:checked {
  background-color: #ddd;
}
</style>