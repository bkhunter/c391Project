CREATE TABLE fact(
	location   	varchar(64),
	person_id    int,
    sensor_id	int,
	value 		float,
	date_created date,
	FOREIGN KEY(sensor_id,person_id) REFERENCES subscriptions
) tablespace c391ware;
