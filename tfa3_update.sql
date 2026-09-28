-- Run this once on the existing TFA2 database.
ALTER TABLE users
    ADD COLUMN avatar VARCHAR(255) NULL AFTER full_name;
