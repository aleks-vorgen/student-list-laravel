<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link to="/schedule" class="btn btn-primary">Редактировать</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Расписание занятий</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                            <tr id="day-of-week">
                                <th>Время</th>
                                <th v-for="(weekday, key) in weekdays_ru" :key="key">{{ weekday }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="schedules.length >= 0">
                            <tr v-for="(schedule,key) in schedules" :key="key">
                                <td>{{ schedule.time_begin }}<br>{{ schedule.time_end}}</td>
                                <td v-for="(weekday, key) in weekdays_en" :key="key"
                                    v-if="schedule.day === weekday">
                                    {{ schedule.title }}<br>{{ schedule.date }}
                                </td>
                                <td v-else> </td>
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
        name: "View-list",
        data(){
            return {
                schedules:[],
                weekdays_ru: [
                    'Понедельник',
                    'Вторник',
                    'Среда',
                    'Четверг',
                    'Пятница',
                    'Суббота',
                ],
                weekdays_en: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                ]
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
            },
        }
    }
</script>

<style scoped>

</style>
