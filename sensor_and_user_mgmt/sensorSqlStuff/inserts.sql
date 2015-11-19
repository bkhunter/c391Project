insert into sensors (location, sensor_type, description, sensor_id)
values ('texas','a','good time', 5500 );

insert into subscriptions values (5500, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7700',5500, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 100 );



insert into sensors (location, sensor_type, description, sensor_id)
values ('canada','a','good time', 5501 );

insert into subscriptions values (5501, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7701',5501, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 150 );



insert into sensors (location, sensor_type, description, sensor_id)
values ('paris','a','good time', 5502 );

insert into subscriptions values (5502, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7702',5502, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 100 );


CREATE TABLE fact(
	location   	varchar(64),
	person_id    int,
    sensor_id	int,
	value 		float,
	date_created date,
	FOREIGN KEY(sensor_id,person_id) REFERENCES subscriptions,
	PRIMARY KEY(sensor_id)
) tablespace c391ware;
