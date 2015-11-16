CREATE TABLE value(
    date_created date,
	sensor_id    int,
	location     varchar(64),
    value float,
    PRIMARY KEY(sensor_id),
    FOREIGN KEY(sensor_id) REFERENCES subcriptions,
	FOREIGN KEY(date_created) REFERENCES scalar_data,
	FOREIGN KEY(location) REFERENCES sensors
)tablespace c391ware;
