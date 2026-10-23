# Plan de pruebas — Tablón de anuncios

## Casos de prueba

### CP01. Registro correcto

- **Preparación:** disponer de un correo electrónico y un nombre de usuario que no estén registrados.
- **Acción:** completar el formulario de registro con datos válidos.
- **Resultado esperado:** la aplicación guarda el nuevo usuario en la base de datos y no almacena la contraseña en texto plano.
- **Resultado obtenido:** Cuando me meto en el formulario de registro y relleno todos los datos, al darle al botón `Registrarse` me lleva nuevamente a la vista principal y tengo que darle a iniciar sesión para poder acceder con la cuenta registrada.
- [X] Superado

### CP02. Registro con campos vacíos

- **Preparación:** abrir el formulario de registro.
- **Acción:** intentar enviarlo sin completar los campos obligatorios.
- **Resultado esperado:** el navegador impide el envío mientras falten campos obligatorios.
- **Resultado obtenido:** Cuando intento registrarme y dejo algun campo vacio no se registrar y marca el campo que te has dejado vacio diciend `Completa este campo`.
- [X] Superado

### CP03. Registro con correo duplicado

- **Preparación:** disponer de una cuenta ya registrada.
- **Acción:** intentar registrar otra cuenta con el mismo correo.
- **Resultado esperado:** la aplicación rechaza el registro duplicado y no crea otra cuenta con ese correo.
- **Resultado obtenido:** Cuando intento registrarme con un correo que ya existe debajo de los campos del formulario pone `El correo o el nombre de usuario ya está registrado`.
- [X] Superado

### CP04. Inicio de sesión correcto

- **Preparación:** disponer de una cuenta registrada.
- **Acción:** introducir el correo y la contraseña correctos.
- **Resultado esperado:** la aplicación autentica al usuario y guarda su identificador y correo en la sesión.
- **Resultado obtenido:** Cuando inicio sesión con un correo y contraseña correctos me inicia sesión y me lleva a la vista principal.
- [X] Superado

### CP05. Inicio de sesión con contraseña incorrecta

- **Preparación:** disponer de una cuenta registrada.
- **Acción:** introducir el correo correcto y una contraseña incorrecta.
- **Resultado esperado:** la aplicación no autentica al usuario ni crea una sesión autenticada.
- **Resultado obtenido:** Cuando inicio con un correo correcto y una contraseña incorrecta no inicia sesión y arriba de los campos del formulario pone `Correo o contraseña incorrectos`.
- [X] Superado

### CP06. Cierre de sesión

- **Preparación:** iniciar sesión.
- **Acción:** utilizar la opción de cerrar sesión.
- **Resultado esperado:** la sesión deja de estar autenticada y vuelven a mostrarse las opciones para iniciar sesión o registrarse.
- **Resultado obtenido:** Cuando le doy al botón de cerrar sesión me cierra sesión la cuenta y me lleva a la vista principal sin ninguna cuenta iniciada sesión.
- [X] Superado

### CP07. Listado de publicaciones

- **Preparación:** disponer de publicaciones guardadas.
- **Acción:** acceder al listado de publicaciones.
- **Resultado esperado:** la aplicación muestra las publicaciones existentes.
- **Resultado obtenido:** Aparece un listado de todas las publicaciones que hay creadas, una debajo de otra.
- [X] Superado

### CP08. Búsqueda de publicaciones

- **Preparación:** disponer de publicaciones con distintos títulos y categorías.
- **Acción:** buscar un texto presente en un título y, después, un texto presente en una categoría.
- **Resultado esperado:** la aplicación muestra las publicaciones que coinciden con la búsqueda.
- **Resultado obtenido:** Escribo algo en el campo de texto de busqueda de publicaciones y al darle al botón de buscar se filtran las publicaciones, mostrando unicamente las que coinciden con la busqueda que hemos realizado.
- [X] Superado

### CP09. Acceso a una publicación inexistente

