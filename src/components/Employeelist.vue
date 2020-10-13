<template>
<div>
    <h1>Employee List</h1>
    <table border=1px>
        <tr>
            <th>Sl.No</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
        <tr v-for="item in list" v-bind:key="item.id">
            <td>{{item.id}}</td>
            <td>{{item.employee_name}}</td>
            <td>{{item.employee_salary}}</td>
            <td>{{item.employee_age}}</td>
            <td><button
                class="btn btn-danger"
                @click="deleteList(item.id)"
            >
                Delete
            </button>
            </td>
        </tr>


    </table>
    
</div>
  
</template>

<script>
//import Vue from 'vue';
import axios from 'axios';
// import VueAxios from 'vue-axios';

// Vue.use(VueAxios, axios);


export default {
    name: 'Employeelist',
    data(){
        return {list: undefined};
    },

    mounted()
    {
        //console.log('Axios->', axios)
        axios.get('http://dummy.restapiexample.com/api/v1/employees')
        .then((res)=>{
            console.warn(res);
            console.warn(res.data.data);
            this.list = res.data.data;
            console.warn('List>>', this.list);
            
        })
    },

    methods: {
        deleteBook(id) {
            this.axios
                .delete(`http://dummy.restapiexample.com/api/v1/employees/delete/${id}`)
                .then((response) => {
                    console.log('Delete Data',response);
                    let i = this.list.map(item => item.id).indexOf(id); // find index of your object
                    this.list.splice(i, 1);
                    console.log(response);
                });
        }
    }

};
</script>

<style>

</style>