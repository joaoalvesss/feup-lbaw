<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("/*update product score on reviews*/

        CREATE OR REPLACE FUNCTION update_product_score() 
        RETURNS TRIGGER 
        AS
        \$BODY$
        BEGIN
            UPDATE products 
            SET score = (SELECT AVG(score) FROM reviews WHERE product_id = NEW.product_id) 
            WHERE id = NEW.product_id;
            RETURN NEW;
        END;
        \$BODY$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER update_score 
        AFTER INSERT OR UPDATE OR DELETE 
        ON reviews
        FOR EACH ROW
        EXECUTE PROCEDURE update_product_score();
        
        /*remove stock from product after purchases*/
        CREATE OR REPLACE FUNCTION update_stock() 
        RETURNS TRIGGER 
        AS
        \$BODY$
        BEGIN
            UPDATE products
            SET stock = stock - NEW.quantity 
            WHERE id = NEW.product_id;
            RETURN NEW;
        END;
        \$BODY$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER update_stock 
        AFTER INSERT 
        ON purchases
        FOR EACH ROW
        EXECUTE PROCEDURE update_stock();
        
        /*can't add over the current stock to cart*/
        
        CREATE OR REPLACE FUNCTION check_cart_quantity() 
        RETURNS TRIGGER 
        AS
        \$BODY$
        BEGIN
            IF NOT EXISTS (SELECT stock FROM products WHERE id = NEW.product_id AND stock >= NEW.quantity) THEN
                RAISE EXCEPTION 'Not enough items of %', NEW.product_id;
            END IF;
            RETURN NEW;
        END;
        \$BODY$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER check_valid_cart 
        BEFORE INSERT 
        ON cart
        FOR EACH ROW
        EXECUTE PROCEDURE check_cart_quantity();
        
        /*delete cart after a purchases*/
        
        CREATE OR REPLACE FUNCTION clear_cart() 
        RETURNS TRIGGER 
        AS
        \$BODY$
        BEGIN
            DELETE FROM cart
            WHERE user_id = NEW.user_id;
            RETURN NEW;
        END;
        \$BODY$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER clear_cart 
        AFTER INSERT 
        ON purchases
        FOR EACH ROW 
        EXECUTE PROCEDURE clear_cart();
        
        /*delete from wishlist*/
        
        CREATE OR REPLACE FUNCTION clear_wishlist() 
        RETURNS TRIGGER 
        AS
        \$BODY$
        BEGIN
            DELETE FROM wishlist
            WHERE user_id = New.user_id;
            RETURN NEW;
        END;
        \$BODY$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER clear_wishlist 
        AFTER INSERT 
        ON purchases
        FOR EACH ROW
        EXECUTE PROCEDURE clear_wishlist();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
        DROP TRIGGER IF EXISTS update_score ON reviews;
        DROP TRIGGER IF EXISTS update_stock ON purchases;
        DROP TRIGGER IF EXISTS check_valid_cart ON cart;
        DROP TRIGGER IF EXISTS clear_cart ON purchases;
        DROP TRIGGER IF EXISTS clear_wishlist ON purchases;

        DROP FUNCTION IF EXISTS update_product_score();
        DROP FUNCTION IF EXISTS update_stock();
        DROP FUNCTION IF EXISTS check_cart_quantity();
        DROP FUNCTION IF EXISTS clear_cart();
        DROP FUNCTION IF EXISTS clear_wishlist();
    ');
    }
};
