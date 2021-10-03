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
        <div class="container mt-5">
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

</style>
