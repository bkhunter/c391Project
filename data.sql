DROP TABLE imageinfo;
DROP TABLE audioinfo;

/*
content is found in images value recoreded_data
*/
CREATE TABLE imageinfo(
    image_id int,
	imagesize int,	
    name varchar(128),
    PRIMARY KEY(image_id),
    FOREIGN KEY(image_id) REFERENCES images
) tablespace c391ware;

/*
content is found in audio_recordings value recoreded_data
*/
CREATE TABLE audioinfo(
    recording_id int,
	audiosize int,	
    name varchar(128),
    PRIMARY KEY(recording_id),
    FOREIGN KEY(recording_id) REFERENCES audio_recordings
) tablespace c391ware;

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
insert into users values ('scientist','scientist','s',1,SYSDATE);
insert into users values ('data','data','d',2,SYSDATE);
insert into users values ('admin','admin','a',3,SYSDATE);
insert into users values ('iamthewalrus','iamtheeggman','s',4,SYSDATE);


insert into sensors values (101, 'edmonton', 'a' , 'whats good');
insert into sensors values (102, 'calgary' , 'a' , 'i dunno');
insert into subscriptions values (101, 1 );

commit;
