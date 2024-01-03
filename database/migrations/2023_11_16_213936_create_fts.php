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
        DB::unprepared("
        ALTER TABLE products
        ADD COLUMN tsvectors TSVECTOR;
        
        CREATE FUNCTION product_search_update() RETURNS TRIGGER AS $$
        BEGIN
         IF TG_OP = 'INSERT' THEN
                NEW.tsvectors = (
                 setweight(to_tsvector('english', NEW.name), 'A') ||
                 setweight(to_tsvector('english', NEW.description), 'B')
                );
         END IF;
         IF TG_OP = 'UPDATE' THEN
                 IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
                   NEW.tsvectors = (
                     setweight(to_tsvector('english', NEW.name), 'A') ||
                     setweight(to_tsvector('english', NEW.description), 'B')
                   );
                 END IF;
         END IF;
         RETURN NEW;
        END $$
        LANGUAGE plpgsql;
        
        CREATE TRIGGER product_search_update
         BEFORE INSERT OR UPDATE ON products
         FOR EACH ROW
         EXECUTE PROCEDURE product_search_update();
        
        CREATE INDEX search_idx ON products USING GIN (tsvectors);
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS product_search_update ON products;
            DROP FUNCTION IF EXISTS product_search_update();

            ALTER TABLE products DROP COLUMN IF EXISTS tsvectors;

            DROP INDEX IF EXISTS search_idx;
        ');
    }
};
