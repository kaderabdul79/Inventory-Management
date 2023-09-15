<template>
    <div id="createproduct">
        <v-container fluid>{{ product }}
            <v-row>
                <v-col cols="6" xs="12" offset="3">
                    <v-sheet>
                        <v-sheet class="text-h4 py-2 text-center">Add Product</v-sheet>
                        <v-form @submit.prevent="addNewProduct">
                            <v-text-field v-model="product.name" label="Name" variant="outlined"></v-text-field>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('name')" v-html="product.errors.get('name')" />
                            <!--  -->
                            <v-text-field v-model="product.price" label="Price" variant="outlined"></v-text-field>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('price')" v-html="product.errors.get('price')" />
                            <!--  -->
                            <v-text-field v-model="product.description" label="Description" variant="outlined"></v-text-field>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('description')" v-html="product.errors.get('description')" />
                            <!--  -->
                            <v-text-field v-model="product.quantity_in_stock" label="quantity_in_stock" type="number" variant="outlined"></v-text-field>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('quantity_in_stock')" v-html="product.errors.get('quantity_in_stock')" />
                            <!--  -->
                            Select a brand
                            <select id="brandDropdown" v-model="product.brand_id">
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                                    {{ brand.name }}
                                </option>
                            </select>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('brand_id')" v-html="product.errors.get('brand_id')" />
                            <!--  -->
                            Select a size
                            <select id="brandDropdown" v-model="product.size_id">
                                <option v-for="size in sizes" :key="size.id" :value="size.id">
                                    {{ size.name }}
                                </option>
                            </select>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('size_id')" v-html="product.errors.get('size_id')" />
                            <!--  -->
                            Select a category
                            <select id="brandDropdown" v-model="product.category_id">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <div class="text-subtitle-2 text-red" v-if="product.errors.has('category_id')" v-html="product.errors.get('category_id')" />
                            <!--  -->
                            <v-btn type="submit" :disabled="product.busy" color="success" block>Submit</v-btn>
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
const selectedBrandId = ref(null);

const product = ref(new Form(
    {
        name: '',
        description: "",
        price: null,
        quantity_in_stock: null,
        category_id: null,
        size_id: null,
        brand_id: null,
    }
));
// brands
const brands = ref([])          
    function getAllBrands(){
        axios.get('active-brands')
        .then(response => {
            // console.log(response);
            brands.value = response.data?.brand
        } )
        .catch(error => {
            console.error(error);
        });
    }
// category
const categories = ref([])    
function getAllCategories(){
        axios.get('active-categories')
        .then(response => {
            console.log(response.data.category);
            categories.value = response.data?.category
        } )
        .catch(error => {
            console.error(error);
        });
    }
// sizes
const sizes = ref([])         

    function getAllSizes(){
        axios.get('active-sizes/')
        .then(response => {
            // console.log(response.data.sizes);
            sizes.value = response.data?.size
        } )
        .catch(error => {
            console.error(error);
        });
    }
// 
function addNewProduct() {
    axios.post('products/',     {
      name: product.value.name,
      description: product.value.description,
      price: product.value.price,
      size: product.value.size,
      quantity_in_stock: product.value.quantity_in_stock,
      category_id: product.value.category_id,
      size_id: product.value.size_id,
      brand_id: product.value.brand_id
    })
        .then(response => {
            notification.notify({title: "Product has been added Inventory 🎉",});
            setTimeout(()=>{
                router.push({name: "products"})
            },2000)
            console.log(response.data);
        })
        .catch(error => {
            product.value.errors.errors = error.response.data.errors;
            console.error(error);
        });
}
onMounted(()=>{
        getAllBrands()
        getAllCategories()
        getAllSizes()
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
  transform: translateY(-50%);
  pointer-events: none;
}
#brandDropdown option:checked {
  background-color: #ddd;
}

</style>