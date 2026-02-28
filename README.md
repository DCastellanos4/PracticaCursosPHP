![CI Status](https://github.com/DCastellanos4/PracticaCursosPHP/actions/workflows/main.yml/badge.svg)
# Proyecto de Gestión de Cursos - Práctica PHP

Este repositorio contiene una aplicación web desarrollada en PHP para la gestión de cursos, usuarios e inscripciones. Es un proyecto de práctica diseñado para implementar conceptos de programación del lado del servidor, manejo de bases de datos y validaciones de formularios.

---

## 🚀 Características

* **Gestión de Cursos:** Creación, edición y eliminación de cursos (CRUD).
* **Sistema de Usuarios:** Registro e inicio de sesión de usuarios/alumnos.
* **Inscripciones:** Funcionalidad para que los usuarios se apunten a los cursos disponibles.
* **Validación:** Control de errores en formularios y seguridad básica en PHP.
* **Persistencia de datos:** Integración con base de datos MySQL/MariaDB.

---

## 🛠️ Tecnologías utilizadas

* **Lenguaje:** PHP 8.x
* **Base de Datos:** MySQL
* **Frontend:** HTML5, CSS3
* **Servidor recomendado:** XAMPP / WAMP / Laragon

---

## 📋 Requisitos previos

Para ejecutar este proyecto localmente, necesitarás:
1.  Un servidor local (como **XAMPP**).
2.  **PHP** instalado (versión 7.4 o superior).
3.  **MySQL** en funcionamiento.

---

## 🔧 Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/DCastellanos4/PracticaCursosPHP.git
    ```

2.  **Configurar la base de datos:**
    * Crea una base de datos en tu gestor.
    * Importa el archivo `cursoscp.sql`.

3.  **Configurar conexión:**
    * Edita el archivo de conexión (`funciones.php`) con tus credenciales locales:
    ```php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "nombre_de_tu_bd";
    ```

4.  **Ejecutar:**
    * Mueve la carpeta al directorio `htdocs` (en XAMPP) o `www` (en WAMP).
    * Accede desde el navegador a `http://localhost/PracticaCursosPHP`.

---

## 📂 Estructura del Proyecto

* `/index.php`: Punto de entrada principal y login.
* `/config/`: Archivos de configuración y conexión a la BD.
* `/src/`: Lógica de negocio y funciones PHP.
* `/assets/`: Archivos CSS, imágenes y scripts JS.

---

## ✒️ Autor

* **David Castellanos** - [DCastellanos4](https://github.com/DCastellanos4)

---
*Este proyecto fue realizado con fines educativos para practicar el desarrollo de aplicaciones web con arquitectura PHP.*
