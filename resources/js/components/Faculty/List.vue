<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"facultyAdd"}' class="btn btn-primary">Добавить</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Список факультетов</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Длительность учебы</th>
                                <th>Опции</th>
                            </tr>
                            </thead>
                            <tbody v-if="faculties.length > 0">
                            <tr v-for="(faculty,key) in faculties" :key="key">
                                <td>{{ faculty.id }}</td>
                                <td>{{ faculty.title }}</td>
                                <td>{{ faculty.work_time }}</td>
                                <td>
                                    <router-link :to='{name:"facultyEdit", params:{id:faculty.id}}' class="btn btn-success">Редактировать</router-link>
                                    <button type="button" @click="deleteFaculty(faculty.id)" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">Список факультетов пуст</td>
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
        name: "List",
        data(){
            return {
                faculties:[]
            }
        },
        mounted(){
            this.getFaculties()
        },
        methods:{
            getFaculties(){
                this.axios.get('/api/faculty').then(response=>{
                    this.faculties = response.data
                }).catch(error=>{
                    console.log(error)
                    this.faculties = []
                })
            },
            deleteFaculty(id){
                if(confirm("Вы уверены, что хотите удалить факультет?\nВсе студенты, учащиеся на этом факультете будут удалены")){
                    this.axios.delete(`/api/faculty/${id}`).then(response=>{
                        this.getFaculties()
                    }).catch(error=>{
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
