<template>
    <div>
        <!-- <form @submit.prevent="createLocation"> -->
            <div class="create-location-form input-group">
            </div>
        <!-- </form> -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Name</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="row in Report" :key="row.id">
                    <td>{{ row.Location }}</td>
                    <td>{{ row.Category }}</td>
                    <td>{{ row.count }}</td>
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
            Report: []
        };
    },
    mounted() {
        this.getReport();
        console.log(this.Report)
    },
    methods: {
        getReport() {
            return axios.get('/api/report')
                .then(response => {
                    this.Report = response.data;
                }).catch(console.error);
        }
    }
}
</script>

<style>
.create-location-form {
    margin-bottom: 10px;
}
</style>