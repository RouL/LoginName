-- add login to users
ALTER TABLE wcf1_user ADD loginname VARCHAR(250);
ALTER TABLE wcf1_user ADD UNIQUE KEY loginname (loginname);
