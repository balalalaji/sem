CREATE TABLE Category (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_title VARCHAR(255) NOT NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE Product (
    product_id INT(11) NOT NULL AUTO_INCREMENT,
    category_id INT(11) NOT NULL,
    product_title VARCHAR(255) NOT NULL,
    product_desc TEXT NOT NULL,
    product_key VARCHAR(255) NOT NULL,
    product_img VARCHAR(255) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

CREATE TABLE Cart_Details (
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

CREATE TABLE User (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_address TEXT NOT NULL,
    user_mobile VARCHAR(20) NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE Order_Details (
    order_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    invoice VARCHAR(255) NOT NULL,
    total_products INT(11) NOT NULL,
    order_date DATE NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);
