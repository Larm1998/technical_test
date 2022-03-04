<template>
    <div>
        <!-- <form @submit.prevent="createCategory"> -->
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newCategoryName" type="text" class="form-control" placeholder="Category Name" />
                <div class="input-group-append">
                    <button v-if="!editCategoryId" class="btn btn-primary" @click="createCategory()">Create</button>
                    <button v-else class="btn btn-info btn-sm" @click="updateCategory()">Update</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-danger float-right" @click="resetCategory()">Reset</button>
        <!-- </form> -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td align="center">
                        <button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(row.id)"><i class="fa fa-times" /> Delete</button>
                        <button class="btn btn-info btn-sm" @click="editCategory(row.id, row.name)"><i class="fa fa-pencil-square-o" /> Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            newCategoryName: '',
            editCategoryId : '',
            editIndex: '',
            timestamp: ''
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);
        },
        createCategory() {
            return axios.post('/api/categories', {name: this.newCategoryName})
                .then(this.getCategories)
                .then(() => this.newCategoryName = '')
                .catch(console.error);
        },
        deleteCategory(id) {
            return axios.post('/api/categories/' + id, {_method: 'DELETE'})
                .then(this.getCategories)
                .catch(console.error);
        },
        editCategory(id, name){
            if(id){
                this.newCategoryName = name;
                this.editCategoryId = id;
                this.editIndex = id
            }
        },
        updateCategory(){
            this.getNow()
            console.log(this.timestamp)
            const data = {
                updated_at: this.timestamp,
                name: this.newCategoryName
            }
            console.log("id:", this.editCategoryId);
            console.log("name:", this.newCategoryName);
            console.log("data: ", data)
            return axios.put('api/categories/' + this.editCategoryId, data)
                 .then(this.getCategories)
                 .catch(console.error);
        },
        resetCategory(){
            this.newCategoryName = '';
            this.editIndex = '';
            this.editCategoryId = '';
            this.timestamp = '';
        },
        getNow(){
            const today = new Date();
            const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            const dateTime = date +' '+ time;
            this.timestamp = dateTime;
        }

    }
}
</script>

<style>
.create-location-form {
    margin-bottom: 10px;
}
</style>