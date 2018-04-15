# Todo

> Proyecto de evaluación de principios básicos de desarrollo con laravel y vue.

## Procedimiento

Primera parte:

1. Clonar y crear una branch llamada `feature/fase-1`
2. Desarrollar dentro de esa branch el `TodoController` junto con la integración del frontend modificando el
    `Todo.vue`, usando la biblioteca axios.

Segunda parte:

1. En una nueva rama `feature/fase-2` creada a partir de `feature/fase-1` deben modificar el frontend dividiendo las partes de `Todo.vue`
   en varios componentes `TodoInput`, `TodoItem` para cada item todo en el listado. y el componente
   `Todo` debe contener a estos. *ver el archivo screenshot.png*.
2. Recuerda que la lógica de añadir y eliminar deben estar en el `Todo` aunque los botones de acción estan en
   los demas componentes por lo que el `TodoInput` debe enviar un evento cuando la cadena nos sea vacia, el
   `TodoItem` debe tener 3 propiedades de componente (text: string, done: boolean, id: numeric) el cual al hacer
   click en eliminar debe enviar un evento pasando al componente padre el id para que con ello se elimine y otro para
   marcar o desmarcar la propiedad done.

Tercera parte:

1. En otra nueva rama `feature/fase-3` a partir de `feature/fase-2` se deberá modificar el proyecto para que ahora use
   la biblioteca [vuex](https://vuex.vuejs.org/en/) por lo que la lógica en el componente `Todo` pasa a estar en los
   actions y getters, donde las llamadas de axios estaran en el store en vez del componente y este último solo debe
   llamarlos.

## Notas:

- Las tres ramas deben estar en su cuenta de github de forma pública.
- Pueden hacer los commits que quieran mientras cumplan con los requerimientos (es buena práctica no tener commits enormes).
- Se va a evaluar la calidad con la que escriben el código, no solo el hecho de que funcione.
- Eres libre de modificar la vista del proyecto, tu creatividad igual sera tomanda en cuenta.