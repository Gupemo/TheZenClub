/* -- Crear la base de datos
CREATE DATABASE IF NOT EXISTS thezenclub CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE thezenclub; */

-- Tabla de roles
CREATE TABLE IF NOT EXISTS roles (
    id_rol INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_rol)
) ENGINE = InnoDB;

-- Insertar roles iniciales
INSERT INTO roles (nombre) VALUES
    ('usuario'), 
    ('instructor'),
    ('profesor'),
    ('maestro');

-- Tabla de cuotas
CREATE TABLE IF NOT EXISTS fees (
    fee_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    amount DECIMAL(7,2) NOT NULL
) ENGINE = InnoDB;

-- Insertar cuotas iniciales
INSERT INTO fees (name, amount) VALUES
  ('Mensualidad básica', 50.00),   -- fee_id = 1

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(100) NOT NULL,
    user_subname VARCHAR(200) NOT NULL,
    user_birthdate DATE NOT NULL,
    categoria ENUM('Kids','Juveniles','Adultos','MMA') DEFAULT 'Adultos',
    user_email VARCHAR(100) NOT NULL UNIQUE,
    user_phone VARCHAR(10) NOT NULL,
    user_sex ENUM('Hombre','Mujer'),
    user_picture VARCHAR(255) DEFAULT NULL,
    user_deseases VARCHAR(250),
    rol_id INT DEFAULT 1 NULL,
    fee_id INT DEFAULT 1 NULL,
    user_active BOOLEAN NOT NULL DEFAULT TRUE,
    fecha_alta DATE NOT NULL DEFAULT CURRENT_DATE,
    fecha_baja DATE DEFAULT NULL,
    user_password VARCHAR(255) NOT NULL,
    tos_accepted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(user_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id_rol)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (fee_id) REFERENCES fees(fee_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Familias
CREATE TABLE IF NOT EXISTS families (
    family_id INT AUTO_INCREMENT PRIMARY KEY,
    family_name VARCHAR(100) NOT NULL,
    responsable_id INT NOT NULL,
    fee_id INT DEFAULT NULL,
    custom_fee DECIMAL(7,2) DEFAULT NULL,
    FOREIGN KEY (responsable_id) REFERENCES users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (fee_id) REFERENCES fees(fee_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Relación familias - usuarios
CREATE TABLE IF NOT EXISTS family_user (
    family_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (family_id, user_id),
    FOREIGN KEY (family_id) REFERENCES families(family_id)
        ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE
);

-- Invitaciones para registro
CREATE TABLE IF NOT EXISTS invitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    used BOOLEAN NOT NULL DEFAULT FALSE,
    user_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla de profesores (perfiles públicos)
CREATE TABLE IF NOT EXISTS profesores (
    profesor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bio TEXT,
    especialidades VARCHAR(255),
    logros TEXT,
    visible BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE
);

-- Contactos de emergencia
CREATE TABLE IF NOT EXISTS emergency_contacts (
    contact_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    contact_name VARCHAR(100) NOT NULL,
    contact_subname VARCHAR(200),
    contact_phone VARCHAR(10) NOT NULL,
    relationship VARCHAR(50),
    PRIMARY KEY(contact_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Asistencia
CREATE TABLE IF NOT EXISTS attendance (
    attendance_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    fecha DATE NOT NULL,
    present BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(attendance_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Pagos
CREATE TABLE IF NOT EXISTS payments (
    payment_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NULL,
    family_id INT NULL,
    fee_id INT NULL,
    payment_date DATE NOT NULL,
    payment_fee DECIMAL(7,2) NOT NULL,
    payment_method VARCHAR(50),
    payment_notes TEXT,
    confirmed BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY(payment_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (family_id) REFERENCES families(family_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fee_id) REFERENCES fees(fee_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Cinturones
CREATE TABLE IF NOT EXISTS belts (
    belt_id INT NOT NULL AUTO_INCREMENT,
    belt_name VARCHAR(50) NOT NULL,
    description TEXT,
    PRIMARY KEY (belt_id)
) ENGINE = InnoDB;

INSERT INTO belts (belt_name) VALUES
    ('Blanco'),
    ('Gris blanco'),
    ('Gris'),
    ('Gris negro'),
    ('Amarillo blanco'),
    ('Amarillo'),
    ('Amarillo negro'),
    ('Naranja blanco'),
    ('Naranja'),
    ('Naranja negro'),
    ('Verde blanco'),
    ('Verde'),
    ('Verde negro'),
    ('Azul'),
    ('Morado'),
    ('Marrón'),
    ('Negro');

-- Relación usuario-cinturón
CREATE TABLE IF NOT EXISTS user_belt (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    belt_id INT NOT NULL,
    fecha_obtencion DATE NOT NULL,
    active BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (belt_id) REFERENCES belts(belt_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Competiciones
CREATE TABLE IF NOT EXISTS competitions (
    competition_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100),
    date DATE NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS user_competitions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    competition_id INT NOT NULL,
    result VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (competition_id) REFERENCES competitions(competition_id)
        ON DELETE CASCADE
) ENGINE = InnoDB;

-- Historial médico
CREATE TABLE IF NOT EXISTS user_health (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_registro DATE NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE
) ENGINE = InnoDB;
