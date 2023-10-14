-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 30, 2023 at 05:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doanweb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAbortOrder` (IN `shopId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN product
ON billdetail.IdProduct = product.Id
WHERE billdetail.Status = 5 AND product.user_id = shopId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAccountAddress` (IN `MemberId` INT)   SELECT address.Id as AddressId, member.Name, member.Phone, address.Name as AddressName, address.Status 
FROM member 
join address
on member.Id = address.MemberId
where member.Id = MemberId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAccountBalance` (IN `userid` INT)   SELECT AccountBalance
FROM member
where member.Id = userid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAccountDetail` (IN `memberIdParam` INT)   SELECT *, 
            (
            SELECT Name
            FROM Address
            WHERE MemberId = memberIdParam and Status = 1
            ) AS Address
            FROM member              
            where member.Id = memberIdParam$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getBanner` ()   SELECT banner.Id as BannerId,banner.BannerName as Name, banner.BannerPath as Picture
FROM banner$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCarrier` (IN `userId` INT)   SELECT 	carrier.id,
		carrier.name
FROM carrier
JOIN shopcarrier
ON carrier.id != shopcarrier.IdCarrier
WHERE shopcarrier.IdShop = userId AND carrier.carrierstatus = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCarrierInfo` ()   BEGIN
    SELECT carrier.id, carrier.name, carrier.address, carrier.phone, carrier.email
    FROM carrier
    WHERE carrier.carrierstatus = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCartDetail` (IN `memberId` INT)   SELECT cartdetail.Id as CartDetailId, 
	   product.Id as ProductId ,
       product.Name as Name, 
       cartdetail.Quantity as Quantity, 
       cartdetail.Price as Price,
       (
           SELECT ImgProductPath
           FROM imageproduct
           WHERE ProductId = product.Id
           LIMIT 1
       ) AS Pic
FROM cart
join cartdetail
on cart.Id = cartdetail.CartId
join product
on cartdetail.ProductId = product.Id
WHERE cart.Status = 0 and cart.member_id = memberId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCategory` ()   SELECT categoryproduct.Id, categoryproduct.Name
FROM categoryproduct$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getConfirmOrder` (IN `shopId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN product
ON billdetail.IdProduct = product.Id
WHERE billdetail.Status = 2 AND product.user_id = shopId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCountActiveNotification` ()   SELECT COUNT(*) as Count
FROM notification
WHERE Status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerAbortOrder` (IN `userId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
WHERE billdetail.Status = 5 AND bill.IdMember = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerConfirmOrder` (IN `userId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity,
                paymentmethod.Name as PaymentMethod
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN paymentmethod
ON bill.PaymentMethod = paymentmethod.ID
WHERE billdetail.Status = 2 AND bill.IdMember = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerDeliveryOrderSuccess` (IN `userId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
WHERE billdetail.Status = 4 AND bill.IdMember = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerNewOrder` (IN `userId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity,
                paymentmethod.Name as PaymentMethod
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN paymentmethod
on bill.PaymentMethod = paymentmethod.ID
WHERE billdetail.Status = 1 AND bill.IdMember = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCustomerPreDeliveryOrder` (IN `userId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
WHERE billdetail.Status = 3 AND bill.IdMember = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartDayProduct` (IN `memberId` INT, IN `FromDate` DATE, IN `ToDate` DATE)   SELECT DATE_FORMAT(A.Date, '%d-%m') as Date,  A.Name, A.ToTalProduct 
FROM 
(SELECT DATE(bill.create_at) as Date, product.Name, SUM(billdetail.Quantity) as ToTalProduct
from  bill
join billdetail
on bill.Id = billdetail.IdBill
join product
on product.Id = billdetail.IdProduct
WHERE product.user_id = memberId and billdetail.Status = 4
GROUP BY DATE(bill.create_at)) as A 
WHERE A.Date >= FromDate and A.Date <= ToDate$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartDayProductAdmin` (IN `FromDate` DATE, IN `ToDate` DATE)   SELECT DATE_FORMAT(A.Date, '%d-%m') as Date,  A.Name, A.ToTalProduct 
FROM 
(SELECT DATE(bill.create_at) as Date, product.Name, SUM(billdetail.Quantity) as ToTalProduct
from  bill
join billdetail
on bill.Id = billdetail.IdBill
join product
on product.Id = billdetail.IdProduct
WHERE billdetail.Status = 4
GROUP BY DATE(bill.create_at)) as A 
WHERE A.Date >= FromDate and A.Date <= ToDate$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartDayRevenue` (IN `memberId` INT, IN `FromDate` DATE, IN `ToDate` DATE)   SELECT DATE_FORMAT(A.Date, '%d-%m') as Date, A.TotalPrice 
FROM 
(SELECT DATE(bill.create_at) as Date ,Sum(bill.TotalPrice) as TotalPrice
 FROM bill 
 join billdetail
 on bill.Id = billdetail.IdBill 
 join product on billdetail.IdProduct = product.Id
 WHERE product.user_id = memberId and billdetail.Status = 4 
 GROUP BY DATE(bill.create_at)) as A 
  WHERE A.Date >= FromDate and A.Date <= ToDate$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartDayRevenueAdmin` (IN `FromDate` DATE, IN `ToDate` DATE)   SELECT DATE_FORMAT(A.Date, '%d-%m') as Date, A.TotalPrice 
FROM 
(SELECT DATE(webincome.Create_at) as Date ,Sum(webincome.Income) as TotalPrice
FROM webincome 
GROUP BY DATE(webincome.Create_at)) as A 
WHERE A.Date >= FromDate and A.Date <= ToDate$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartMonthProductUploadAdmin` (IN `YearValue` INT, IN `FromMonth` INT, IN `ToMonth` INT)   SELECT DATE_FORMAT(A.Date, '%Y-%m') as Date, A.Count 
FROM 
(SELECT DATE(product.Create_at) as Date ,COUNT(product.Id) as Count
 FROM product 
 GROUP BY YEAR(product.Create_at),MONTH(product.Create_at)) as A
WHERE YEAR(A.Date) = YearValue AND MONTH(A.Date) BETWEEN FromMonth AND ToMonth$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartMonthRevenue` (IN `memberId` INT, IN `YearValue` INT, IN `FromMonth` INT, IN `ToMonth` INT)   SELECT DATE_FORMAT(A.Date, '%Y-%m') as Date, A.TotalPrice 
FROM 
(SELECT DATE(billdetail.TimeSold) as Date , 0.95 * Sum(billdetail.Price * billdetail.Quantity) as TotalPrice
 FROM billdetail
 join product on billdetail.IdProduct = product.Id
 WHERE product.user_id = MemberId and billdetail.Status = 4 
 GROUP BY YEAR(billdetail.TimeSold), MONTH(billdetail.TimeSold)) as A
WHERE YEAR(A.Date) = YearValue AND MONTH(A.Date) BETWEEN FromMonth AND ToMonth$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartMonthRevenueAdmin` (IN `YearValue` INT, IN `FromMonth` INT, IN `ToMonth` INT)   SELECT DATE_FORMAT(A.Date, '%Y-%m') as Date, A.TotalPrice 
FROM 
(SELECT DATE(webincome.Create_at) as Date ,Sum(webincome.Income) as TotalPrice
 FROM webincome 
 GROUP BY YEAR(webincome.Create_at),MONTH(webincome.Create_at)) as A
WHERE YEAR(A.Date) = YearValue AND MONTH(A.Date) BETWEEN FromMonth AND ToMonth$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartStatusBill` (IN `memberId` INT)   SELECT billdetail.Status as Id, order_status.Status as Name ,Count(billdetail.Status) as Count 
FROM billdetail 
join product 
on product.Id = billdetail.IdProduct 
join order_status 
on billdetail.Status = order_status.Id 
WHERE product.user_id =  memberId
GROUP BY billdetail.Status
ORDER BY billdetail.Status$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartStatusBillAdmin` ()   SELECT billdetail.Status as Id, order_status.Status as Name ,Count(billdetail.Status) as Count 
FROM billdetail 
join product 
on product.Id = billdetail.IdProduct 
join order_status 
on billdetail.Status = order_status.Id 
GROUP BY billdetail.Status
ORDER BY billdetail.Status$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartTopProduct` (IN `memberId` INT)   SELECT product.Name, Sum(billdetail.Quantity) as TotalQuantity
from billdetail
join product
on billdetail.IdProduct = product.Id
WHERE product.user_id = memberId and billdetail.Status = 4
GROUP BY product.Id
LIMIT 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataChartTopProductAdmin` ()   SELECT product.Name, Sum(billdetail.Quantity) as TotalQuantity
from billdetail
join product
on billdetail.IdProduct = product.Id
WHERE billdetail.Status = 4
GROUP BY product.Id
LIMIT 100$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDefaultAddressById` (IN `user_id` INT)   Select address.ID, address.MemberId, address.Name,address.Status
From address
Where address.MemberId = user_id 
And address.status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDeliveryOrderSuccess` (IN `shopId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN product
ON billdetail.IdProduct = product.Id
WHERE billdetail.Status = 4 AND product.user_id = shopId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailOrder` (IN `orderID` INT)   SELECT	orderdetail.Id as ID,
		member.Name as CusName,
        orders.Address as Address,
        orderdetail.ProductName as ProductName,
        orderdetail.Price as Price,
        orderdetail.Quantity as Quantity
FROM orderdetail
JOIN orders 
ON orderdetail.IdOrder = orders.Id
JOIN member
on orders.IdMember = member.Id
WHERE orderdetail.IdOrder = orderID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getImageProductByProductId` (IN `user_id` INT)   BEGIN
   SELECT imageproduct.id AS ID, imageproduct.ImgProductPath AS Pic, imageproduct.ProductId AS ProductID, product.Name AS ProductName 
   FROM imageproduct
   JOIN product ON imageproduct.ProductId=product.Id
   WHERE product.user_id = user_id
   ORDER BY imageproduct.ProductId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLockedMemberInfo` ()   SELECT member.Id, member.Name, member.Phone, member.Username, member.AccountBalance,member.RoleId as Role
    FROM member
    WHERE member.userstatus = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMarketingProductForShop` (IN `memberId` INT)   SELECT marketingproduct.Id, product.Name as ProductName, marketing.Name as MarketingName, DATE_ADD(marketingproduct.Create_At, INTERVAL 30 DAY) AS ExpiryDate
FROM product
join marketingproduct
on product.Id = marketingproduct.ProductId
join marketing
on marketing.Id = marketingproduct.MarketingId
WHERE product.user_id = memberId AND marketingproduct.Status = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMemberInfo` ()   BEGIN
    SELECT member.Id, member.Name, member.Phone, member.Username, member.AccountBalance,member.RoleId as Role
    FROM member
    WHERE member.userstatus = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNewOrder` (IN `shopId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN product
ON billdetail.IdProduct = product.Id
WHERE billdetail.Status = 1 AND product.user_id = shopId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrders` (IN `userId` INT)   SELECT  billdetail.Id AS Id,
		billdetail.ProductName AS ProductName,
        billdetail.Price AS Price,
        billdetail.Quantity AS Quantity,
        bill.Address AS Address,
        bill.create_at AS Time
FROM billdetail
JOIN product
ON billdetail.IdProduct = product.Id
JOIN bill
ON billdetail.IdBill = bill.Id
WHERE product.user_id = userId AND billdetail.Status = 2 AND billdetail.IdCarrier IS NULL$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOtherAddressById` (IN `user_id` INT)   Select address.ID, address.MemberId, address.Name,address.Status
From address
Where address.MemberId = user_id 
And address.status = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPaymentMethodOfBill` (IN `billdetailId` INT)   SELECT 	bill.IdMember as Id,
		billdetail.Price as Price
FROM bill
JOIN billdetail
ON bill.Id = billdetail.IdBill
WHERE billdetail.Status = 5 AND bill.PaymentMethod = 1 AND billdetail.Id = billdetailId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPreDeliveryOrder` (IN `shopId` INT)   SELECT DISTINCT	billdetail.Id as ID,
				billdetail.ProductName as ProductName,
				member.Name as CusName,
        		bill.Address as Address,
        		bill.create_at as Time,
        		billdetail.Price as Price,
        		billdetail.Quantity as Quantity
FROM billdetail
JOIN bill 
ON billdetail.IdBill = bill.Id
JOIN member 
ON bill.IdMember = member.Id
JOIN product
ON billdetail.IdProduct = product.Id
WHERE billdetail.Status = 3 AND product.user_id = shopId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProduct` ()   BEGIN
    SELECT product.Id, product.Name, product.Price, product.QuantityInStock, product.Description,categoryproduct.Name as CategoryName, member.Name as ShopName
    FROM product
    JOIN categoryproduct 
    ON product.CategoryId = categoryproduct.Id
JOIN member
    ON product.user_id= member.Id
    WHERE product.deleted = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductByUserId` (IN `user_id` INT)   BEGIN
    SELECT product.Id, product.Name, product.Price, product.QuantityInStock, product.Description,categoryproduct.Name as CategoryName
    FROM product
    JOIN categoryproduct 
    ON product.CategoryId = categoryproduct.Id
    WHERE product.user_id = user_id AND product.deleted = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetQuantityCartDetail` (IN `MemberId` INT)   SELECT Count(cartdetail.ProductId) as Count  FROM cart
join cartdetail
on cart.Id = cartdetail.CartId
join product
on cartdetail.ProductId = product.Id
WHERE cart.Status = 0 and cart.member_id = MemberId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getShopCarrier` (IN `userId` INT)   SELECT 	shopcarrier.Id as Id,
		carrier.name as Name,
        carrier.Price as Price
FROM shopcarrier
JOIN carrier
ON carrier.id = shopcarrier.IdCarrier
WHERE shopcarrier.IdShop = userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTotalMonthComment` ()   SELECT COUNT(Id) AS Count
    FROM comment
    WHERE YEAR(Create_at) = YEAR(CURDATE()) AND MONTH(Create_at) = MONTH(CURDATE())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTotalMonthProductSold` ()   SELECT COUNT(Id) AS Count
    FROM billdetail
    WHERE Status = 4 and YEAR(TimeSold) = YEAR(CURDATE()) AND MONTH(TimeSold) = MONTH(CURDATE())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTotalMonthProductUpload` ()   SELECT COUNT(Id) AS Count
    FROM product
    WHERE YEAR(Create_at) = YEAR(CURDATE()) AND MONTH(Create_at) = MONTH(CURDATE())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTotalMonthRating` ()   SELECT COUNT(Id) AS Count
    FROM rating
    WHERE YEAR(Create_at) = YEAR(CURDATE()) AND MONTH(Create_at) = MONTH(CURDATE())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTotalMonthWebIncome` ()   SELECT SUM(Income) AS Total
    FROM webincome
    WHERE YEAR(Create_at) = YEAR(CURDATE()) AND MONTH(create_at) = MONTH(CURDATE())$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `ID` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`ID`, `MemberId`, `Name`, `Status`) VALUES
(1, 2, 'Đức Giang, Long Biên, Hà Nội', 1),
(2, 1, 'Long Biên, Hà Nội', 0),
(3, 3, 'Đức Giang, Long Biên, Hà Nội', 1),
(4, 4, 'Đức Giang, Long Biên, Hà Nội', 1),
(5, 7, 'Ngọc Lâm', 1),
(6, 1, 'Ngọc Lâm, Long Biên, Hà Nội', 1),
(7, 1, 'Hoàng Mai', 0),
(8, 10, 'LB', 1),
(9, 11, 'Viet Nam', 1),
(10, 12, 'Viet Nam', 1),
(11, 1, 'Hai Bà Trưng, Hà Nội', 0),
(12, 13, 'Long Biên, Hà Nội', 0),
(13, 13, 'Hà Nội', 1),
(14, 14, 'Hà Nội', 1),
(15, 15, 'Hà Nội', 1),
(16, 16, 'Cupertino, California, Hoa Kỳ', 1),
(17, 17, 'Hoa Kỳ', 1),
(18, 18, 'Hà Nội', 1),
(19, 19, 'Nhật Bản', 1),
(20, 20, 'Hoa Kỳ', 1),
(21, 21, 'Hoa Kỳ', 1),
(22, 22, 'Italia', 1),
(23, 23, 'Hoa Kỳ', 1),
(24, 24, 'Hoa Kỳ', 1),
(25, 1, 'VN', 0),
(26, 1, 'Vn 2', 0),
(27, 1, 'VN 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `Id` int(11) NOT NULL,
  `BannerPath` varchar(255) NOT NULL,
  `BannerName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`Id`, `BannerPath`, `BannerName`) VALUES
(3, 'Banner-1684639393.jpg', 'Banner 2'),
(4, 'Banner-1684692037.webp', 'Banner 1'),
(8, 'Banner-1688029171.jpg', 'Banner 3');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `Id` int(11) NOT NULL,
  `IdMember` int(11) DEFAULT NULL,
  `PaymentMethod` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `TotalPrice` int(11) DEFAULT NULL,
  `Address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`Id`, `IdMember`, `PaymentMethod`, `create_at`, `TotalPrice`, `Address`) VALUES
(132, 1, 1, '2023-05-13 06:54:00', 200000, 'Đức Giang, Long Biên, Hà Nội'),
(133, 1, 1, '2023-05-13 06:56:53', 200000, 'Đức Giang, Long Biên, Hà Nội'),
(134, 1, 1, '2023-05-13 07:12:50', 200000, 'Đức Giang, Long Biên, Hà Nội'),
(135, 1, 1, '2023-05-13 07:21:10', 200000, 'Đức Giang, Long Biên, Hà Nội'),
(136, 1, 2, '2023-05-13 07:22:14', 200000, 'Đức Giang, Long Biên, Hà Nội'),
(137, 1, 2, '2023-05-14 07:33:36', 1055555, 'Ngọc Lâm, Long Biên, Hà Nội'),
(138, 1, 2, '2023-05-15 07:43:01', 3200000, 'Đức Giang, Long Biên, Hà Nội'),
(139, 1, 2, '2023-05-25 08:19:54', 3000000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(140, 1, 2, '2023-05-26 01:24:53', 3200000, 'Hoàng Mai'),
(141, 1, 2, '2023-05-28 06:20:14', 3400000, 'Long Biên, Hà Nội'),
(142, 1, 2, '2023-05-28 06:25:01', 3000000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(143, 1, 2, '2023-05-28 06:26:03', 3000000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(144, 1, 2, '2023-05-28 06:26:37', 9999999, 'Ngọc Lâm, Long Biên, Hà Nội'),
(145, 1, 1, '2023-05-28 06:28:23', 3000000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(146, 4, 2, '2023-05-28 08:09:46', 10000, 'Đức Giang, Long Biên, Hà Nội'),
(147, 4, 2, '2023-05-28 09:02:35', 500000, 'Đức Giang, Long Biên, Hà Nội'),
(148, 1, 2, '2023-05-28 21:12:02', 210000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(149, 1, 2, '2023-05-30 20:39:54', 4365555, 'Ngọc Lâm, Long Biên, Hà Nội'),
(150, 1, 2, '2023-05-30 20:40:40', 14365554, 'Ngọc Lâm, Long Biên, Hà Nội'),
(151, 1, 2, '2023-06-26 09:01:56', 1455555, 'Ngọc Lâm, Long Biên, Hà Nội'),
(152, 1, 1, '2023-06-28 05:11:19', 9999999, 'Ngọc Lâm, Long Biên, Hà Nội'),
(153, 13, 2, '2023-06-28 20:57:08', 15999999, 'Hà Nội'),
(154, 13, 1, '2023-06-28 20:58:14', 200000, 'Hà Nội'),
(155, 13, 2, '2023-06-28 21:08:38', 3000000, 'Hà Nội'),
(156, 13, 1, '2023-06-28 21:11:58', 9999999, 'Hà Nội'),
(157, 13, 1, '2023-06-28 21:13:13', 9999999, 'Hà Nội'),
(158, 1, 1, '2023-06-29 08:22:52', 43000000, 'Ngọc Lâm, Long Biên, Hà Nội'),
(159, 13, 1, '2023-06-29 08:27:20', 48000000, 'Hà Nội'),
(160, 13, 1, '2023-06-29 08:36:31', 3500000, 'Hà Nội'),
(161, 13, 1, '2023-06-29 08:38:24', 700000, 'Hà Nội'),
(162, 1, 2, '2023-06-29 19:37:32', 25200000, 'Hoàng Mai'),
(163, 1, 1, '2023-06-30 08:03:54', 25000000, 'Ngọc Lâm, Long Biên, Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `billdetail`
--

CREATE TABLE `billdetail` (
  `Id` int(11) NOT NULL,
  `IdBill` int(11) DEFAULT NULL,
  `IdCarrier` int(11) DEFAULT NULL,
  `ProductName` varchar(50) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `IdProduct` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `IdReasonAbort` int(11) DEFAULT NULL,
  `TimeSold` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billdetail`
--

INSERT INTO `billdetail` (`Id`, `IdBill`, `IdCarrier`, `ProductName`, `Price`, `Quantity`, `IdProduct`, `Status`, `IdReasonAbort`, `TimeSold`) VALUES
(289, 132, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-05-01 14:24:18'),
(290, 133, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 5, NULL, NULL),
(291, 134, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 5, NULL, NULL),
(292, 135, 5, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-06-29 04:03:00'),
(293, 136, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 5, NULL, NULL),
(294, 137, NULL, 'Đồng Hồ MCK', 500000, 1, 25, 4, NULL, '2023-05-01 14:24:18'),
(295, 137, NULL, 'Đồng hồ x100', 555555, 1, 24, 5, NULL, NULL),
(296, 138, 2, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-05-01 14:24:18'),
(297, 138, 4, 'Samsung Galaxy SS4', 3000000, 1, 22, 4, NULL, '2023-05-01 14:24:18'),
(298, 139, NULL, 'Samsung Galaxy SS4', 3000000, 1, 22, 5, NULL, NULL),
(299, 140, 2, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-05-01 14:24:18'),
(300, 140, 4, 'Samsung Galaxy SS4', 3000000, 1, 22, 4, NULL, '2023-05-08 14:24:18'),
(301, 141, 1, 'Áo phông Xanh cây', 200000, 2, 20, 4, NULL, '2023-05-01 14:24:18'),
(302, 141, NULL, 'Samsung Galaxy SS4', 3000000, 1, 22, 5, NULL, NULL),
(303, 142, NULL, 'Samsung Galaxy SS4', 3000000, 1, 22, 5, NULL, NULL),
(304, 143, NULL, 'Samsung Galaxy SS4', 3000000, 1, 22, 5, NULL, NULL),
(305, 144, NULL, 'Iphone 13 Pro Max', 9999999, 1, 23, 5, NULL, NULL),
(306, 145, NULL, 'Samsung Galaxy SS4', 3000000, 1, 22, 5, NULL, NULL),
(307, 146, 1, 'test', 10000, 1, 34, 6, 1, NULL),
(308, 147, 1, 'Áo Phao vàng', 500000, 1, 26, 6, 1, NULL),
(309, 148, 1, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-05-29 04:52:10'),
(310, 148, 1, 'test', 10000, 1, 34, 4, NULL, '2023-05-29 04:52:13'),
(311, 149, 1, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-06-03 15:05:20'),
(312, 149, 1, 'Đồng hồ x100', 555555, 1, 24, 6, 1, NULL),
(313, 149, 1, 'Áo Phao vàng', 500000, 1, 26, 4, NULL, '2023-06-03 15:19:47'),
(314, 149, 1, 'Samsung Galaxy SS4', 3000000, 1, 22, 4, NULL, '2023-06-05 13:32:06'),
(315, 149, 1, 'Test 2', 100000, 1, 35, 4, NULL, '2023-06-29 04:03:01'),
(316, 149, 1, 'test', 10000, 1, 34, 4, NULL, '2023-06-29 04:03:03'),
(317, 150, 1, 'Áo phông Xanh cây', 200000, 1, 20, 4, NULL, '2023-06-29 04:03:04'),
(318, 150, 1, 'Samsung Galaxy SS4', 3000000, 1, 22, 4, NULL, '2023-06-29 04:03:06'),
(319, 150, 1, 'Iphone 13 Pro Max', 9999999, 1, 23, 4, NULL, '2023-06-29 04:03:07'),
(320, 150, 1, 'Áo Phao vàng', 500000, 1, 26, 4, NULL, '2023-06-29 04:03:09'),
(321, 150, 1, 'Đồng hồ x100', 555555, 1, 24, 4, NULL, '2023-06-29 04:03:10'),
(322, 150, 1, 'test', 10000, 1, 34, 4, NULL, '2023-06-29 04:03:18'),
(323, 150, 1, 'Test 2', 100000, 0, 35, 6, 1, NULL),
(324, 151, NULL, 'Đồng hồ x100', 555555, 1, 24, 5, NULL, NULL),
(325, 151, NULL, 'Áo Phao vàng', 500000, 1, 26, 5, NULL, NULL),
(326, 151, NULL, 'Áo phông Xanh cây', 200000, 2, 20, 5, NULL, NULL),
(327, 152, 1, 'Iphone 13 Pro Max', 9999999, 1, 23, 4, NULL, '2023-06-28 12:12:32'),
(328, 153, NULL, 'Iphone 13 Pro Max', 9999999, 1, 23, 5, NULL, NULL),
(329, 153, 1, 'Samsung Galaxy SS4', 3000000, 2, 22, 4, NULL, '2023-06-29 04:02:52'),
(330, 154, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 5, NULL, NULL),
(331, 155, 2, 'Samsung Galaxy SS4', 3000000, 1, 22, 4, NULL, '2023-06-29 04:11:31'),
(332, 156, NULL, 'Iphone 13 Pro Max', 9999999, 1, 23, 5, NULL, NULL),
(333, 157, NULL, 'Iphone 13 Pro Max', 9999999, 1, 23, 5, NULL, NULL),
(334, 158, 1, 'iPhone 14 Pro Max', 25000000, 1, 81, 4, NULL, '2023-06-29 15:23:37'),
(335, 158, 1, 'Apple AirPods Pro 2022', 3000000, 1, 78, 4, NULL, '2023-06-29 15:23:38'),
(336, 158, 1, 'Màn hình Asus ROG Swift PG48UQ', 15000000, 1, 65, 4, NULL, '2023-06-29 15:25:36'),
(337, 159, 1, 'iPhone 14 Pro Max', 25000000, 1, 81, 4, NULL, '2023-06-29 15:37:31'),
(338, 159, 1, 'Apple AirPods Pro 2022', 3000000, 1, 78, 4, NULL, '2023-06-29 15:37:30'),
(339, 159, 1, 'Màn hình Asus ROG Swift PG48UQ', 15000000, 1, 65, 4, NULL, '2023-06-29 15:28:03'),
(340, 159, NULL, 'Jumpman MVP', 5000000, 1, 51, 1, NULL, NULL),
(341, 160, 1, 'Apple HomePod Mini', 2500000, 1, 80, 4, NULL, '2023-06-29 15:37:33'),
(342, 160, 1, 'Apple Magic Keyboard', 1000000, 1, 83, 4, NULL, '2023-06-29 15:37:34'),
(343, 161, 1, 'Apple AirTag', 700000, 1, 82, 4, NULL, '2023-06-29 15:38:52'),
(344, 162, NULL, 'iPhone 14 Pro Max', 25000000, 1, 81, 1, NULL, NULL),
(345, 162, NULL, 'Áo phông Xanh cây', 200000, 1, 20, 2, NULL, NULL),
(346, 163, NULL, 'iPhone 14 Pro Max', 25000000, 1, 81, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `carrierstatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `address`, `phone`, `email`, `carrierstatus`) VALUES
(1, 'DHL', '123 Main St, New York, NY', '555-1234', 'info@dhl.com', 1),
(2, 'FedEx', '456 Elm St, Los Angeles, CA', '555-5678', 'info@fedex.com', 1),
(3, 'UPS', '789 Oak St, Chicago, IL', '555-9012', 'info@ups.com', 1),
(4, 'USPS', '101 Pine St, San Francisco, CA', '555-3456', 'info@usps.com', 0),
(5, 'Amazon Logistics', '1000 Maple St, Seattle, WA', '555-7890', 'info@amazon.com', 1),
(6, 'Shopee', 'Ha Noi, Viet Nam', '012345678910', 'info@shopee.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `AddressId` int(11) DEFAULT NULL,
  `PaymentMethodId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Id`, `member_id`, `create_at`, `Status`, `AddressId`, `PaymentMethodId`) VALUES
(70, 1, '2023-05-13 00:00:00', 1, 2, 1),
(71, 1, '2023-05-13 00:00:00', 1, 2, 1),
(72, 1, '2023-05-13 00:00:00', 1, 2, 2),
(73, 1, '2023-05-13 00:00:00', 1, 2, 1),
(74, 1, '2023-05-13 00:00:00', 1, 2, 2),
(75, 1, '2023-05-14 00:00:00', 1, 6, 2),
(76, 1, '2023-05-15 00:00:00', 1, 2, 2),
(77, 1, '2023-05-22 00:00:00', 1, 6, 2),
(78, 1, '2023-05-26 00:00:00', 1, 7, 2),
(79, 1, '2023-05-28 00:00:00', 1, 2, 2),
(80, 1, '2023-05-28 00:00:00', 1, 6, 2),
(81, 1, '2023-05-28 00:00:00', 1, 6, 2),
(82, 1, '2023-05-28 00:00:00', 1, 6, 2),
(83, 1, '2023-05-28 00:00:00', 1, 6, 1),
(84, 4, '2023-05-28 00:00:00', 1, 4, 2),
(85, 4, '2023-05-28 00:00:00', 1, 4, 2),
(86, 1, '2023-05-29 00:00:00', 1, 6, 2),
(87, 1, '2023-05-31 00:00:00', 1, 6, 2),
(88, 1, '2023-05-31 00:00:00', 1, 6, 2),
(89, 1, '2023-06-07 00:00:00', 1, 6, 2),
(90, 1, '2023-06-28 00:00:00', 1, 6, 1),
(91, 13, '2023-06-29 00:00:00', 1, 13, 2),
(92, 13, '2023-06-29 00:00:00', 1, 13, 1),
(93, 13, '2023-06-29 00:00:00', 1, 13, 2),
(94, 13, '2023-06-29 00:00:00', 1, 13, 1),
(95, 13, '2023-06-29 00:00:00', 1, 13, 1),
(96, 13, '2023-06-29 00:00:00', 1, 13, 1),
(97, 1, '2023-06-29 00:00:00', 1, 6, 1),
(98, 13, '2023-06-29 00:00:00', 1, 13, 1),
(99, 13, '2023-06-29 00:00:00', 1, 13, 1),
(100, 1, '2023-06-30 00:00:00', 1, 7, 2),
(101, 1, '2023-06-30 00:00:00', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartdetail`
--

CREATE TABLE `cartdetail` (
  `Id` int(11) NOT NULL,
  `CartId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartdetail`
--

INSERT INTO `cartdetail` (`Id`, `CartId`, `ProductId`, `Quantity`, `Price`) VALUES
(112, 70, 20, 1, 200000),
(113, 71, 20, 1, 200000),
(114, 72, 20, 1, 200000),
(115, 73, 20, 1, 200000),
(116, 74, 20, 1, 200000),
(117, 75, 25, 1, 500000),
(118, 75, 24, 1, 555555),
(119, 76, 20, 1, 200000),
(120, 76, 22, 1, 3000000),
(121, 77, 22, 1, 3000000),
(122, 78, 20, 1, 200000),
(123, 78, 22, 1, 3000000),
(124, 79, 20, 2, 200000),
(125, 79, 22, 1, 3000000),
(126, 80, 22, 1, 3000000),
(127, 81, 22, 1, 3000000),
(128, 82, 23, 1, 9999999),
(129, 83, 22, 1, 3000000),
(130, 84, 34, 1, 10000),
(131, 85, 26, 1, 500000),
(132, 86, 20, 1, 200000),
(133, 86, 34, 1, 10000),
(134, 87, 20, 1, 200000),
(135, 87, 24, 1, 555555),
(136, 87, 26, 1, 500000),
(137, 87, 22, 1, 3000000),
(138, 87, 35, 1, 100000),
(139, 87, 34, 1, 10000),
(140, 88, 20, 1, 200000),
(141, 88, 22, 1, 3000000),
(142, 88, 23, 1, 9999999),
(143, 88, 26, 1, 500000),
(144, 88, 24, 1, 555555),
(145, 88, 34, 1, 10000),
(146, 88, 35, 1, 100000),
(147, 89, 24, 1, 555555),
(148, 89, 26, 1, 500000),
(149, 89, 20, 2, 200000),
(150, 90, 23, 1, 9999999),
(151, 91, 23, 1, 9999999),
(153, 91, 22, 2, 3000000),
(154, 92, 20, 1, 200000),
(155, 93, 22, 1, 3000000),
(156, 94, 23, 1, 9999999),
(157, 95, 23, 1, 9999999),
(160, 97, 81, 1, 25000000),
(161, 97, 78, 1, 3000000),
(162, 97, 65, 1, 15000000),
(163, 96, 81, 1, 25000000),
(164, 96, 78, 1, 3000000),
(165, 96, 65, 1, 15000000),
(166, 96, 51, 1, 5000000),
(167, 98, 80, 1, 2500000),
(168, 98, 83, 1, 1000000),
(169, 99, 82, 1, 700000),
(170, 100, 81, 1, 25000000),
(171, 100, 20, 1, 200000),
(173, 101, 81, 1, 25000000);

-- --------------------------------------------------------

--
-- Table structure for table `categoryproduct`
--

CREATE TABLE `categoryproduct` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoryproduct`
--

INSERT INTO `categoryproduct` (`Id`, `Name`) VALUES
(1, 'Nội thất'),
(2, 'Thể thao'),
(3, 'Trang sức & Phụ kiện'),
(4, 'Máy ảnh & Máy quay phim'),
(5, 'Sức khỏe'),
(6, 'Đồ gia dụng'),
(7, 'Nhạc cụ'),
(8, 'Sách'),
(9, 'Đồ chơi'),
(10, 'Máy tính & Laptop'),
(11, 'Quần áo'),
(12, 'Giầy dép'),
(13, 'Đồ điện tử'),
(14, 'Dụng cụ'),
(15, 'Giáo dục'),
(16, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Create_at` datetime NOT NULL,
  `Content` varchar(500) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Id`, `MemberId`, `ProductId`, `Create_at`, `Content`, `deleted`) VALUES
(1, 7, 26, '2023-05-06 00:00:00', 'Hàng đẹp', 0),
(2, 7, 26, '2023-05-07 00:00:00', 'Đẹp tuyệt vời !!!', 0),
(3, 7, 25, '2023-05-07 00:00:00', 'Đồng hồ đẹp quá', 1),
(4, 7, 25, '2023-05-07 00:00:00', 'Tuyệt vời !!!', 0),
(5, 8, 26, '2023-05-07 00:00:00', 'Áo phao mặc hơi nóng nhưng mặc vào cảm giác vjp pro', 1),
(6, 9, 26, '2023-05-07 00:00:00', 'Áo cũng đẹp đấy', 1),
(7, 1, 20, '2023-06-26 23:03:05', 'ghe ghe', 1),
(8, 1, 23, '2023-06-28 19:12:47', 'điện thoại tuyệt vời', 0),
(9, 1, 23, '2023-06-28 19:13:09', 'tôi đã mua 2 cái', 1),
(10, 13, 22, '2023-06-29 11:38:02', 'máy rẻ', 0),
(11, 13, 22, '2023-06-29 11:38:34', '4 sao', 0),
(12, 1, 81, '2023-06-29 22:24:11', 'máy dùng ổn và khá rẻ', 0),
(13, 1, 78, '2023-06-29 22:24:51', 'tai nghe apple < sony', 0),
(14, 1, 65, '2023-06-29 22:25:52', 'màn hình dùng tốt', 0),
(15, 13, 65, '2023-06-29 22:28:49', 'thuê mình PR để mở khóa 5*', 0),
(16, 13, 83, '2023-06-29 22:40:10', 'Đây không phải magic keyboard', 0),
(17, 13, 81, '2023-06-29 22:42:43', 'nhận máy free tại youtube.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `Id` int(11) NOT NULL,
  `Member_Id` int(11) DEFAULT NULL,
  `AmountMoney` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`Id`, `Member_Id`, `AmountMoney`) VALUES
(16, 1, 700000),
(17, 1, 300000),
(18, 7, 700000),
(19, NULL, 10000),
(20, NULL, 10000),
(21, 1, 10000),
(22, NULL, 100000),
(23, NULL, 100000),
(24, NULL, 10000),
(25, 1, 10000),
(26, 13, 100000000),
(27, 2, 100000000),
(28, 13, 100000000),
(29, 13, 100000000),
(30, 2, 100000000),
(31, 24, 100000000),
(32, 21, 100000000),
(33, 21, 100000000),
(34, 21, 100000000),
(35, 16, 100000000);

--
-- Triggers `deposit`
--
DELIMITER $$
CREATE TRIGGER `tg_UpdateAccountBalance` AFTER INSERT ON `deposit` FOR EACH ROW BEGIN
-- statements
    DECLARE Member_Id INT;
    DECLARE AmountMoney INT; 
    DECLARE AccountBalanceUpdate INT;
    SET Member_Id = NEW.Member_Id;
    SET AmountMoney = NEW.AmountMoney;
    SET AccountBalanceUpdate = (SELECT AccountBalance FROM member WHERE Id = Member_Id);
    SET AccountBalanceUpdate = AccountBalanceUpdate + AmountMoney;
    UPDATE member SET AccountBalance = AccountBalanceUpdate WHERE Id = Member_Id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `imageproduct`
--

CREATE TABLE `imageproduct` (
  `Id` int(11) NOT NULL,
  `ImgProductPath` varchar(500) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imageproduct`
--

INSERT INTO `imageproduct` (`Id`, `ImgProductPath`, `ProductId`, `Status`) VALUES
(20, 'imageProduct-1682240192-2.webp', 20, 1),
(21, 'imageProduct-1682240428-2.webp', 21, 1),
(22, 'imageProduct-1682240553-2.webp', 22, 1),
(23, 'imageProduct-1682240583-2.webp', 23, 1),
(24, 'imageProduct-1682240607-2.webp', 24, 1),
(25, 'imageProduct-1682240646-2.webp', 25, 1),
(26, 'imageProduct-1682240666-2.webp', 26, 1),
(31, 'ImageProduct-1682351056-2.png', 20, 1),
(35, 'imageProduct-1683558894-10.jpg', 33, 1),
(38, 'imageProduct-1685337352-2.jpg', 35, 0),
(44, 'ImageProduct-1688019051-2.jpg', 37, 1),
(45, 'ImageProduct-1688019063-2.jpg', 37, 1),
(47, 'imageProduct-1688032105-14.jpg', 39, 1),
(48, 'ImageProduct-1688032164-14.jpg', 39, 1),
(49, 'imageProduct-1688033123-14.jpg', 40, 1),
(50, 'ImageProduct-1688033134-14.jpg', 39, 1),
(51, 'imageProduct-1688034041-14.jpg', 41, 1),
(52, 'ImageProduct-1688034055-14.jpg', 41, 1),
(53, 'imageProduct-1688035004-14.jpg', 42, 1),
(54, 'ImageProduct-1688035051-14.jpg', 42, 1),
(55, 'imageProduct-1688035522-15.jpg', 43, 1),
(56, 'ImageProduct-1688035533-15.jpg', 43, 1),
(57, 'imageProduct-1688035749-15.jpg', 44, 1),
(58, 'ImageProduct-1688035781-15.jpg', 44, 1),
(59, 'imageProduct-1688035946-15.jpg', 45, 1),
(60, 'ImageProduct-1688035968-15.jpg', 45, 1),
(61, 'imageProduct-1688036114-15.jpg', 46, 1),
(62, 'ImageProduct-1688036125-15.jpg', 46, 1),
(63, 'imageProduct-1688036405-15.jpg', 47, 1),
(64, 'ImageProduct-1688036414-15.jpg', 47, 1),
(65, 'imageProduct-1688037263-16.jpg', 48, 1),
(66, 'imageProduct-1688037371-16.jpg', 49, 1),
(67, 'ImageProduct-1688037384-16.jpg', 49, 1),
(68, 'imageProduct-1688037535-16.jpg', 50, 1),
(69, 'ImageProduct-1688037545-16.jpg', 50, 1),
(70, 'imageProduct-1688037678-16.webp', 51, 1),
(72, 'ImageProduct-1688037734-16.webp', 51, 1),
(73, 'imageProduct-1688038255-17.webp', 52, 1),
(74, 'ImageProduct-1688038263-17.webp', 52, 1),
(75, 'imageProduct-1688038469-17.jpg', 53, 1),
(76, 'ImageProduct-1688038483-17.jpg', 53, 1),
(77, 'imageProduct-1688038762-17.jpg', 54, 1),
(78, 'ImageProduct-1688038772-17.webp', 54, 1),
(79, 'imageProduct-1688040964-18.webp', 55, 1),
(80, 'ImageProduct-1688040973-18.webp', 55, 1),
(81, 'imageProduct-1688042102-18.webp', 56, 1),
(82, 'ImageProduct-1688042116-18.webp', 55, 1),
(83, 'imageProduct-1688042496-18.jpg', 57, 1),
(84, 'ImageProduct-1688042507-18.jpg', 57, 1),
(85, 'imageProduct-1688042845-18.jpg', 58, 1),
(86, 'ImageProduct-1688042857-18.jpg', 58, 1),
(87, 'imageProduct-1688043386-19.jpg', 59, 1),
(88, 'ImageProduct-1688043393-19.jpg', 59, 1),
(89, 'imageProduct-1688043636-19.webp', 60, 1),
(90, 'ImageProduct-1688043646-19.webp', 60, 1),
(91, 'imageProduct-1688043737-19.jpg', 61, 1),
(92, 'ImageProduct-1688043745-19.jpg', 61, 1),
(93, 'imageProduct-1688045099-20.jpg', 62, 1),
(94, 'ImageProduct-1688045110-20.jpg', 62, 1),
(95, 'imageProduct-1688045451-20.webp', 63, 1),
(96, 'ImageProduct-1688045463-20.webp', 63, 1),
(97, 'imageProduct-1688045643-20.jpg', 64, 1),
(98, 'imageProduct-1688046072-21.webp', 65, 1),
(99, 'ImageProduct-1688046084-21.webp', 65, 1),
(100, 'imageProduct-1688046374-21.jpg', 66, 1),
(101, 'ImageProduct-1688046382-21.jpg', 66, 1),
(102, 'imageProduct-1688046558-21.jpg', 67, 1),
(103, 'ImageProduct-1688046569-21.jpg', 67, 1),
(104, 'imageProduct-1688046703-21.webp', 68, 1),
(105, 'ImageProduct-1688046714-21.webp', 68, 1),
(106, 'imageProduct-1688046947-21.webp', 69, 1),
(107, 'ImageProduct-1688046960-21.webp', 69, 1),
(108, 'imageProduct-1688047406-22.webp', 70, 1),
(109, 'ImageProduct-1688047415-22.webp', 70, 1),
(110, 'imageProduct-1688047498-22.webp', 71, 1),
(111, 'ImageProduct-1688047507-22.webp', 71, 1),
(112, 'imageProduct-1688047591-22.webp', 72, 1),
(113, 'ImageProduct-1688047602-22.webp', 72, 1),
(114, 'imageProduct-1688047705-22.webp', 73, 1),
(115, 'ImageProduct-1688047733-22.webp', 73, 1),
(116, 'imageProduct-1688048241-23.jpg', 74, 1),
(117, 'ImageProduct-1688048252-23.jpg', 74, 1),
(118, 'imageProduct-1688048465-23.webp', 75, 1),
(119, 'imageProduct-1688048634-23.webp', 76, 1),
(120, 'ImageProduct-1688048644-23.webp', 76, 1),
(121, 'imageProduct-1688048769-23.webp', 77, 1),
(122, 'ImageProduct-1688048780-23.webp', 77, 1),
(123, 'imageProduct-1688049222-24.webp', 78, 1),
(124, 'ImageProduct-1688049232-24.webp', 78, 1),
(125, 'imageProduct-1688049380-24.jpg', 79, 1),
(126, 'ImageProduct-1688049389-24.jpg', 79, 1),
(127, 'imageProduct-1688049485-24.jpg', 80, 1),
(128, 'ImageProduct-1688049496-24.jpg', 80, 1),
(129, 'imageProduct-1688049809-24.png', 81, 1),
(130, 'ImageProduct-1688049819-24.webp', 81, 1),
(131, 'imageProduct-1688052723-24.jpg', 82, 1),
(133, 'ImageProduct-1688053293-24.png', 83, 1);

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE `marketing` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing`
--

INSERT INTO `marketing` (`Id`, `Name`, `Price`) VALUES
(1, 'Sản phẩm Hot', 500000),
(3, 'Siêu Marketing', 1000000),
(6, 'Hot', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `marketingproduct`
--

CREATE TABLE `marketingproduct` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `MarketingId` int(11) NOT NULL,
  `Create_At` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketingproduct`
--

INSERT INTO `marketingproduct` (`Id`, `ProductId`, `MarketingId`, `Create_At`, `Status`) VALUES
(1, 26, 1, '2023-05-23 10:08:49', 0),
(2, 22, 1, '2023-05-25 04:55:09', 0),
(8, 21, 1, '2023-04-01 00:00:00', 0),
(9, 34, 1, '2023-05-28 13:42:44', 0),
(10, 20, 1, '2023-06-01 06:45:53', 0),
(11, 34, 1, '2023-06-01 06:46:01', 0),
(12, 21, 1, '2023-06-01 06:46:06', 0),
(15, 20, 1, '2023-06-05 12:33:00', 0),
(16, 23, 1, '2023-06-05 12:33:05', 0),
(17, 24, 1, '2023-06-05 12:33:22', 0),
(18, 26, 1, '2023-06-05 12:33:33', 0),
(19, 37, 1, '2023-06-29 04:53:40', 0),
(20, 36, 6, '2023-06-29 07:52:20', 0),
(21, 21, 3, '2023-06-29 07:55:15', 0),
(22, 35, 6, '2023-06-29 07:57:26', 0),
(23, 25, 6, '2023-06-29 07:57:47', 0),
(24, 81, 3, '2023-06-29 15:06:42', 1),
(25, 80, 1, '2023-06-29 15:09:58', 1),
(26, 78, 3, '2023-06-29 15:10:07', 1),
(27, 65, 3, '2023-06-29 15:13:17', 1),
(28, 67, 1, '2023-06-29 15:13:26', 1),
(29, 69, 1, '2023-06-29 15:13:33', 1),
(30, 68, 1, '2023-06-29 15:18:48', 1),
(31, 51, 3, '2023-06-29 15:20:35', 1);

--
-- Triggers `marketingproduct`
--
DELIMITER $$
CREATE TRIGGER `tg_updateMarketingProductStatus` BEFORE UPDATE ON `marketingproduct` FOR EACH ROW BEGIN
    IF NEW.Create_At <= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN
       SET NEW.Status = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Birthday` date NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ava_img_path` varchar(255) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `AccountBalance` int(11) DEFAULT 0,
  `CreateAt` datetime DEFAULT NULL,
  `userstatus` tinyint(1) DEFAULT NULL,
  `reasonLockId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Id`, `Name`, `Gender`, `Birthday`, `Phone`, `Username`, `Password`, `ava_img_path`, `RoleID`, `AccountBalance`, `CreateAt`, `userstatus`, `reasonLockId`) VALUES
(1, 'nam dep zai so 1', 'Male', '2001-03-14', '094789432', 'nam', 'nam', 'imageAva-1-nam.jpg', 2, 2069668648, '2022-05-19 11:55:16', 1, NULL),
(2, 'namthin', 'Male', '2023-04-01', '13213131', 'namshop', 'nam', 'imageAva-2-namshop.jpg', 3, 241660775, '2020-07-16 11:55:31', 1, NULL),
(3, 'nam', 'Male', '2023-04-05', '13213131', 'admin', '123', 'imageAva-3-admin.jpg', 1, 0, '2016-05-19 11:55:56', 1, NULL),
(4, 'nam', 'Male', '2023-04-01', '13131312321', 'nam2', 'nam', NULL, 2, -45000, '2020-05-29 11:56:06', 1, NULL),
(7, 'Ngọc Linh', 'Female', '2023-05-06', '909001238012', 'ngoclinh123', '123', 'imageAva-7-ngoclinh123.jpg', 2, 700000, '2023-03-15 11:56:17', 0, NULL),
(8, 'Trung Kiên', 'Male', '2023-05-09', '097891120', 'trungkien', '123', 'imageAva-33-Hiimjolly.jpg', 2, 0, '2023-03-28 11:56:33', 1, NULL),
(9, 'Đăng Tùng ', 'Male', '2016-05-11', '0946339872', 'dangtung', '123', 'dangtungvjppro.jpg', 2, 0, '2016-05-19 13:12:00', 1, NULL),
(10, 'namshop2', 'Male', '2023-05-05', '13131312321', 'namshop2', 'nam', NULL, 3, 0, NULL, 1, NULL),
(11, 'namgay', 'Female', '2023-05-02', '0123456789', 'imheretobedeleted', '123', NULL, 2, 0, NULL, 1, NULL),
(12, 'namgay1', 'Female', '2023-05-01', '01234567899', 'namgay', '123', NULL, 2, 0, '2023-05-11 00:00:00', 0, 3),
(13, 'Nhận PR sản phẩm', 'Male', '2023-06-01', '0123456789', 'demo', '123456', 'imageAva-13-demo.png', 2, 247799000, '2023-06-29 00:00:00', 1, NULL),
(14, 'Back to the Kitchen', 'Male', '2014-10-10', '0998876754', 'giadungoffical', '123', 'imageAva-14-giadungoffical.png', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(15, 'Decor Home', 'Female', '2019-03-01', '0998876712', 'noithatoffical', '123', 'imageAva-15-noithatoffical.jpg', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(16, 'Nike', 'Male', '2023-06-01', '0998876742', 'thethaooffical', '123', 'imageAva-16-thethaooffical.png', 3, 99000000, '2023-06-29 00:00:00', 1, NULL),
(17, 'JOHNNY DANG & CO', 'Male', '2023-03-29', '0998876714', 'trangsucoffical', '123', 'imageAva-17-trangsucoffical.webp', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(18, 'Sony', 'Male', '2023-02-28', '0998876732', 'mayquayoffical', '123', 'imageAva-18-mayquayoffical.png', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(19, 'Yamaha Music', 'Male', '2023-03-08', '0998876722', 'musicoffical', '123', 'imageAva-19-musicoffical.png', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(20, 'LIBRARY OF CONGRESS', 'Male', '2023-01-18', '0998876725', 'sachoffical', '123', 'imageAva-20-sachoffical.png', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(21, 'ASUS ROG Store', 'Male', '2023-01-11', '0998876752', 'maytinhoffical', '123', 'imageAva-21-maytinhoffical.jpg', 3, 326000000, '2023-06-29 00:00:00', 1, NULL),
(22, 'Brunello Cucinelli', 'Male', '2023-01-03', '0998876701', 'quanaooffical', '123', 'imageAva-22-quanaooffical.png', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(23, 'Adidas Shoes', 'Male', '2023-02-06', '0998876743', 'giaydepoffical', '123', 'imageAva-23-giaydepoffical.webp', 3, 0, '2023-06-29 00:00:00', 1, NULL),
(24, 'Apple', 'Male', '2023-02-28', '0998876702', 'dientuoffical', '123', 'imageAva-24-dientuoffical.jpg', 3, 154690000, '2023-06-29 00:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Id` int(11) NOT NULL,
  `FromUserId` int(11) NOT NULL,
  `ToUserId` int(11) NOT NULL,
  `Body` mediumtext DEFAULT NULL,
  `CreateAt` datetime DEFAULT NULL,
  `ToUserSeen` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Id`, `FromUserId`, `ToUserId`, `Body`, `CreateAt`, `ToUserSeen`) VALUES
(1, 7, 2, 'hello', '2023-05-10 00:00:00', b'1'),
(2, 7, 2, 'yolo', '2023-05-10 00:00:00', b'1'),
(3, 8, 2, 'xin chào', '2023-05-10 00:00:00', b'1'),
(4, 8, 2, 'xin chào 2', '2023-05-10 00:00:00', b'1'),
(5, 2, 7, 'Xin chao', '2023-05-11 08:44:19', b'1'),
(6, 2, 7, '3', '2023-05-11 08:59:13', b'1'),
(7, 2, 7, 'Chào bạn !!!', '2023-05-11 09:38:06', b'1'),
(8, 7, 2, 'Xin chào bạn', '2023-05-11 09:38:22', b'1'),
(9, 2, 7, 'helllo', '2023-05-11 10:06:33', b'1'),
(10, 2, 7, 'tuyệt vời', '2023-05-11 10:06:53', b'1'),
(13, 7, 2, 'cảm ơn bạn', '2023-05-11 10:44:01', b'1'),
(14, 2, 7, 'oke b nhé', '2023-05-11 10:44:10', b'1'),
(15, 2, 7, 'oke nhé', '2023-05-11 10:44:34', b'1'),
(16, 7, 2, 'ok', '2023-05-11 10:45:13', b'1'),
(17, 2, 7, 'xin chào b', '2023-05-11 10:46:07', b'1'),
(18, 7, 2, 'chào bạn', '2023-05-11 10:46:13', b'1'),
(19, 2, 7, 'bạn đẹp tuyệt vời !!!', '2023-05-11 10:51:35', b'1'),
(20, 7, 2, 'oke cảm ơn bạn nhé', '2023-05-11 10:51:43', b'1'),
(21, 2, 7, 'chào bạn', '2023-05-11 12:26:04', b'1'),
(22, 2, 7, 'hello', '2023-05-11 12:28:14', b'1'),
(23, 2, 7, 'yolo', '2023-05-11 12:28:21', b'1'),
(24, 2, 7, '2', '2023-05-11 12:29:03', b'1'),
(25, 7, 2, '2', '2023-05-11 12:32:24', b'1'),
(26, 2, 7, 'hello', '2023-05-11 12:32:42', b'1'),
(27, 2, 7, '2', '2023-05-11 12:33:39', b'1'),
(28, 7, 2, '2', '2023-05-11 12:39:14', b'1'),
(29, 2, 7, '1', '2023-05-11 12:40:21', b'1'),
(30, 2, 7, NULL, '2023-05-11 12:40:45', b'1'),
(31, 2, 7, '2', '2023-05-11 12:40:54', b'1'),
(32, 2, 7, 'yolo', '2023-05-11 12:41:51', b'1'),
(33, 7, 2, 'chaof b', '2023-05-11 12:41:58', b'1'),
(34, 7, 2, NULL, '2023-05-11 12:42:24', b'1'),
(35, 7, 2, 'hello', '2023-05-11 12:42:34', b'1'),
(36, 2, 7, 'chao b', '2023-05-11 12:42:43', b'1'),
(37, 2, 7, 'hello', '2023-05-11 12:43:25', b'1'),
(38, 7, 2, 'chao b', '2023-05-11 12:43:30', b'1'),
(39, 7, 2, 'hello', '2023-05-11 13:03:55', b'1'),
(40, 7, 2, 'xin chaof tung dang', '2023-05-11 13:05:36', b'1'),
(41, 1, 2, 'ê mày', '2023-05-14 21:34:58', b'1'),
(42, 1, 2, 'eeeeeeee', '2023-05-14 21:35:31', b'1'),
(43, 2, 1, 'hello e', '2023-05-28 20:43:15', b'1'),
(44, 1, 2, 'chao a zai', '2023-05-28 20:43:41', b'1'),
(45, 2, 8, 'hello', '2023-06-27 18:37:34', b'0'),
(46, 7, 2, 'hello', '2023-06-27 18:38:22', b'1'),
(47, 7, 2, 'hello 2', '2023-06-27 19:28:36', b'1'),
(48, 2, 7, 'xin chao', '2023-06-27 19:28:42', b'0'),
(49, 7, 2, 'xin chao nam', '2023-06-27 20:45:03', b'1'),
(50, 7, 2, 'hello', '2023-06-27 20:48:09', b'1'),
(51, 7, 2, 'haha', '2023-06-27 20:48:18', b'1'),
(52, 7, 2, 'gh', '2023-06-27 20:48:34', b'1'),
(53, 7, 2, 'tai sao vay', '2023-06-27 20:48:52', b'1'),
(54, 7, 2, 'hello', '2023-06-27 20:55:59', b'1'),
(55, 7, 2, 'xin chao 02', '2023-06-27 20:56:06', b'1'),
(56, 7, 2, 'hello 1', '2023-06-27 20:57:21', b'1'),
(57, 7, 2, 'lô', '2023-06-27 20:57:35', b'1'),
(58, 7, 2, 'looo', '2023-06-27 20:57:44', b'1'),
(59, 7, 2, 'say your name', '2023-06-27 20:57:56', b'1'),
(60, 7, 2, 'say your name', '2023-06-27 20:58:06', b'1'),
(61, 7, 2, 'yahooo', '2023-06-27 20:59:24', b'1'),
(62, 7, 2, 'yelo', '2023-06-27 20:59:40', b'1'),
(63, 7, 2, 'hello', '2023-06-27 21:29:39', b'1'),
(64, 7, 2, 'kaka', '2023-06-27 21:29:44', b'1'),
(65, 7, 2, 'sadas', '2023-06-27 21:30:01', b'1'),
(66, 7, 2, 'ádasd', '2023-06-27 21:30:06', b'1'),
(67, 7, 2, 'sa', '2023-06-27 21:30:13', b'1'),
(68, 1, 2, 'xin chào', '2023-06-27 21:30:49', b'1'),
(69, 1, 2, 'hello e', '2023-06-27 21:30:55', b'1'),
(70, 1, 2, 'xin chào', '2023-06-27 21:41:56', b'1'),
(71, 1, 2, 'hân hạnh làm quen', '2023-06-27 21:42:07', b'1'),
(72, 1, 2, 'hay nhỉ', '2023-06-27 21:42:47', b'1'),
(73, 2, 1, 'đúng vậy', '2023-06-27 21:43:01', b'0'),
(74, 1, 2, 'sd', '2023-06-27 21:43:11', b'1'),
(75, 1, 2, 'yolo', '2023-06-27 22:08:47', b'1'),
(76, 1, 2, 'helo', '2023-06-27 22:09:38', b'1'),
(77, 1, 2, 'hello', '2023-06-27 22:13:02', b'1'),
(78, 2, 1, 'xin chào', '2023-06-27 22:13:14', b'0'),
(79, 1, 2, 'xin chào nhớ', '2023-06-27 22:13:23', b'1'),
(80, 2, 1, 'oke', '2023-06-27 22:13:45', b'0'),
(81, 1, 2, 'kk', '2023-06-27 22:13:50', b'1'),
(82, 1, 2, 'hello', '2023-06-27 22:16:04', b'1'),
(83, 1, 2, 'lo e', '2023-06-27 22:23:17', b'1'),
(84, 13, 2, 'giảm giá iphone đi shop', '2023-06-29 11:32:49', b'1'),
(85, 2, 13, 'không', '2023-06-29 11:33:01', b'0'),
(86, 13, 2, 'ok', '2023-06-29 11:33:07', b'1'),
(87, 2, 13, 'ok', '2023-06-29 11:33:12', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `moneytransaction`
--

CREATE TABLE `moneytransaction` (
  `Id` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moneytransaction`
--

INSERT INTO `moneytransaction` (`Id`, `Status`) VALUES
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 0),
(32, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 0),
(41, 1),
(42, 0),
(43, 0),
(44, 1),
(45, 0),
(46, 0),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 0),
(52, 0),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(67, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Id` int(11) NOT NULL,
  `IdAboutMember` int(11) DEFAULT NULL,
  `Content` varchar(1000) DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  `Create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Id`, `IdAboutMember`, `Content`, `Status`, `Create_at`) VALUES
(1, 4, 'Số dư tài khoản dưới 0 đồng', 1, '2023-05-28 15:22:40'),
(2, 4, 'Số dư tài khoản dưới 0 đồng', 0, '2023-05-28 16:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `Id` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`Id`, `Status`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao hàng'),
(4, 'Đã giao hàng thành công'),
(5, 'Đã hủy'),
(6, 'Giao hàng thất bại');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`ID`, `Name`) VALUES
(1, 'Thanh toán ví shopfast'),
(2, 'Thanh toán khi nhận hàng');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Price` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `QuantityInStock` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `Create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `Name`, `Price`, `Description`, `CategoryId`, `SubCategoryId`, `user_id`, `QuantityInStock`, `deleted`, `Create_at`) VALUES
(20, 'Áo phông Xanh cây', 200000, '<p>&Aacute;o ph&ocirc;ng&nbsp;</p>', 11, 78, 2, 84, 0, '2023-05-29 11:44:12'),
(21, 'Máy ảnh x100', 200000, 'Model x100', 4, 31, 2, 0, 0, '2023-05-29 11:44:12'),
(22, 'Samsung Galaxy SS4', 3000000, 'Điện thoại thông minh', 13, 109, 2, 106, 0, '2023-05-29 11:44:12'),
(23, 'Iphone 13 Pro Max', 9999999, 'Điện thoại xịn nhất', 13, 109, 2, 94, 0, '2023-05-29 11:44:12'),
(24, 'Đồng hồ x100', 555555, 'model x100', 3, 30, 2, 2, 0, '2023-05-29 11:44:12'),
(25, 'Đồng Hồ MCK', 500000, 'clock', 3, 30, 2, 0, 0, '2023-05-29 11:44:12'),
(26, 'Áo Phao vàng', 500000, '<p>Quy tr&igrave;nh sản xuất mềm mại, tho&aacute;ng kh&iacute; v&agrave; thoải m&aacute;i, ph&ugrave; hợp với l&agrave;n da nhạy cảm của trẻ đang ph&aacute;t triển, mang đến cho trẻ sự chăm s&oacute;c tự nhi&ecirc;n v&agrave; khỏe mạnh. Th&acirc;n thiện với l&agrave;n da v&agrave; tho&aacute;ng kh&iacute;.</p><p>Chất liệu vải được l&agrave;m từ chất liệu cao cấp mềm mại khi chạm v&agrave;o sẽ kh&ocirc;ng g&acirc;y hại cho l&agrave;n da của b&eacute;.</p><p>Qu&agrave; tặng cho B&eacute; - Tuyệt vời cho Qu&agrave; tặng bất ngờ, Qu&agrave; tặng cho b&eacute; trai v&agrave; b&eacute; g&aacute;i, Sinh nhật, Ng&agrave;y lễ, Chụp ảnh cho b&eacute; v&agrave; hơn thế nữa. Quần &aacute;o của ch&uacute;ng t&ocirc;i l&agrave; m&oacute;n qu&agrave; ho&agrave;n hảo cho kỳ nghỉ.</p><p>Kids FAVORITE - Thiết kế quần &aacute;o trẻ em thời trang với c&aacute;c họa tiết hoạt h&igrave;nh đầy m&agrave;u sắc m&agrave; trẻ em, b&eacute; trai v&agrave; b&eacute; g&aacute;i sẽ th&iacute;ch. Mặc quần &aacute;o cho con bạn v&agrave; l&agrave;m cho n&oacute; tr&ocirc;ng thật ngầu v&agrave; dễ thương. Trẻ em của bạn sẽ th&iacute;ch chiếc v&aacute;y đẹp n&agrave;y.</p><p>Nếu bạn c&oacute; bất kỳ c&acirc;u hỏi n&agrave;o, vui l&ograve;ng li&ecirc;n hệ với ch&uacute;ng t&ocirc;i v&agrave; ch&uacute;ng t&ocirc;i sẽ gi&uacute;p bạn xử l&yacute; n&oacute; một c&aacute;ch ho&agrave;n hảo!</p><p>Nếu bạn h&agrave;i l&ograve;ng với chất lượng v&agrave; dịch vụ sản phẩm của ch&uacute;ng t&ocirc;i, vui l&ograve;ng gi&uacute;p t&ocirc;i đặt h&agrave;ng năm sao bằng c&aacute;ch đăng ảnh v&agrave; đ&aacute;nh gi&aacute; tốt trong nhận x&eacute;t. Sẽ c&oacute; nhiều giảm gi&aacute; hơn trong lần mua lại tiếp theo, cảm ơn bạn</p>', 11, 72, 2, 86, 0, '2023-05-29 11:44:12'),
(33, 'Hàng Test', 100000, 'Hàng Test', 9, 63, 10, 0, 1, '2023-05-29 11:44:12'),
(34, 'test', 10000, 'hang test', 9, 63, 2, 97, 1, '2023-05-29 11:44:12'),
(35, 'Test 2', 100000, 'Test 2', 9, 63, 2, 98, 1, '2023-05-29 12:15:52'),
(36, 'bun oc', 100000, '<p>31232131</p>', 16, 120, 2, 81, 1, '2023-06-27 10:51:20'),
(37, 'Chăn gối tổng hợp', 100000, '<p>M&ocirc; tả sản phẩm : Chăn b&ocirc;ng tuyết cực mềm cực mịn</p><p>Ko ra mau</p><p>Ko xu long</p><p>Trọng lượng (650g) mền mỏng H&agrave;ng đ&uacute;ng size 1m6 x 2m nhiều m&agrave;u</p><p>Kh&aacute;ch mua nhắn cho shop để shop tư vấn chọn mẫu nhe !! Hết mẩu chọn ngẩu nhi&ecirc;n ạ</p>', 1, 1, 2, 100, 0, '2023-06-29 11:46:57'),
(39, 'Bộ 4 nồi inox Elmich 304', 2490000, '<p>Gồm 3 nồi đường k&iacute;nh 18, 20, 24 cm, 1 qu&aacute;nh đường k&iacute;nh 16cm</p><p>Sử dụng được tr&ecirc;n bếp từ, bếp ga, bếp hồng ngoại</p><p>Chất liệu&nbsp;inox cao cấp 430 &iacute;t bị oxy h&oacute;a, s&aacute;ng b&oacute;ng, bền tốt</p><p>Đ&aacute;y nồi gồm 5 lớp gi&uacute;p tối ưu việc truyền v&agrave; giữ nhiệt</p><p>Kh&ocirc;ng giải ph&oacute;ng chất độc hại, an to&agrave;n sức khỏe</p>', 6, 43, 14, 100, 0, '2023-06-29 16:48:25'),
(40, 'Máy hút bụi không dây Dyson SV18 Dslim Fluffy', 15489000, '<p>M&aacute;y h&uacute;t bụi kh&ocirc;ng d&acirc;y thiết kế nhỏ hơn v&agrave; nhẹ hơn gi&uacute;p l&agrave;m sạch triệt để mọi vị tr&iacute;</p><p>M&aacute;y h&uacute;t bụi c&oacute; c&ocirc;ng suất h&uacute;t cực mạnh với lực h&uacute;t được duy tr&igrave; kh&ocirc;ng sụt giảm</p><p>Ở chế độ Eco, m&aacute;y h&uacute;t bụi Dyson Digital Slim c&oacute; thời gian hoạt động đến 40 ph&uacute;t</p><p>Hệ thống lọc kh&eacute;p k&iacute;n gi&uacute;p giữ lại bụi mịn trong m&aacute;y, thổi ra kh&ocirc;ng kh&iacute; sạch hơn</p><p>M&agrave;n h&igrave;nh LCD b&aacute;o c&aacute;o thời gian v&agrave; hiệu suất hoạt động theo thời gian thực</p><p>Cơ chế đổ hộp chứa bụi dễ d&agrave;ng v&agrave; hợp vệ sinh, kh&ocirc;ng cần chạm tay v&agrave;o bụi bẩn</p><p>M&aacute;y h&uacute;t bụi đi k&egrave;m c&aacute;c đầu h&uacute;t chuy&ecirc;n dụng, gi&uacute;p l&agrave;m sạch linh hoạt v&agrave; hiệu quả</p>', 6, 44, 14, 100, 0, '2023-06-29 17:05:23'),
(41, 'Quạt điều hòa Boss S106', 6990000, '<p>Khả năng lọc kh&ocirc;ng kh&iacute; ho&agrave;n hảo, gi&uacute;p kh&ocirc;ng gian trong l&agrave;nh</p><p>C&ocirc;ng suất 160W l&agrave;m m&aacute;t hiệu quả kh&ocirc;ng gian rộng 28 m&sup2;</p><p>Dung t&iacute;ch b&igrave;nh chứa lớn, cho thời gian sử dụng l&acirc;u d&agrave;i</p><p>Th&acirc;n quạt nhựa&nbsp;ABS&nbsp;độ bền cao, dễ lau ch&ugrave;i, mới l&acirc;u</p><p>Quạt điều h&ograve;a&nbsp;trang bị điều khiển từ xa gi&uacute;p t&ugrave;y chỉnh dễ d&agrave;ng</p>', 6, 45, 14, 100, 0, '2023-06-29 17:20:41'),
(42, 'Máy lọc không khí Sharp FP-J60E-W', 6990000, '<p>C&ocirc;ng nghệ J-tech Inverter m&aacute;y vận h&agrave;nh &ecirc;m &aacute;i, tiết kiệm điện&nbsp;</p><p>M&aacute;y lọc kh&ocirc;ng kh&iacute;&nbsp;sở hữu chế độ HAZE tự động điều chỉnh tốc độ quạt ph&ugrave; hợp</p><p>Chế độ PCI Spot diệt khuẩn, loại bỏ m&ugrave;i h&ocirc;i trong kh&ocirc;ng kh&iacute;</p><p>Cảm biến bụi, m&ugrave;i, &aacute;nh s&aacute;ng tăng hiệu quả lọc bụi bẩn</p><p>T&iacute;nh năng tự khởi động lại khi c&oacute; điện tiện lợi</p>', 6, 46, 14, 100, 0, '2023-06-29 17:36:44'),
(43, 'CHĂN SOFIA', 300000, '<p>Chăn được l&agrave;m từ100% polyester dạng l&ocirc;ng mềm mại, nỉ c&oacute; độ bền cao, bền m&agrave;u, nhẹ, giữ nhiệt v&agrave; giữa ấm tốt, kh&ocirc;ng phai m&agrave;u, kh&ocirc;ng bị rụng l&ocirc;ng trong qu&aacute; tr&igrave;nh sử dụng</p><p>Bề mặt chăn mềm mại, mịn m&agrave;ng như nhung , trọng lượng nhẹ, tạo cảm gi&aacute;c dễ chịu, thoải m&aacute;i, gi&uacute;p mang lại giấc ngủ ngon v&agrave; ấm &aacute;p cho bạn, an to&agrave;n với l&agrave;n da trẻ em, nhạy cảm đem lại trải nghiệm tuyệt vời.</p><p>Chăn với c&aacute;c sợi l&ocirc;ng si&ecirc;u nhỏ kết hợp c&ugrave;ng đặc điểm của len l&ocirc;ng đ&oacute; l&agrave; nhẹ v&agrave; c&oacute; t&iacute;nh c&aacute;ch nhiệt rất tốt, n&ecirc;n khi đắp ngay lập tức sẽ mang lại cảm gi&aacute;c ấm &aacute;p v&agrave; lu&ocirc;n tạo sự thoải m&aacute;i dễ chịu cho người d&ugrave;ng. Ngo&agrave;i ra, với kỹ thuật dệt may ti&ecirc;n tiến c&ograve;n gi&uacute;p cho chăn kh&ocirc;ng chỉ ấm m&agrave; c&ograve;n tạo sự th&ocirc;ng tho&aacute;ng, kh&ocirc;ng bị ẩm hay b&iacute; kh&iacute;. Chất liệu chất lượng cao, kh&ocirc;ng phai m&agrave;u khi giặt, kh&ocirc;ng bị rụng l&ocirc;ng trong suốt qu&aacute; tr&igrave;nh sử dụng.</p><p>Họa tiết m&agrave;u sắc tươi s&aacute;ng tạo cảm gi&aacute;c ấm c&uacute;ng.</p><p>Sản phẩm c&oacute; thể sử dụng với nhiều c&ocirc;ng dụng kh&aacute;c nhau như l&agrave;m chăn văn ph&ograve;ng, chăn đắp khi ngủ, chăn thư gi&atilde;n sofa, chăn đắp tr&ecirc;n &ocirc; t&ocirc;, khi đi du lịch&hellip; với mục đ&iacute;ch n&agrave;o th&igrave; cũng khiến bạn cảm thấy dễ chịu, vừa tho&aacute;ng kh&iacute; v&agrave; v&ocirc; c&ugrave;ng ấm &aacute;p.</p><p>Xuất xứ: Th&aacute;i Lan</p>', 1, 1, 15, 100, 0, '2023-06-29 17:45:22'),
(44, 'BÀN CÀ PHÊ CONNEMARA', 3493000, '<p>B&agrave;n caf&eacute; CONNEMARA l&agrave; một thiết kế đặc biệt của BAYA, lấy cảm hứng từ phong c&aacute;ch Art Deco ấn tượng. Kết hợp đầy đủ bộ sưu tập CONNEMARA để ho&agrave;n thiện việc b&agrave;y tr&iacute; ng&ocirc;i nh&agrave; sang trọng v&agrave; ấm c&uacute;ng.</p>', 1, 2, 15, 100, 0, '2023-06-29 17:49:09'),
(45, 'BỘ BÀN ĂN 4 GHẾ PALL-MALL', 12900000, '<p>B&agrave;n ăn PALL-MALL l&agrave; sản phẩm c&oacute; xuất xứ từ Việt Nam. Với kiểu d&aacute;ng trẻ trung, hiện đại c&ugrave;ng m&agrave;u sắc trang nh&atilde;, đ&acirc;y l&agrave; sản phẩm bạn kh&ocirc;ng thể bỏ lỡ để ho&agrave;n thiện kh&ocirc;ng gian bếp của gia đ&igrave;nh bạn</p><p>Ghế ăn HATHEN sử dụng nguy&ecirc;n liệu gỗ cao su tự nhi&ecirc;n th&acirc;n thiện với m&ocirc;i trường, thiết kế vừa vặn với mặt ngồi v&agrave; tựa lưng bọc vải tổng hợp m&agrave;u x&aacute;m rất sạch sẽ v&agrave; dễ phối với c&aacute;c đồ nội thất kh&aacute;c trong ph&ograve;ng ăn</p>', 1, 3, 15, 100, 0, '2023-06-29 17:52:26'),
(46, 'ĐÈN SÀN ARENA', 699000, '<p>Đ&egrave;n s&agrave;n ARENA của BAYA l&agrave; n&eacute;t chấm ph&aacute; cho kh&ocirc;ng gian ph&ograve;ng kh&aacute;ch hiện đại. Kiểu d&aacute;ng đơn giản, chất liệu kim loại sơn x&aacute;m sang trọng, nổi bật c&ugrave;ng chiều cao 121cm, đem lại &aacute;nh s&aacute;ng tự nhi&ecirc;n ấm &aacute;p cho căn ph&ograve;ng.</p>', 1, 4, 15, 100, 0, '2023-06-29 17:55:14'),
(47, 'BỘ BÀN GHẾ NGOÀI TRỜI BARCELONA', 15000000, '<p>- Phong c&aacute;ch giản dị, l&agrave; lựa chọn tuyệt vời cho c&aacute;c ban c&ocirc;ng v&agrave; c&aacute;c g&oacute;c nhỏ, ấm c&uacute;ng tr&ecirc;n s&acirc;n thượng hoặc trong vườn.</p><p>- Mỗi ghế c&oacute; đi k&egrave;m theo một gối lưng v&agrave; một gối ngồi tăng cảm gi&aacute;c &ecirc;m &aacute;i v&agrave; thoải m&aacute;i khi ngồi xuống.</p><p>- C&oacute; khả năng chống chịu được thời tiết khắc nghiệt, c&oacute; độ bền tốt v&agrave; chi ph&iacute; bảo dướng kh&ocirc;ng hề tốn k&eacute;m.</p>', 1, 5, 15, 100, 0, '2023-06-29 18:00:05'),
(48, 'Vali Nike Jordan', 3500000, '<p>&nbsp;Vali Nike Ch&iacute;nh H&atilde;ng<br />Size : 38 x 25 x 58 cm ( size 22 )<br /><br />chất liệu vỏ nhựa ABS , khung nh&ocirc;m gia cố 4 g&oacute;c , 4 b&aacute;nh k&eacute;o xoay 360 độ</p>', 2, 9, 16, 100, 0, '2023-06-29 18:14:23'),
(49, 'Nike Brasilia', 1400000, '<p>Featuring a comfortable padded shoulder strap to haul your gear through those long days, the Nike Brasilia Duffel Bag goes wherever you need with enough space to store it all. The additional padded handles are great for grab-and-go, and the large mesh side pocket gives you easy access to electronics, water bottles or other items.</p>', 2, 10, 16, 100, 0, '2023-06-29 18:16:11'),
(50, 'Nike Air Shorts', 2000000, '<p>Designed to fit baggy and below the knee, these Nike Air shorts revitalise a mid-90s, hoops-inspired style. The plush cotton fleece feels soft and comfortable, while the understated Nike Air branding on the left thigh nods to the most powerful franchise in Air.</p>', 2, 11, 16, 100, 0, '2023-06-29 18:18:55'),
(51, 'Jumpman MVP', 5000000, '<p>We didn&#39;t invent the remix&mdash;but considering the material we get to sample, this one&#39;s a no-brainer. We fired up the SP-12 and took elements from the AJ6, 7 and 8, making them into a completely new shoe that celebrates MJ&#39;s first 3-peat championship run. With leather, textile and nubuck details, these sneakers honour one legacy while encouraging you to cement your own.</p>', 2, 12, 16, 99, 0, '2023-06-29 18:21:18'),
(52, 'Custom 4 Carat Emerald Cut Engagement Ring', 1000000000, '<p>This ring can be customized to any size, shape, karat, clarity or color.&nbsp;</p>', 3, 16, 17, 10, 0, '2023-06-29 18:30:55'),
(53, 'VDER96i - Diamond Emerald Earrings', 10000000, '<p>All products come with a thirty (30) day manufacturers warranty.</p>', 3, 17, 17, 10, 0, '2023-06-29 18:34:29'),
(54, 'FLAWLESS VIP DEALS BUNDLE', 1000000000, '<p>20 Teeth Honeycomb Set With 4 Solid: Perms or Pull-Out ($35,000 Value)</p><p>VIP PHOTO WITH BIG BOSS JOHNNY DANG TAGGED WITH&nbsp; INSTAGRAM ($1000 VALUE)</p>', 3, 30, 17, 1, 0, '2023-06-29 18:39:22'),
(55, 'Máy ảnh kỹ thuật số Sony ZV1 II', 20000000, '<p>Dễ d&agrave;ng quay phim v&agrave; tự chụp ảnh nhờ m&agrave;n h&igrave;nh cảm ứng LCD c&oacute; thể lật sang một b&ecirc;n</p><p>T&iacute;nh năng Face-Priority AE c&oacute; thể ph&aacute;t hiện khu&ocirc;n mặt v&agrave; điều chỉnh độ phơi s&aacute;ng hợp l&yacute;</p><p>Quay video chuẩn 4K mang đến những thước phim với chất lượng tuyệt hảo v&agrave; ổn định</p><p>Khả năng tối ưu h&oacute;a t&ocirc;ng m&agrave;u da cho đa dạng c&aacute;c đối tượng cho chất lượng ảnh tự nhi&ecirc;n</p><p>Trang bị chế độ ổn định h&igrave;nh ảnh n&acirc;ng cao gi&uacute;p video được r&otilde; n&eacute;t ngay cả khi di chuyển</p>', 4, 31, 18, 10, 0, '2023-06-29 19:16:04'),
(56, 'Camera IP Hikvision Dome DS-2CD1123G0E 2MP', 650000, '<p>Thiết kế nhỏ gọn, đơn giản gi&uacute;p bạn dễ d&agrave;ng lắp đặt trong bất k&igrave; kh&ocirc;ng gian n&agrave;o</p><p>Độ ph&acirc;n giải video 1920 &times; 1080@25fps cho h&igrave;nh ảnh thu được chi tiết, r&otilde; r&agrave;ng hơn</p><p>Ph&aacute;t hiện chuyển động, b&aacute;o động giả mạo video, đăng nhập bất hợp ph&aacute;p</p><p>Tầm xa của hồng ngo&agrave;i l&ecirc;n đến 30m sẽ gi&uacute;p bảo vệ v&agrave; g&igrave;n giữ an ninh cực tốt</p><p>C&oacute; chức năng: chống nhấp nh&aacute;y, nhịp tim, gương, bảo vệ bằng mật khẩu, mặt nạ ri&ecirc;ng tư, h&igrave;nh mờ</p>', 4, 32, 18, 10, 0, '2023-06-29 19:35:02'),
(57, 'Ống Kính Canon EF 24-70mm f/2.8L II USM', 32000000, '<p>Canon EF 24-70mm f/2.8L II USM c&oacute; thể chụp ở khoảng c&aacute;ch gần tối thiểu l&agrave; 0,38 m&eacute;t, kết hợp c&ugrave;ng m&ocirc;-tơ lấy n&eacute;t si&ecirc;u thanh USM v&agrave; một chip xử l&yacute; nhằm n&acirc;ng cao thuật to&aacute;n lấy n&eacute;t của m&aacute;y. Phi&ecirc;n bản II n&agrave;y cũng được thiết kế lại ho&agrave;n to&agrave;n hệ thống quang học với hai thấu k&iacute;nh c&oacute; độ t&aacute;n xạ thấp UD v&agrave; một thấu k&iacute;nh phi cầu t&aacute;n xạ si&ecirc;u thấp nhằm giảm thiểu hiện tượng quang sai m&agrave;u v&agrave; l&agrave;m mờ m&agrave;u sắc cũng như cho độ sắc n&eacute;t v&agrave; độ tương phản cao. Mỗi thấu k&iacute;nh được sử dụng đều c&oacute; lớp phủ Super Spectra nhằm giảm hiện tượng b&oacute;ng mờ v&agrave; &quot;flare&quot;, giảm lượng bụi bẩn, chống b&aacute;m v&acirc;n tay ở ph&iacute;a trước v&agrave; ph&iacute;a sau của ống k&iacute;nh.</p>', 4, 34, 18, 10, 0, '2023-06-29 19:41:36'),
(58, 'DJI Mavic 3 Cine Premium Combo', 118000000, '<p>DJI Mavic 3 được DJI ra mắt với thiết kế ho&agrave;n to&agrave;n mới v&agrave; l&agrave; sự cải tiến to&agrave;n diện nhất so với c&aacute;c flycam kh&aacute;c của nh&agrave; DJI. Với hai camera được t&iacute;ch hợp, trang bị cảm biến CMOS 4/3inch, DJI Mavic 3 cho ph&eacute;p bạn c&oacute; thể thực hiện những cảnh quay tr&ecirc;n kh&ocirc;ng chuy&ecirc;n nghiệp.&nbsp;</p>', 4, 36, 18, 10, 0, '2023-06-29 19:47:25'),
(59, 'ĐÀN PIANO ĐIỆN YAMAHA YDP-165', 27000000, '<p>Chất lượng &acirc;m thanh chuẩn Piano cơ</p><p>Tối ưu h&oacute;a chi ph&iacute;</p><p>Kiểu d&aacute;ng gọn nhẹ, ph&ugrave; hợp mọi kh&ocirc;ng gian sử dụng (chung cư, studio, lớp nhạc,...)</p>', 7, 47, 19, 10, 0, '2023-06-29 19:56:26'),
(60, 'Digital to Analog Audio Converter', 100000, '<p>Digital to Analog Audio Converter,DAC Digital SPDIF Optical to Analog L/R RCA &amp; 3.5Mm AUX Stereo Audio Adapter</p>', 7, 48, 19, 100, 0, '2023-06-29 20:00:36'),
(61, 'Bộ dung dịch vệ sinh và khăn lau cho đàn', 250000, '<p>An to&agrave;n cho người sử dụng v&agrave; kh&ocirc;ng g&acirc;y k&iacute;ch ứng da</p><p>Nhanh ch&oacute;ng l&agrave;m sạch v&agrave; b&oacute;ng bẩy c&acirc;y đ&agrave;n Piano của bạn</p><p>L&agrave;m sạch bụi bẩn v&agrave; vết tay hiệu quả hơn c&aacute;c loại vải đ&aacute;nh b&oacute;ng th&ocirc;ng thường v&agrave; t&aacute;c dụng k&eacute;o d&agrave;i</p>', 7, 49, 19, 10000, 0, '2023-06-29 20:02:17'),
(62, 'Vợ Nhặt', 60000, '<p>Vợ Nhặt - Kim L&acirc;n</p><p>Kim L&acirc;n (1920 - 2007) nh&agrave; văn Kim L&acirc;n t&ecirc;n thật l&agrave; Nguyễn Văn T&agrave;i, sinh tại th&ocirc;n Ph&ugrave; Lưu (l&agrave;ng chợ Giầu), x&atilde; T&acirc;n Hồng, huyện Từ Sơn, tỉnh Bắc Ninh.</p><p>&#39;Kim L&acirc;n l&agrave; một trong những c&acirc;y b&uacute;t truyện ngắn xuất sắc của văn học Việt Nam hiện đại. Kim L&acirc;n đ&atilde; tạo c&aacute;ch viết độc đ&aacute;o. Phải n&oacute;i rằng, Kim L&acirc;n viết kh&ocirc;ng nhiều nhưng những s&aacute;ng t&aacute;c của &ocirc;ng g&acirc;y ấn tượng với bạn đọc&#39;.</p><p>B&igrave;a minh họa &#39;Vợ nhặt - Kim L&acirc;n&#39; do ch&iacute;nh họa sĩ Nguyễn Thị Hiền con g&aacute;i ruột nh&agrave; văn Kim L&acirc;n đặt hết t&acirc;m huyết &nbsp;vẽ n&ecirc;n v&agrave; c&ugrave;ng họa sĩ Trọng Ki&ecirc;n thiết kế ra b&igrave;a s&aacute;ch ho&agrave;n chỉnh, mang phong c&aacute;ch ng&agrave;y xưa, t&aacute;i hiện lại con người những năm đ&oacute;i khổ c&ugrave;ng cực, vẫn hi vọng, tin tưởng ở tương lai, tất cả được t&aacute;i hiện lại trong cuốn s&aacute;ch &#39;Vợ nhặt - &nbsp;Kim L&acirc;n&#39;</p>', 8, 51, 20, 100, 0, '2023-06-29 20:24:59'),
(63, 'Đắc Nhân Tâm', 90000, '<p>Đắc nh&acirc;n t&acirc;m của Dale Carnegie l&agrave; quyển s&aacute;ch duy nhất về thể loại self-help li&ecirc;n tục đứng đầu danh mục s&aacute;ch b&aacute;n chạy nhất (best-selling Books) do b&aacute;o The New York Times b&igrave;nh chọn suốt 10 năm liền. Được xuất bản năm 1936, với số lượng b&aacute;n ra hơn 15 triệu bản, t&iacute;nh đến nay, s&aacute;ch đ&atilde; được dịch ra ở hầu hết c&aacute;c ng&ocirc;n ngữ, trong đ&oacute; c&oacute; cả Việt Nam, v&agrave; đ&atilde; nhận được sự đ&oacute;n tiếp nhiệt t&igrave;nh của đọc giả ở hầu hết c&aacute;c quốc gia.</p>', 8, 52, 20, 100, 0, '2023-06-29 20:30:51'),
(64, 'Hộp 60 Kẹp Giấy Màu 15mm', 30000, '<p>Đặc điểm nổi bật:</p><p>- Sản xuất từ chất liệu kim loại cao cấp, được phủ Niken chống gỉ gi&uacute;p kẹp bướm lu&ocirc;n bền đẹp theo thời gian</p><p>- Phần l&ograve; xo của kẹp linh hoạt, nhẹ, dễ d&ugrave;ng, kh&ocirc;ng bị lỏng hay bung rời sau nhiều lần sử dụng</p><p>- Tay cầm chắc chắn, vừa vặn tạo cảm gi&aacute;c thoải m&aacute;i khi sử dụng</p><p>- Đa dạng đủ mọi k&iacute;ch cỡ từ 15 - 51 mm ph&ugrave; hợp với mọi nhu cầu</p><p>- C&oacute; 4 m&agrave;u tươi s&aacute;ng, hợp xu hướng gi&uacute;p b&agrave;n l&agrave;m việc nhiều m&agrave;u sắc, khơi gợi cảm hứng v&agrave; s&aacute;ng tạo</p><p>- T&iacute;nh ứng dụng cao, dễ sử dụng gi&uacute;p việc ph&acirc;n loại, bảo quản t&agrave;i liệu nhẹ nh&agrave;ng v&agrave; hiệu quả hơn</p>', 8, 53, 20, 100, 0, '2023-06-29 20:34:03'),
(65, 'Màn hình Asus ROG Swift PG48UQ', 15000000, '<p>M&agrave;n h&igrave;nh gaming&nbsp;Asus ROG Swift PG48UQ sở hữu độ s&acirc;u m&agrave;u sắc 10 bit, độ phủ m&agrave;u 98% DCI-P3 chuẩn cinema, hứa hẹn mang lại h&igrave;nh ảnh chất lượng v&agrave; ch&acirc;n thật đến từng chi tiết. Mỗi m&agrave;n h&igrave;nh PC đều được hiệu chỉnh trước tại nh&agrave; m&aacute;y, hệ số Delta E &lt;2 kết hợp với m&agrave;n h&igrave;nh OLED cho khả năng t&aacute;i tạo m&agrave;u sắc tuyệt vời.</p>', 10, 65, 21, 8, 0, '2023-06-29 20:41:12'),
(66, 'Máy tính All in one Asus A3202WBAK-WA019W White', 15000000, '<p>M&aacute;y t&iacute;nh All in one Asus A3202WBAK-WA019W<strong>&nbsp;</strong>chiến mọi dự &aacute;n nhờ đầu n&atilde;o core i5-1235U gồm 10 l&otilde;i v&agrave; 12 luồng mang lại tốc độ phản hồi c&aacute;c t&aacute;c vụ nhanh ch&oacute;ng, tối đa h&oacute;a năng suất l&agrave;m việc v&agrave; c&ugrave;ng bạn chinh phục c&aacute;c thử th&aacute;ch mỗi ng&agrave;y.</p><p>Đi k&egrave;m với đ&oacute; l&agrave; 8Gb RAM c&ugrave;ng ổ cứng 512GB M.2 PCIe NVMe SSD cung cấp khả năng đa nhiệm mượt m&agrave;, mở ra kh&ocirc;ng gian lưu trữ khổng lồ v&agrave; cũng gi&uacute;p cho việc khởi động m&aacute;y hay mở c&aacute;c ứng dụng trở n&ecirc;n nhanh ch&oacute;ng hơn rất nhiều.</p><p>Ngo&agrave;i ra cấu h&igrave;nh ho&agrave;n hảo kh&ocirc;ng thể thiếu đồ họa ấn tượng đến từ Intel Iris Xe Graphics/ UHD Graphic cho trải nghiệm h&igrave;nh ảnh cực đ&atilde;.</p><p>Sự trang bị đầy mạnh mẽ tr&ecirc;n cho m&aacute;y khả năng xử l&yacute; tốt c&aacute;c t&aacute;c vụ nặng nhẹ kh&aacute;c nhau, từ những t&aacute;c vụ cơ bản như soạn thảo văn bản, nhập liệu, gọi video trực tuyến, nghe nhạc,&nbsp;giải tr&iacute; c&aacute; nh&acirc;n&nbsp;cho đến những t&aacute;c vụ n&acirc;ng cao hơn như chỉnh sửa h&igrave;nh ảnh qua Photoshop, cắt dựng video qua Premiere,...</p><p>Để c&oacute; khả năng kết nối si&ecirc;u nhanh, ASUS A3202 được trang bị l&ecirc;n tới WiFi 6 802.11ax băng tần k&eacute;p cho tốc độ nhanh gấp 3 lần so với 802.11ax WiFi 5.</p><p>Sẵn s&agrave;ng sử dụng ngay ngay khi sắm về với Windows 11 Home được trang bị sẵn s&agrave;ng ngay tr&ecirc;n All in one.</p>', 10, 64, 21, 10, 0, '2023-06-29 20:46:14'),
(67, 'Laptop Asus ROG Mothership GZ700', 100000000, '<p>Từng chiếc th&acirc;n m&aacute;y bằng nh&ocirc;m nguy&ecirc;n khối đều được phay đến độ ho&agrave;n hảo theo quy tr&igrave;nh gia c&ocirc;ng m&aacute;y CNC ch&iacute;nh x&aacute;c. Khung m&aacute;y dựng thẳng để tăng cường lưu th&ocirc;ng kh&iacute; v&agrave; khả năng l&agrave;m m&aacute;t, mang đến thiết kế mỏng hơn v&agrave; linh hoạt hơn. Khung m&aacute;y nghi&ecirc;ng về ph&iacute;a sau nhờ v&agrave;o ch&acirc;n đế v&ocirc; cấp ph&ugrave; hợp với mọi ho&agrave;n cảnh sử dụng v&agrave; b&agrave;n ph&iacute;m c&oacute; thể t&aacute;ch rời để tăng th&ecirc;m độ linh hoạt. B&agrave;n ph&iacute;m c&oacute; thể th&aacute;o rời v&agrave; điều chỉnh vị tr&iacute; để c&oacute; được tư thế chơi game l&yacute; tưởng hoặc sử dụng thiết bị ngoại vi d&agrave;nh cho m&aacute;y t&iacute;nh để b&agrave;n y&ecirc;u th&iacute;ch của bạn. Bạn c&oacute; thể mở ROG Mothership ra để sử dụng khi di chuyển hoặc l&agrave;m trung t&acirc;m sức mạnh cho to&agrave;n bộ hệ thống chiến đấu tại nh&agrave;.</p>', 10, 70, 21, 10, 0, '2023-06-29 20:49:18'),
(68, 'Mainboard ASUS ROG MAXIMUS Z790', 15000000, '<p>- Chuẩn mainboard: ATX<br />- Socket: 1700 , Chipset: Z790<br />- Hỗ trợ RAM: 2 khe DDR5, tối đa 64GB<br />- Lưu trữ: 6 x SATA 3 6Gb/s, 1 x M.2 SATA/NVMe, 1 x M.2 NVMe</p>', 10, 66, 21, 10, 0, '2023-06-29 20:51:43'),
(69, 'Tản nhiệt nước ASUS ROG RYUJIN 360', 1000000, '<p>Hệ thống tản nhiệt bằng chất lỏng tất cả trong một ROG Ryujin 360 cho CPU với OLED m&agrave;u LiveDash, đ&egrave;n Aura Sync RGB v&agrave; 3 quạt tản nhiệt Noctua iPPC 2000 PWM 120mm</p>', 10, 66, 21, 10, 0, '2023-06-29 20:55:47'),
(70, 'Áo khoác nam dài tay Brunello Cucinelli', 2000000, '<p>+ Thương hiệu: Brunello Cucinelli</p><p>+ M&ocirc; tả: &Aacute;o kho&aacute;c nam d&agrave;i tay m&agrave;u x&aacute;m , 2 c&aacute;nh tay m&agrave;u n&acirc;u nhạt. C&oacute; t&uacute;i nhỏ dọc ở trước ngực</p><p>+ M&agrave;u sắc: X&aacute;m</p><p>+ Chất liệu: 60% Lana 40% Nylon</p><p>+ Xuất xứ: Italy</p>', 11, 72, 22, 10, 0, '2023-06-29 21:03:26'),
(71, 'Áo blazer nam Brunello Cucinelli', 2000000, '<p>+ Thương hiệu: Brunello Cucinelli</p><p>+ M&ocirc; tả: &Aacute;o blazer nam , m&agrave;u xanh dương</p><p>+ M&agrave;u sắc: Xanh dương</p><p>+ Chất liệu: 100% Lino</p><p>+ Xuất xứ: Italy</p>', 11, 73, 22, 10, 0, '2023-06-29 21:04:58'),
(72, 'Quần jean nam Brunello Cucinelli', 400000, '<p>+ Thương hiệu: Brunello Cucinelli</p><p>+ M&ocirc; tả: Quần kaki nam , m&agrave;u x&aacute;m nhạt</p><p>+ M&agrave;u sắc: X&aacute;m nhạt</p><p>+ Chất liệu: 100% Cotton</p><p>+ Xuất xứ: Italy</p>', 11, 75, 22, 100, 0, '2023-06-29 21:06:31'),
(73, 'Quần short nam Brunello Cucinelli', 500000, '<p>+ Thương hiệu: Brunello Cucinelli</p><p>+ M&ocirc; tả: Quần short nam , m&agrave;u xanh đậm</p><p>+ M&agrave;u sắc: Xanh đậm</p><p>+ Chất liệu: 100% Polyester</p><p>+ Xuất xứ: Italy</p>', 11, 77, 22, 10, 0, '2023-06-29 21:08:25'),
(74, 'Giày Slip-on Adidas Wmns Superstar Slip-on Cloud White', 1000000, '<p><strong>Gi&agrave;y Slip-on Adidas Wmns Superstar Slip-on Cloud White CQ2381 M&agrave;u Trắng</strong>&nbsp;l&agrave; đ&ocirc;i gi&agrave;y d&agrave;nh cho nam nữ đến từ&nbsp;thương hiệu Adidas&nbsp;nổi tiếng. Sở hữu gam m&agrave;u nổi bật c&ugrave;ng chất liệu cao cấp&nbsp;<strong>Adidas Wmns Superstar Slip-on Cloud White CQ2381</strong>&nbsp;sẽ cho bạn trải nghiệm tuyệt vời khi đi l&ecirc;n ch&acirc;n.</p>', 12, 92, 23, 100, 0, '2023-06-29 21:17:21'),
(75, 'Bộ 3 đôi tất thể thao cổ ngắn adidas - HT3458', 450000, '<p>Chiều d&agrave;i cổ vớ</p><p>62% cotton, 36% polyester t&aacute;i chế, 1% elastane, 1% nylon t&aacute;i chế</p><p>Ba đ&ocirc;i trong một bộ</p><p>Đế gi&agrave;y được đệm, bao gồm ng&oacute;n ch&acirc;n v&agrave; g&oacute;t ch&acirc;n</p><p>Hỗ trợ cung ch&acirc;n</p><p>Đường may gắn liền ở ng&oacute;n ch&acirc;n</p><p>M&agrave;u sản phẩm: White / Black</p>', 12, 96, 23, 100, 0, '2023-06-29 21:21:05'),
(76, 'GIÀY BUỘC DÂY BOUNCE RAPIDASPORT', 1400000, '<p>L&agrave;m từ một loạt chất liệu t&aacute;i chế, th&acirc;n gi&agrave;y c&oacute; chứa tối thiểu 50% th&agrave;nh phần t&aacute;i chế. Sản phẩm n&agrave;y đại diện cho một trong số rất nhiều c&aacute;c giải ph&aacute;p của ch&uacute;ng t&ocirc;i hướng tới chấm dứt r&aacute;c thải nhựa. - D&aacute;ng regular fit - C&oacute; d&acirc;y gi&agrave;y - Th&acirc;n gi&agrave;y sử dụng kết hợp nhiều loại vải dệt với phần phủ th&acirc;n sau kh&ocirc;ng đường may - Lớp l&oacute;t bằng vải dệt - Kẹp g&oacute;t gi&agrave;y đ&uacute;c - Đế giữa Bounce - Đế ngo&agrave;i bằng cao su</p>', 12, 94, 23, 10, 0, '2023-06-29 21:23:54'),
(77, 'DÉP ADILETTE AQUA', 500000, '<p>D&aacute;ng regular fit</p><p>Kiểu d&aacute;ng slip-on</p><p>Quai d&eacute;p bằng chất liệu tổng hợp</p><p>M&agrave;u sản phẩm: Core Black / Core Black / Core Black</p>', 12, 95, 23, 100, 0, '2023-06-29 21:26:09'),
(78, 'Apple AirPods Pro 2022', 3000000, '<p>H&agrave;ng ch&iacute;nh h&atilde;ng Apple Việt Nam, Mới</p><p>Hộp sạc v&agrave; tai nghe, C&aacute;p Type-C to Lightning, S&aacute;ch hướng dẫn, Đệm tai</p><p>Bảo h&agrave;nh 12 th&aacute;ng ch&iacute;nh h&atilde;ng 1 đổi 1 trong 15 ng&agrave;y nếu c&oacute; lỗi phần cứng từ NSX.</p>', 13, 105, 24, 8, 0, '2023-06-29 21:33:42'),
(79, 'Apple Watch SE 2022', 5000000, '<p>Nh&igrave;n tổng thể,&nbsp;đồng hồ th&ocirc;ng minh Apple Watch SE 2022&nbsp;vẫn giữ kiểu thiết kế tương tự như thế hệ tiền nhiệm, tuy nhi&ecirc;n&nbsp;đ&atilde; được Apple trang bị&nbsp;<strong>m&agrave;n h&igrave;nh lớn hơn 30%</strong>&nbsp;so với phi&ecirc;n bản Watch 3 Series, cho bạn một kh&ocirc;ng gian hiển thị lớn hơn. Tấm nền&nbsp;<strong>OLED</strong>&nbsp;c&ugrave;ng độ ph&acirc;n giải&nbsp;<strong>324 x 394 pixels</strong>&nbsp;cũng mang đến những trải nghiệm về thị gi&aacute;c tuyệt vời trong bất cứ điều kiện &aacute;nh s&aacute;ng n&agrave;o.</p><p>Đồng hồ th&ocirc;ng minh Apple&nbsp;c&oacute; khung viền được ho&agrave;n thiện từ&nbsp;<strong>hợp kim nh&ocirc;m</strong>&nbsp;kết hợp c&ugrave;ng d&acirc;y đeo silicone với nhiều m&agrave;u sắc. B&ecirc;n cạnh đ&oacute;, lớp vỏ xung quanh c&aacute;c cảm biến của thiết bị đ&atilde; được đổi mới để ph&ugrave; hợp hơn với m&agrave;u sắc của đồng hồ.</p>', 13, 101, 24, 10, 0, '2023-06-29 21:36:20'),
(80, 'Apple HomePod Mini', 2500000, '<p>Jam-packed with innovation, HomePod mini delivers unexpectedly big sound for a speaker of its size. At just 3.3 inches tall, it takes up almost no space but fills the entire room with rich 360‑degree audio that sounds amazing from every angle.</p><p>Full-range driver and dual passive radiators for deep bass and crisp high frequencies</p><p>Custom acoustic waveguide for a 360&ordm; sound field</p><p>Four-microphone design for far-field Siri</p><p>Multiroom audio with AirPlay 2, Stereo pair capable</p>', 13, 106, 24, 9, 0, '2023-06-29 21:38:05'),
(81, 'iPhone 14 Pro Max', 25000000, '<p>iPhone 14 Pro Max&nbsp;đem đến những trải nghiệm kh&ocirc;ng thể t&igrave;m thấy tr&ecirc;n&nbsp;mọi thế hệ iPhone trước đ&oacute; với&nbsp;m&agrave;u T&iacute;m Deep Purple sang trọng, camera 48MP lần đầu xuất hiện, chip A16 Bionic v&agrave;&nbsp;m&agrave;n h&igrave;nh &ldquo;vi&ecirc;n thuốc&rdquo; Dynamic Island linh hoạt, nịnh mắt.</p><p>&nbsp;</p><p>Đỉnh cao thiết kế sang trọng v&agrave; bền bỉ</p><p>Rất kh&oacute; để t&igrave;m ra chiếc điện thoại n&agrave;o sang trọng&nbsp;như iPhone 14 Pro Max tr&ecirc;n thị trường. Thừa hưởng thiết kế v&aacute;t phẳng từ thế hệ trước, thủ lĩnh iPhone 14 series kho&aacute;c l&ecirc;n bộ khung vỏ th&eacute;p, đầm tay v&agrave; chắc chắn. Bạn sẽ lập tức bị l&ocirc;i cuốn bởi vẻ ngo&agrave;i cao cấp với th&acirc;n m&aacute;y b&oacute;ng bẩy của sản phẩm.</p><p>Nhờ kỹ nghệ ho&agrave;n thiện xuất sắc, thiết kế iPhone 14 Pro Max đạt chuẩn chống nước IP68 cao nhất c&oacute; thể tr&ecirc;n smartphone. Apple đ&atilde; phủ l&ecirc;n m&agrave;n h&igrave;nh thiết bị&nbsp;chất liệu k&iacute;nh Ceramic Shield si&ecirc;u bền, tối ưu khả năng kh&aacute;ng lực v&agrave; chống xước cực tốt&nbsp;suốt v&ograve;ng đời sử dụng.</p>', 13, 109, 24, 6, 0, '2023-06-29 21:43:29'),
(82, 'Apple AirTag', 700000, '<p>Apple AirTag l&agrave; một&nbsp;<strong>thiết bị định vị th&ocirc;ng minh&nbsp;</strong>&ldquo;<strong>t&iacute; hon</strong>&rdquo; d&ugrave;ng để gắn v&agrave;o c&aacute;c đồ d&ugrave;ng c&aacute; nh&acirc;n quan trọng như ch&igrave;a kh&oacute;a, v&iacute; tiền, thiết bị di động,&hellip; để dễ d&agrave;ng t&igrave;m thấy ch&uacute;ng khi v&ocirc; t&igrave;nh thất lạc.</p>', 13, 109, 24, 99, 0, '2023-06-29 22:32:03'),
(83, 'Apple Magic Keyboard', 1000000, '<p>B&agrave;n ph&iacute;m Magic Keyboard Apple MK2A3&nbsp;gọn nhẹ, thiết kế tinh tế, phản hồi nhanh nhạy,... hỗ trợ bạn tối đa trong qu&aacute; tr&igrave;nh sử dụng.</p><p>Thiết kế đẹp mắt,&nbsp;b&agrave;n ph&iacute;m&nbsp;gọn nhẹ, m&agrave;u trắng trang nh&atilde;, sang trọng.</p><p>Phản hồi nhanh ch&oacute;ng, ch&iacute;nh x&aacute;c cho bạn thoải m&aacute;i thực hiện mọi t&aacute;c vụ kể cả đồ hoạ hoặc chơi game.</p><p>Tương th&iacute;ch với c&aacute;c thiết bị nh&agrave; Apple chạy hệ điều h&agrave;nh từ macOS 11.3 trở l&ecirc;n, iPadOS 14.5 trở l&ecirc;n v&agrave; iOS 14.5 trở l&ecirc;n.</p><p>B&agrave;n ph&iacute;m kh&ocirc;ng d&acirc;y, kết nối với thiết bị th&ocirc;ng qua Bluetooth hiện đại.</p><p>B&agrave;n ph&iacute;m Apple&nbsp;n&agrave;y hoạt động bằng pin sạc, khi hết pin bạn c&oacute; thể sạc lại th&ocirc;ng qua c&aacute;p sạc đi k&egrave;m.</p>', 13, 109, 24, 9, 0, '2023-06-29 22:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `Create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`Id`, `MemberId`, `ProductId`, `star`, `Create_at`) VALUES
(1, 7, 26, 4, '2023-05-29 12:08:16'),
(2, 8, 26, 5, '2023-05-29 12:08:16'),
(3, 1, 25, 5, '2023-05-29 12:08:16'),
(4, 1, 20, 5, '2023-06-26 23:03:03'),
(5, 1, 23, 5, '2023-06-28 19:12:40'),
(6, 13, 22, 4, '2023-06-29 11:37:57'),
(7, 1, 81, 5, '2023-06-29 22:24:04'),
(8, 1, 78, 3, '2023-06-29 22:24:38'),
(9, 1, 65, 5, '2023-06-29 22:25:47'),
(10, 13, 65, 1, '2023-06-29 22:28:34'),
(11, 13, 83, 1, '2023-06-29 22:39:53'),
(12, 13, 81, 3, '2023-06-29 22:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `reasonabort`
--

CREATE TABLE `reasonabort` (
  `Id` int(11) NOT NULL,
  `Reason` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasonabort`
--

INSERT INTO `reasonabort` (`Id`, `Reason`) VALUES
(1, 'Giao hàng không thành công do khách hàng'),
(2, 'Giao hàng không thành công do vận chuyển');

-- --------------------------------------------------------

--
-- Table structure for table `reasonlock`
--

CREATE TABLE `reasonlock` (
  `Id` int(11) NOT NULL,
  `Reason` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasonlock`
--

INSERT INTO `reasonlock` (`Id`, `Reason`) VALUES
(1, 'Đăng sản phẩm có tên không đúng chuẩn mực'),
(2, 'Phần miêu tả sản phẩm chứa các từ ngữ không đúng chuẩn mực'),
(3, 'Comment sai chuẩn mực'),
(4, 'Hình ảnh không chuẩn mực hoặc không đúng với mô tả');

-- --------------------------------------------------------

--
-- Table structure for table `reportcomment`
--

CREATE TABLE `reportcomment` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `CommentId` int(11) NOT NULL,
  `Content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportcomment`
--

INSERT INTO `reportcomment` (`Id`, `MemberId`, `CommentId`, `Content`) VALUES
(1, 7, 1, 'Test báo cáo'),
(2, 3, 5, 'Bình luận bịp, không đúng sự thật'),
(3, 1, 9, 'comment không liên quan');

-- --------------------------------------------------------

--
-- Table structure for table `reportproduct`
--

CREATE TABLE `reportproduct` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportproduct`
--

INSERT INTO `reportproduct` (`Id`, `MemberId`, `ProductId`, `Content`) VALUES
(1, 7, 23, 'Test báo cáo'),
(2, 1, 23, 'hoi bi dat'),
(3, 13, 23, 'quá đắt'),
(4, 13, 24, 'đồng hồ fake');

-- --------------------------------------------------------

--
-- Table structure for table `roleusers`
--

CREATE TABLE `roleusers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roleusers`
--

INSERT INTO `roleusers` (`ID`, `Name`) VALUES
(1, 'Admin'),
(2, 'Người mua'),
(3, 'Người bán');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`Id`, `Name`, `CategoryId`) VALUES
(1, 'Chăn, ga, gối & nệm', 1),
(2, 'Trang trí', 1),
(3, 'Đồ dùng bếp', 1),
(4, 'Đèn trang trí', 1),
(5, 'Ngoài trời, sân vườn', 1),
(6, 'Thờ cúng', 1),
(7, 'Dụng cụ pha chế', 1),
(8, 'Khác', 1),
(9, 'Vali', 2),
(10, 'Túi du lịch', 2),
(11, 'Quần áo thể thao', 2),
(12, 'Giày dép thể thao', 2),
(13, 'Dụng cụ thể thao', 2),
(14, 'Phụ kiện thể thao', 2),
(15, 'Khác', 2),
(16, 'Nhẫn', 3),
(17, 'Bông tai', 3),
(18, 'Khăn', 3),
(19, 'Găng tay', 3),
(20, 'Phụ kiện tóc', 3),
(21, 'Vòng tay', 3),
(22, 'Lắc chân', 3),
(23, 'Mũ', 3),
(24, 'Dây chuyền', 3),
(25, 'Kính mắt', 3),
(26, 'Kim loại quý', 3),
(27, 'Thắt lưng', 3),
(28, 'Cà vạt', 3),
(29, 'Tất', 3),
(30, 'Khác', 3),
(31, 'Máy ảnh & Máy quay phim', 4),
(32, 'Camera giám sát & Camera hệ thống', 4),
(33, 'Thẻ nhớ', 4),
(34, 'Lens', 4),
(35, 'Phụ kiện máy ảnh', 4),
(36, 'Flycam', 4),
(37, 'Khác', 4),
(38, 'Vật tư y tế', 5),
(39, 'Thực phẩm chức năng', 5),
(40, 'Thuốc', 5),
(41, 'Hỗ trọ làm đẹp', 5),
(42, 'Khác', 5),
(43, 'Đồ làm bếp', 6),
(44, 'Máy hút bụi & Thiết bị làm sạch', 6),
(45, 'Quạt & Máy nóng lạnh', 6),
(46, 'Khác', 6),
(47, 'Nhạc cụ', 7),
(48, 'Phụ kiện', 7),
(49, 'Dung dịch làm sạch', 7),
(50, 'Khác', 7),
(51, 'Sách Tiếng Việt', 8),
(52, 'Sách nước ngoài', 8),
(53, 'Dụng cụ văn phòng phẩm', 8),
(54, 'Quà lưu niệm', 8),
(55, 'Giấy gói trang trí', 8),
(56, 'Khác', 8),
(57, 'Đồ chơi mô hình', 9),
(58, 'Đồ chơi giải trí', 9),
(59, 'Đồ chơi giáo dục', 9),
(60, 'Đồ chơi cho trẻ sơ sinh và trẻ nhỏ', 9),
(61, 'Đồ chơi vận động và ngoài trời', 9),
(62, 'Búp bê và thú nhồi bông', 9),
(63, 'Khác', 9),
(64, 'Máy tính bàn', 10),
(65, 'Màn hình', 10),
(66, 'Linh kiện', 10),
(67, 'Thiết bị lưu trữ', 10),
(68, 'Thiết bị mạng', 10),
(69, 'Phụ kiện máy tính', 10),
(70, 'Laptop', 10),
(71, 'Khác', 10),
(72, 'Áo khoác', 11),
(73, 'Áo Vest & Blazer', 11),
(74, 'Áo Hoodie, Áo Len & Áo Nỉ', 11),
(75, 'Quần Jeans', 11),
(76, 'Quần dài & Quần Âu', 11),
(77, 'Quần Short', 11),
(78, 'Áo', 11),
(79, 'Đồ lót', 11),
(80, 'Đồ ngủ', 11),
(81, 'Tất', 11),
(82, 'Trang phục truyền thống', 11),
(83, 'Đồ hóa trang', 11),
(84, 'Trang phục ngành nghề', 11),
(85, 'Váy', 11),
(86, 'Đồ liền thân', 11),
(87, 'Đồ tập gym', 11),
(88, 'Đồ bầu', 11),
(89, 'Vải', 11),
(90, 'Khác', 11),
(91, 'Boots', 12),
(92, 'Giày thể thao/Sneakers', 12),
(93, 'Giày Tây lười', 12),
(94, 'Giầy Oxford & Giày buộc dây', 12),
(95, 'Sandals và Dép', 12),
(96, 'Phụ kiện Giày Dép', 12),
(97, 'Giày Đế Bằng', 12),
(98, 'Giày Cao Gót', 12),
(99, 'Giày Đế Xuồng', 12),
(100, 'Khác', 12),
(101, 'Thiết bị đeo thông minh', 13),
(102, 'Phụ kiện TV', 13),
(103, 'Consoles', 13),
(104, 'Linh kiện', 13),
(105, 'Tai nghe', 13),
(106, 'Loa', 13),
(107, 'TV', 13),
(108, 'Tai nghe', 13),
(109, 'Khác', 13),
(110, 'Dụng cụ', 14),
(111, 'Dụng cụ cầm tay', 14),
(112, 'Thiết bị điện', 14),
(113, 'Vật liệu xây dựng', 14),
(114, 'Thiết bị và phụ kiện xây dựng', 14),
(115, 'Khác', 14),
(116, 'Đồ chơi giáo dục', 15),
(117, 'Dụng cụ thí nghiệm', 15),
(118, 'Đồ dùng mỹ thuật', 15),
(120, 'Khác', 16),
(121, 'Khác', 15);

-- --------------------------------------------------------

--
-- Table structure for table `webincome`
--

CREATE TABLE `webincome` (
  `Id` int(11) NOT NULL,
  `IdBillDetail` int(11) NOT NULL,
  `Income` int(11) DEFAULT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webincome`
--

INSERT INTO `webincome` (`Id`, `IdBillDetail`, `Income`, `Create_at`) VALUES
(2, 297, 150000, '2023-05-24 15:53:34'),
(3, 289, 10000, '2023-05-24 15:56:31'),
(4, 297, 150000, '2023-05-24 15:56:46'),
(5, 297, 150000, '2023-05-25 07:09:22'),
(6, 299, 10000, '2023-05-26 08:26:17'),
(7, 300, 150000, '2023-05-26 08:26:19'),
(8, 296, 10000, '2023-05-28 13:41:56'),
(9, 301, 10000, '2023-05-28 13:42:24'),
(10, 309, 10000, '2023-05-29 04:16:31'),
(11, 310, 500, '2023-06-01 04:16:33'),
(12, 309, 10000, '2023-05-29 04:52:10'),
(13, 310, 500, '2023-05-29 04:52:13'),
(14, 311, 10000, '2023-06-03 15:05:20'),
(15, 313, 25000, '2023-06-03 15:19:47'),
(16, 314, 150000, '2023-06-05 13:32:06'),
(17, 327, 500000, '2023-06-28 12:12:32'),
(18, 329, 300000, '2023-06-29 04:02:52'),
(19, 292, 10000, '2023-06-29 04:03:00'),
(20, 315, 5000, '2023-06-29 04:03:01'),
(21, 316, 500, '2023-06-29 04:03:03'),
(22, 317, 10000, '2023-06-29 04:03:04'),
(23, 318, 150000, '2023-06-29 04:03:06'),
(24, 319, 500000, '2023-06-29 04:03:07'),
(25, 320, 25000, '2023-06-29 04:03:09'),
(26, 321, 27778, '2023-06-29 04:03:10'),
(27, 322, 500, '2023-06-29 04:03:18'),
(28, 331, 150000, '2023-06-29 04:11:31'),
(29, 334, 1250000, '2023-06-29 15:23:37'),
(30, 335, 150000, '2023-06-29 15:23:39'),
(31, 336, 750000, '2023-06-29 15:25:36'),
(32, 339, 750000, '2023-06-29 15:28:03'),
(33, 338, 150000, '2023-06-29 15:37:30'),
(34, 337, 1250000, '2023-06-29 15:37:31'),
(35, 341, 125000, '2023-06-29 15:37:33'),
(36, 342, 50000, '2023-06-29 15:37:34'),
(37, 343, 35000, '2023-06-29 15:38:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMember` (`IdMember`);

--
-- Indexes for table `billdetail`
--
ALTER TABLE `billdetail`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdBill` (`IdBill`),
  ADD KEY `Status` (`Status`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdCarrier` (`IdCarrier`),
  ADD KEY `IdReasonAbort` (`IdReasonAbort`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AddressId` (`AddressId`),
  ADD KEY `PaymentMethodId` (`PaymentMethodId`);

--
-- Indexes for table `cartdetail`
--
ALTER TABLE `cartdetail`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CartId` (`CartId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `categoryproduct`
--
ALTER TABLE `categoryproduct`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `imageproduct`
--
ALTER TABLE `imageproduct`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `marketingproduct`
--
ALTER TABLE `marketingproduct`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `MarketingId` (`MarketingId`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `reasonLockId` (`reasonLockId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FromUserId` (`FromUserId`),
  ADD KEY `ToUserId` (`ToUserId`);

--
-- Indexes for table `moneytransaction`
--
ALTER TABLE `moneytransaction`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdAboutMember` (`IdAboutMember`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoryId` (`CategoryId`),
  ADD KEY `FK_UserId` (`user_id`),
  ADD KEY `SubCategoryId` (`SubCategoryId`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `MemberId` (`MemberId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `reasonabort`
--
ALTER TABLE `reasonabort`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reasonlock`
--
ALTER TABLE `reasonlock`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reportcomment`
--
ALTER TABLE `reportcomment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CommentId` (`CommentId`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `reportproduct`
--
ALTER TABLE `reportproduct`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `roleusers`
--
ALTER TABLE `roleusers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `webincome`
--
ALTER TABLE `webincome`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdBillDetail` (`IdBillDetail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `billdetail`
--
ALTER TABLE `billdetail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `cartdetail`
--
ALTER TABLE `cartdetail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `categoryproduct`
--
ALTER TABLE `categoryproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `imageproduct`
--
ALTER TABLE `imageproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `marketing`
--
ALTER TABLE `marketing`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `marketingproduct`
--
ALTER TABLE `marketingproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `moneytransaction`
--
ALTER TABLE `moneytransaction`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reasonabort`
--
ALTER TABLE `reasonabort`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reasonlock`
--
ALTER TABLE `reasonlock`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reportcomment`
--
ALTER TABLE `reportcomment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reportproduct`
--
ALTER TABLE `reportproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roleusers`
--
ALTER TABLE `roleusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `webincome`
--
ALTER TABLE `webincome`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`IdMember`) REFERENCES `member` (`Id`);

--
-- Constraints for table `billdetail`
--
ALTER TABLE `billdetail`
  ADD CONSTRAINT `billdetail_ibfk_1` FOREIGN KEY (`IdBill`) REFERENCES `bill` (`Id`),
  ADD CONSTRAINT `billdetail_ibfk_3` FOREIGN KEY (`Status`) REFERENCES `order_status` (`Id`),
  ADD CONSTRAINT `billdetail_ibfk_4` FOREIGN KEY (`Status`) REFERENCES `order_status` (`Id`),
  ADD CONSTRAINT `billdetail_ibfk_5` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `billdetail_ibfk_6` FOREIGN KEY (`IdCarrier`) REFERENCES `carrier` (`id`),
  ADD CONSTRAINT `billdetail_ibfk_7` FOREIGN KEY (`IdReasonAbort`) REFERENCES `reasonabort` (`Id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`AddressId`) REFERENCES `address` (`ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`PaymentMethodId`) REFERENCES `paymentmethod` (`ID`);

--
-- Constraints for table `cartdetail`
--
ALTER TABLE `cartdetail`
  ADD CONSTRAINT `cartdetail_ibfk_1` FOREIGN KEY (`CartId`) REFERENCES `cart` (`Id`),
  ADD CONSTRAINT `cartdetail_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`);

--
-- Constraints for table `imageproduct`
--
ALTER TABLE `imageproduct`
  ADD CONSTRAINT `imageproduct_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketingproduct`
--
ALTER TABLE `marketingproduct`
  ADD CONSTRAINT `marketingproduct_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `marketingproduct_ibfk_2` FOREIGN KEY (`MarketingId`) REFERENCES `marketing` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roleusers` (`ID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`FromUserId`) REFERENCES `member` (`Id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ToUserId`) REFERENCES `member` (`Id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`IdAboutMember`) REFERENCES `member` (`Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_UserId` FOREIGN KEY (`user_id`) REFERENCES `member` (`Id`),
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `categoryproduct` (`Id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`SubCategoryId`) REFERENCES `subcategory` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`);

--
-- Constraints for table `reportcomment`
--
ALTER TABLE `reportcomment`
  ADD CONSTRAINT `reportcomment_ibfk_1` FOREIGN KEY (`CommentId`) REFERENCES `comment` (`Id`),
  ADD CONSTRAINT `reportcomment_ibfk_2` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`);

--
-- Constraints for table `reportproduct`
--
ALTER TABLE `reportproduct`
  ADD CONSTRAINT `reportproduct_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`),
  ADD CONSTRAINT `reportproduct_ibfk_2` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `categoryproduct` (`Id`);

--
-- Constraints for table `webincome`
--
ALTER TABLE `webincome`
  ADD CONSTRAINT `webincome_ibfk_1` FOREIGN KEY (`IdBillDetail`) REFERENCES `billdetail` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
