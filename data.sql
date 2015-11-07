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

commit;
