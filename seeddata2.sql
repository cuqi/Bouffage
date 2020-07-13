-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 08:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seeddata2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'primary key ',
  `tags` enum('Pasta','Rice','Vegetarian','Vegan') NOT NULL COMMENT 'What does the food consist of or what does it stand for'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'Primary key',
  `critique` varchar(300) NOT NULL COMMENT 'The comment itself',
  `comment_posted` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'When the comment was posted',
  `useful` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '~upvotes',
  `useless` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '~downvotes',
  `type` set('Question','Comment','Tip','Review') NOT NULL DEFAULT 'Comment',
  `review_stars` char(1) DEFAULT NULL COMMENT '1-5 stars zero-to-hero',
  `user_commented_id` mediumint(9) DEFAULT NULL COMMENT 'which user posted the comment',
  `comment_on_recipe_id` mediumint(9) DEFAULT NULL COMMENT 'On which recipe was the comment posted',
  `reply_comment_id` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'if the comment is a reply'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `critique`, `comment_posted`, `useful`, `useless`, `type`, `review_stars`, `user_commented_id`, `comment_on_recipe_id`, `reply_comment_id`) VALUES
(1, 'ou ma gadd ova e nesto prekrasno. nesto sto sekoj mora da go proba. spremete vlazni maramчiњa', '2020-06-01 14:29:47', 7, 4, 'Comment', NULL, 3, 2, NULL),
(2, 'le le Gorde znachi BRA-VO za tortatava. prsti da izlizhesh e. pozdrav Vera na Trajan', '2020-06-01 14:29:47', 1000, 3, 'Comment', NULL, 4, 1, NULL),
(3, 'potpolno se soglasuvam LIKE  PRF', '2020-06-01 14:30:47', 2, 16, 'Comment', NULL, 3, 2, 1),
(6, 'Test 1 za dali rabotat komentarite', '2020-06-03 12:38:36', 1, 0, 'Comment', NULL, 4, 2, NULL),
(21, 'finna get fat', '2020-06-03 13:13:37', 1, 0, 'Comment', NULL, 4, 1, NULL),
(71, 'asd', '2020-06-08 16:07:25', 0, 1, 'Comment', NULL, NULL, 2, NULL),
(75, 'Last test', '2020-07-09 13:20:37', 0, 0, 'Comment', NULL, 4, 1, NULL),
(76, 'Test 2', '2020-07-09 13:21:44', 0, 0, 'Comment', NULL, 4, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `user_following_id` mediumint(9) NOT NULL,
  `user_followee_id` mediumint(9) NOT NULL,
  `date_followed` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredient` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'What is used',
  `ingredient_id` int(11) NOT NULL,
  `recipe_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` mediumint(9) NOT NULL COMMENT 'The primary key for the Recipe tab;e',
  `title` varchar(50) NOT NULL COMMENT 'Title of the recipe',
  `cuisine` set('Chinese','Mexican','Italian','Japanese','French','Greek','Thai','Spanish','Indian','Mediterranean','Vietnamese','Cuban','American','Taiwanese','Indonesian','Moroccan','Lebanese','Brazilian','Swedish','Argentinian','Danish','Estonian','Portuguese','Korean','German','Filipino','Peruvian','Cajun','Pakistani','Macedonian','Other') NOT NULL COMMENT 'What type of cooking is it',
  `essay` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Wall of text explaining the origin of the recipe and how good it really is and how it goes great in *insert season* or with wine and on and on and on...',
  `preparation` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'how does one do the deed',
  `prep_time` tinyint(3) UNSIGNED NOT NULL,
  `cook_time` tinyint(3) UNSIGNED NOT NULL,
  `servings` tinyint(3) UNSIGNED DEFAULT NULL,
  `complexity` set('Easy','Medium','Hard') NOT NULL,
  `upvotes` smallint(5) UNSIGNED DEFAULT 0,
  `downvotes` smallint(5) UNSIGNED DEFAULT 0,
  `posting_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'date the recipe was posted',
  `special_equipment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Is any special equipment needed for making this recipe',
  `user_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table is used for the recipes ';

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `title`, `cuisine`, `essay`, `preparation`, `prep_time`, `cook_time`, `servings`, `complexity`, `upvotes`, `downvotes`, `posting_date`, `special_equipment`, `user_id`) VALUES
(1, 'Vanilla Tort', 'Other', 'This cake won me First Prize at the county fair last year. It is very chocolaty.', '1. Preheat oven to 350 degrees F (175 degrees C).\r\n2. In a large bowl, mix together the cake and pudding mixes, sour cream, oil, beaten eggs and water. Stir in the chocolate chips and pour batter into a well greased 12 cup bundt pan.\r\n3. Bake for 50 to 55 minutes, or until top is springy to the touch and a wooden toothpick inserted comes out clean. Cool cake thoroughly in pan at least an hour and a half before inverting onto a plate If desired, dust the cake with powdered sugar.', 15, 55, 12, 'Medium', 41, 14, '2020-05-19 12:27:45', 'Reynolds® Aluminum foil can be used to keep food moist, cook it evenly, and make clean-up easier.', 3),
(2, 'Mejican Tacqueauxes', 'Mexican', 'Traditional Mexican beef tacos are made with marinated sliced or shredded beef on soft corn tortillas.  Those are great!  But, that’s not what most Americans think of when we think of classic tacos.', 'If you use the traditional size hard taco shell, or small 6-inch flour tortillas, 2 tablespoons of taco meat per taco is the perfect amount.  This recipe, using 1 pound of lean ground beef, will make 12 tacos.  I tend to serve 3 tacos per person.  So I use 1 pound of taco meat for 4 people.', 5, 15, 12, 'Easy', 136, 67, '2020-05-19 12:27:45', 'Of course, if you have ground beef with more fat, you can still use it in this recipe.  Just cook th', 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_image`
--

CREATE TABLE `recipe_image` (
  `recipe_image_id` int(10) UNSIGNED NOT NULL COMMENT 'The key that binds the recipe and the image',
  `image_name` varchar(50) NOT NULL COMMENT 'The image path',
  `image_from_recipe_id` mediumint(9) NOT NULL COMMENT 'The id from the recipe where the picture is from'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_in_category`
--

CREATE TABLE `recipe_in_category` (
  `recipe_id` mediumint(9) NOT NULL,
  `category_id` mediumint(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` mediumint(9) NOT NULL COMMENT 'primary key for the users table',
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(100) NOT NULL COMMENT 'profile picture for user',
  `date_created` date NOT NULL DEFAULT current_timestamp() COMMENT 'date the account was created',
  `role` set('User','Admin','Moderator') NOT NULL DEFAULT 'User' COMMENT 'What privileges does the account have',
  `karma` int(11) DEFAULT 0,
  `followers` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Which users follow this account',
  `following` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'which users does this account follow',
  `verified_email` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `profile_picture`, `date_created`, `role`, `karma`, `followers`, `following`, `verified_email`) VALUES
(3, 'vlatko@edu.mk', '456e86313e54610921eb0a9df2a932006866dbbd', 'vladko', '', '2020-05-19', 'User', 3, 0, 0, NULL),
(4, 'filip@edu.mk', 'a574d9a772510296f7b4d6631b5550392e4f4e05', 'vilipche', '../images/11111.jpg', '2020-05-19', 'Admin', 37, 0, 0, NULL),
(10, 'a', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 'a', '', '2020-06-29', 'User', 0, 0, 0, NULL),
(11, 'b', '9a900f538965a426994e1e90600920aff0b4e8d2', 'b', '', '2020-06-29', 'User', 0, 0, 0, NULL),
(14, 'c', 'bdb480de655aa6ec75ca058c849c4faf3c0f75b1', 'c', '../images/avatar.png', '2020-06-30', 'User', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote_comment`
--

CREATE TABLE `vote_comment` (
  `user_voted_this_comment` mediumint(9) NOT NULL,
  `comment_got_voted_id` mediumint(8) UNSIGNED NOT NULL,
  `u_or_d` varchar(1) NOT NULL COMMENT 'did the user upvote or downvote'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote_comment`
--

INSERT INTO `vote_comment` (`user_voted_this_comment`, `comment_got_voted_id`, `u_or_d`) VALUES
(4, 2, 'd'),
(4, 3, 'u'),
(4, 1, 'd'),
(4, 21, 'u');

-- --------------------------------------------------------

--
-- Table structure for table `vote_recipe`
--

CREATE TABLE `vote_recipe` (
  `user_voted_this_recipe_id` mediumint(9) NOT NULL,
  `recipe_got_voted_id` mediumint(9) NOT NULL,
  `u_or_d` varchar(1) DEFAULT NULL COMMENT 'did the user upvote or downvote?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `tags` (`tags`) USING HASH;

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_comment_id` (`user_commented_id`),
  ADD KEY `recipe_comment_id` (`comment_on_recipe_id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`user_following_id`,`user_followee_id`),
  ADD KEY `user_followee_id` (`user_followee_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `recipe_ingredient_id` (`recipe_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `servings` (`servings`) USING HASH,
  ADD KEY `cook_time` (`cook_time`,`prep_time`) USING BTREE,
  ADD KEY `complexity` (`complexity`) USING HASH,
  ADD KEY `user_recipe_id` (`user_id`);

--
-- Indexes for table `recipe_image`
--
ALTER TABLE `recipe_image`
  ADD PRIMARY KEY (`recipe_image_id`),
  ADD KEY `recipe_image_id` (`image_from_recipe_id`);

--
-- Indexes for table `recipe_in_category`
--
ALTER TABLE `recipe_in_category`
  ADD PRIMARY KEY (`recipe_id`,`category_id`),
  ADD KEY `recipe_category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vote_comment`
--
ALTER TABLE `vote_comment`
  ADD KEY `comment_got_voted_id` (`comment_got_voted_id`),
  ADD KEY `user_voted_on_comment` (`user_voted_this_comment`);

--
-- Indexes for table `vote_recipe`
--
ALTER TABLE `vote_recipe`
  ADD KEY `user_voted_this_recipe` (`user_voted_this_recipe_id`),
  ADD KEY `recipe_got_voted` (`recipe_got_voted_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'primary key ';

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'The primary key for the Recipe tab;e', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recipe_image`
--
ALTER TABLE `recipe_image`
  MODIFY `recipe_image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'The key that binds the recipe and the image';

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'primary key for the users table', AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `recipe_comment_id` FOREIGN KEY (`comment_on_recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment_id` FOREIGN KEY (`user_commented_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `user_followee_id` FOREIGN KEY (`user_followee_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_following_id` FOREIGN KEY (`user_following_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `recipe_ingredient_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `user_recipe_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `recipe_image`
--
ALTER TABLE `recipe_image`
  ADD CONSTRAINT `recipe_image_id` FOREIGN KEY (`image_from_recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_in_category`
--
ALTER TABLE `recipe_in_category`
  ADD CONSTRAINT `category_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipe_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_comment`
--
ALTER TABLE `vote_comment`
  ADD CONSTRAINT `comment_got_voted_id` FOREIGN KEY (`comment_got_voted_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_voted_on_comment` FOREIGN KEY (`user_voted_this_comment`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_recipe`
--
ALTER TABLE `vote_recipe`
  ADD CONSTRAINT `recipe_got_voted` FOREIGN KEY (`recipe_got_voted_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_voted_this_recipe` FOREIGN KEY (`user_voted_this_recipe_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
