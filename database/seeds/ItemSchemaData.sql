REPLACE INTO `item_schema` (`id`, `title`, `pizza_size`, `is_full_url`, `css_expression`, `full_content_selector`, `created_at`, `updated_at`) VALUES
(1, 'Ricsi oldala Mezek', '36', 1, 'title[.card-title a]||price[h5]||content[.card-title a]', 'false', NOW(), NOW()),
(3, 'Pizzaguru pizza schema', '28', 1, 'title[tr td p span strong]||price[.options_price]||content[tr td p:nth-child(2) span]', 'false', NOW(), NOW()),
(4, 'Gorog Pizzeria pizza schema', '26', 1, 'title[tr td p span strong]||price[.base_price]||content[tr td p:nth-child(2) span]', 'false', NOW(), NOW()),
(5, 'Pizza-pasta item schema', '32', 1, 'title[.menu_title]||price[.menu_price]||content[.simple-menu-item p]', 'false', NOW(), NOW()),
(8, 'American chicken 32 item schema', '32', 1, 'title[.woocommerce-loop-product__title]||price[.woocommerce-Price-amount]||content[div p]||source_link[a[href]]', 'false', NOW(), NOW()),
(10, 'hobiart item schema', '30', 0, 'title[.art-postheader]||price[.field-name-commerce-price .field-items .field-item]||content[.field-item p]||source_link[a[href]]', 'false',  NOW(), NOW()),
(11, 'Lesdegesz item schema', '32', 0, 'title[.product_info h3 a]||price[.product_price .product_multiprice div:nth-child(4)]||content[.product_info .product_s_desc]||source_link[a.product_flypage[href]]', 'false', NOW(), NOW()),
(12, 'Lucky pizza item schema', '0', 1, 'title[h3 a]||price[.price-table a.price-small span.price]||content[p.product-desc ]||source_link[h3 a[href]]||size[.price-table a.price-small span]', 'false', NOW(), NOW()),
(16, 'Pizza Monster item schema', '32', 1, 'title[h3]||price[.pizzaBoxFooter span span]||content[.pizzaOptions]', 'false', NOW(), NOW()),
(17, 'Pizzatorony item schema', '30', 1, 'title[h1.product_name]||price[h1.product_price span]||content[p]', 'false', NOW(), NOW()),
(18, 'Rustica item schema', '32', 1, 'title[.description h3]||price[span.price]||content[.description .topping]', 'false', NOW(), NOW()),
(19, 'Turbo pizza item schema', '32', 1, 'title[.caption h4]||price[.price p]||content[.caption p]||source_link[.caption h4 a[href]]', 'false', NOW(), NOW()),
(20, 'Zed slice item schema', '32', 1, 'title[.description h3]||size[.subcategories form .subcategory label]||price[.price]||content[.description p]', 'false', NOW(), NOW()),
(21, 'Don Quijote item schema', '32', 1, 'title[a h3]||price[div:nth-child(2) a:nth-child(3) div:nth-child(2)]||content[a div p]||source_link[a[href]]', 'false', NOW(), NOW()),
(22, 'Pizza Margaréta item schema', '32', 1, 'title[.list_prouctname]||price[.list_prouctprice span]||source_link[.list_prouctname a[href]]', 'tr.product-short-description-row p span span span', NOW(), NOW()),
(23, 'Bella italia item schema', '32', 1, 'title[.listBody16 div]||content[.listBody16 .ingredients3]||price[td:nth-child(3)]', 'false', NOW(), NOW()),
(24, 'pizza király item schema', '32', 1, 'title[.caption .name a]||price[.product-option-wrap .col-sm-12 div div:nth-child(3) label div]||source_link[.caption .name a[href]]', '.tab-content .tab-pane ul', NOW(), NOW()),
(25, 'La Rose item schema', '26', 1, 'title[a h3]||price[.price div span]||content[a div p]||source_link[a[href]]', 'false', NOW(), NOW()),
(26, 'Bányai cukrászda item schema', '26', 1, 'title[td:nth-child(1)]||price[td:nth-child(3)]', 'false', NOW(), NOW()),
(27, 'Troja item schema', '0', 1, 'title[td p strong]||content[td p span]||price[td h2]', 'false', NOW(), NOW());
