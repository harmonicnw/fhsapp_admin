-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2014 at 01:31 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fhsapp_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL COMMENT 'should we change this??',
  `location` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `start_date` date NOT NULL COMMENT 'see date',
  `end_date` date NOT NULL COMMENT 'see date',
  `author` int(10) NOT NULL COMMENT 'Go by id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `date`, `location`, `time`, `start_date`, `end_date`, `author`, `timestamp`) VALUES
(51, 'HW', '<p>Read Chpt. 1 - 4 by Thursday.</p>', '0000-00-00', '', '', '2013-11-25', '2013-12-16', 1, '2013-12-14 20:04:09'),
(52, 'General Announcement', '<p>General</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:02:17'),
(53, 'Class', '<p>Class</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:23'),
(54, 'Club', '<p>Clubby stuff</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:33'),
(55, 'Sports', '<p>Sporty stuff</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:53'),
(102, 'One more week left in quarter 3', '<p>Reminder - There is only one week left in 3rd quarter. &nbsp;ALL late assignments are DUE Monday, April 7th. &nbsp;Also, if you are doing Honor''s credit, you must have your novel project #1 to me ASAP. &nbsp;</p>\r\n<p>No school Friday, April 11th, so that I can publish grades.</p>', '0000-00-00', '', '', '2014-04-06', '2014-04-11', 32, '2014-04-06 15:03:25'),
(89, 'Slam Informational Meeting', '<p>March 4 Lunch in Library. Must come to 1st Meeting to get Registration Form for FHS Slam 2014!</p>', '2014-03-04', 'Library', 'Lunch', '2014-02-22', '2014-03-04', 20, '2014-02-22 22:56:07'),
(59, 'There is a Krampus loose on Hawthorne!', '<p>I''d be okay with this, if it was IN SEASON! If you see the Krampus, please give him a stern talking-to and call the local authorities. Or write to your congressperson! Whatever, y''know?&nbsp;</p>', '2013-12-31', 'Hawthorne St. ', 'Whenever', '2013-12-31', '2014-01-01', 1, '2014-01-01 00:39:00'),
(60, '" character test one', '<p>" character test one&nbsp;</p>', '2014-01-04', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:15:12'),
(61, '! character test two', '<p>! character test two&nbsp;</p>', '2014-01-04', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:19:14'),
(62, '~ character test three', '<p>~ character test three&nbsp;</p>', '2014-01-04', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:20:01'),
(63, '/ character test five', '<p>/ character test five</p>', '2014-01-04', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:22:00'),
(64, ' character test six ', '<p>\\ character test six&nbsp;</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:22:50'),
(65, 'character test four point one ', '<p>'' character test four point one&nbsp;</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:24:35'),
(66, '( character test seven', '<p>character test seven</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:33:43'),
(67, ') character test eight', '<p>) character test eight</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:34:19'),
(68, '{ character test nine', '<p>{ character test nine</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:34:51'),
(69, '} character test ten', '<p>} character test ten</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:35:18'),
(70, '< character test eleven ', '<p>&lt; character test eleven&nbsp;</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:36:13'),
(71, '> character test twelve', '<p>&gt; character test twelve</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:37:04'),
(72, '[ character test thirteen SPOOKY', '<p>[ character test thirteen SPOOKY</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:37:33'),
(73, '] character test fourteen', '<p>] character test fourteen</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:38:05'),
(74, '_ character test 15', '<p>character test 15 _&nbsp;</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:38:37'),
(75, '@ character test sixteen', '<p>ergo</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:40:38'),
(76, '# character test seventeen', '<p>ergo</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:40:58'),
(77, '$ character test eighteen', '<p>ergo</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:41:22'),
(78, '1234567890 character test nineteen', '<p>ergo</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:43:09'),
(79, '% character test twenty ', '<p>ergo</p>', '0000-00-00', '', '', '2014-01-04', '2014-01-05', 1, '2014-01-04 21:43:47'),
(93, 'Testing Announcements....', '<p>This is a test.&nbsp; Only a test.&nbsp; Thanks.&nbsp; Wait, while you are here, go to my <a href="http://www.youtube.com/channel/UCzb7leP5OkZ9DgQ7P7SNEJg/feed">YouTube page</a>.&nbsp; Watch, like, subscribe.&nbsp;</p>', '2014-03-07', 'Everywhere', 'NOW!', '2014-02-27', '2014-03-08', 19, '2014-02-27 23:01:44'),
(81, '""''''!@#$%^&*()_+\\|/?<>,.;;:{"}{', '<p>yo</p>', '2014-01-11', '', '', '2014-01-11', '2014-01-12', 1, '2014-01-11 20:59:10'),
(82, 'etcetera!', '<p>HAHA</p>', '2014-01-11', '', '', '2014-01-11', '2014-01-12', 1, '2014-01-11 21:04:32'),
(83, 'Annual ', '<p>This saturday, be sure to abuse moe socha.&nbsp;</p>', '2014-01-11', 'Library at Franklin', '2:18 pm', '2014-01-11', '2014-01-12', 1, '2014-01-11 22:18:10'),
(84, 'testertester', '<p>blenderblender</p>', '2014-01-11', '', '', '2014-01-11', '2014-01-12', 1, '2014-01-11 22:19:08'),
(85, 'Upcoming Due Dates 6th Period', '<p><strong>Chapter 13 homework:</strong> Friday, January 17th</p>\r\n<p><strong>EDTA Lab:</strong> Friday, January 17th 3:30 pm</p>\r\n<p><strong>Final:</strong> January 21st 12:05 - 1:35pm</p>\r\n<p><strong>Quarter 2 Formal Report:</strong> Januarry 24th 11:25am</p>', '0000-00-00', '', '', '2014-01-17', '2014-01-24', 18, '2014-01-17 16:04:10'),
(86, 'Upcoming Due Dates 3rd Period', '<ol>\r\n<li><strong>Chapter 13 homework:</strong> Friday, January 17th</li>\r\n<li><strong>EDTA Lab:</strong> Tuesday, January 21st 3:30 pm</li>\r\n<li><strong>Final:</strong> January 23rd 9:55 - 11:25am</li>\r\n<li><strong>Quarter 2 Formal Report:</strong> Januarry 24th 11:25am</li>\r\n</ol>', '0000-00-00', '', '', '2014-01-17', '2014-01-24', 18, '2014-01-17 16:07:53'),
(87, 'Test 02/28/14', '<p>Hello All!&nbsp; We will have a test this upcoming Friday 02/28/14!&nbsp; Study Study Study!&nbsp; We will review the class beforehand.&nbsp;</p>', '2014-02-28', 'Room 126 (My classroom)', '8:15am', '2014-02-24', '2014-03-01', 19, '2014-02-22 21:54:59'),
(90, 'Upcomming Test!', '<p>There will be a test coming soon.&nbsp; For period 3 it will be Friday 02/28/14.&nbsp; For period 2 and 6 it will be Monday March 3rd.&nbsp; We will have a review day beforehand!&nbsp; It is on chapter 10!</p>\r\n<p>Make sure you are ready for this test.&nbsp; </p>', '2014-02-28', 'Room 126 (Jamieson''s Room)', '8:15am', '2014-02-24', '2014-03-04', 19, '2014-02-23 00:57:02'),
(91, 'Test!!!!', '<p>We have a test coming up!&nbsp; It will be Thursday, February 27th!!!&nbsp; That''s this Thursday!&nbsp; Make sure you study all worksheets and the study guide to prepare for this test.&nbsp;</p>', '2014-02-27', 'Room 126 (Jamieson''s Room)', '4th Period', '2014-02-24', '2014-02-28', 19, '2014-02-23 00:58:24'),
(92, 'FREE STUDENT TICKETS', '<p class="MsoNormal"><strong><span style="font-size: 12pt; line-height: 115%;">Come join 100 other students to hear&nbsp; US Supreme Court Justice Sonia Sotomayor on March 11 7:30 at the Schnitzer&nbsp; for FREE! Transportation from FHS and tickets provided to the first 100 students who get their permission slips in to Ms. Childs Room 244. Slips can be obtained from 244/Library or Social Studies/Language Arts/Law/Spanish teacher . Slips must be in by March 4 For more information see sponsor links-Literary Arts or MCPL&nbsp;</span></strong></p>', '2014-03-11', 'Arlene Schnitzer Concert Hall', '7:30 pm', '2014-02-27', '2014-03-05', 22, '2014-02-26 22:30:43'),
(94, 'Chapter 6 Beginning ', '<p>Hopefully some of you are helping test this app.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>We just started chapter 6.&nbsp; All material from chapter 5 should be turned in.&nbsp; Make sure you turn in the worksheet I gave out on Inverses the day we took the chapter 5 test.&nbsp; Also make sure you did today''s worksheet.&nbsp; For the quiz:&nbsp; As long as you got the inverse for the second problem, I''m fine with that.&nbsp; We can touch on how to take the 5th root of something soon.&nbsp;</p>', '2014-03-06', 'Math Class', 'All Week', '2014-03-03', '2014-03-07', 19, '2014-03-03 20:27:34'),
(95, 'Silver-Copper replacement Lab', '<p>Due tomorrow, March 6, 2014!</p>', '2014-03-06', '234', '1st period', '2014-03-05', '2014-03-07', 25, '2014-03-05 18:59:57'),
(96, 'Test Tuesday, March 18th!!!', '<p>We will have a test on Tuesday, March 18th on Chapter 9 material.&nbsp; Study, study, study.&nbsp;</p>', '2014-03-18', 'Jamieson''s Room 126', 'Class time', '2014-03-10', '2014-03-20', 19, '2014-03-07 02:37:02'),
(97, 'Extra Extra!!', '<p><em><strong>Here is a problem I found.&nbsp; This person is giving clues about how old they are.&nbsp; Find out for some extra credit:</strong></em></p>\n<p>I started working at 15.&nbsp; I spent 1/4 of my working life in a factory.&nbsp; I spent 1/5 of my working life in an office, and I spent 1/3 of my working life as a school caretaker.&nbsp; For the last 13 years of my working life I''ve&nbsp; been a chipmunk herder.&nbsp; How old am I?</p>\n<p>&nbsp;</p>\n<p>Write it down.&nbsp; Show work.&nbsp; Thanks.&nbsp;</p>', '2014-03-17', 'Here', 'Now', '2014-03-13', '2014-03-19', 19, '2014-03-16 01:34:59'),
(98, 'Image test', '<p>Cartoon.</p>\r\n<p>&nbsp;</p>\r\n<p><img src="https://upload.wikimedia.org/wikipedia/en/5/50/ST_TroubleWithTribbles.jpg" alt="Tribbles" width="400" height="294" /></p>', '0000-00-00', '', '', '2014-03-15', '2014-03-17', 27, '2014-03-16 01:38:05'),
(99, 'Finish up your narratives', '<p>Come in and work on your writing sample-Tuesday from 3:15 to 4:15, Wed during Office Hours, and Thurs 3:15 to 4:15. These are the only times to finish. Writing samples will be sent off at the end of the week.</p>', '2014-03-18', 'Room 159', 'Tues 3:15, Wed 2:15, Thurs 3:15', '2014-03-18', '2014-03-20', 31, '2014-03-18 20:34:07'),
(100, 'March 31', '<p>Module 8 test for 7th period.&nbsp;</p>', '2014-03-31', '244', '7th period', '2014-03-20', '2014-04-01', 20, '2014-03-20 22:14:18'),
(101, 'April 2 Mandatory Meeting & optional Workshop', '<p>Office Hours April 2. you must come to a check in meeting and then you can stay for a writing workshop&nbsp;</p>', '2014-04-02', 'library', 'office hours', '2014-03-21', '2014-04-03', 20, '2014-03-20 22:08:18'),
(103, 'New Announcement', '<p>This is a test</p>', '2014-04-07', 'Here', 'Now', '2014-04-06', '2014-04-09', 1, '2014-04-07 22:33:55'),
(104, 'FST 7-3 QUIZ', '<p>Hey FST Posse! &nbsp;Just a reminder that the best quiz number (FST 7-3) is coming up on Wednesday!</p>\r\n<p>Thx,</p>\r\n<p>Botas</p>', '2014-04-09', '141', '6th and 8th Period', '2014-04-07', '2014-04-09', 28, '2014-04-07 22:35:00'),
(105, 'AP Preparation', '<p>The month of April is AP exam preparation month</p>', '2014-04-07', 'Room 245', 'ALL DAY', '2014-04-07', '2014-04-11', 24, '2014-04-07 22:36:00'),
(106, 'Biology grades', '<p>Be sure to check your grades before the end of the week to make sure you aren''t missing anything before quarter grades.&nbsp;</p>', '0000-00-00', '', '', '2014-04-07', '2014-04-19', 34, '2014-04-07 22:37:00'),
(110, 'Senior Prom', '<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">Hey Seniors-Prom is coming up on Saturday, April 26th, 2014 at The Refuge PDX.&nbsp; </span></strong></p>\r\n<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">Tickets will be on sale at LUNCH, near Benji. Cost is $30.00 for singles and $50.00 for couples.&nbsp; Be sure to get your tickets!&nbsp; </span></strong></p>\r\n<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">Non-FHS guest forms are available on the counter in the VP Office and are due TODAY- Monday, April 21st.&nbsp; </span></strong></p>\r\n<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">You must turn-in your APPROVED guest form PRIOR to purchasing tickets.&nbsp; See form for rules.</span></strong></p>', '2014-04-21', 'Near Benji', 'Lunch', '2014-04-20', '2014-04-22', 1, '2014-04-20 23:53:15'),
(111, 'Earth Week', '<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">Earth Club is celebrating Earth Week this week. Stop by Benji during lunch to donate old t-shirts for repurposing or make your very own Earth Week pledge!</span></strong></p>', '0000-00-00', 'Benji', 'All Week', '2014-04-20', '2014-04-26', 1, '2014-04-20 23:54:19'),
(112, 'Early Dismissal Athletics', '<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">EARLY DISMISSAL for ATHLETICS TODAY- Please dismiss Varsity Softball at 2:40pm for a game at Clinton Park.&nbsp; JV Baseball at 2:55pm for a game at Bloomington.</span></strong></p>', '2014-04-21', '', '2:40 p.m. & 2:55 p.m.', '2014-04-20', '2014-04-22', 1, '2014-04-20 23:55:27'),
(113, 'Senior All Night Party', '<p><strong style="font-family: Helvetica, Arial, sans-serif; font-size: 14px;"><span style="line-height: 18.399999618530273px; font-size: 12pt;">ATTN SENIORS: Sign up for the Senior All Night Party.&nbsp; Have a blast with your Class of 2014 friends on graduation night!&nbsp; Swimming, game room, casino, temporary tattoos, caricatures, and photos; DJ and movies for entertainment.&nbsp; Food is provided.&nbsp; All this, and a second very exciting surprise venue!&nbsp; You will be bussed to two exciting venues, and return to Franklin early Saturday morning.&nbsp; Cost is $50 each, scholarships are available.&nbsp; The forms and payment are due to the office no later than Friday, May 16.&nbsp; Pick up registration forms in the VP Office or check the website for details/forms.</span></strong></p>', '0000-00-00', '', '', '2014-04-20', '2014-05-17', 1, '2014-04-20 23:56:12'),
(114, 'Check YOUR GRADE!  Time is running out!', '<p>It is time to check your grade! &nbsp;Are you passing? &nbsp;How many missing assignments do you have? &nbsp;Last day to turn in any late work will be June 6th, 2014.&nbsp;</p>', '2014-05-07', 'Room 241', '3:15 PM', '2014-05-07', '2014-06-06', 62, '2014-05-07 22:41:44'),
(115, 'Juniors:  Remember to Attend June 4:  "Now that I''m a Senior" NIght:  6-8:45 pm', '', '0000-00-00', '', '', '2014-05-07', '2014-06-05', 63, '2014-05-07 23:09:25'),
(116, 'Test Retake Deadline May 28th!!!', '<p>Any students in Algebra or Geometry who need to retake must do so by Wednesday, May 28th.&nbsp; That means there is only one more opportunity during Office Hours (no office hours on the 21st due to the carnival).&nbsp; Students will need to schedule a time with me if they need to retake sometime other than office hours on the 28th.&nbsp;</p>', '2014-05-28', '', '', '2014-05-16', '2014-06-13', 41, '2014-05-16 19:52:17'),
(117, 'Outliers/Freakonomics Due 5/24', '<p>Please email to me by midnight on Saturday, May 24th.&nbsp; kandrews@pps.net</p>', '2014-05-24', '', '', '2014-05-16', '2014-05-24', 41, '2014-05-16 19:53:41')