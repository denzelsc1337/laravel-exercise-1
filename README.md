
# 📦 Ejercicio 1: Envío de Boletín Informativo

Envío en masa de un correo promocional a 1,000,000 usuarios sin afectar el rendimiento principal de la aplicación.

### 🕵 **Normativas**

- ⛔ prohibido paquetes externos
- ⛔ prohibido inteligencia artificial
- ⛔ prohibido github copilot
- ✅ permitido documentacion de laravel
- ✅ permitido google, stackoverflow
### 🛠 **Configuración Inicial:**

1. **Instalacion** ejercicio laravel:
```bash
composer require byancode/laravel-exercise-1
```
2. **Service Provider** ejecuta el comando:
```bash
php artisan vendor:publish --provider="Byancode\LaravelExercise1\ServiceProvider"
```
3. **Variables de Entorno:**
```properties
MAIL_FROM_ADDRESS="test@byancode.com"
MAIL_FROM_NAME="Byancode"
```

### 🗂 **Modelos y Datos:**

1. **Modelo `Newsletter`:**
    - Crea un modelo llamado `Newsletter`.
    - Establece una relación `belongsToMany` con el modelo `User`.

2. **Población de Datos (Seeders):**
    - Llena la tabla `users` con 1,000,000 registros de usuarios ficticios.
    - Crea un registro en `Newsletter` con un asunto (`subject`) que diga: **'Nueva actualizacion del sistema'**.

### **Funcionalidad de Envío:**

4. **Comando Personalizado:** Crea un comando de Artisan que pueda invocarse como: `php artisan users:send-newsletter`.

5. **Clase Mailable:**
    - Crea una clase mailable llamada `NewsletterShipped`.
    - En su constructor, recibe el modelo `Newsletter` como parámetro.
    - En la función `envelope` retorna la clase `envelope` pasandole como argumento `subject` de el modelo `Newsletter`.
    - En la función `content`, retorna una instancia de la clase `Content` con el argumento `text` que diga: "Enviado correctamente".

6. **Funcionalidad del Comando:**
    - **Función `retrieve`:** Dentro del comando `users:send-newsletter`:
        - Obten una lista de 100 usuarios que no estén registrados en la tabla pivot en una unica consulta con eloquent.
        - Recupera el primer registro de `Newsletter` para que lo pases como argumento a la clase `NewsletterShipped`.
        - Usa `Mail::to` para enviar el boletín a los usuarios seleccionados utilizando la función `queue` y pasando la clase `NewsletterShipped` como argumento.
    - **Función `handle`:** Dentro del mismo comando:
        - Haz un bucle que ejecute la función `retrieve` 10 veces, de esta manera se enviarán correos a 1,000 usuarios.

7. **Programación del Comando:** En el archivo `Kernel` de Laravel, programa que el comando `users:send-newsletter` se ejecute cada minuto con la ayuda del scheduler.
