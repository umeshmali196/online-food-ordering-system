-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 05:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `f_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`f_id`, `res_id`, `u_id`) VALUES
(4, 78, 18),
(5, 78, 17),
(6, 79, 17);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `res_id`, `o_id`, `rate`, `date`) VALUES
(6, 79, 72, '5', '2023-04-03 15:08:27'),
(7, 79, 75, '5', '2023-04-03 16:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_desc` varchar(30) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `m_id`, `res_id`, `item_name`, `item_desc`, `image_name`, `price`, `quantity`, `status`, `date`, `availability`) VALUES
(340, 175, 82, 'Dark forest', 'delisious', '(2023-03-31)(10-06-43)choco pastry_8_11zon.jpeg', 200, 1, 'Accpted', '2023-03-31 05:31:02', 1),
(341, 176, 78, 'Kathiyawadi Thali', 'Sweet & Spice Flavours', '(2023-03-31)(08-16-06)shree-thaker-bhojanalay-kalbadevi-mumbai-gujarati-restaurants-9gfsk7x-1024x768_17_11zon.jpg', 300, 10, 'Accpted', '2023-03-31 06:16:06', 1),
(342, 176, 78, 'Dhokla', 'Soft Dhokla With chutney', '(2023-03-31)(08-17-02)Dhokla_8_11zon.jpeg', 50, 10, 'Accpted', '2023-03-31 06:17:02', 1),
(343, 176, 78, 'Khandvi', 'khandvi ', '(2023-03-31)(08-18-12)Gujrati-Khandvi_2_11zon.jpg', 40, 10, 'Accpted', '2023-03-31 06:18:12', 1),
(344, 176, 78, 'Locho', 'Spicy butter locho', '(2023-03-31)(08-19-37)2-type-surti-locho-WS_2_11zon.jpg', 60, 10, 'Accpted', '2023-03-31 06:19:37', 1),
(345, 177, 78, 'Misal pav', 'Spicy Maharastrian Misal Pav', '(2023-03-31)(08-20-51)misalpav_625x350_61465888599_4_11zon.jpg', 60, 10, 'Accpted', '2023-03-31 06:20:51', 1),
(346, 177, 78, 'Puranpoli', 'sweet  puranpoli', '(2023-03-31)(08-34-18)v0s43mj_puran-poli_625x300_13_September_18_5_11zon.jpg', 100, 15, 'Accpted', '2023-03-31 06:34:18', 1),
(347, 177, 78, 'Kajuwadi', 'kajuwadi sabji', '(2023-03-31)(08-40-39)kajuvadi-625_625x350_81465887037_2_11zon.jpg', 120, 10, 'Accpted', '2023-03-31 06:40:40', 1),
(348, 177, 78, 'Kothmbir vadi', 'coriender crispy spicy bhajiya', '(2023-03-31)(08-41-44)8mht07mo_kolhapuri-vegetables_625x300_03_December_18_1_11zon.jpeg', 70, 10, 'Accpted', '2023-03-31 06:41:44', 1),
(349, 178, 78, 'Palakpaneer', 'spicy paneer sabji', '(2023-03-31)(08-43-02)palak-paneer-1-960x960_3_11zon.jpg', 120, 10, 'Accpted', '2023-03-31 06:43:02', 1),
(350, 178, 78, 'Malai Kofta', 'Malai cheesy Kofta', '(2023-03-31)(08-43-48)malai-koft_2_11zon.jpg', 135, 10, 'Accpted', '2023-03-31 06:43:48', 1),
(351, 178, 78, 'Chhole Kulcha', 'Amritsri chhole kulcha', '(2023-03-31)(08-45-25)amritsari-kulcha-1-960x720_1_11zon.jpg', 65, 10, 'Accpted', '2023-03-31 06:45:25', 1),
(352, 178, 78, 'Kadhi Pakora', 'Punjabi kadhi pakora', '(2023-03-31)(08-46-48)punjabi-kadhi-pakora-1-960x769_5_11zon.jpg', 150, 10, 'Accpted', '2023-03-31 06:46:48', 1),
(353, 178, 78, 'Rajma Chawal', 'Punjabi rajma chawal', '(2023-03-31)(08-47-33)rajma-chawal-1_6_11zon.jpg', 70, 10, 'Accpted', '2023-03-31 06:47:33', 1),
(354, 179, 78, 'Masala dhosa', 'Masala Dhosa with sambhal n co', '(2023-03-31)(08-49-45)images_2_11zon.jpeg', 150, 10, 'Accpted', '2023-03-31 06:49:45', 1),
(355, 179, 78, 'Appam', 'Appam with coconut chutney', '(2023-03-31)(08-50-20)appam_1_11zon.jpg', 70, 10, 'Accpted', '2023-03-31 06:50:20', 1),
(356, 179, 78, 'Pongal', 'South famous pongal', '(2023-03-31)(08-51-01)pongal_3_11zon.jpg', 80, 10, 'Rejected', '2023-03-31 06:51:01', 1),
(357, 180, 79, 'Chocolate icecream', 'chocolate chips icecream', '(2023-03-31)(09-01-32)chocolate icecream_2_11zon.jpeg', 40, 5, 'Accpted', '2023-03-31 07:01:32', 1),
(358, 180, 79, 'Dark Chocolate', 'Dark syrup with chocolates', '(2023-03-31)(09-02-51)chocolate shake_3_11zon.jpg', 100, 10, 'Accpted', '2023-03-31 07:02:51', 1),
(359, 180, 79, 'American Dryfruits', 'American Chcolate icecream', '(2023-03-31)(09-04-04)american icecream_1_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 07:04:04', 1),
(360, 180, 79, 'Vanila Icecream', 'Vanila icecream', '(2023-03-31)(09-04-42)vanila icecream_10_11zon.jpeg', 50, 10, 'Accpted', '2023-03-31 07:04:42', 1),
(361, 180, 79, 'Mango Icecream', 'Mango dryfruits', '(2023-03-31)(09-05-27)mango icecream_6_11zon.jpeg', 70, 10, 'Accpted', '2023-03-31 07:05:27', 1),
(362, 180, 79, 'Strawberry Icecream', 'Strawberry vanila icecream', '(2023-03-31)(09-06-08)stowberry icecream_8_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 07:06:08', 1),
(363, 181, 79, 'Kitkat Shake', 'Kitkat & Chips crumbs shakes', '(2023-03-31)(09-07-37)kitkat shake_5_11zon.jpeg', 160, 10, 'Accpted', '2023-03-31 07:07:37', 1),
(364, 181, 79, 'Oreo shake', 'Oreo biscuits crumbs and choco', '(2023-03-31)(09-08-17)oreo shake_7_11zon.jpeg', 150, 10, 'Accpted', '2023-03-31 07:08:17', 1),
(365, 181, 79, 'strawberry shake', 'Strawberry chips n milk shake', '(2023-03-31)(09-09-32)stowberry shake_9_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 07:09:32', 1),
(366, 181, 79, 'icecream shake', 'milk shake', '(2023-03-31)(09-10-22)Icecream shake_4_11zon.jpeg', 180, 10, 'Accpted', '2023-03-31 07:10:22', 1),
(367, 182, 80, 'Hongkong fried rice', 'fried rice', '(2023-03-31)(09-21-25)Hongkong fried rice_5_11zon.jpeg', 70, 10, 'Accpted', '2023-03-31 07:21:25', 1),
(368, 182, 80, 'Fried Rice', 'chinese', '(2023-03-31)(09-23-12)fried rice_3_11zon.jpeg', 100, 10, 'Accpted', '2023-03-31 07:23:12', 1),
(369, 182, 80, 'Chinese bhel', 'chinese', '(2023-03-31)(09-27-20)chinese bhel_1_11zon.jpeg', 100, 10, 'Accpted', '2023-03-31 07:27:20', 1),
(370, 183, 80, 'Hakka noodles', 'chinese', '(2023-03-31)(09-28-08)image-137-scaled-e1604152201367_6_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 07:28:08', 1),
(371, 183, 80, 'paneer chili', 'chinese', '(2023-03-31)(09-28-37)paneer chilli_9_11zon.jpeg', 60, 10, 'Accpted', '2023-03-31 07:28:37', 1),
(372, 183, 80, 'Chinese Momos', 'chinese', '(2023-03-31)(09-38-31)chinese momos_2_11zon.jpeg', 80, 10, 'Accpted', '2023-03-31 07:38:31', 1),
(373, 184, 80, 'Manchow Soup', 'chinese', '(2023-03-31)(09-39-13)manchow-soup_7_11zon.jpg', 110, 10, 'Accpted', '2023-03-31 07:39:13', 1),
(374, 184, 80, 'Manchurian', 'chinese', '(2023-03-31)(09-41-40)Manchuriyan_8_11zon.jpeg', 80, 10, 'Accpted', '2023-03-31 07:41:40', 1),
(375, 184, 80, 'Gravy Manchurian', 'chinese', '(2023-03-31)(09-42-12)gravy manchuriyan_4_11zon.jpeg', 100, 10, 'Accpted', '2023-03-31 07:42:12', 1),
(376, 184, 80, 'Tomato Soup', 'chinese', '(2023-03-31)(09-42-52)tomato soup_10_11zon.jpeg', 150, 10, 'Accpted', '2023-03-31 07:42:52', 1),
(377, 184, 80, 'vegetable soup', 'chinese', '(2023-03-31)(09-44-06)vegitable soup_11_11zon.jpeg', 100, 10, 'Pending', '2023-03-31 07:44:06', 1),
(378, 185, 81, 'Grill Sandwich', 'sandwich', '(2023-03-31)(09-50-21)grill sandwitch_6_11zon.jpeg', 75, 10, 'Accpted', '2023-03-31 07:50:21', 1),
(379, 185, 81, 'Toast Sandwich', 'sandwich', '(2023-03-31)(09-52-03)toast sandwitch_16_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 07:52:03', 1),
(380, 185, 81, 'veg. Sandwich', 'sandwich', '(2023-03-31)(09-52-34)simple sandwitch_14_11zon.jpeg', 60, 10, 'Accpted', '2023-03-31 07:52:34', 1),
(381, 185, 81, 'Sandwich Combo', 'sandwich', '(2023-03-31)(09-53-23)combo sandwitch_2_11zon.jpeg', 200, 10, 'Accpted', '2023-03-31 07:53:23', 1),
(382, 186, 81, 'Chinese frankie', 'frankie', '(2023-03-31)(09-53-58)noodels frankie_10_11zon.jpeg', 80, 10, 'Accpted', '2023-03-31 07:53:58', 1),
(390, 186, 81, 'Cheese frankie', 'frankie', '(2023-03-31)(09-56-03)cheese frankie_1_11zon.jpeg', 70, 10, 'Accpted', '2023-03-31 07:56:03', 1),
(391, 186, 81, 'Veg frankie', 'frankie', '(2023-03-31)(09-57-47)Mix frankie_9_11zon.jpeg', 40, 10, 'Accpted', '2023-03-31 07:57:47', 1),
(392, 186, 81, 'sehwan frankie', 'frankie', '(2023-03-31)(09-58-42)schezwan frankie_13_11zon.jpeg', 70, 10, 'Accpted', '2023-03-31 07:58:42', 1),
(393, 187, 81, 'Vadapav', 'vadapav', '(2023-03-31)(09-59-36)vadapav_17_11zon.jpeg', 60, 10, 'Accpted', '2023-03-31 07:59:36', 1),
(394, 187, 81, 'Dabeli', 'dabeli', '(2023-03-31)(10-00-04)dabeli_3_11zon.jpeg', 40, 10, 'Accpted', '2023-03-31 08:00:04', 1),
(395, 187, 81, 'momos', 'momos', '(2023-03-31)(10-00-31)paneer momos_11_11zon.jpeg', 60, 10, 'Pending', '2023-03-31 08:00:31', 1),
(396, 175, 82, 'blue berry', 'cake', '(2023-03-31)(10-06-19)blueberry_3_11zon.jpeg', 200, 10, 'Accpted', '2023-03-31 08:06:19', 1),
(397, 175, 82, 'cheese cake', 'cake', '(2023-03-31)(10-07-21)cheese cake_6_11zon.jpeg', 300, 10, 'Accpted', '2023-03-31 08:07:21', 1),
(398, 175, 82, 'Red Valvet', 'cake', '(2023-03-31)(10-08-48)red valvet_12_11zon.jpeg', 300, 10, 'Accpted', '2023-03-31 08:08:48', 1),
(399, 175, 82, 'sponge Cake', 'cake', '(2023-03-31)(10-09-29)sponge_13_11zon.jpeg', 150, 10, 'Accpted', '2023-03-31 08:09:29', 1),
(400, 188, 82, 'Chocolate cupcake', 'cupcake', '(2023-03-31)(10-10-43)cup cake_9_11zon.jpeg', 80, 10, 'Accpted', '2023-03-31 08:10:43', 1),
(401, 188, 82, 'Blueberry cupcake', 'cake', '(2023-03-31)(10-11-20)bluebery cupcakes_4_11zon.jpeg', 90, 10, 'Accpted', '2023-03-31 08:11:20', 1),
(402, 188, 82, 'Strawberry Cupcake', '10', '(2023-03-31)(10-12-14)strawberry_1_11zon.jpeg', 80, 10, 'Accpted', '2023-03-31 08:12:14', 1),
(403, 189, 82, 'Puff Pastry', 'cake', '(2023-03-31)(10-15-06)puff pastry_11_11zon.jpeg', 150, 10, 'Accpted', '2023-03-31 08:15:06', 1),
(404, 189, 82, 'Dark Pastry', 'cake', '(2023-03-31)(10-15-38)dark pastry_10_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 08:15:38', 1),
(405, 189, 82, 'Fruit Pastry', 'cake', '(2023-03-31)(10-16-19)angle food_2_11zon.jpeg', 100, 10, 'Accpted', '2023-03-31 08:16:19', 1),
(406, 188, 82, 'Vanila Cupcake', 'cake', '(2023-03-31)(10-16-51)vanila cupcake_14_11zon.jpeg', 120, 10, 'Accpted', '2023-03-31 08:16:51', 1),
(407, 190, 85, 'Veg Cheese Burger', 'burger', '(2023-04-03)(05-33-19)veg cheese_6_11zon.jpeg', 150, 10, 'Accpted', '2023-04-03 03:33:19', 1),
(408, 190, 85, 'Paneer Makhni', 'burger', '(2023-04-03)(05-34-47)paneer makhni_5_11zon.jpeg', 130, 10, 'Accpted', '2023-04-03 03:34:47', 1),
(409, 190, 85, 'Crispy Veg Double Burger', 'burger', '(2023-04-03)(05-36-30)crispy veg double_4_11zon.jpeg', 100, 10, 'Accpted', '2023-04-03 03:36:30', 1),
(410, 190, 85, 'Burger Combo', 'burger', '(2023-04-03)(05-37-28)combo_3_11zon.jpeg', 120, 10, 'Accpted', '2023-04-03 03:37:28', 1),
(411, 191, 85, 'Veg Wrap', 'wrap', '(2023-04-03)(05-45-47)veg wrap_4_11zon.jpeg', 60, 10, 'Accpted', '2023-04-03 03:45:47', 1),
(412, 191, 85, 'Veggie Salad Wrap', 'wrap', '(2023-04-03)(05-47-19)veg wrap sandwich_3_11zon.jpeg', 120, 10, 'Accpted', '2023-04-03 03:47:19', 1),
(413, 191, 85, 'Mix Veg Wrap', 'wrap', '(2023-04-03)(05-49-06)mix veg_1_11zon.jpeg', 130, 10, 'Accpted', '2023-04-03 03:49:06', 1),
(414, 191, 85, 'Roasted  Veg Wrap', 'wrap', '(2023-04-03)(05-50-15)roasted veg_2_11zon.jpeg', 90, 10, 'Accpted', '2023-04-03 03:50:15', 1),
(415, 191, 85, 'Vegie Sandwich Wrap', 'wrap', '(2023-04-03)(05-51-08)veg wrap sandwich_3_11zon.jpeg', 140, 10, 'Rejected', '2023-04-03 03:51:08', 1),
(416, 192, 85, 'Salted French Fries', 'fries', '(2023-04-03)(06-37-39)french fries_2_11zon.jpeg', 60, 10, 'Accpted', '2023-04-03 04:37:39', 1),
(417, 192, 85, 'peri peri fries', 'fries', '(2023-04-03)(06-38-40)peri peri fries_5_11zon.jpeg', 100, 10, 'Accpted', '2023-04-03 04:38:40', 1),
(418, 192, 85, 'Frozen Fries', 'fries', '(2023-04-03)(06-39-26)frozen fries_4_11zon.jpeg', 70, 10, 'Accpted', '2023-04-03 04:39:26', 1),
(419, 192, 85, 'Crispy Fries', 'fries', '(2023-04-03)(06-41-26)crispy fries_1_11zon.jpeg', 70, 10, 'Accpted', '2023-04-03 04:41:26', 1),
(420, 193, 83, 'Veggie cheese', 'pizza', '(2023-04-03)(01-47-21)pizza_12_11zon.jpeg', 100, 10, 'Accpted', '2023-04-03 11:47:21', 1),
(421, 193, 83, 'Cheese Overloaded Pizza', 'pizza', '(2023-04-03)(01-48-23)loaded cheese_6_11zon.jpeg', 130, 10, 'Accpted', '2023-04-03 11:48:23', 1),
(422, 193, 83, 'Margherita Pizza', 'pizza', '(2023-04-03)(01-49-10)margherita_7_11zon.jpeg', 125, 10, 'Accpted', '2023-04-03 11:49:10', 1),
(423, 193, 83, 'Cheesy Margherita', 'pizza', '(2023-04-03)(01-49-51)cheesy margherita_2_11zon.jpeg', 150, 10, 'Accpted', '2023-04-03 11:49:51', 1),
(425, 193, 83, 'Veg paneer cheese pizza', 'pizza', '(2023-04-03)(01-58-45)veg_10_11zon.jpeg', 130, 10, 'Accpted', '2023-04-03 11:51:04', 1),
(426, 193, 83, 'veg Olivia pizza', 'pizza', '(2023-04-03)(01-52-42)veg1_11_11zon.jpeg', 135, 10, 'Accpted', '2023-04-03 11:52:42', 1),
(428, 194, 83, 'Italian pizza', 'pizza', '(2023-04-03)(01-53-23)italian_3_11zon.jpeg', 200, 10, 'Accpted', '2023-04-03 11:53:23', 1),
(429, 194, 83, 'cheesy Italian Pizza', 'pizza', '(2023-04-03)(01-54-04)italian-1_4_11zon.jpeg', 250, 10, 'Accpted', '2023-04-03 11:54:04', 1),
(430, 194, 83, 'Italian Combo', 'pizza', '(2023-04-03)(01-54-40)italian3_5_11zon.jpeg', 900, 10, 'Accpted', '2023-04-03 11:54:40', 1),
(431, 194, 83, 'Paperconi pizza', 'pizza ', '(2023-04-03)(01-55-22)paperconi_9_11zon.jpeg', 450, 10, 'Accpted', '2023-04-03 11:55:22', 1),
(432, 194, 83, 'Olivia Cheese Pizza', 'pizza', '(2023-04-03)(01-56-02)olivia veg pizza_8_11zon.jpeg', 380, 10, 'Accpted', '2023-04-03 11:56:02', 1),
(433, 197, 84, 'Strawberry ', '', '(2023-04-03)(02-04-02)jh12_9_11zon.jpeg', 170, 10, 'Accpted', '2023-04-03 12:04:02', 1),
(434, 197, 84, 'Cherry Drink', 'drink', '(2023-04-03)(02-04-51)kj56_10_11zon.jpeg', 150, 10, 'Accpted', '2023-04-03 12:04:51', 1),
(435, 197, 84, 'Blueberry Drink', 'drink', '(2023-04-03)(02-05-20)hg43_5_11zon.jpeg', 100, 10, 'Accpted', '2023-04-03 12:05:20', 1),
(436, 197, 84, 'Orange Drink', 'drink', '(2023-04-03)(02-06-10)hj44_6_11zon.jpeg', 120, 10, 'Accpted', '2023-04-03 12:06:10', 1),
(437, 197, 84, 'Apple Drink', 'drink', '(2023-04-03)(02-06-49)bg12_1_11zon.jpeg', 120, 10, 'Accpted', '2023-04-03 12:06:49', 1),
(438, 197, 84, 'Lemon Drink', 'drink', '(2023-04-03)(02-07-20)tj23_12_11zon.jpeg', 130, 10, 'Accpted', '2023-04-03 12:07:20', 1),
(439, 197, 84, 'cherry apple drink', 'drink', '(2023-04-03)(02-07-59)miami vice_11_11zon.jpg', 200, 10, 'Accpted', '2023-04-03 12:07:59', 1),
(440, 198, 84, 'Hot Coffee', 'coffee', '(2023-04-03)(02-08-26)coffeee_3_11zon.jpeg', 180, 10, 'Accpted', '2023-04-03 12:08:26', 1),
(441, 198, 84, 'Hot Chpcolate', 'coffee', '(2023-04-03)(02-09-08)hot chocolate_7_11zon.jpeg', 120, 10, 'Accpted', '2023-04-03 12:09:08', 1),
(442, 198, 84, 'Black Coffee', 'coffee', '(2023-04-03)(02-09-45)Brown Coffee_2_11zon.jpeg', 100, 10, 'Accpted', '2023-04-03 12:09:45', 1),
(443, 198, 84, 'Hot Chcolate with icecream', 'coffee', '(2023-04-03)(02-10-28)icecream hot chocolate_8_11zon.jpeg', 200, 10, 'Accpted', '2023-04-03 12:10:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_id`, `m_name`, `res_id`) VALUES
(175, 'cake', 82),
(176, 'Gujarati Dish', 78),
(177, 'Marathi Dish', 78),
(178, 'Punjabi Dish', 78),
(179, 'South-Indian Dish', 78),
(180, 'Ice Cream', 79),
(181, 'Shake', 79),
(182, 'Fried', 80),
(183, 'Chinese Special', 80),
(184, 'Soup And Manchurian', 80),
(185, 'Sandwich', 81),
(186, 'Frankie', 81),
(187, 'street special', 81),
(188, 'cupcake', 82),
(189, 'pastry', 82),
(190, 'Burgers', 85),
(191, 'Wrap', 85),
(192, 'French fries', 85),
(193, 'Veg Cheese Pizza', 83),
(194, 'Italian pizza', 83),
(197, 'Soft Drinks', 84),
(198, 'Coffee And Hotchocolate', 84);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offer_code` varchar(30) NOT NULL,
  `offer_text` text NOT NULL,
  `valid_user` varchar(30) NOT NULL,
  `max_usage` int(11) NOT NULL,
  `discount_type` varchar(30) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `max_discount_amount` int(11) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `flat_discount_amount` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT '1',
  `expire_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `offer_code`, `offer_text`, `valid_user`, `max_usage`, `discount_type`, `min_amount`, `max_discount_amount`, `discount_percentage`, `flat_discount_amount`, `status`, `expire_time`) VALUES
