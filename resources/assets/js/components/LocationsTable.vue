<template>
    <div>
        <!-- <form @submit.prevent="createLocation"> -->
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newLocationName" type="text" class="form-control" placeholder="Location Name" />
                <div class="input-group-append">
                    <button v-if="!editLocationId" class="btn btn-primary" @click="createLocation()">Create</button>
                    <button v-else class="btn btn-info btn-sm" @click="updateLocation()">Update</button>
                </div>
            </div>
            <button type="button" class="btn btn-sm text-danger float-right" @click="resetLocation()">Reset</button>
        <!-- </form> -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in locations" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td align="center">
                        <button class="btn btn-danger btn-sm" @click.prevent="deleteLocation(row.id)"><i class="fa fa-times" /> Delete</button>
                        <button class="btn btn-info btn-sm" @click="editLocation(row.id, row.name)"><i class="fa fa-pencil-square-o" /> Edit</button>
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
            locations: [],
            newLocationName: '',
            editLocationId : '',
            editIndex: '',
            timestamp: ''
        };
    },
    mounted() {
        this.getLocations();
    },
    methods: {
        getLocations() {
            return axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                }).catch(console.error);
        },
        createLocation() {
            return axios.post('/api/locations', {name: this.newLocationName})
                .then(this.getLocations)
                .then(() => this.newLocationName = '')
                .catch(console.error);
        },
        deleteLocation(id) {
            return axios.post('/api/locations/' + id, {_method: 'DELETE'})
                .then(this.getLocations)
                .catch(console.error);
        },
        editLocation(id, name){
            if(id){
                this.newLocationName = name;
                this.editLocationId = id;
                this.editIndex = id
            }
        },
        updateLocation(){
            this.getNow()
            console.log(this.timestamp)
            const data = {
                updated_at: this.timestamp,
                name: this.newLocationName
            }
            console.log("id:", this.editLocationId);
            console.log("name:", this.newLocationName);
            console.log("data: ", data)
            return axios.put('api/locations/' + this.editLocationId, data)
                 .then(this.getLocations)
                 .catch(console.error);
        },
        resetLocation(){
            this.newLocationName = '';
            this.editIndex = '';
            this.editLocationId = '';
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