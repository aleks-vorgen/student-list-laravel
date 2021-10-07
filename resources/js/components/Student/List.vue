<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"studentAdd"}' class="btn btn-primary">Добавить</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Список студентов</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Факультет</th>
                                <th>Курс</th>
                                <th>Опции</th>
                            </tr>
                            </thead>
                            <tbody v-if="students.length > 0">
                            <tr v-for="(student,key) in students" :key="key">
                                <td>{{ student.id }}</td>
                                <td>{{ student.name }}</td>
                                <td>{{ student.surname }}</td>
                                <td>{{ student.title }}</td>
                                <td>{{ student.course }}</td>
                                <td>
                                    <router-link :to='{name:"studentEdit", params:{id:student.id}}' class="btn btn-success">Редактировать</router-link>
                                    <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">Список студентов пуст</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"students",
        data(){
            return {
                students:[],
                faculties:[]
            }
        },
        mounted(){
            this.getStudents()
        },
        methods:{
            getStudents(){
                this.axios.get('/api/student').then(response=>{
                    this.students = response.data.students
                    this.faculties = response.data.faculties
                }).catch(error=>{
                    if(error.response.status === 500) {
                        alert(error.response.statusText + ": Connection to database failed")
                        return this.$router.push('/')
                    }
                })
            },
            deleteStudent(id){
                if(confirm("Вы уверены, что хотите удалить студента?")){
                    this.axios.delete(`/api/student/${id}`).then(response=>{
                        this.getStudents()
                    }).catch(error=>{
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

