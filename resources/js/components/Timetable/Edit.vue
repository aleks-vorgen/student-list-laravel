<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Редактировать расписание</h4>
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
                                    <label>Факультет</label>
                                    <select name="faculty" class="form-select" v-model="timetable.faculty_id" >
                                        <option v-for="(item) in faculties"
                                                :value="item.id">
                                            {{ item.id }}. {{ item.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Рабочий день</label>
                                    <select name="work_date" class="form-select" v-model="timetable.work_date">
                                        <option value=1>1. Понедельник</option>
                                        <option value=2>2. Вторник</option>
                                        <option value=3>3. Среда</option>
                                        <option value=4>4. Четверг</option>
                                        <option value=5>5. Пятница</option>
                                        <option value=6>6. Суббота</option>
                                    </select>
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
        name:"update-timetable",
        data(){
            return {
                timetable:{
                    faculty_id: "",
                    work_date: "",
                    _method: "",
                },
                faculties: [],
                errors: []
            }
        },
        mounted(){
            this.getFacultyList()

            if(this.$route.params.id)
                this.showTimetable()
        },
        methods:{
            showTimetable(){
                this.axios.get(`/api/timetable/${this.$route.params.id}`).then(response=>{
                    const { faculty_id, work_date } = response.data
                    this.timetable.faculty_id = faculty_id
                    this.timetable.work_date = work_date
                }).catch(error=>{
                    console.log(error)
                })
            },
            getFacultyList() {
                this.axios.get(`/api/timetable/`).then(response=>{
                    this.faculties = response.data.faculties
                }).catch(error=>{
                    console.log(error)
                })
            },
            updateOrCreate() {
                this.errors = [];
                if (!this.timetable.faculty_id)
                    this.errors.push('Укажите факультет')
                if (!this.timetable.work_date)
                    this.errors.push('Укажите рабочий день')

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update(){
                this.timetable._method = 'patch'
                this.axios.post(`/api/timetable/${this.$route.params.id}`,this.timetable).then(response=>{
                    this.$router.push({name:"timetableList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            },
            create(){
                this.timetable._method = 'post'
                this.axios.post(`/api/timetable/`,this.timetable).then(response=>{
                    this.$router.push({name:"timetableList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            }
        }
    }
</script>
