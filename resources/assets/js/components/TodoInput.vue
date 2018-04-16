<template>

    <section class="hero is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Todo App</h1>
                <h2 class="subtitle">
                    Subtitulo para poner
                </h2>
                <div class="section-small">
                    <input class="input is-rounded"
                           type="text"
                           placeholder="¿Qué quieres hacer hoy?"
                           :value="todoItemText"
                           @input="$emit('update:todoItemText', $event.target.value)"
                    >
                </div>

                <p class="has-text-centered">
                    <a class="button is-info is-outlined is-rounded" @click="$emit('addTodo')">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['todoItemText']
    }
</script>

<style scoped>
    .is-rounded {
        border-radius: 290486px;
        padding-left: 1em;
        padding-right: 1em;
    }

    .section-small{
        padding-bottom: 1em;
    }

</style>