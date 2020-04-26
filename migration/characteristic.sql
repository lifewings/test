CREATE TABLE characteristic(
    id serial NOT NULL PRIMARY KEY,
    product_id bigint NOT NULL,
    brand varchar(150) NOT NULL,
    model varchar(150) NOT NULL,
    width integer NOT NULL,
    height integer NOT NULL,
    construction varchar(15) NOT NULL,
    diameter integer NOT NULL,
    load_index varchar(15) NOT NULL,
    speed_index varchar(15) NOT NULL,
    abbreviations varchar(15) NOT NULL,
    ranflat varchar(15) NOT NULL,
    chamber varchar(15) NOT NULL,
    season varchar(150) NOT NULL,
    CONSTRAINT characteristic_product_id_key_unique UNIQUE (product_id)
);
