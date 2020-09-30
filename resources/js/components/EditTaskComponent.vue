<template>
<div>
    <!-- Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nom de la tâche</label>
                            <textarea name="name" rows="4" class="form-control" v-if="taskToEdit" v-model="taskToEdit.name"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit" @click.prevent="update" data-dismiss="modal">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['taskToEdit'],
    methods: {
        update() {
            axios.patch('http://localhost/laravel-vueJS/public/tasks/edit/' + this.taskToEdit.id, {
                    name: this.taskToEdit.name
                })
                .then(response => {
                    this.$emit('task-updated', response)
                })
                .catch(err => console.log(err))
        }
    }
}
</script>
