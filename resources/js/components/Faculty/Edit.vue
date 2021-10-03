<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Редактировать факультет</h4>
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
                                    <label>Название</label>
                                    <input type="text" class="form-control" v-model="faculty.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Длительность учебы</label>
                                    <input class="form" type="time" min="00:30" max="05:00" v-model="faculty.work_time">
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
        name:"update-faculty",
        data(){
            return {
                faculty:{
                    title: "",
                    work_time: "",
                    _method: "",
                },
                errors: []
            }
        },
        mounted(){
            if(this.$route.params.id)
                this.showFaculty()
        },
        methods:{
            showFaculty(){
                this.axios.get(`/api/faculty/${this.$route.params.id}`).then(response=>{
                    const { title, work_time } = response.data
                    this.faculty.title = title
                    this.faculty.work_time = work_time
                }).catch(error=>{
                    console.log(error)
                })
            },
            updateOrCreate() {
                this.errors = [];
                if (this.faculty.title.length < 3)
                    this.errors.push('Название введено некорректно, минимум 3 символа')
                if (this.faculty.work_time < 3000 || this.faculty.work_time > 50000)
                    this.errors.push("Длительность учебы введена некорректно, минимум 30 минут, максимум 5 часов, в формате (00:00:00) или (000000)")

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update(){
                this.faculty._method = 'patch'
                this.axios.post(`/api/faculty/${this.$route.params.id}`, this.faculty).then(response=>{
                    this.$router.push({name:"facultyList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            },
            create(){
                this.faculty._method = 'post'
                this.axios.post(`/api/faculty/`,this.faculty).then(response=>{
                    this.$router.push({name:"facultyList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            }
        }
    }
</script>
