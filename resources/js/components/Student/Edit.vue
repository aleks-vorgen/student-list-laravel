<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Редактировать студента</h4>
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
                                    <label>Имя</label>
                                    <input type="text" class="form-control" v-model="student.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Фамилия</label>
                                    <input type="text" class="form-control" v-model="student.surname">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Факультет</label>
                                    <select name="faculty" class="form-select" v-model="student.faculty_id" >
                                        <option v-for="(item) in faculties"
                                                :value="item.id">
                                            {{ item.id }}. {{ item.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Курс</label>
                                    <input type="text" class="form-control" v-model="student.course">
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
        name:"update-student",
        data(){
            return {
                student:{
                    name: "",
                    surname: "",
                    faculty_id: "",
                    course: "",
                    _method: "",
                },
                faculties: [],
                errors: []
            }
        },
        mounted(){
            this.getFacultyList()

            if(this.$route.params.id)
                this.showStudent()
        },
        methods:{
            showStudent(){
                this.axios.get(`/api/student/${this.$route.params.id}`).then(response=>{
                    const { name, surname, faculty_id, course } = response.data
                    this.student.name = name
                    this.student.surname = surname
                    this.student.faculty_id = faculty_id
                    this.student.course = course
                    console.log(response.data)
                }).catch(error=>{
                    console.log(error)
                })
            },
            getFacultyList() {
                this.axios.get(`/api/student/`).then(response=>{
                    this.faculties = response.data.faculties
                }).catch(error=>{
                    console.log(error)
                })
            },
            updateOrCreate() {
                this.errors = [];
                if (!this.student.name || this.student.name.length < 3)
                    this.errors.push('Имя введено некорректно, минимум 3 символа')
                if (!this.student.surname || this.student.surname.length < 5)
                    this.errors.push('Фамилия введена некорректно, минимум 5 символов')
                if(!this.student.faculty_id)
                    this.errors.push('Укажите факультет')
                if (!this.student.course || this.student.course < 1 || this.student.course > 8)
                    this.errors.push('Укажите курс (1-8)')

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update(){
                this.student._method = 'patch'
                this.axios.post(`/api/student/${this.$route.params.id}`,this.student).then(response=>{
                    this.$router.push({name:"studentList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            },
            create(){
                this.student._method = 'post'
                this.axios.post(`/api/student/`,this.student).then(response=>{
                    this.$router.push({name:"studentList"})
                    alert(response.data.message)
                }).catch(error=>{
                    //
                })
            }
        }
    }
</script>
