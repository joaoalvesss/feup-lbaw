-- SCHEMA: lbaw23154
DROP SCHEMA IF EXISTS lbaw23154 CASCADE;

CREATE SCHEMA IF NOT EXISTS lbaw23154;

SET search_path TO lbaw23154;


DROP TYPE IF EXISTS deliveryProgress CASCADE;
DROP TYPE IF EXISTS userPermission CASCADE;


CREATE TYPE deliveryProgress AS ENUM ('Processing', 'Shipped', 'Delivered');
CREATE TYPE userPermission AS ENUM ('User', 'Admin');


DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS addresses  CASCADE;
DROP TABLE IF EXISTS platform CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS product CASCADE;
DROP TABLE IF EXISTS category_product CASCADE;
DROP TABLE IF EXISTS review CASCADE;
DROP TABLE IF EXISTS review_vote CASCADE;
DROP TABLE IF EXISTS cart CASCADE;
DROP TABLE IF EXISTS wishlist CASCADE;
DROP TABLE IF EXISTS purchase CASCADE;
DROP TABLE IF EXISTS faq CASCADE;


CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    phone_number TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    credits TEXT,
    permissions userPermission NOT NULL
);

CREATE TABLE addresses  (
    id SERIAL PRIMARY KEY,
    street TEXT NOT NULL,
    city TEXT NOT NULL,
    postal_code TEXT NOT NULL,
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE platform (
    id SERIAL PRIMARY KEY, 
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY, 
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    price FLOAT NOT NULL CONSTRAINT price_ck CHECK (price > 0),
    photo TEXT,
    quantity INTEGER NOT NULL CONSTRAINT quantity_ck CHECK (quantity >= 0), 
    score FLOAT NOT NULL CONSTRAINT score_ck CHECK ((score > 0) AND (score <= 5)),
    description TEXT NOT NULL,
    hardware BOOLEAN NOT NULL,
    publication_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL CONSTRAINT pub_date_ck CHECK (publication_date <= now()),
    id_platform INTEGER REFERENCES platform(id) ON DELETE CASCADE
);

CREATE TABLE category_product (
    id_category INTEGER NOT NULL REFERENCES category(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE,
    PRIMARY KEY (id_category, id_product)
);

CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE,
    score INTEGER NOT NULL CONSTRAINT score_ck CHECK ((score > 0) OR (score <= 5)),
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    comment TEXT
);

CREATE TABLE review_vote (
    id SERIAL PRIMARY KEY,
    vote BOOLEAN NOT NULL,
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE cart (
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE,
    quantity INTEGER NOT NULL CONSTRAINT quantity_ck CHECK (quantity > 0),
    PRIMARY KEY (id_user, id_product)
);

CREATE TABLE wishlist (
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_product)
);

CREATE TABLE purchase (
    id SERIAL PRIMARY KEY,
    id_user INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    total FLOAT NOT NULL CONSTRAINT total_ck CHECK (total > 0),
    delivery_progress deliveryProgress NOT NULL,
    id_address INTEGER NOT NULL REFERENCES addresses(id) ON DELETE CASCADE
);

CREATE TABLE purchase_product (
    id_purchase INTEGER NOT NULL REFERENCES purchase(id) ON DELETE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE,
    quantity INTEGER NOT NULL CONSTRAINT quantity_ck CHECK (quantity > 0),
    PRIMARY KEY (id_purchase, id_product)
);

CREATE TABLE faq (
    id SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);