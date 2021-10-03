const StudentList = () => import('./components/student/List.vue')
const StudentCreate = () => import('./components/student/Edit.vue')
const StudentEdit = () => import('./components/student/Edit.vue')

const FacultyList = () => import('./components/faculty/List.vue')
const FacultyCreate = () => import('./components/faculty/Edit.vue')
const FacultyEdit = () => import('./components/faculty/Edit.vue')

const TimetableList = () => import('./components/timetable/List.vue')
const TimetableCreate = () => import('./components/timetable/Edit.vue')
const TimetableEdit = () => import('./components/timetable/Edit.vue')

const ScheduleList = () => import('./components/schedule/List.vue')
const ScheduleCreate = () => import('./components/schedule/Edit.vue')
const ScheduleEdit = () => import('./components/schedule/Edit.vue')
const ScheduleView = () => import ('./components/Schedule/ViewList.vue')

export const routes = [
    {
        name: 'studentList',
        path: '/student',
        component: StudentList
    },
    {
        name: 'studentEdit',
        path: '/student/:id/edit',
        component: StudentEdit
    },
    {
        name: 'studentAdd',
        path: '/student/edit',
        component: StudentCreate
    },
    {
        name: 'facultyList',
        path: '/faculty',
        component: FacultyList
    },
    {
        name: 'facultyEdit',
        path: '/faculty/:id/edit',
        component: FacultyEdit
    },
    {
        name: 'facultyAdd',
        path: '/faculty/edit',
        component: FacultyCreate
    },
    {
        name: 'timetableList',
        path: '/timetable',
        component: TimetableList
    },
    {
        name: 'timetableEdit',
        path: '/timetable/:id/edit',
        component: TimetableEdit
    },
    {
        name: 'timetableAdd',
        path: '/timetable/edit',
        component: TimetableCreate
    },
    {
        name: 'scheduleList',
        path: '/schedule',
        component: ScheduleList
    },
    {
        name: 'scheduleEdit',
        path: '/schedule/:id/edit',
        component: ScheduleEdit
    },
    {
        name: 'scheduleAdd',
        path: '/schedule/edit',
        component: ScheduleCreate
    },
    {
        name: 'scheduleView',
        path: '/schedule/view',
        component: ScheduleView
    }
]
