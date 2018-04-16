<template>
    <tr>
        <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': done }"
            @click="$emit('toggleDone')">
            {{ text }}
        </td>
        <td class="is-narrow">
            <a class="button is-danger is-small" @click="removeTodo(id)">Eliminar</a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            text: {
                type: String
            },
            done: {
                type: Boolean
            },
            id: {
                type: Number
            }
        },
        methods: {
            removeTodo(value) {
                this.$emit('removeTodo', value)
            }
        }
    }
</script>

<style scoped>

</style>