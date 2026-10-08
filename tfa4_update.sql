-- Run this once on the existing TFA3 database.
-- Existing sample accounts will use the temporary password: password

ALTER TABLE users
    ADD COLUMN password VARCHAR(255) NULL AFTER full_name;

UPDATE users
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

ALTER TABLE users
    MODIFY password VARCHAR(255) NOT NULL;
