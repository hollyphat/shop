CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'hollyphat', 'hacker');

CREATE TABLE IF NOT EXISTS `carttemp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sess` char(50) NOT NULL,
  `invId` char(5) NOT NULL,
  `qty` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sess` (`sess`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Book Music and Videos'),
(2, 'Computers'),
(1, 'Electronics'),
(4, 'Fashions'),
(5, 'Home and Offices'),
(7, 'Jobs'),
(3, 'Phones and Tablet');

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `City` varchar(15) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `customer` (`id`, `UserId`, `Password`, `FirstName`, `LastName`, `Address`, `City`, `Zip`, `State`, `Email`, `Phone`) VALUES
(1, 'hollyfat', 'nigeria', 'Olatunji', 'Fatai', 'No 2 lawole street osogbo', 'Osogbo', '231230', 'Osun', 'sirhollyfat@gmail.com', '08130327697'),
(2, 'Neyodhino', '6494222', 'Awofisayo', 'Olaniyi', 'royal priesthood', 'ile ife', '232321', 'Osun', 'neyodhino@yahoo.com', '08168456790');

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `InvName` varchar(150) NOT NULL,
  `InvDescription` text NOT NULL,
  `category` varchar(5) NOT NULL,
  `InvPrice` decimal(10,2) NOT NULL,
  `img` varchar(150) NOT NULL,
  `DateAdded` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `inventory` (`id`, `InvName`, `InvDescription`, `category`, `InvPrice`, `img`, `DateAdded`) VALUES
(1, 'Anne Klein Sleeveless Colorblock Scuba', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', '8500.00', '1436129891_gallery1.jpg', '2015-07-05'),
(2, 'Easy Polo Black Edition', 'The one and only garri from the koko master itself. \r\nEja NlaThe one and only garri from the koko master itself. \r\nEja NlaThe one and only garri from the koko master itself. \r\nEja NlaThe one and only garri from the koko master itself. \r\nEja NlaThe one and only garri from the koko master itself. Eja Nla', '6', '2507.00', '1436158234_girl1.jpg', '2015-07-06'),
(3, 'Web Design and development', 'Create a new website for your product, business, church or mosque for a low price\r\nCreate a new website for your product, business, church or mosque for a low price\r\nCreate a new website for your product, business, church or mosque for a low price\r\nCreate a new website for your product, business, church or mosque for a low price', '2', '4623.00', '1436158471_gallery2.jpg', '2015-07-06'),
(4, 'CBA logo t-shirt', 'This T-shirt will show off your CBA connection. Our t-shirts are high quality and 100% preshrunk cotton.\r\nThis T-shirt will show off your CBA connection. Our t-shirts are high quality and 100% preshrunk cotton.', '4', '4858.87', '', '2015-07-06'),
(5, 'Intensive English For Primary 6', 'Get the new Intensive English For Primary 6 at afforable rate from naijacampus store\r\nGet the new Intensive English For Primary 6 at afforable rate from naijacampus store', '6', '245.78', '', '2015-07-06'),
(6, 'Intensive English For Primary 6', 'Get the new Intensive English For Primary 6 at afforable rate from naijacampus store\r\nGet the new Intensive English For Primary 6 at afforable rate from naijacampus store', '6', '245.78', '', '2015-07-06'),
(7, 'Testing purpose only', 'This is only for testing purpose, hope it works', '2', '548.00', '', '2015-07-15');

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `qty` int(3) NOT NULL,
  `prodnum` varchar(5) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `orders` (`id`, `qty`, `prodnum`, `orderid`) VALUES
(1, 6, '5', 1),
(2, 2, '4', 2),
(3, 2, '3', 3),
(4, 2, '5', 3),
(5, 2, '4', 4),
(6, 2, '2', 4),
(7, 7, '2', 5),
(8, 3, '3', 5),
(9, 2, '3', 6),
(10, 1, '4', 7),
(11, 8, '7', 8),
(12, 8, '7', 9),
(13, 4, '5', 10);

CREATE TABLE IF NOT EXISTS `order_details` (
  `OrderId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(10) NOT NULL,
  `total` varchar(25) NOT NULL,
  `rname` varchar(60) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `DateAdded` varchar(25) NOT NULL,
  PRIMARY KEY (`OrderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `order_details` (`OrderId`, `UserId`, `total`, `rname`, `Address`, `DateAdded`) VALUES
(1, '1', '1474.68', 'Mr java', 'Atapara road Ede, Osun state', '1436959149'),
(2, '1', '9717.74', 'hollyfat', 'No 2 lawole street osogbo', '1436959355'),
(3, '1', '9737.56', 'Soviat', 'Agable ede', '1436977385'),
(4, '1', '14731.74', 'Abiodun', 'No 2 lawole osogbo', '1436999955'),
(5, '1', '31418', 'hollyfat', 'No 2 lawole street osogbo', '1437001869'),
(6, '1', '9246', 'hollyfat', 'No 2 lawole street osogbo', '1437001962'),
(7, '1', '4858.87', 'hollyfat', 'No 2 lawole street osogbo', '1437002036'),
(8, '1', '4384', 'hollyfat', 'No 2 lawole street osogbo', '1437002172'),
(9, '1', '4384', 'hollyfat', 'No 2 lawole street osogbo', '1437002251'),
(10, '1', '983.12', 'hollyfat', 'No 2 lawole street osogbo', '1437014416');

CREATE TABLE IF NOT EXISTS `shopping_cart_items` (
  `ShoppingCartId` int(11) NOT NULL AUTO_INCREMENT,
  `InventoryId` varchar(10) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Date` varchar(25) NOT NULL,
  `UserId` int(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`ShoppingCartId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
