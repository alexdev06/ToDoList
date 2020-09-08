-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 05 sep. 2020 à 14:16
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `user_id`, `created_at`, `title`, `content`, `is_done`) VALUES
(1, 1, '2020-09-05 14:14:42', 'Nisi facilis ex aliquid nisi eius alias commodi.', 'Dolor quidem perferendis tenetur consectetur aut et qui. Consequatur quasi impedit eveniet nihil ut ad. Molestiae dolor ut maiores ex.', 0),
(2, 1, '2020-09-05 14:14:42', 'Eos aut aliquid qui modi perspiciatis nisi eveniet.', 'Quia fugit id et ex adipisci. Soluta explicabo labore voluptatem. Asperiores vel molestiae dolore officiis quam et laudantium. Et inventore adipisci necessitatibus.', 0),
(3, 1, '2020-09-05 14:14:42', 'Ut commodi reiciendis blanditiis ab.', 'Sunt autem sequi veritatis et sit reiciendis. Qui excepturi minima ut et. Voluptate recusandae fugit non. Aspernatur officiis quo quia expedita est sit porro. Et qui ut maxime doloremque officiis totam.', 0),
(4, 2, '2020-09-05 14:14:42', 'Ex in quis optio labore.', 'Rem beatae cumque et ut. Veritatis nesciunt adipisci nemo veritatis dolor. Atque voluptas voluptas minima dolor aut.', 0),
(5, 2, '2020-09-05 14:14:42', 'Voluptatem neque amet odit voluptatem libero similique.', 'Quis accusamus labore alias laudantium doloribus vel. Reiciendis vero et consequatur voluptatibus porro ad. Tempora rerum accusantium quia sit veniam. Illo qui omnis voluptatem consequatur assumenda a.', 0),
(6, 2, '2020-09-05 14:14:42', 'Cupiditate quia quam adipisci molestias.', 'Necessitatibus et incidunt inventore quia. Itaque vel perspiciatis minima voluptatum et voluptatem adipisci non. Quos optio non qui nam et veritatis cum tempora. Possimus neque minima rerum ea.', 0),
(7, NULL, '2020-09-05 14:14:43', 'Ad iusto amet eum ab.', 'Non dolorem adipisci exercitationem mollitia dolores eum. Et velit necessitatibus recusandae optio et non. Quae ea voluptate sunt dolor. Officiis minus voluptas sequi ut maxime quo ducimus aut.', 0),
(8, NULL, '2020-09-05 14:14:43', 'Labore maxime repellat iste sint alias praesentium.', 'Deleniti vitae quasi aperiam et minus. Aut sapiente ratione veniam possimus placeat maxime et voluptatem. Ut qui beatae rem nemo esse.', 0),
(9, NULL, '2020-09-05 14:14:43', 'Sed eum accusamus numquam accusamus doloremque sit odio quis.', 'Praesentium nostrum libero praesentium. Ex dolore veritatis accusamus impedit ullam omnis. Et unde et officia sint adipisci doloremque.', 0),
(10, NULL, '2020-09-05 14:14:43', 'Blanditiis eveniet est unde vero.', 'Quod nobis ea et nihil laborum. Molestiae sunt nulla sit dignissimos enim numquam aut.', 0),
(11, 4, '2020-09-05 14:14:43', 'Illo totam quibusdam ut et dolore ex.', 'Aut sit commodi repellat autem aut impedit. Perspiciatis deserunt nesciunt eum maxime non. Accusantium neque in perferendis mollitia.', 0),
(12, NULL, '2020-09-05 14:14:43', 'Vel facere suscipit numquam autem nihil autem saepe.', 'Voluptatum sit repellendus quis nemo sit. Blanditiis temporibus est temporibus ea a quia vel. Sed magnam ad consequatur quasi hic ipsa.', 0),
(13, NULL, '2020-09-05 14:14:43', 'Est nostrum non natus ipsam enim sapiente quo.', 'Quas illo et dolores sequi. Est sit et aspernatur omnis qui. Nam et et amet sapiente aut magni.', 0),
(14, NULL, '2020-09-05 14:14:43', 'Doloremque voluptas eos aut tempore id doloribus dolorem quo.', 'Dolorum ut harum commodi natus est quia. Ex vitae a libero enim nostrum quibusdam.', 0),
(15, 5, '2020-09-05 14:14:43', 'Placeat perferendis illo autem veritatis enim et sed.', 'Sit explicabo porro cumque natus unde exercitationem aut dicta. Eligendi ut alias veniam facere esse illo omnis. Ea quae cumque autem accusamus a et. Ea ad ab sunt ipsum libero magnam ut.', 0),
(16, 6, '2020-09-05 14:14:43', 'Eaque sint ea in dolorem est nisi.', 'Ut rem exercitationem qui veniam ut accusamus. Omnis eligendi repellendus dicta ut saepe. Velit similique velit corrupti et odio enim amet. Temporibus fugiat unde provident voluptas aut quam.', 0),
(17, 6, '2020-09-05 14:14:43', 'Consequatur aut odit qui non aut aut magnam.', 'Numquam consectetur eius voluptatum ducimus. Laborum ut eveniet ex earum rerum itaque eveniet commodi. Id praesentium et voluptates ipsam molestiae asperiores corrupti est. Quidem ut qui excepturi fugit labore.', 0),
(18, NULL, '2020-09-05 14:14:43', 'Enim eos iure aut accusantium.', 'Qui dolore exercitationem ipsum ut voluptatem. Doloribus esse similique asperiores sint et esse. Enim dolores dignissimos rerum quae ea.', 0),
(19, 7, '2020-09-05 14:14:43', 'Rerum delectus sed quas velit voluptas temporibus.', 'Quia recusandae eligendi ratione beatae. Qui rem iusto molestiae et nostrum. Pariatur soluta officia ratione.', 0),
(20, 7, '2020-09-05 14:14:43', 'Minima molestiae soluta officia voluptatibus aut occaecati quo.', 'Ut neque mollitia provident quod. Ea praesentium quia optio aperiam nemo quidem quia. Ducimus aut aut impedit ut. Qui autem quia quas qui.', 0),
(21, 7, '2020-09-05 14:14:43', 'Quidem rerum rem ut quas in.', 'Aut aut esse ducimus dolor occaecati est tempora. Facere esse quia ipsa sit. Sed qui quis illum ducimus.', 0),
(22, NULL, '2020-09-05 14:14:43', 'titre', 'Illo sed rerum aliquid architecto iste quae. Repellat corrupti dolor laboriosam facilis saepe sit aut. Aliquid hic eius ipsa et ipsam et.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `roles`) VALUES
(1, 'alex06', '$argon2id$v=19$m=65536,t=4,p=1$MVBlOXdZRmhBcndDNGFETw$7O2UilC48nBAaiTGN0Xl3uTB1BExaGUrIEHRlXFydSI', 'alex06@gmail.com', '[\"ROLE_ADMIN\"]'),
(2, 'ludo06', '$argon2id$v=19$m=65536,t=4,p=1$dGxsWkNtTVlwSVJaT3YweQ$bRPHsjCUY0M3ZZ+V71DF8PWBWRyanzbaXdT5F0jm7t4', 'ludo06@gmail.com', '[\"ROLE_USER\"]'),
(3, 'ugorczany', '$argon2id$v=19$m=65536,t=4,p=1$cnc3ZS5ZS1JHRzdYeUdNQg$jLrhglQVfEK2q1NuwStLa2aQtqgCF+j2s2eRNhiHIP4', 'hazel.breitenberg@medhurst.com', '[\"ROLE_ADMIN\"]'),
(4, 'kacie.mills', '$argon2id$v=19$m=65536,t=4,p=1$N1pNdzRpR1VMMmFSQkd0WQ$lGrlhP2ypQIEfRZOVC7A1dOY/8yJag6qj7J5JBzRzzg', 'corwin.noe@gmail.com', '[\"ROLE_ADMIN\"]'),
(5, 'ally.yost', '$argon2id$v=19$m=65536,t=4,p=1$VlNiT0l4Lmk0b3VTTW52Sw$4WEhIxV9VBaXo1B5nQSvpv6IfgMXWts8lG02kRyFSco', 'boyer.noe@senger.biz', '[\"ROLE_USER\"]'),
(6, 'verla27', '$argon2id$v=19$m=65536,t=4,p=1$UTg1dGJ4N0ZQdG1rRmFYVQ$3DJbM6W+tsASDArUoo/bsNtS27zE75CvbHYcMrRusLI', 'vbaumbach@gmail.com', '[\"ROLE_USER\"]'),
(7, 'schneider.hildegard', '$argon2id$v=19$m=65536,t=4,p=1$WTQ3R01NSUVqL09helVnMA$MlFLarScpUj0hmDf1Ww0F+/x0Oe02+f5v4dMuIoIfNQ', 'ismitham@borer.info', '[\"ROLE_ADMIN\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
