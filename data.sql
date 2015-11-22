DROP TABLE idtracker;

/*
for keeping track of that id is next
*/
CREATE TABLE idtracker(
	colid     int,
    image_id  int,
	audio_id  int,
	scalar_id int,	
    PRIMARY KEY(colid),
    UNIQUE (image_id),
	UNIQUE (audio_id),
	UNIQUE (scalar_id)
) tablespace c391ware;

insert into idtracker values (0,0,0,0);

/*
persons data
*/
insert into persons values (1,'John','Lennon','Abbey Road','tangerine@trees.mail',9999999999);
insert into persons values (2,'Ringo','Starr','Peppers Loney Hearts','marmalade@skies.mail',9999999999);
insert into persons values (3,'George','Harrison','Magical Mystery','kaleidoscope@eyes.mail',9999999999);
insert into persons values (4,'Paul','McCartney','Yellow Submarine','cellophane@flowers.mail',9999999999);

/*
users data

SYSDATE is current date 
use sysdate when creating new users
sysdate will give current date 
*/
insert into users values ('scientist','scientist','s',1,to_date( TO_CHAR(sysdate, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ) );
insert into users values ('data','data','d',2,to_date( TO_CHAR(sysdate, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ));
insert into users values ('admin','admin','a',3,to_date( TO_CHAR(sysdate, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ));
insert into users values ('iamthewalrus','iamtheeggman','s',4,to_date( TO_CHAR(sysdate, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ));


insert into sensors values (101, 'edmonton', 'a' , 'whats good');
insert into sensors values (102, 'calgary' , 'a' , 'i dunno');
insert into subscriptions values (101, 1 );

commit;
