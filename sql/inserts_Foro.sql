INSERT INTO usuarios (nombre_usuario, nombre_real_usuario, correo, contraseña)
VALUES 
('juan123', 'Juan Pérez', 'juanperez@gmail.com', '$2y$10$z8k6Zqg4wDpgk4yUsm1pV.bSRHVg/NsJv8DjXWkBx6bsAm4CnKf3S'),
('maria456', 'María López', 'marialopez@hotmail.com', '$2y$10$sdZvRNV80xM1NHR3PA0H6OlFO5XeYFdFwSRZ2hPq/8XHcsOlKQ0pa'), 
('jose789', 'José Martínez', 'josemartinez@yahoo.com', '$2y$10$8smcfn2bX5n.n8sjS6XxwKuTr9l0G3lbZb9v0aF5t7zKc1HK09y6G'); 

INSERT INTO preguntas (id_usuario, titulo, contenido, fecha_creacion)
VALUES
(1, '¿Cómo puedo aprender PHP?', 'Estoy comenzando con PHP, ¿por dónde debería empezar?', NOW()),
(2, '¿Qué es SQL?', 'Quiero aprender más sobre bases de datos y SQL. ¿Alguien me puede ayudar?', NOW()),
(3, '¿Cómo mejorar mi código?', 'Tengo dudas sobre buenas prácticas en la programación. ¿Alguien puede ayudarme?', NOW());

INSERT INTO respuestas (id_pregunta, id_usuario, contenido, fecha_creacion)
VALUES
(1, 2, 'Te recomiendo empezar con los conceptos básicos como variables, estructuras de control y funciones.', NOW()),
(2, 1, 'SQL es un lenguaje para gestionar bases de datos. Puedes aprenderlo desde la creación de tablas hasta consultas complejas.', NOW()),
(3, 2, 'Es importante seguir buenas prácticas como el uso de nombres claros para variables y funciones, y modularizar el código.', NOW());
