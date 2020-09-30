<template>
<div class="container">
    <add-task @task-added="refresh"></add-task>
    <ul class="list-group">
        <li class="list-group-item" v-for="task in tasks.data" :key="task.id"><a href="#">{{ task.name }}</a></li>
    </ul>
    <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
</div>
</template>

<script>
export default {
    data() {
        return {
            tasks: {}
        }
    },
    created() {
        axios.get('http://localhost/laravel-vueJS/public/tasksList')
            .then(response => {
                this.tasks = response.data
            })
            .catch(err => console.log(err))
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        getResults(page = 1) {
            axios.get('http://localhost/laravel-vueJS/public/tasksList?page=' + page)
                .then(response => {
                    this.tasks = response.data
                })
        },
        refresh(tasks) {
            this.tasks = tasks.data
        }
    }
}
</script>
