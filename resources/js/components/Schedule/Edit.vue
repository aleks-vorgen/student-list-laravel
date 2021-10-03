<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ header }}</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateOrCreate">
                        <div class="alert alert-danger" role="alert" v-if="errors.length">
                            Исправьте указанные ошибки:
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Название пары</label>
                                    <input type="text" class="form-control" v-model="schedule.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Начало пары</label>
                                    <select name="time_begin" class="form-select" v-model="schedule.time_begin">
                                        <option v-for="(item, index) in time"
                                                :value="item"
                                                :key="index"
                                                :class="{selected: item === schedule.time_begin}">
                                            {{ item }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Дата</label>
                                    <input type="date" class="form-control" v-model="schedule.date">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"update-schedule",
        data(){
            return {
                header: "Добавить расписание",
                time: ['08:30', '10:05', '11:40', '14:00', '15:35', '17:10'],
                schedule:{
                    title: "",
                    time_begin: "",
                    date: "",
                    _method: "",
                },
                errors: []
            }
        },
        mounted(){
            if(this.$route.params.id) {
                this.showSchedule()
                this.header = "Редактировать расписание"
            }
        },
        methods:{
            showSchedule(){
                this.axios.get(`/api/schedule/${this.$route.params.id}`).then(response=>{
                    const { title, time_begin, date } = response.data
                    this.schedule.title = title
                    this.schedule.time_begin = time_begin
                    this.schedule.date = date
                }).catch(error=>{
                    console.log(error)
                })
            },
            updateOrCreate() {
                this.errors = [];
                if (this.schedule.title.length < 5)
                    this.errors.push('Название пары введено некорректно, минимум 5 символов')
                if (!this.schedule.time_begin)
                    this.errors.push("Выберите время начала пары")

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update(){
                this.schedule._method = 'patch'
                this.axios.post(`/api/schedule/${this.$route.params.id}`, this.schedule).then(response=>{
                    this.$router.push({name:"scheduleList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            },
            create() {
                this.schedule._method = 'post'
                this.axios.post(`/api/schedule/`, this.schedule).then(response => {
                    this.$router.push({name: "scheduleList"})
                    alert(response.data.message)
                }).catch(error => {
                    //
                })
            }
        }
    }
</script>
