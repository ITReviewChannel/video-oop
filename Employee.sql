CREATE TABLE employee
(
    id INTEGER UNSIGNED NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    account INTEGER NOT NULL,
    work_hours INTEGER UNSIGNED NOT NULL,
    paid_hours INTEGER UNSIGNED NOT NULL
);

INSERT INTO employee
    (id, name, account, email, work_hours, paid_hours)
VALUES
    (1, 'Ivanov', 0, 'ivanov@mail.ru', 150, 40),
    (2, 'Petrov', 0, 'petrov@mail.ru', 250, 90),
    (3, 'Sergeev', 0, 'sergeev@mail.ru', 10, 5);