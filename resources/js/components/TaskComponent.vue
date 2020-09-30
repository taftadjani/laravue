<template>
<div class="container">
    <div class="form-row">
        <div class="col-row">
            <input type="text" class="form-control" @keyup="searchTask" v-model="q" placeholder="Rechercher une tache">
        </div>
    </div>
    <add-task @task-added="refresh"></add-task>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
            <a href="#">{{ task.name }}</a>
            <!-- Button trigger modal -->
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTaskModal" @click.prevent="getTask(task.id)">
                    Edit
                </button>
                <button type="button" class="btn btn-danger" @click.prevent="deleteTask(task.id)">Supprimer</button>
            </div>
        </li>
        <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></edit-task>
    </ul>
    <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
</div>
</template>

<script>
export default {
    data() {
        return {
            tasks: {},
            taskToEdit: null,
            q: null
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
        },
        getTask(id) {
            axios.get('http://localhost/laravel-vueJS/public/tasks/edit/' + id)
                .then(response => this.taskToEdit = response.data)
                .catch(err => console.log(err))
        },
        deleteTask(id) {
            axios.delete('http://localhost/laravel-vueJS/public/tasks/' + id)
                .then(response => this.tasks = response.data)
                .catch(err => console.log(err))
        },
        searchTask() {
            if (this.q != null && this.q.length >= 3) {
                axios.get('http://localhost/laravel-vueJS/public/tasksList/' + this.q)
                    .then(response => this.tasks = response.data)
                    .catch(err => console.log(err))
            } else {
                axios.get('http://localhost/laravel-vueJS/public/tasksList')
                    .then(response => {
                        this.tasks = response.data
                    })
                    .catch(err => console.log(err))
            }
        }
    }
}
</script>
