  -- phpMyAdmin SQL Dump
  -- version 5.2.0
  -- https://www.phpmyadmin.net/
  --
  -- Host: localhost:3306
  -- Generation Time: Nov 12, 2024 at 09:53 AM
  -- Server version: 8.0.30
  -- PHP Version: 8.1.10

  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  START TRANSACTION;
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;

  --
  -- Database: `quiz_master`
  --

  -- --------------------------------------------------------

  --
  -- Table structure for table `achievements`
  --

  CREATE TABLE `achievements` (
    `achievement_id` int NOT NULL,
    `user_id` int NOT NULL,
    `achievement_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `date_earned` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `answers`
  --

  CREATE TABLE `answers` (
    `answer_id` int NOT NULL,
    `question_id` int NOT NULL,
    `answer_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `is_correct` tinyint(1) DEFAULT '0'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `answer_options`
  --

  CREATE TABLE `answer_options` (
    `id` int NOT NULL,
    `question_id` int NOT NULL,
    `option_text` text NOT NULL,
    `is_correct` tinyint(1) DEFAULT '0'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `leaderboards`
  --

  CREATE TABLE `leaderboards` (
    `leaderboard_id` int NOT NULL,
    `quiz_id` int NOT NULL,
    `user_id` int NOT NULL,
    `score` int NOT NULL,
    `ranking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------

  --
  -- Table structure for table `password_reset`
  --

  CREATE TABLE `password_reset` (
    `id` int NOT NULL,
    `email` varchar(255) NOT NULL,
    `reset_token` varchar(10) NOT NULL,
    `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `password_reset`
  --

  INSERT INTO `password_reset` (`id`, `email`, `reset_token`, `created_on`) VALUES
  (1, 'sonnypsarcia@gmail.com', 'h0KMH6n1AX', '2024-11-08 11:27:29'),
  (2, 'toxicookie.v1@gmail.com', '8uM3JFEm1H', '2024-11-11 21:45:01');

  -- --------------------------------------------------------

  --
  -- Table structure for table `questions`
  --

  CREATE TABLE `questions` (
    `question_id` int NOT NULL,
    `quiz_id` int NOT NULL,
    `question_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `media_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
    `answer_mode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
    `correct_answer` text
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `questions`
  --

  INSERT INTO `questions` (`question_id`, `quiz_id`, `question_text`, `media_url`, `answer_mode`, `correct_answer`) VALUES
  (19, 28, 'Sinong PBB ex-housemate ang laging masakit ang uloq?', NULL, NULL, 'KAI ANNE ADARLO'),
  (20, 28, 'Sinong PBB ex-housemate ang mukhang ibon?', NULL, NULL, 'RAINZ ACLAN'),
  (21, 28, 'Anong pangalan ang ginagampanan ng lead actress na si Belle Mariano sa Can\'t Buy Me Love', NULL, NULL, 'LING DIMAILIG'),
  (22, 28, 'Sinong artista ang kumanta ng Birds of The Feather?', NULL, NULL, 'ELLIE EILISH'),
  (23, 28, 'Sino ang main rapper ng BINI?', NULL, NULL, 'MIKHA SUAREZ');

  -- --------------------------------------------------------

  --
  -- Table structure for table `quizzes`
  --

  CREATE TABLE `quizzes` (
    `quiz_id` int NOT NULL,
    `user_id` int NOT NULL,
    `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
    `difficulty` enum('Easy','Medium','Hard') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `is_published` tinyint(1) DEFAULT '0',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `quizType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `isTimed` tinyint(1) DEFAULT '0',
    `showResults` tinyint(1) DEFAULT '0'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `quizzes`
  --

  INSERT INTO `quizzes` (`quiz_id`, `user_id`, `title`, `category`, `difficulty`, `is_published`, `created_at`, `updated_at`, `quizType`, `isTimed`, `showResults`) VALUES
  (28, 2, 'CELEBRITY TRIVIA', 'general-knowledge', 'Hard', 0, '2024-11-11 22:07:43', '2024-11-12 06:07:43', 'identification', 0, 1);

  -- --------------------------------------------------------

  --
  -- Table structure for table `sessions`
  --

  CREATE TABLE `sessions` (
    `session_id` int NOT NULL,
    `user_id` int NOT NULL,
    `browser` varchar(255) NOT NULL,
    `ip` varchar(60) NOT NULL,
    `session_data` varchar(70) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `sessions`
  --

  INSERT INTO `sessions` (`session_id`, `user_id`, `browser`, `ip`, `session_data`, `created_at`) VALUES
  (3, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', '::1', '4883436da8e29a0da198832c988c4986ac5b0326ada46bfdb5931b0aba19b732', '2024-11-08 11:51:44'),
  (9, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', '::1', '73b9ef6968316dbab3c5a29da16919d6bfac80e27bf81eb4b1a9042e9f34e872', '2024-11-11 21:54:58'),
  (11, 2, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edg/130.0.0.0', '::1', '2c4c68a2e0113add4b823355c34eb5b7bc79f32d994d9456c65e74ac374b1296', '2024-11-11 23:29:16'),
  (13, 2, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edg/130.0.0.0', '::1', 'bc899914639f5628ac418309821ad8a13f0d73286827d56c975741f2aee62007', '2024-11-11 23:30:12'),
  (14, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', '::1', '70faa3a7bdaa063651fa5105cb6a54866804ecc43f907c552e5d61862ba198ec', '2024-11-11 23:36:25'),
  (15, 2, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edg/130.0.0.0', '::1', '2b87515b31aa4bba41afb3cef87e1212070cef80947fc2ab922bfae5942c9d46', '2024-11-11 23:53:00'),
  (16, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', '::1', '2eac84392a2e461b044fe0d72c5181e4a1366fb02d904c0974e4b67e4af602ca', '2024-11-12 00:36:34'),
  (17, 2, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edg/130.0.0.0', '::1', 'd1217f3bc3c1e76a6a017dbf3aa62d40ec012af95a27fe26f8fa321d88a08f2e', '2024-11-12 12:39:55'),
  (21, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', '::1', '515c590a70fca3333addb7dd83c4f22a5b49447d492125f364559bf9585d42f0', '2024-11-12 14:44:59'),
  (22, 2, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36 Edg/130.0.0.0', '::1', '2dad074d798c9ea1d1f69bf4b649cc3097174f8088fccdee6aa9f02245f5d1f5', '2024-11-12 15:01:09');

  -- --------------------------------------------------------

  --
  -- Table structure for table `users`
  --

  CREATE TABLE `users` (
    `id` int NOT NULL,
    `username` varchar(20) NOT NULL,
    `email` varchar(255) NOT NULL,
    `email_token` varchar(255) NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `remember_token` varchar(100) DEFAULT NULL,
    `google_oauth_id` varchar(255) DEFAULT NULL,
    `is_admin` tinyint(1) NOT NULL DEFAULT '0',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Dumping data for table `users`
  --

  INSERT INTO `users` (`id`, `username`, `email`, `email_token`, `email_verified_at`, `password`, `remember_token`, `google_oauth_id`, `is_admin`, `created_at`, `updated_at`) VALUES
  (2, 'sonny', 'toxicookie.v1@gmail.com', '086fbdbd9c22e8b254adf75355aa6be9d3c8ea0d01141b5d2c855d51b61369d5691908b831dc5cd96cea8fbd518ce980a139', NULL, '$2y$04$cDXMHRcPXEzD031yezK4UuRhBztHwZckRHNLSM0nT9YlMb7jKvZou', NULL, NULL, 1, '2024-11-08 03:40:14', NULL);

  -- --------------------------------------------------------

  --
  -- Table structure for table `user_scores`
  --

  CREATE TABLE `user_scores` (
    `score_id` int NOT NULL,
    `user_id` int NOT NULL,
    `quiz_id` int NOT NULL,
    `score` int NOT NULL,
    `time_taken` int DEFAULT NULL,
    `date_taken` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Indexes for dumped tables
  --

  --
  -- Indexes for table `achievements`
  --
  ALTER TABLE `achievements`
    ADD PRIMARY KEY (`achievement_id`),
    ADD KEY `idx_achievement_user` (`user_id`),
    ADD KEY `idx_achievement_type` (`achievement_type`);

  --
  -- Indexes for table `answers`
  --
  ALTER TABLE `answers`
    ADD PRIMARY KEY (`answer_id`),
    ADD KEY `idx_answer_question` (`question_id`);

  --
  -- Indexes for table `answer_options`
  --
  ALTER TABLE `answer_options`
    ADD PRIMARY KEY (`id`),
    ADD KEY `question_id` (`question_id`);

  --
  -- Indexes for table `leaderboards`
  --
  ALTER TABLE `leaderboards`
    ADD PRIMARY KEY (`leaderboard_id`),
    ADD KEY `idx_leaderboard_user` (`user_id`),
    ADD KEY `idx_leaderboard_quiz_score` (`quiz_id`,`score`),
    ADD KEY `idx_leaderboard_date` (`ranking_date`);

  --
  -- Indexes for table `password_reset`
  --
  ALTER TABLE `password_reset`
    ADD PRIMARY KEY (`id`);

  --
  -- Indexes for table `questions`
  --
  ALTER TABLE `questions`
    ADD PRIMARY KEY (`question_id`),
    ADD KEY `idx_question_quiz` (`quiz_id`);

  --
  -- Indexes for table `quizzes`
  --
  ALTER TABLE `quizzes`
    ADD PRIMARY KEY (`quiz_id`),
    ADD KEY `idx_quiz_user` (`user_id`),
    ADD KEY `idx_quiz_difficulty` (`difficulty`),
    ADD KEY `idx_quiz_category` (`category`) USING BTREE;

  --
  -- Indexes for table `sessions`
  --
  ALTER TABLE `sessions`
    ADD PRIMARY KEY (`session_id`);

  --
  -- Indexes for table `users`
  --
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `username` (`username`),
    ADD UNIQUE KEY `email` (`email`);

  --
  -- Indexes for table `user_scores`
  --
  ALTER TABLE `user_scores`
    ADD PRIMARY KEY (`score_id`),
    ADD KEY `idx_user_quiz` (`user_id`,`quiz_id`),
    ADD KEY `idx_date_taken` (`date_taken`),
    ADD KEY `fk_user_scores_quiz` (`quiz_id`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `achievements`
  --
  ALTER TABLE `achievements`
    MODIFY `achievement_id` int NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `answers`
  --
  ALTER TABLE `answers`
    MODIFY `answer_id` int NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `answer_options`
  --
  ALTER TABLE `answer_options`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `leaderboards`
  --
  ALTER TABLE `leaderboards`
    MODIFY `leaderboard_id` int NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT for table `password_reset`
  --
  ALTER TABLE `password_reset`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- AUTO_INCREMENT for table `questions`
  --
  ALTER TABLE `questions`
    MODIFY `question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

  --
  -- AUTO_INCREMENT for table `quizzes`
  --
  ALTER TABLE `quizzes`
    MODIFY `quiz_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

  --
  -- AUTO_INCREMENT for table `sessions`
  --
  ALTER TABLE `sessions`
    MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

  --
  -- AUTO_INCREMENT for table `users`
  --
  ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- AUTO_INCREMENT for table `user_scores`
  --
  ALTER TABLE `user_scores`
    MODIFY `score_id` int NOT NULL AUTO_INCREMENT;

  --
  -- Constraints for dumped tables
  --

  --
  -- Constraints for table `achievements`
  --
  ALTER TABLE `achievements`
    ADD CONSTRAINT `fk_achievement_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

  --
  -- Constraints for table `answers`
  --
  ALTER TABLE `answers`
    ADD CONSTRAINT `fk_answers_question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

  --
  -- Constraints for table `answer_options`
  --
  ALTER TABLE `answer_options`
    ADD CONSTRAINT `answer_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

  --
  -- Constraints for table `leaderboards`
  --
  ALTER TABLE `leaderboards`
    ADD CONSTRAINT `fk_leaderboard_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`),
    ADD CONSTRAINT `fk_leaderboard_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

  --
  -- Constraints for table `questions`
  --
  ALTER TABLE `questions`
    ADD CONSTRAINT `fk_questions_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

  --
  -- Constraints for table `quizzes`
  --
  ALTER TABLE `quizzes`
    ADD CONSTRAINT `fk_quiz_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

  --
  -- Constraints for table `user_scores`
  --
  ALTER TABLE `user_scores`
    ADD CONSTRAINT `fk_user_scores_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`),
    ADD CONSTRAINT `fk_user_scores_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
  COMMIT;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
