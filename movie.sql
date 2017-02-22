-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 18, 2017 at 01:48 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`) VALUES
(1, 'Star Wars: Episode IV - A New Hope', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a wookiee and two droids to save the galaxy from the Empire\'s world-destroying battle-station, while also attempting to rescue Princess Leia from the evil Darth Vader.'),
(2, 'Star Wars: Episode VI - Return of the Jedi', 'After rescuing Han Solo from the palace of Jabba the Hutt, the rebels attempt to destroy the second Death Star, while Luke struggles to make Vader return from the dark side of the Force.'),
(3, 'Star Wars: Episode V - The Empire Strikes Back', 'After the rebels have been brutally overpowered by the Empire on their newly established base, Luke Skywalker takes advanced Jedi training with Master Yoda, while his friends are pursued by Darth Vader as part of his plan to capture Luke.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `review` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `movie_id`, `title`, `review`) VALUES
(1, 2, 'All the fun of the original with a much better', 'The Rebellion has struck an important blow to the power of the Empire by destroying it\'s Death Star, however the power of the Dark Side of the Force remains strong and continues to hunt the rebellion. While the Rebellion base on Hoth is under treat, Luke has gone to a distant swamp planet to receive further Jedi training from Master Yoda. However the power of the dark side should not be underestimated and many dark truths are revealed as the threat of the Empire looms large.\\r\\n\\r\\nFollowing Star Wars was never going to be easy but this is actually better. Empire retains the same characters and the same sense of fun that the first had – the battle on Hoth is just one of THE moments of the series. However what gets added to that is a much darker strand. The Empire is not beaten by the destruction of one ship – it\'s power is barely dented in fact. This sees some startling revelations (I won\'t spoil it in case you\'ve been living under a rock!) but also sees significant blows to the rebellion. In fact the ending of this film could not be more different from the end of Star Wars.\\r\\n\\r\\nLike the recent episode two this follows two strands – the more pedestrian scenes with Luke and Yoda and the more action based scenes with Han and company. The scenes with Yoda add depth to the film and hint at the truth. Meanwhile the other half is a lot more action orientated and has comedy and good new characters such as Bobba Fett. The two work well together and come together well for a great finale. The addition of a dark strand to the film makes it all the better as it can be enjoyed as a story and not just a fun sci-fi film with good effects.\\r\\n\\r\\nThe characters are better here than the first. The strong characters from the first (Han, C3P0 et al) are all still good here. However we also get a much more interesting version of Luke as he continues his journey into becoming a full Jedi. Yoda is a good addition (despite sounding like Fozzie Bear!) and Darth Vader becomes a lot more than just a good villain – we learn his past, a revelation then, but a thing of common knowledge now.\\r\\n\\r\\nOverall this is as good as Star Wars at it\'s heart, but the darker nature of the film makes it much better. Where the first one was a victorious uprising this is, as the title suggests, the time in history where the Empire strikes back against the uprising. All the music, characters and things that make Star Wars Star Wars are here and it\'s simply one of the best of the series to date.'),
(2, 1, 'No words to say', 'There\'s not much to say about this movie this is *THE* movie that changed it all.\\r\\n\\r\\nIt\'s my favourite movie, and not only among the quadrilogy, among all movies; it has everything that can be great in a movie, great characters, great story, great sights, great special effects (they don\'t show 23 years) and a mythological background that made us dream for decades now, and that\'ll keep us dreaming for a long, long time. Maybe the characters I liked most in this one are Old Obi-Wan Kenobi, wonderfully portrayed by Alec Guinness, and Han Solo, Harrison Ford\'s first important role, they\'re both great.\\r\\n\\r\\nNot to mention John Williams\' wonderful score, without of it, the movie wouldn\'t have been this great it\'s a perfect mix, that\'s what it is!\\r\\n\\r\\n\\r\\n'),
(3, 3, 'Age helps final episode of sci-fi saga', 'Perspective is a good thing. Since the release of \"Star Wars Episode I: The Phantom Menace\", claims and counter-claims of just how Episode\'s II and III will eventuate has taken the spotlight off the \'original\' Star Wars films, making them part of a cohesive whole, rather than segregating the older and new films into separate trilogies. What the new films have done is allow fresh perspectives to be placed on the older films. This new outlook allows us to greater appreciate what has often been viewed as the weakest of the original trilogy: \"Return of the Jedi\". Often derided for its overly \'cute\' factor, ROTJ is in a sense as strong as the original and only slightly less impressive than the nearly perfect \"The Empire Strikes Back\". Indeed the \'cute\' element of ROTJ, namely the Ewoks, remains a weak link in the entire series. Did George Lucas place the furry midgets in the film purely for the merchandising possibilities? Only he can answer that question.\\r\\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);
