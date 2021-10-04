<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Student List</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/student" class="nav-item nav-link">Student</router-link>
                        <router-link exact-active-class="active" to="/faculty" class="nav-item nav-link">Faculty</router-link>
                        <router-link exact-active-class="active" to="/timetable" class="nav-item nav-link">Timetable</router-link>
                        <router-link exact-active-class="active" to="/schedule" class="nav-item nav-link">Schedule</router-link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="card text-center mt-5" v-if="$route.path === '/'">
            <div class="card-header">Featured</div>
            <div class="card-body padding-y-10">
                <h5 class="card-title">University manager</h5>
                <p class="card-text">Internship project</p>
            </div>
            <div class="card-footer text-muted">
                Prod. by Aleksey Kulikov
            </div>
        </div>

        <div class="container mt-3" v-if="$route.path !== '/'">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {
        //
    }
</script>

<style scoped>
    .padding-y-10 {
        padding: 15% 0 15% 0;
    }
</style>
