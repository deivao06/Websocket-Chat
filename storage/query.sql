-- CREATE TABLE users(
--     id INTEGER PRIMARY KEY,
--     name VARCHAR(250),
--     pass TEXT,
--     admin INTEGER
-- );
UPDATE users set admin = 1 where id = 1;