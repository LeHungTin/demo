Create Table category
(
	id int PRIMARY KEY auto_increment,
	name varchar(150) not null unique,
	parent int Default '0',
	status tinyint Default '1',
	created_at datetime Default CURRENT_TIMESTAMP
);

Create Table product
(
	id int PRIMARY KEY auto_increment,
	name varchar(200) not null,
	category_id int not null,
	image varchar(200),
	description text,
	price float,
	sale_price float,
	status tinyint Default '1',
	created_at datetime Default CURRENT_TIMESTAMP
);
-- Tạo khóa ngoại từ bảng product - category
Alter Table product Add Foreign Key FK_product_category (category_id) References category(id);

Create Table product_image
(
	id int PRIMARY KEY auto_increment,
	link_img varchar(200) NOT NULL,
	product_id int NOT NULL
);

Alter Table product_image Add Foreign KEY FK_product_img_product (product_id) References product(id);

-- bảng lưu các thuộc tính của sản phẩm
Create Table attributes
(
	id int PRIMARY KEY auto_increment,
	name varchar(150) not null unique,
	value varchar(50) not null,
	type varchar(50) NOT NULL,
	created_at datetime Default CURRENT_TIMESTAMP
);

-- bảng lưu các thuộc tính của sản phẩm
Create Table product_attribute
(
	product_id int not null,
	attribute_id int not null
);

Alter Table product_attribute Add Foreign KEY FK_product_attribute_product (product_id) References product(id);
Alter Table product_attribute Add Foreign KEY FK_product_attribute_attributes (attribute_id) References attributes(id);

Create Table users
(
	id int PRIMARY KEY auto_increment,
	name varchar(100) NOT NULL,
	email varchar(100) NOT NULL unique,
	phone varchar(20),
	address varchar(255),
	gender tinyint Default '1',
	birthday date,
	password varchar(100) NOT NULL,
	group_name varchar(50) Default 'customer',
	created_at datetime Default CURRENT_TIMESTAMP
);

Create Table orders
(
	id int PRIMARY KEY auto_increment,
	user_id int NOT NULL,
	status tinyint Default '0',
	created_at datetime Default CURRENT_TIMESTAMP
);

Alter Table orders Add Foreign KEY FK_orders_user (user_id) References users(id);


Create Table order_detail
(
	order_id int NOT NULL,
	product_id int NOT NULL,
	quantity int NOT NULL,
	price float NOT NULL
);

Alter Table order_detail Add Foreign KEY FK_order_detail_orders (order_id) References orders(id);
Alter Table order_detail Add Foreign KEY FK_order_detail_product (product_id) References product(id);

Create Table banner
(
	id int PRIMARY KEY auto_increment,
	name varchar(200),
	link_image varchar(200) NOT NULL,
	link varchar(200) Default '#',
	ordering int Default '0',
	status tinyint Default '0',
	created_at datetime Default CURRENT_TIMESTAMP
);

Create Table post
(
	id int PRIMARY KEY auto_increment,
	name varchar(200),
	image varchar(200) Default '#',
	description text,
	status tinyint Default '0',
	created_at datetime Default CURRENT_TIMESTAMP
);
