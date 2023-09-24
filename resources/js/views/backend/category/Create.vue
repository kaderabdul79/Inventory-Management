<template>
    <div id="createcategory">
        <v-container fluid>
            <!-- {{ form }} -->
            <v-row>
                <v-col cols="6" xs="12" offset="3">
                    <v-sheet class="px-4 py-2">
                        <v-sheet class="text-h4 py-2 text-center">Add Category</v-sheet>
                        <v-form @submit.prevent="addNewCategory">
                            <v-text-field v-model="form.name" label="Name" variant="outlined"></v-text-field>
                            <div class="text-subtitle-2 text-red" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                            <v-radio-group v-model="form.is_active" inline>
                                <v-radio label="Inactive" :value="0"></v-radio>
                                <v-radio label="Active" :value="1"></v-radio>
                            </v-radio-group>
                            <div class="text-subtitle-2 text-red" v-if="form.errors.has('is_active')" v-html="form.errors.get('is_active')" />
                            <v-btn type="submit" :disabled="form.busy" color="success" block>Submit</v-btn>
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
const form = ref(new Form(
    {
        name: '',
        is_active: 0,
    }
));

function addNewCategory() {
    axios.post('categories/', {
        name: form.value.name,
        is_active: form.value.is_active
    })
        .then(response => {
            notification.notify({title: "Category Created 🎉",});
            setTimeout(()=>{
                router.push({name: "categories"})
            },2000)
            console.log(response.data);
        })
        .catch(error => {
            form.value.errors.errors = error.response.data.errors;
            console.error(error);
        });
}
</script>

<style scoped></style>