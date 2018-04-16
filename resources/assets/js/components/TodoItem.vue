<template>
    <tr>
        <td class="is-narrow remove-border">
            <label class="radio">
                <input type="radio" :checked="done" @click="$emit('toggleDone')">
            </label>
        </td>
        <td class="is-fullwidth remove-border" style="cursor: pointer" :class="{ 'is-done': done }"
            >
            {{ text }}
        </td>
        <td class="is-narrow is-danger remove-border">
            <a @click="removeTodo(id)">Eliminar</a>
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
    .is-done {
        text-decoration: line-through;
    }

    .remove-border{
        border: 0 !important;
    }
</style>