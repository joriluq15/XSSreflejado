# PPS-Usuarios-y-Crud Reflected XSS
Mi aplicación no es vulnerable a XSS reflejado ya que:

- Los productos en mostrar_tabla.php se muestran usando htmlspecialchars lo cual evita que un usuario inyecte código JS o HTML malicioso.
- Los formularios para crear y editar productos no muestran los valores del usuario en la respuesta sin escapar evitando ataques de xss.
- Los alert de error y éxito se muestran sin datos del usuario evitando filtrarlos.
- No se muestran resultados de forma directa que se hayan recibido por GET o POST sin una validación previa.

# Robo de Cookie de sesión método POST
Abrimos una conexión con netcat en la máquina maliciosa que escucha al puerto 8080
![alt text](image-3.png)

Cuando el usuario cargue la página ataque_xss_post.html se enviará el formulario de buscar_producto_xss_post.php enviando la cookie de sesión.
![alt text](image-5.png)

Llega la información a la máquina maliciosa
![alt text](image-4.png)

Si intentamos entrar sin cookie nos indica que iniciemos sesión
![alt text](image.png)

Pero al introducir la cookie robada
![alt text](image-1.png)

Ya estamos dentro como el usuario.
![alt text](image-2.png)

(Los directorios del crud podemos encontrarlos haciendo un análisis con herramientas como dirsearch)


# Robo de Cookie de sesión método GET

En este caso el payload irá directamente en la URL y codificado
![alt text](image-6.png)

Al acceder en nuestra máqunina maliciosa que está escuchando obtenemos la cookie:
![alt text](image-7.png)