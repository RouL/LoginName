-- add login to users
ALTER TABLE wcf1_user ADD login VARCHAR(250);
ALTER TABLE wcf1_user ADD UNIQUE login (login);
