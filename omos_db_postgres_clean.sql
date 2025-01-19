-- PostgreSQL Compatible Database Dump

-- Disable notices
SET client_min_messages TO WARNING;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS cart_list CASCADE;
DROP TABLE IF EXISTS category_list CASCADE;
DROP TABLE IF EXISTS customer_list CASCADE;
DROP TABLE IF EXISTS order_items CASCADE;
DROP TABLE IF EXISTS order_list CASCADE;
DROP TABLE IF EXISTS product_list CASCADE;
DROP TABLE IF EXISTS stock_list CASCADE;
DROP TABLE IF EXISTS stock_out CASCADE;
DROP TABLE IF EXISTS system_info CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- Create Tables
CREATE TABLE category_list (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    status BOOLEAN NOT NULL DEFAULT TRUE,
    delete_flag BOOLEAN NOT NULL DEFAULT FALSE,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE customer_list (
    id SERIAL PRIMARY KEY,
    firstname TEXT NOT NULL,
    middlename TEXT,
    lastname TEXT NOT NULL,
    gender VARCHAR(100) NOT NULL,
    contact TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    avatar TEXT,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_list (
    id SERIAL PRIMARY KEY,
    category_id INTEGER NOT NULL,
    brand TEXT NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    dose VARCHAR(250) NOT NULL,
    price NUMERIC(12,2) NOT NULL DEFAULT 0.00,
    image_path TEXT,
    status BOOLEAN NOT NULL DEFAULT TRUE,
    delete_flag BOOLEAN NOT NULL DEFAULT FALSE,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES category_list(id) ON DELETE CASCADE
);

CREATE TABLE order_list (
    id SERIAL PRIMARY KEY,
    code VARCHAR(100) NOT NULL,
    customer_id INTEGER NOT NULL,
    delivery_address TEXT NOT NULL,
    total_amount NUMERIC(12,2) NOT NULL DEFAULT 0.00,
    status SMALLINT NOT NULL DEFAULT 0,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customer_list(id) ON DELETE CASCADE
);

CREATE TABLE order_items (
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL DEFAULT 0,
    price NUMERIC(12,2) NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES order_list(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product_list(id) ON DELETE CASCADE
);

CREATE TABLE cart_list (
    id SERIAL PRIMARY KEY,
    customer_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL DEFAULT 0,
    FOREIGN KEY (customer_id) REFERENCES customer_list(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product_list(id) ON DELETE CASCADE
);

CREATE TABLE stock_list (
    id SERIAL PRIMARY KEY,
    product_id INTEGER NOT NULL,
    code VARCHAR(100) NOT NULL,
    quantity NUMERIC(12,2) NOT NULL DEFAULT 0.00,
    expiration DATE,
    date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES product_list(id) ON DELETE CASCADE
);

CREATE TABLE stock_out (
    id SERIAL PRIMARY KEY,
    order_id INTEGER NOT NULL,
    stock_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL DEFAULT 0,
    FOREIGN KEY (order_id) REFERENCES order_list(id) ON DELETE CASCADE,
    FOREIGN KEY (stock_id) REFERENCES stock_list(id) ON DELETE CASCADE
);

CREATE TABLE system_info (
    id SERIAL PRIMARY KEY,
    meta_field TEXT NOT NULL,
    meta_value TEXT NOT NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(250) NOT NULL,
    middlename TEXT,
    lastname VARCHAR(250) NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    avatar TEXT,
    last_login TIMESTAMP,
    type SMALLINT NOT NULL DEFAULT 0,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Data
INSERT INTO category_list (id, name, description, status, delete_flag, date_created, date_updated) VALUES
(1, 'Tablet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', TRUE, FALSE, '2022-05-25 10:14:16', '2024-07-01 20:51:56'),
(2, 'Capsule', 'Suspendisse accumsan mollis quam.', TRUE, FALSE, '2022-05-25 10:16:05', '2024-07-01 20:51:43'),
(5, 'Tablets', 'follow your doctors prescription', TRUE, FALSE, '2024-07-02 03:19:29', '2024-07-02 04:28:49'),
(6, 'Syrub', 'Follow your Docs prescription', TRUE, FALSE, '2024-07-02 03:20:06', '2024-07-02 04:28:30'),
(7, 'Capsule', 'follow your docs prescription', TRUE, FALSE, '2024-07-02 03:20:36', '2024-07-02 04:27:28');

INSERT INTO customer_list (id, firstname, middlename, lastname, gender, contact, email, password, avatar, date_created, date_updated) VALUES
(4, 'Akindele', 'Badmus', 'Bamidele', 'Male', '08078342228', 'bamideleakins09@gmail.com', '0bda527670d31e0f03ffd634d819a8b1', NULL, '2024-07-01 12:25:40', '2024-07-01 12:25:40');

INSERT INTO product_list (id, category_id, brand, name, description, dose, price, image_path, status, delete_flag, date_created, date_updated) VALUES
(8, 5, 'brand1', 'Paracetamol', 'Follow Doctors prescription', '100mg', 200.00, NULL, TRUE, FALSE, '2024-07-02 03:21:52', '2024-07-02 03:21:52'),
(9, 7, 'brand2', 'Penicillin', 'follow docs description', '250mg', 700.00, NULL, TRUE, FALSE, '2024-07-02 03:33:59', '2024-07-02 03:33:59'),
(10, 7, 'brand1', 'Amaxollin', 'follow doctors prescription', '250mg', 700.00, NULL, TRUE, FALSE, '2024-07-02 03:40:42', '2024-07-02 03:40:42'),
(11, 5, 'brand3', 'chloroquin', 'follow doctors description', '250mg', 500.00, NULL, TRUE, FALSE, '2024-07-02 04:44:41', '2024-07-02 04:44:41'),
(12, 5, 'brand1', 'flagyl', 'follow doctors prescription', '150mg', 450.00, NULL, TRUE, FALSE, '2024-07-02 04:54:47', '2024-07-02 04:54:47');

INSERT INTO order_list (id, code, customer_id, delivery_address, total_amount, status, date_created, date_updated) VALUES
(6, '2024070200001', 4, 'Plot 2, Comercial Layout, Ring Road Hospital Road, Ring Road', 200.00, 0, '2024-07-02 03:31:13', '2024-07-02 03:31:13');

INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(6, 8, 1, 200.00);

INSERT INTO stock_list (id, product_id, code, quantity, expiration, date_created, date_updated) VALUES
(10, 8, '90292', 50.00, '2025-06-14', '2024-07-02 03:26:13', '2024-07-02 03:26:13'),
(11, 10, '29013', 25.00, '2026-10-02', '2024-07-02 04:29:50', '2024-07-02 04:31:20'),
(12, 9, '10', 14.00, '2028-02-20', '2024-07-02 04:48:37', '2024-07-02 04:48:37'),
(13, 11, '6758', 10.00, '2026-10-10', '2024-07-02 04:50:23', '2024-07-02 04:50:23');

INSERT INTO system_info (meta_field, meta_value) VALUES
('name', 'Online Pharmacy Management System'),
('short_name', 'OPMS'),
('logo', 'uploads/logo.png?v=1653443580'),
('user_avatar', 'uploads/user_avatar.jpg'),
('cover', 'uploads/cover.png?v=1653443581'),
('phone', '07038229267'),
('mobile', '07038229267'),
('email', 'info@medicine.com'),
('address', 'no 3, oluyole, ibadan');

INSERT INTO users (firstname, middlename, lastname, username, password, avatar, type, date_added, date_updated) VALUES
('Adminstrator', '', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', 1, '2021-01-20 14:02:37', '2022-05-16 14:17:49');

-- Reset sequences to match original IDs
SELECT setval('category_list_id_seq', (SELECT MAX(id) FROM category_list));
SELECT setval('customer_list_id_seq', (SELECT MAX(id) FROM customer_list));
SELECT setval('product_list_id_seq', (SELECT MAX(id) FROM product_list));
SELECT setval('order_list_id_seq', (SELECT MAX(id) FROM order_list));
SELECT setval('stock_list_id_seq', (SELECT MAX(id) FROM stock_list));
SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));
