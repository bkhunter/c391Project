drop table users;
drop table persons;

CREATE TABLE persons (
       person_id int,
       first_name varchar(24),
       last_name  varchar(24),
       address    varchar(128),
       email      varchar(128),
       phone      char(10),
       PRIMARY KEY(person_id),
       UNIQUE (email)
) tablespace c391ware;

/*
 * To store user info
 * role: 'a'->administrator
 * role: 'd'->data curator
 * role: 's'->scientist
 */
CREATE TABLE users (
    user_name           varchar(32),
    password            varchar(32),
    role                char(1),
    person_id           int,
    date_registered     date,
    CHECK (role in ('a', 'd', 's')),
    PRIMARY KEY(user_name),
    FOREIGN KEY(person_id) REFERENCES persons
) tablespace c391ware;
