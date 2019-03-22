Select 'Crear esquema llamado escuela';

create table curso(
    id_curso serial not null,
    titulo varchar(60),
    descripcion varchar(126),
    costo number (12,2),
    constraint pkCurso primary key(id_curso)
);

insert into curso(titulo,descripcion, costo)values
('Curso de PHP','Curso avanzado de php y postgresql',189),
('Curso de Javaquery','Curso avanzado de javascript',199),
('Programacion orientada a objetos','Curso avanzado de POO',499);

