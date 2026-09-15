CREATE TABLE IF NOT EXISTS contacts (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    surname    TEXT NOT NULL,
    name       TEXT NOT NULL,
    lastname   TEXT,
    gender     TEXT NOT NULL CHECK (gender IN ('мужской', 'женский')),
    birthdate  TEXT,
    phone      TEXT,
    location   TEXT,
    email      TEXT,
    comment    TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts (surname, name, lastname, gender, birthdate, phone, location, email, comment) VALUES
('Иванов', 'Иван', 'Иванович', 'мужской', '1990-05-12', '+375291234567', 'г. Минск, ул. Ленина 1', 'ivanov@example.com', 'Коллега по работе'),
('Петрова', 'Мария', 'Сергеевна', 'женский', '1985-11-03', '+375291112233', 'г. Гродно, ул. Советская 5', 'petrova@example.com', 'Подруга'),
('Сидоров', 'Алексей', 'Петрович', 'мужской', '1993-02-20', '+375295556677', 'г. Брест, ул. Мира 10', 'sidorov@example.com', '');