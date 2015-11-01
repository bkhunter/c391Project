CREATE TABLE sensors(
    sensor_id    int,
    location     varchar(64),
    sensor_type  char(1),
    description  varchar(128),
    CHECK(sensor_type in ('a', 'i', 's')),
    PRIMARY KEY(sensor_id)
) tablespace c391ware;

commit;