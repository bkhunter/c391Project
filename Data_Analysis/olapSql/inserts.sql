insert into sensors (location, sensor_type, description, sensor_id)
values ('texas','a','good time', 5500 );

insert into subscriptions values (5500, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7700',5500, TO_DATE('1-JAN-2013', 'DD-MON-YYYY' ), 100 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7800',5500, TO_DATE('11-JAN-2013', 'DD-MON-YYYY' ), 200 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7801',5500, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 500 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7802',5500, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 10 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7803',5500, TO_DATE('12-NOV-2015', 'DD-MON-YYYY' ), 12 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7804',5500, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 8 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7805',5500, TO_DATE('11-NOV-2016', 'DD-MON-YYYY' ), 90 );


insert into scalar_data (id, sensor_id, date_created, value)
values ('7806',5500, TO_DATE('17-AUG-2013', 'DD-MON-YYYY' ), 10 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7807',5500, TO_DATE('30-AUG-2013', 'DD-MON-YYYY' ), 59 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7808',5500, TO_DATE('25-AUG-2013', 'DD-MON-YYYY' ), 200 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7809',5500, TO_DATE('2-AUG-2013', 'DD-MON-YYYY' ), 0 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7810',5500, TO_DATE('1-FEB-2013', 'DD-MON-YYYY' ), 100 );

insert into scalar_data (id, sensor_id, date_created, value)
values ('7811',5500, TO_DATE('20-FEB-2013', 'DD-MON-YYYY' ), 50 );


insert into sensors (location, sensor_type, description, sensor_id)
values ('canada','a','good time', 5501 );

insert into subscriptions values (5501, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7701',5501, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 0 );




insert into sensors (location, sensor_type, description, sensor_id)
values ('paris','a','good time', 5502 );

insert into subscriptions values (5502, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7702',5502, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 100 );





insert into sensors (location, sensor_type, description, sensor_id)
values ('texas','a','good time', 5503 );

insert into subscriptions values (5503, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7703',5503, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 200 );




insert into sensors (location, sensor_type, description, sensor_id)
values ('canada','a','good time', 5504 );

insert into subscriptions values (5504, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7704',5504, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 150 );



insert into sensors (location, sensor_type, description, sensor_id)
values ('paris','a','good time', 5505 );

insert into subscriptions values (5505, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7705',5505, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 50 );




insert into sensors (location, sensor_type, description, sensor_id)
values ('fort wayne','a','good time', 5506 );

insert into subscriptions values (5506, 3);

insert into scalar_data (id, sensor_id, date_created, value)
values ('7706',5506, TO_DATE('11-NOV-2015', 'DD-MON-YYYY' ), 700 );

commit;

