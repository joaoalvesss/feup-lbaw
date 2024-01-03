DELETE FROM users;
DELETE FROM addresses;
DELETE FROM platforms;
DELETE FROM categories;
DELETE FROM products;
DELETE FROM category_product;
DELETE FROM reviews;
DELETE FROM review_vote;
DELETE FROM cart;
DELETE FROM wishlist;
DELETE FROM purchases;
DELETE FROM faqs;

INSERT INTO users (name, phone_number, email, password)
VALUES
  ('Sophia Rodriguez', '934231657', 'test@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
  ('Ethan Williams', '915732687', 'test1@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
  ('James Sunderland', '945567283', 'test2@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
  ('Ada Wong', '925638056', 'test3@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
  ('John Smith', '964923458', 'test4@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO users (name, phone_number, email, password, permission)
VALUES
  ('Admin', '999999999', 'admin@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin');

INSERT INTO addresses (label, street, city, postal_code, user_id)
VALUES
  ('home', '789 Oak Ave', 'Villageton', '67890', 1),
  ('home', '456 Elm St', 'Cityville', '12345', 2),
  ('home', '321 Pine Rd', 'Suburbia', '98765', 3),
  ('home', '123 Oak Lane', 'Townsville', '54321', 4),
  ('home', '789 Maple Ave', 'Suburbia', '98765', 5);

INSERT INTO platforms (name)
VALUES
  ('PC'),
  ('PlayStation 5'),
  ('Xbox Series X'),
  ('Nintendo Switch'),
  ('PlayStation 4'),
  ('Xbox One');

INSERT INTO categories (name)
VALUES
  ('Action'),
  ('Adventure'),
  ('RPG'),
  ('Simulation'),
  ('Strategy'),
  ('Sports'),
  ('Racing'),
  ('Puzzle'),
  ('Horror'),
  ('Fighting');

INSERT INTO products (name, stock, price, image, image2, description, platform_id)
VALUES
('Stray', 30, 27.99, 'baseProducts/stray.png', 'baseProducts/stray2.jpg', 'Lost, alone and separated from family, a stray cat must untangle an ancient mystery to escape a long-forgotten cybercity and find their way home.', 1),
('Elden Ring', 40, 59.99, 'baseProducts/elden_ring.jpg', 'baseProducts/elden_ring2.jpg', 'THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between. ', 2),
('Baldur’s Gate 3', 30, 59.99, 'baseProducts/baldurs.jpg', 'baseProducts/baldurs2.jpg', 'Baldur’s Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons & Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.', 1),
('Goat Simulator', 50, 9.75, 'baseProducts/goat.jpg', 'baseProducts/goat2.jpg', 'Goat Simulator is the latest in high-tech Goat Simulation technology.', 1),
('Sid Meier’s Civilization VI', 40, 59.99, 'baseProducts/civ.jpg', 'baseProducts/civ2.jpg', 'Civilization VI is the newest installment in the award winning Civilization Franchise. Expand your empire, advance your culture and go head-to-head against history’s greatest leaders. Will your civilization stand the test of time?', 1),
('Nintendo Switch Sports', 25, 39.99, 'baseProducts/switch_sports.jpg', 'baseProducts/switch_sports2.jpg', 'Swing, kick, spike, and bowl your way to victory in a sports collection that will get the whole family moving.', 4),
('Forza Horizon 5', 15, 69.99, 'baseProducts/forza.jpg', 'baseProducts/forza2.jpg', 'Your Ultimate Horizon Adventure awaits! Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars. Conquer the rugged Sierra Nueva in the ultimate Horizon Rally experience. Requires Forza Horizon 5 game, expansion sold separately.', 2),
('Forza Horizon 5', 35, 69.99, 'baseProducts/forza.jpg', 'baseProducts/forza2.jpg', 'Your Ultimate Horizon Adventure awaits! Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars. Conquer the rugged Sierra Nueva in the ultimate Horizon Rally experience. Requires Forza Horizon 5 game, expansion sold separately.', 5),
('The Witness', 30, 36.99, 'baseProducts/witness.jpg', 'baseProducts/witness2.jpg', 'You wake up, alone, on a strange island full of puzzles that will challenge and surprise you.', 1),
('Silent Hill 2', 5, 59.99, 'baseProducts/silent.jpg', 'baseProducts/silent2.jpg', '"My name...is Maria," the woman smiles. Her face, her voice... She’s just like her.', 1),
('Silent Hill 2', 20, 69.99, 'baseProducts/silent.jpg', 'baseProducts/silent2.jpg', '"My name...is Maria," the woman smiles. Her face, her voice... She’s just like her.', 2),
('Tekken 8', 40, 69.99, 'baseProducts/tekken.jpg', 'baseProducts/tekken2.jpg', 'Get ready for the next chapter in the legendary fighting game franchise, TEKKEN 8.', 1),
('Tekken 8', 40, 69.99, 'baseProducts/tekken.jpg', 'baseProducts/tekken2.jpg', 'Get ready for the next chapter in the legendary fighting game franchise, TEKKEN 8.', 2),
('Tekken 8', 40, 69.99, 'baseProducts/tekken.jpg', 'baseProducts/tekken2.jpg', 'Get ready for the next chapter in the legendary fighting game franchise, TEKKEN 8.', 3),
('Yakuza: Like a Dragon', 20, 40.99, 'baseProducts/yakuza.jpg', 'baseProducts/yakuza2.jpg', 'Become Ichiban Kasuga, a low-ranking yakuza grunt left on the brink of death by the man he trusted most. Take up your legendary bat and get ready to crack some underworld skulls in dynamic RPG combat set against the backdrop of modern-day Japan.', 2);

INSERT INTO category_product (category_id, product_id)
VALUES
(2,1),
(1,2),
(2,2),
(2,3),
(3,3),
(5,3),
(4,4),
(5,5),
(6,6),
(7,7),
(7,8),
(8,9),
(9,10),
(9,11),
(1,12),
(10,12),
(1,13),
(10,13),
(1,14),
(10,14),
(1,15),
(3,15);

INSERT INTO reviews (user_id, product_id, score, comment)
VALUES
(1, 2, 5, null),
(1, 10, 4, 'By far the greatest horror experience of all time!!'),
(2, 4, 5, 'he he funny goat game'),
(3, 2, 4, 'Some of FromSoftware’s best work, however Bloodborne is still better'),
(3, 5, 3, null),
(3, 7, 2, null),
(4, 1, 1, null),
(4, 3, 5, null),
(4, 6, 4, null);


INSERT INTO review_vote (vote, user_id, review_id)
VALUES
  (true, 2, 4),
  (true, 3, 3),
  (true, 4, 6),
  (true, 5, 7),
  (true, 1, 5),
  (false, 4, 9);

INSERT INTO cart (user_id, product_id, quantity)
VALUES
  (1, 3, 1),
  (2, 4, 2),
  (1, 4, 1),
  (3, 3, 3),
  (4, 2, 2),
  (2, 1, 1),
  (4, 5, 2),
  (3, 7, 3),
  (2, 6, 1),
  (5, 5, 2),
  (1, 8, 1),
  (2, 9, 2),
  (1, 10, 1);


INSERT INTO wishlist (user_id, product_id)
VALUES
  (3, 2),
  (4, 3),
  (1, 2),
  (2, 1),
  (5, 4),
  (1, 3),
  (1, 4),
  (4, 6);

INSERT INTO purchases (user_id, product_id, quantity, total, delivery_progress, address_id)
VALUES
  (1, 3, 1, 59.99, 'Shipped', 1),
  (4, 4, 2, 19.5, 'Delivered', 4),
  (1, 1, 2, 55.98, 'Delivered', 1),
  (2, 2, 1, 59.99, 'Processing', 2),
  (5, 2, 3, 179.97, 'Shipped', 5),
  (3, 4, 2, 19.5, 'Delivered', 3),
  (4, 7, 1, 69.99, 'Shipped', 4),
  (2, 5, 2, 119.98, 'Delivered', 2),
  (1, 4, 3, 29.35, 'Delivered', 1),
  (3, 6, 2, 79.98, 'Processing', 3);


INSERT INTO faqs (question, answer)
VALUES
  ('How can I reset my password?', 'You can reset your password by clicking on the "Forgot Password" link on the login page. Follow the instructions in the email we send you to reset your password.'),
  ('What payment methods do you accept?', 'We accept major credit cards, including Visa, MasterCard, and American Express, as well as PayPal for online payments.'),
  ('Can I change my email address associated with my account?', 'Yes, you can update your email address in your account settings. Please make sure to verify your new email address for security purposes.'),
  ('Is there a return policy for physical products?', 'Yes, we have a return policy for physical products. Please review our return policy on our website for details and instructions.'),
  ('How do I redeem a game key or code?', 'To redeem a game key or code, go to your account settings and find the "Redeem Key" option. Enter your key or code, and the game will be added to your library.'),
  ('What are the system requirements for PC games?', 'System requirements can vary by game. Check the product page for the specific game to find information on its system requirements.'),
  ('Do you offer pre-orders for upcoming games?', 'Yes, we offer pre-orders for select upcoming games. You can pre-order them on our website and receive exclusive bonuses.'),
  ('How can I request a refund for a digital purchase?', 'If you are not satisfied with a digital purchase, please contact our customer support team within 14 days of purchase to request a refund.'),
  ('Is there a mobile app available for your platform?', 'Yes, we have a mobile app that allows you to access your account, purchase games, and stay updated on the latest releases.'),
  ('Can I gift a game to a friend?', 'Yes, you can gift games to friends. On the product page, look for the "Gift" option and follow the instructions to send the game as a gift to another user.');
