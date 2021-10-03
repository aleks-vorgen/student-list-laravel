<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"timetableAdd"}' class="btn btn-primary">Добавить</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Расписание факультетов</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Факультет</th>
                                <th>Рабочий день</th>
                                <th>Опции</th>
                            </tr>
                            </thead>
                            <tbody v-if="timetables.length >= 0">
                            <tr v-for="(timetable,key) in timetables" :key="key">
                                <td>{{ timetable.id }}</td>
                                <td>{{ timetable.title }}</td>
                                <td>{{ timetable.work_date }}</td>
                                <td>
                                    <router-link :to='{name:"timetableEdit", params:{id:timetable.id}}' class="btn btn-success">Редактировать</router-link>
                                    <button type="button" @click="deleteTimetable(timetable.id)" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">Расписание для факультетов отсутствует</td>
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
                timetables:[],
                faculties:[]
            }
        },
        mounted(){
            this.getTimetables()
        },
        methods:{
            getTimetables(){
                this.axios.get('/api/timetable').then(response=>{
                    this.timetables = response.data.timetables
                    this.faculties = response.data.faculties
                }).catch(error=>{
                    console.log(error)
                    this.timetables = []
                })
            },
            deleteTimetable(id){
                if(confirm("Вы уверены, что хотите удалить расписание?")){
                    this.axios.delete(`/api/timetable/${id}`).then(response=>{
                        this.getTimetables()
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
