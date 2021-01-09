--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`) VALUES
(1, 'John', 'Dow'),
(2, 'Walter', 'White'),
(3, 'John', 'Snow');

-- --------------------------------------------------------

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `status`, `price`, `created_at`) VALUES
(1, 1, 'processing', 14.00, '2019-09-02 17:02:53'),
(2, 1, 'processing', 40.00, '2019-09-02 18:23:32'),
(3, 2, 'processing', 120.00, '2019-09-04 10:32:51'),
(4, 3, 'canceled', 14.00, '2019-09-05 08:54:22');

-- --------------------------------------------------------

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `price`) VALUES
(1, 'ref1', 'Product 1', 14.00),
(2, 'ref2', 'Product 2', 10.00),
(3, 'ref3', 'Product 3', 15.00),
(4, 'ref4', 'Product 4', 20.00);

-- --------------------------------------------------------

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`id`, `product_id`, `order_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 2, 2),
(4, 2, 3, 10),
(5, 4, 3, 1),
(6, 1, 4, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'admin', '[]', '$argon2id$v=19$m=65536,t=4,p=1$1JNla9TQUCv0CMYltptSLw$J0ssXnJdnJPZt+0c9ulhQSQnIpz+ih6pm54vB2Hgfwg');

-- --------------------------------------------------------