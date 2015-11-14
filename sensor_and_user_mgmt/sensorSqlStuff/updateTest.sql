UPDATE persons
SET persons.person_id = '100' 
FROM persons p1, users u1
WHERE p1.id = ui.id;

UPDATE users
SET users.person_id = '100'
FROM persons p1, users u1
WHERE p1.id = ui.id;

commit;
