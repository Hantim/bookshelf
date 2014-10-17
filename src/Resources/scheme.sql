CREATE TABLE categories (
id serial primary key,
name text NOT NULL
);

CREATE TABLE books (
id serial primary key,
category_id int references categories(id),
name text NOT NULL,
description text,
rating int,
link text,
owner_id int NOT NULL
);
CREATE TABLE users ( 
id serial primary key,
firstname text,
lastname text,
email varchar,
password VARCHAR
);

CREATE TABLE contacts (
id serial primary key,
name text,
value varchar,
userId int references users(id)
);
