<template>
    <div class="box">
        <div class="field is-grouped">
            <p class="control is-expanded">
                <input class="input"
                       type="text"
                       placeholder="Nuevo recordatorio"
                       :value="todoItemText"
                       @input="$emit('update:todoItemText', $event.target.value)"
                >
            </p>
            <p class="control">
                <a class="button is-info" @click="$emit('addTodo')">
                    Agregar
                </a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props:['todoItemText']
    }
</script>

<style scoped>

</style>