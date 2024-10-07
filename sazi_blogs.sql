-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 10:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sazi_blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `content`, `created_at`) VALUES
(1, 'hey!!!!!!!', 'Story', '<div><font size=\"5\">this is a story!!!!!!!!!!!</font></div>', '2024-07-29 18:55:41'),
(3, 'This is a test blog', '5', 'This is a story<div><br></div><div>how are you?&nbsp;</div><div><br></div><div>and it ends!!!!!!</div>', '2024-07-30 12:21:26'),
(4, 'This is a test blog', '5', 'This is a story<div><br></div><div>how are you?&nbsp;</div><div><br></div><div>and it ends!!!!!!</div>', '2024-07-30 12:34:51'),
(5, 'sad life', '5', 'sad', '2024-07-30 12:35:56'),
(7, 'life', '3', 'isnot good', '2024-07-30 12:39:38'),
(8, 'new blog testing again!', '2', 'it is not', '2024-07-30 12:46:31'),
(10, 'another story', '5', 'this is another story', '2024-07-30 18:56:32'),
(16, 'again image test!', '3', '<img src=\"https://picsum.photos/200/300/?blur\">', '2024-07-31 20:01:53'),
(17, 'A Beautiful Sunrise, About Love And The Moon!', '4', 'Love, like the sunrise, brings warmth and light to our lives. As the first rays of dawn break through the darkness, they symbolize the hope and new beginnings that love can offer. Each sunrise is a reminder of the beauty that surrounds us, just as love reminds us of the joy and connection we share with others. The sun\'s gentle ascent mirrors the way love gradually fills our hearts, bringing clarity and purpose.<div><br></div><div><img src=\"https://i.imgur.com/I0tcOwd.jpeg\"><br></div><div><br></div><div>Yet, love also has the mystery and allure of the moon. The moon, with its soft, silvery glow, casts a serene and calming light over the night. It’s a beacon of constancy, waxing and waning, much like love, which has its phases and changes. The moon’s quiet presence in the night sky symbolizes the enduring nature of true love, which, even in moments of darkness, remains a guiding force.<br></div>', '2024-07-31 20:09:44'),
(18, 'Oww Sooo Cuteee!!!', '8', '<img src=\"https://24.media.tumblr.com/tumblr_mc42klsUyi1rhxgajo1_500.gif\">', '2024-07-31 20:40:36'),
(20, 'About Philosophy go', '11', 'Lifee is an enigmatic tapestry woven from the threads of choice and chance, each thread representing the dual forces that shape our existence. As conscious beings, we find ourselves in a perpetual dance between these two forces, where every decision we make reflects our agency, while every unforeseen event serves as a reminder of our vulnerability to the unpredictable nature of the universe.<div><img src=\"https://images.unsplash.com/photo-1636037500839-64d0c01c30c6?w=500&amp;auto=format&amp;fit=crop&amp;q=60&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHBoaWxvc29waHl8ZW58MHx8MHx8fDA%3D\"><br></div><div>The concept of choice is central to our understanding of existence. It is through our decisions that we assert our will and carve out our identities. Every choice, no matter how small, contributes to the mosaic of our lives, shaping who we are and who we become. The freedom to choose is often celebrated as one of the highest forms of human expression. It is through choice that we create meaning, align ourselves with our values, and pursue our aspirations. The power to choose gives us a sense of control and purpose, allowing us to navigate the complexities of life with intention and direction.<br></div><div><br></div><div>However, the realm of choice is inextricably intertwined with the domain of chance. Despite our best efforts to control our destinies, life remains unpredictable and capricious. The forces of chance—those random, uncontrollable events that can alter the course of our lives in an instant—remind us of the inherent uncertainty of existence. These events, whether they come in the form of unexpected opportunities or unforeseen challenges, are beyond our control and often defy our expectations. The interplay between choice and chance creates a dynamic tension that defines the human experience. We are constantly negotiating between the known and the unknown, the deliberate and the accidental.<br></div><div><img src=\"https://plus.unsplash.com/premium_photo-1682308422738-727102e018ca?w=500&amp;auto=format&amp;fit=crop&amp;q=60&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fHBoaWxvc29waHl8ZW58MHx8MHx8fDA%3D\"><br></div><div>In the end, life is not just a series of choices or a sequence of random events; it is the intricate interplay between the two. It is the dance between our will and the forces of the universe, between our desires and the realities of the world. By embracing both the power of choice and the inevitability of chance, we can navigate the journey of life with grace and resilience, finding meaning in both the paths we choose and the surprises that come our way. This philosophical perspective encourages us to live with intention while remaining open to the possibilities that lie beyond our control, creating a life that is both purposeful and enriched by the unexpected.<br></div>', '2024-08-01 18:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `created_at`) VALUES
(1, 'Fictional', '2024-07-30 11:44:22'),
(2, 'Supernatural', '2024-07-30 12:17:09'),
(3, 'Technology', '2024-07-30 12:18:43'),
(4, 'Love', '2024-07-30 12:19:19'),
(5, 'Story', '2024-07-30 12:20:40'),
(6, 'Entertainment', '2024-07-30 12:21:26'),
(7, 'AI', '2024-07-30 12:34:51'),
(8, 'Anime', '2024-07-30 12:35:56'),
(9, 'Technical', '2024-07-30 12:37:16'),
(10, 'Travel', '2024-07-30 12:39:38'),
(11, 'Advise', '2024-07-30 12:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` varchar(50) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `cname`, `comment`, `created_at`) VALUES
(2, '4', 'Bill Gates', 'Great!', '2024-07-31 15:28:59'),
(3, '4', 'Bill Gates', 'Great!', '2024-07-31 15:32:35'),
(4, '4', 'Bill Gates', 'Great!', '2024-07-31 15:34:31'),
(5, '9', 'Greta Thunberg', 'Save Climate', '2024-07-31 15:54:43'),
(6, '5', 'Kurosaki Yamettai', 'Lol, you exposed my inner self :\'(', '2024-07-31 17:10:00'),
(7, '5', 'Raheem Starling', 'Really?', '2024-07-31 17:28:04'),
(8, '5', 'Lionel Messi', 'Football makes us feel better when our life seems painful!', '2024-07-31 17:30:18'),
(9, '17', 'Rohit Sharma', 'Oye Oye I love is only Cricket, yk...', '2024-08-01 03:38:08'),
(10, '20', 'Mark Zuker', 'This blog was so good!', '2024-08-02 00:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`, `submission_datetime`) VALUES
(1, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'test', 'Hey there!!!!!!!!!!!!!', '2024-07-29 23:19:59'),
(2, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'test', 'Hey there!!!!!!!!!!!!!', '2024-07-29 23:21:21'),
(3, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'test', 'Hey there!!!!!!!!!!!!!', '2024-07-29 23:31:33'),
(4, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'test', 'Hey there!!!!!!!!!!!!!', '2024-07-29 23:31:58'),
(5, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'This is a test sending', 'Hello this is a test message. is it going?', '2024-08-01 03:39:45'),
(6, 'Mst. Fakhrun', 'Nessa', 'fancy.ctsc@gmail.com', 'test', 'this is a test message', '2024-08-02 00:10:28'),
(7, 'Rakib', 'Hosen', 'sazedurrahman707@gmail.com', 'lol', 'yo man what up?', '2024-10-05 23:48:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
