CREATE DATABASE cepre_bc;
USE cepre_bc;

-- =========================
-- TABLA ROLES
-- =========================

CREATE TABLE roles(
    idRol INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL
);

-- =========================
-- TABLA USUARIOS
-- =========================

CREATE TABLE usuarios(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    estado ENUM('activo','inactivo') DEFAULT 'activo',
    idRol INT,
    FOREIGN KEY(idRol) REFERENCES roles(idRol)
);

-- =========================
-- TABLA ESTUDIANTES
-- =========================

CREATE TABLE estudiantes(
    idEstudiante INT PRIMARY KEY AUTO_INCREMENT,
    dni CHAR(8) UNIQUE,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    sexo ENUM('Masculino','Femenino'),
    fechaNacimiento DATE,
    correo VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    colegioProcedencia VARCHAR(150),
    carrera VARCHAR(100),
    foto VARCHAR(255),
    estado ENUM('activo','retirado') DEFAULT 'activo',
    fechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA APODERADOS
-- =========================

CREATE TABLE apoderados(
    idApoderado INT PRIMARY KEY AUTO_INCREMENT,
    idEstudiante INT,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    telefono VARCHAR(20),
    parentesco VARCHAR(50),
    direccion VARCHAR(200),
    FOREIGN KEY(idEstudiante) REFERENCES estudiantes(idEstudiante)
);

-- =========================
-- TABLA DOCENTES
-- =========================

CREATE TABLE docentes(
    idDocente INT PRIMARY KEY AUTO_INCREMENT,
    dni CHAR(8) UNIQUE,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    especialidad VARCHAR(100),
    correo VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    foto VARCHAR(255),
    estado ENUM('activo','inactivo') DEFAULT 'activo'
);

-- =========================
-- TABLA CICLOS
-- =========================

CREATE TABLE ciclos(
    idCiclo INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    fechaInicio DATE,
    fechaFin DATE,
    estado ENUM('activo','finalizado') DEFAULT 'activo'
);

-- =========================
-- TABLA CURSOS
-- =========================

CREATE TABLE cursos(
    idCurso INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion TEXT,
    creditos INT,
    estado ENUM('activo','inactivo') DEFAULT 'activo'
);

-- =========================
-- TABLA AULAS
-- =========================

CREATE TABLE aulas(
    idAula INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    capacidad INT,
    ubicacion VARCHAR(100)
);

-- =========================
-- TABLA HORARIOS
-- =========================

CREATE TABLE horarios(
    idHorario INT PRIMARY KEY AUTO_INCREMENT,
    idCurso INT,
    idDocente INT,
    idAula INT,
    dia VARCHAR(20),
    horaInicio TIME,
    horaFin TIME,
    FOREIGN KEY(idCurso) REFERENCES cursos(idCurso),
    FOREIGN KEY(idDocente) REFERENCES docentes(idDocente),
    FOREIGN KEY(idAula) REFERENCES aulas(idAula)
);

-- =========================
-- TABLA MATRICULAS
-- =========================

CREATE TABLE matriculas(
    idMatricula INT PRIMARY KEY AUTO_INCREMENT,
    idEstudiante INT,
    idCiclo INT,
    fecha DATE,
    estado ENUM('activo','retirado') DEFAULT 'activo',
    FOREIGN KEY(idEstudiante) REFERENCES estudiantes(idEstudiante),
    FOREIGN KEY(idCiclo) REFERENCES ciclos(idCiclo)
);

-- =========================
-- TABLA DETALLE MATRICULA
-- =========================

CREATE TABLE detalle_matricula(
    idDetalle INT PRIMARY KEY AUTO_INCREMENT,
    idMatricula INT,
    idCurso INT,
    FOREIGN KEY(idMatricula) REFERENCES matriculas(idMatricula),
    FOREIGN KEY(idCurso) REFERENCES cursos(idCurso)
);

-- =========================
-- TABLA EVALUACIONES
-- =========================

CREATE TABLE evaluaciones(
    idEvaluacion INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    porcentaje DECIMAL(5,2),
    fecha DATE,
    idCurso INT,
    FOREIGN KEY(idCurso) REFERENCES cursos(idCurso)
);

-- =========================
-- TABLA NOTAS
-- =========================

CREATE TABLE notas(
    idNota INT PRIMARY KEY AUTO_INCREMENT,
    idEvaluacion INT,
    idEstudiante INT,
    nota DECIMAL(5,2),
    observacion VARCHAR(255),
    FOREIGN KEY(idEvaluacion) REFERENCES evaluaciones(idEvaluacion),
    FOREIGN KEY(idEstudiante) REFERENCES estudiantes(idEstudiante)
);

-- =========================
-- TABLA ASISTENCIAS
-- =========================

CREATE TABLE asistencias(
    idAsistencia INT PRIMARY KEY AUTO_INCREMENT,
    idEstudiante INT,
    idCurso INT,
    fecha DATE,
    estado ENUM('Presente','Falta','Tardanza'),
    FOREIGN KEY(idEstudiante) REFERENCES estudiantes(idEstudiante),
    FOREIGN KEY(idCurso) REFERENCES cursos(idCurso)
);

-- =========================
-- TABLA PAGOS
-- =========================

CREATE TABLE pagos(
    idPago INT PRIMARY KEY AUTO_INCREMENT,
    idEstudiante INT,
    concepto VARCHAR(100),
    monto DECIMAL(10,2),
    fechaPago DATE,
    metodoPago VARCHAR(50),
    estado ENUM('Pagado','Pendiente') DEFAULT 'Pendiente',
    FOREIGN KEY(idEstudiante) REFERENCES estudiantes(idEstudiante)
);

-- =========================
-- TABLA COMPROBANTES
-- =========================

CREATE TABLE comprobantes(
    idComprobante INT PRIMARY KEY AUTO_INCREMENT,
    idPago INT,
    tipo VARCHAR(50),
    serie VARCHAR(20),
    correlativo VARCHAR(20),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(idPago) REFERENCES pagos(idPago)
);

-- =========================
-- TABLA ANUNCIOS
-- =========================

CREATE TABLE anuncios(
    idAnuncio INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200),
    descripcion TEXT,
    imagen VARCHAR(255),
    fechaPublicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA NOTICIAS
-- =========================

CREATE TABLE noticias(
    idNoticia INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200),
    descripcion TEXT,
    imagen VARCHAR(255),
    fechaPublicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA EVENTOS
-- =========================

CREATE TABLE eventos(
    idEvento INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(150),
    descripcion TEXT,
    fechaEvento DATE,
    lugar VARCHAR(150)
);

-- =========================
-- TABLA CONTACTOS
-- =========================

CREATE TABLE contactos(
    idContacto INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100),
    correo VARCHAR(100),
    asunto VARCHAR(150),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA INSCRIPCIONES WEB
-- =========================

CREATE TABLE inscripciones_web(
    idInscripcion INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    dni CHAR(8),
    telefono VARCHAR(20),
    correo VARCHAR(100),
    carrera VARCHAR(100),
    fechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA SLIDERS
-- =========================

CREATE TABLE sliders(
    idSlider INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(150),
    descripcion TEXT,
    imagen VARCHAR(255)
);

-- =========================
-- TABLA GALERIA
-- =========================

CREATE TABLE galeria(
    idImagen INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(150),
    imagen VARCHAR(255)
);

-- =========================
-- TABLA CONFIGURACION
-- =========================

CREATE TABLE configuracion(
    idConfiguracion INT PRIMARY KEY AUTO_INCREMENT,
    nombreInstitucion VARCHAR(150),
    direccion VARCHAR(200),
    telefono VARCHAR(20),
    correo VARCHAR(100),
    logo VARCHAR(255)
);

-- =========================
-- INSERTAR ROLES
-- =========================

INSERT INTO roles(nombre) VALUES
('Administrador'),
('Docente'),
('Estudiante');

-- =========================
-- USUARIO ADMINISTRADOR
-- =========================

INSERT INTO usuarios(usuario,clave,idRol)
VALUES('admin','123456',1);

-- =========================
-- DATOS CONFIGURACION
-- =========================

INSERT INTO configuracion(
nombreInstitucion,
direccion,
telefono,
correo,
logo
)
VALUES(
'CEPRE Academy',
'Av. Principal 123',
'999999999',
'cepre@gmail.com',
'logo.png'
);

ALTER TABLE comprobantes
ADD pdf VARCHAR(500);
