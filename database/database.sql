
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(64),
    apellidos VARCHAR(64),
    temperatura INT,
    format INT(1),
    ciudad VARCHAR(64),
    provincia VARCHAR(64)
);

INSERT INTO users (nombre, apellidos, temperatura, `format`, ciudad, provincia) VALUES
                    ("Juan", "Cuadrado", 35, 1, "Orihuela", "Alicante"),
                    ("Laura", "Pérez", 42, 1, "Jacarilla", "Alicante"),
                    ("Marta", "Fuentes", 17, 1, "Arteixo", "A Coruña");