(28, 'WELCOME50', 'Get 50% discount On Your First Order', 'newuser', 1, 'percent', 100, 100, 50, 50, '1', '2023-08-18 01:45:00'),
(44, 'SUMMERSPECIAL', '20% off on Summer season', 'alluser', 1, 'percent', 200, 40, 20, NULL, '1', '2023-09-06 04:30:00'),
(45, 'FOODIFY_SPECIAL', '10% Discount on all cake', 'alluser', 5, 'flat', 100, NULL, NULL, 10, '1', '2023-09-29 03:30:00'),
(46, 'HAPPYHOLIDAYS', '30% off on your first order', 'alluser', 3, 'flat', 200, NULL, NULL, 30, '1', '2023-11-30 03:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderd_item_details`
--

CREATE TABLE `orderd_item_details` (
  `oi_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderd_item_details`
--

INSERT INTO `orderd_item_details` (`oi_id`, `o_id`, `i_id`, `quantity`, `price`) VALUES
(83, 72, 357, '1', '40'),
(84, 73, 341, '1', '300'),
(85, 74, 400, '3', '80'),
(86, 75, 357, '5', '40'),
(87, 76, 361, '8', '70');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `rozarpay_id` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `o_id`, `rozarpay_id`, `amount`, `status`) VALUES
(24, 72, 'pay_LYp2sDo9Aq0CgP', 80, 'success'),
(25, 73, 'pay_LYpeBGMS3oWXmf', 320, 'success'),
(26, 74, 'pay_LYr2c26iy2suCY', 280, 'success'),
(27, 75, 'pay_LZMtCzzS8S2nlV', 200, 'success'),
(28, 76, 'pay_LZOM1RlDT4VclX', 600, 'success');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `res_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` varchar(5000) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `moblie` varchar(12) NOT NULL,
  `owner_name` varchar(30) DEFAULT NULL,
  `delivery_charge` int(11) NOT NULL,
  `image_name` varchar(100) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `availability` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `name`, `city`, `address`, `email`, `pass`, `moblie`, `owner_name`, `delivery_charge`, `image_name`, `status`, `availability`) VALUES