- **Preparación:** conocer la ruta de detalle de una publicación.
- **Acción:** acceder a `/posts/999999`, usando un identificador que no exista.
- **Resultado esperado:** la aplicación responde con un error 404 y no muestra una publicación inexistente.
- **Resultado obtenido:** Cuando buscamos por ejemplo `/posts/99999` aparece un mensaje diciendo `Publicación no encontrada`.
- [X] Superado

### CP10. Creación de una publicación sin iniciar sesión

- **Preparación:** cerrar sesión.
- **Acción:** acceder a `/posts/create`.
- **Resultado esperado:** la aplicación redirige al inicio de sesión con un mensaje explicativo y no permite crear la publicación.
- **Resultado obtenido:** Cuando intento acceder a `/posts/create` sin tener ninguna cuenta iniciada, me redirige automaticamente al formulario de inicio de sesión.
- [X] Superado

### CP11. Creación de una publicación con sesión iniciada

- **Preparación:** iniciar sesión.
- **Acción:** crear una publicación con título, categoría y contenido.
- **Resultado esperado:** la publicación se guarda en la base de datos y queda asociada al usuario autenticado.
- **Resultado obtenido:** Iniciando sesión y creando una publicación nueva con título, categoría y contenido se crea correctamente guardandose en la base de datos y mostrandose en la página web.
- [X] Superado

### CP12. Edición de una publicación propia

- **Preparación:** iniciar sesión con la cuenta propietaria de una publicación.
- **Acción:** modificar su título, categoría o contenido.
- **Resultado esperado:** la aplicación guarda los cambios y muestra los datos actualizados.
- **Resultado obtenido:** Cuando modifico mi publicación y modifico el título, categoría y contenido se modifica perfectamente actualizandose en la página web y en la base de datos.
- [X] Superado

### CP13. Edición de una publicación ajena

- **Preparación:** disponer de dos cuentas y una publicación propiedad de la primera.
- **Acción:** iniciar sesión con la segunda cuenta e intentar acceder a la edición de la publicación ajena.
- **Resultado esperado:** la aplicación responde con un error 403 y no permite modificarla.
- **Resultado obtenido:** Cuando intento modificar una publicación ajena no me sale el botón para poder modificarla.
- [X] Superado

### CP14. Eliminación de una publicación ajena

- **Preparación:** disponer de dos cuentas y una publicación propiedad de la primera.
- **Acción:** iniciar sesión con la segunda cuenta e intentar eliminar esa publicación.
- **Resultado esperado:** la aplicación responde con un error 403 y la publicación permanece en la base de datos.
- **Resultado obtenido:** Cuando intento eliminar una publicación ajena no me sale el botón para poder eliminarla.
- [X] Superado

### CP15. Creación de un comentario

- **Preparación:** iniciar sesión y abrir una publicación existente.
- **Acción:** enviar un comentario con contenido válido.
- **Resultado esperado:** el comentario se guarda asociado a la publicación y al usuario autenticado.
- **Resultado obtenido:** Cuando añado un comentario a una publicación se crea correctamente en la base de datos y se muestra en la página web.
- [X] Superado

### CP16. Intento de comentar sin iniciar sesión

- **Preparación:** cerrar sesión.
- **Acción:** intentar enviar un comentario.
- **Resultado esperado:** la aplicación redirige al inicio de sesión y no guarda el comentario.
- **Resultado obtenido:** Cuando cierro sesión y me meto en una publicación para añdir un comentario no me sale el recuadro para escribir un comentario.
- [X] Superado

### CP17. Visualización y orden de los comentarios

- **Preparación:** disponer de varios comentarios en una publicación.
- **Acción:** acceder al detalle de esa publicación.
- **Resultado esperado:** se muestran los comentarios de esa publicación ordenados por fecha de creación, del más antiguo al más reciente.
- **Resultado obtenido:** Cuando añado un segundo comentario a una publicación se muestran los comentarios del más antiguo al más reciente.
- [X] Superado

## Resumen de resultados

- **Casos ejecutados:** 17 de 17.
- **Casos superados:** 17.
- **Casos fallidos:** 0.
- **Casos pendientes:** 0.