CREATE TABLE products (
    id serial NOT NULL PRIMARY KEY,
    name varchar(255) NOT NULL,
    CONSTRAINT products_name_key_unique UNIQUE (name)
);
