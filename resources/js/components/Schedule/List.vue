<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"scheduleAdd"}' class="btn btn-primary">Добавить</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><router-link :to='{name: "scheduleView"}'>Расписание занятий</router-link></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Пара</th>
                                <th>Время</th>
                                <th>Дата</th>
                                <th>Опции</th>
                            </tr>
                            </thead>
                            <tbody v-if="schedules.length >= 0">
                            <tr v-for="(schedule,key) in schedules" :key="key">
                                <td>{{ schedule.title }}</td>
                                <td>{{ schedule.time_begin }} - {{ schedule.time_end}}</td>
                                <td>{{ schedule.date }}<br>{{ schedule.day }}</td>
                                <td>
                                    <router-link :to='{name:"scheduleEdit", params:{id:schedule.id}}' class="btn btn-success">Редактировать</router-link>
                                    <button type="button" @click="deleteSchedule(schedule.id)" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">Расписание занятий отсутствует</td>
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
                schedules:[],
            }
        },
        mounted(){
            this.getSchedules()
        },
        methods:{
            getSchedules(){
                this.axios.get('/api/schedule').then(response=>{
                    this.schedules = response.data
                }).catch(error=>{
                    console.log(error)
                    this.schedules = []
                })
            },
            deleteSchedule(id){
                if(confirm("Вы уверены, что хотите удалить расписание?")){
                    this.axios.delete(`/api/schedule/${id}`).then(response=>{
                        this.getSchedules()
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
