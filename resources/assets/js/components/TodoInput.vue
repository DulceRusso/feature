<template>

    <section class="hero is-primary is-bold background-cover">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Todo App</h1>
                <h2 class="subtitle">
                    Lista de tareas por hacer
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
                    <a class="button is-info is-rounded" @click="$emit('addTodo')">
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

    .hero-body{
        z-index: 2;
    }

    .background-cover::after{
        content: "";
        opacity: 0.5;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: 1;
        background-image: url(/images/background2.jpg) !important;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        height:270px;
    }

</style>