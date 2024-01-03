-- TRAN01
BEGIN TRANSACTION;

INSERT INTO purchase (id_user, total, delivery_progress)
VALUES ($user_id, $total, $progress_status)
RETURNING id INTO $purchase_id;

INSERT INTO purchase_product (id_purchase, id_product, quantity)
SELECT $purchase_id, pp.id_product, pp.quantity
FROM UNNEST($products) pp(id_product INT, quantity INT);

COMMIT;
END TRANSACTION;

--TRAN02
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

SELECT product.id, product.name, product.price, product.photo, product.description, product.hardware, cart.quantity
FROM product
INNER JOIN cart ON product.id = cart.id_product
WHERE cart.id_user = $user_id;

END TRANSACTION;

--TRAN03
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

-- Insert product
INSERT INTO product (name, price, photo, score, description, hardware, publication_date, id_platform)
	VALUES ($name, $price, $photo, $score, $description, $hardware, $publication_date, $id_platform)
	RETURNING id;

-- Insert product into a category
INSERT INTO category_product (id_category, id_product)
	VALUES ($id_platform, id);

END TRANSACTION;
