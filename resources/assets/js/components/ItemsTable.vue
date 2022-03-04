<template>
    <div>
        <!-- <form @submit.prevent="createItem"> -->
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data</span>
                </div>
                <input v-model="newItemName" type="text" class="form-control" placeholder="Item Name" />
                <input v-model="newItemPrice" type="number" class="form-control" placeholder="Price" />
                <input v-model="newItemLocation" type="number" class="form-control" placeholder="Location" />
                <input v-model="newItemCategory" type="number" class="form-control" placeholder="Category" />
                <div class="input-group-append">
                    <button v-if="!editItemId" class="btn btn-primary" @click="createItem()">Create</button>
                    <button v-else class="btn btn-info btn-sm" @click="updateItem()">Update</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-danger float-right" @click="resetItem()">Reset</button>
        <!-- </form> -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Location</th>
                <th>Category</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in Items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.price }}</td>
                    <td align="center">{{ row.location_id }}</td>
                    <td align="center">{{ row.category_id }}</td>
                    <td align="center">
                        <button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button>
                        <button class="btn btn-info btn-sm" @click="editItem(row.id, row.name, row.price, row.location_id, row.category_id)"><i class="fa fa-pencil-square-o" /> Edit</button>
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
            Items: [],
            newItemName: '',
            newItemPrice: '',
            newItemLocation: '',
            newItemCategory: '',
            editItemId : '',
            editIndex: '',
            timestamp: ''
        };
    },
    mounted() {
        this.getItems();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.Items = response.data;
                }).catch(console.error);
        },
        createItem() {
            return axios.post('/api/items', {name: this.newItemName, category: this.newItemCategory, location: this.newItemLocation, price: this.newItemPrice})
                .then(this.getItems)
                .then(() => this.newItemName = '', this.newItemPrice = '', this.newItemLocation = '', this.newItemCategory = '')
                .catch(console.error);
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        },
        editItem(id, name, price, location, category){
            if(id){
                this.newItemName = name;
                this.editItemId = id;
                this.editIndex = id;
                this.newItemPrice = price;
                this.newItemLocation = location;
                this.newItemCategory = category;
            }
        },
        updateItem(){
            this.getNow()
            console.log(this.timestamp)
            const data = {
                updated_at: this.timestamp,
                name: this.newItemName,
                price: this.newItemPrice,
                location_id: this.newItemLocation,
                category_id: this.newItemCategory
            }
            console.log("id:", this.editItemId);
            console.log("name:", this.newItemName);
            console.log("price:", this.newItemPrice);
            console.log("location:", this.newItemLocation);
            console.log("category:", this.newItemCategory);
            console.log("data: ", data)
            return axios.put('api/items/' + this.editItemId, data)
                 .then(this.getItems)
                 .catch(console.error);
        },
        resetItem(){
            this.newItemName = '';
            this.editIndex = '';
            this.editItemId = '';
            this.timestamp = '';
            this.newItemPrice = '';
            this.newItemLocation = '';
            this.newItemCategory = '';
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