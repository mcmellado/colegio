DROP TABLE IF EXISTS alumnos CASCADE;

CREATE TABLE alumnos (
    id      bigserial       PRIMARY KEY,
    codigo  numeric(3)      NOT NULL UNIQUE,
    nombre  varchar(255)    NOT NULL
);

DROP TABLE IF EXISTS ccee CASCADE;

CREATE TABLE ccee (
    id              bigserial       PRIMARY KEY,
    ce              varchar(255)    NOT NULL,
    descripcion     varchar(255)        
);

DROP TABLE IF EXISTS notas CASCADE;
/**
CREATE TABLE notas (
    id_notas        bigserial       PRIMARY KEY,
    alumno_id       bigserial       NOT NULL UNIQUE,
    codigo_alumno   numeric(3)      NOT NULL UNIQUE,
    ccee_id         bigserial       NOT NULL,
    alumno          varchar(255)    NOT NULL,
    nota            numeric(1)      NOT NULL,
    foreign key(alumno_id) references alumnos(id) on delete cascade,
    foreign key(ccee_id) references ccee(id) on delete cascade,
    foreign key(codigo_alumno) references alumnos(codigo) on delete cascade
);
**/


INSERT INTO alumnos (nombre, codigo)
    VALUES ('pepito', 1),
           ('juanito', 2),
           ('joselito', 3);

INSERT INTO ccee (ce, descripcion)
        VALUES('Hud8', 'Instituto Salmedina');

/** INSERT INTO notas (alumno_id, ccee_id, codigo_alumno, alumno, nota) 
        VALUES  ( (SELECT id from alumnos where nombre='pepito'), 
                  (SELECT id from ccee where descripcion='Instituto Salmedina'),
                  (SELECT codigo from alumnos where nombre='pepito'),
                  (SELECT nombre from alumnos where nombre='pepito'),
                  '5'),
                ( (SELECT id from alumnos where nombre='juanito'), 
                  (SELECT id from ccee where descripcion='Instituto Salmedina'),
                  (SELECT codigo from alumnos where nombre='juanito'),
                  (SELECT nombre from alumnos where nombre='juanito'),
                  '6'),
                ( (SELECT id from alumnos where nombre='joselito'), 
                  (SELECT id from ccee where descripcion='Instituto Salmedina'),
                  (SELECT codigo from alumnos where nombre='joselito'),
                  (SELECT nombre from alumnos where nombre='joselito'),
                  '3');
**/