(78, 'Indianium', 'surat', 'vesu,surat', 'indianium@gmail.com', '123456', '1234567897', 'indian', 20, '(2023-03-28)(07-21-35)indian.jpg', 'Accpted', 1),
(79, 'Ice Bliss', 'surat', 'piplod', 'ice@gmail.com', '123456', '1236547898', 'icebliss', 40, '(2023-03-31)(10-27-32)(2023-03-28)(07-23-02)icecream.jpg', 'Accpted', 1),
(80, 'Chinese Brew', 'surat', 'althan', 'chinese@gmail.com', '123456', '9874563210', 'chinesebrew', 20, '(2023-03-28)(07-22-10)chinese.jpg', 'Accpted', 1),
(81, 'Area Food', 'surat', 'varacha', 'area@gmail.com', '123456', '4569871235', 'areafood', 20, '(2023-03-28)(07-22-36)street.jpg', 'Accpted', 1),
(82, 'Cake corner', 'surat', 'vesu', 'cake@gmail.com', '123456', '7516499234', 'cakecorner', 40, '(2023-03-28)(07-23-33)cake.jpg', 'Accpted', 1),
(83, 'Pizza Bites', 'surat', 'katargam', 'pizzabites@gmail.com', '123456', '1593574625', 'pizzabites', 20, '(2023-03-28)(07-24-08)pizza.jpg', 'Accpted', 1),
(84, 'Drink Fiesta', 'surat', 'piplod', 'drink@gmail.com', '123456', '7892315461', 'drinkfiesta', 40, '(2023-03-28)(07-24-36)beverage.jpg', 'Accpted', 1),
(85, 'The Burger Hub', 'surat', 'vesu', 'burger@gmail.com', '123456', '1947285637', 'Burger', 50, '(2023-04-03)(05-16-25)burger_11zon.jpeg', 'Accpted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img_name`) VALUES
(41, '4129i123.png'),
(42, '4233ti256.jpg'),
(43, '4330P123.jpg'),
(44, '4434C23.jpg'),
(45, '4535c35.jpg'),
(40, '4027c1511.jpg'),
(39, '11a.jpg'),
(46, '4635c34.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `s_admin`
--

CREATE TABLE `s_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_admin`
--

INSERT INTO `s_admin` (`id`, `email`, `pass`) VALUES
(1, 'admin@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `order_status` varchar(30) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`o_id`, `u_id`, `r_id`, `a_id`, `order_status`, `subtotal`, `discount`, `grand_total`, `order_date`) VALUES
(72, 17, 79, 14, 'deliverd', 80, 0, 80, '2023-04-02 06:23:13'),
(73, 17, 78, 14, 'ontheway', 320, 0, 320, '2023-04-02 06:58:27'),
(74, 17, 82, 14, 'preparing', 280, 0, 280, '2023-04-02 08:20:16'),
(75, 17, 79, 14, 'deliverd', 200, 40, 200, '2023-04-03 15:29:34'),
(76, 17, 79, 14, 'deliverd', 600, 0, 600, '2023-04-03 16:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `moblie` varchar(12) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `name`, `email`, `moblie`, `pass`) VALUES
(17, 'krisha', 'krisha@gmail.com', '1236547895', '123456'),
(18, 'Divya', 'Divya@gmail.com', '7896541235', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `a_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `add_name` varchar(30) NOT NULL,
  `add_line` varchar(500) NOT NULL,
  `landmark` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL,
  `state` varchar(300) NOT NULL,
  `pincode` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`a_id`, `u_id`, `add_name`, `add_line`, `landmark`, `city`, `state`, `pincode`) VALUES
(14, 17, 'c-401,priyank,palace', 'sudama chowk,mota varachha,surat', 'surat', 'surat', 'gujrat', '123456'),
(15, 18, '41-c, pal bunglow', 'pandesara', 'udhana', 'surat', 'gujrat', '394210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `fk_favorite_resid` (`res_id`),
  ADD KEY `fk_favorite_uid` (`u_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `fk_feedback` (`res_id`),
  ADD KEY `fk_feedback_oid` (`o_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkm_id` (`m_id`),
  ADD KEY `fk_item_resid` (`res_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `fk_menu_resid` (`res_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offer_code` (`offer_code`);

--
-- Indexes for table `orderd_item_details`
--
ALTER TABLE `orderd_item_details`
  ADD PRIMARY KEY (`oi_id`),
  ADD KEY `fk_oid` (`o_id`),
  ADD KEY `fk_order_item_iid` (`i_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_oid_payment` (`o_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_admin`
--
ALTER TABLE `s_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fk_order_uid` (`u_id`),
  ADD KEY `fk_order_resid` (`r_id`),
  ADD KEY `fk_order_aid` (`a_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `fk_useradd_uid` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orderd_item_details`
--
ALTER TABLE `orderd_item_details`
  MODIFY `oi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `s_admin`
--
ALTER TABLE `s_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `fk_favorite_resid` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favorite_uid` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_feedback_oid` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_mid` FOREIGN KEY (`m_id`) REFERENCES `menu` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_resid` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_resid` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderd_item_details`
--
ALTER TABLE `orderd_item_details`
  ADD CONSTRAINT `fk_oid` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_item_iid` FOREIGN KEY (`i_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_oid_payment` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_order_aid` FOREIGN KEY (`a_id`) REFERENCES `user_address` (`a_id`),
  ADD CONSTRAINT `fk_order_resid` FOREIGN KEY (`r_id`) REFERENCES `restaurants` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_uid` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_useradd_uid` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
