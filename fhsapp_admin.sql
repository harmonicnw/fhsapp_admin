-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2014 at 01:36 PM
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
(117, 'Outliers/Freakonomics Due 5/24', '<p>Please email to me by midnight on Saturday, May 24th.&nbsp; kandrews@pps.net</p>', '2014-05-24', '', '', '2014-05-16', '2014-05-24', 41, '2014-05-16 19:53:41'),
(118, 'Ensayo: borrador para el martes', '<p>escribe un borrador (primera versi&oacute;n) para entregar el martes, el 27 de mayo</p>', '2014-05-27', '', '', '2014-05-23', '2014-05-27', 38, '2014-05-24 20:18:51'),
(119, 'Communication Methods', '<p>Look for the Facebook group Franklin Constitution Team 2015</p>\r\n<p>Join the Celly to get group text messages. &nbsp;Go to this link:&nbsp;<a href="http://cy.tl/1kRoKFN">http://cy.tl/1kRoKFN</a>&nbsp;or text&nbsp;<span style="box-sizing: border-box; font-weight: 600; line-height: 25.600000381469727px; color: #333333; font-family: ''Open Sans''; font-size: 16px; text-align: center; background-color: rgba(248, 248, 238, 0.4);">@FranklinConLaw2015</span><span style="color: #333333; font-family: ''Open Sans''; font-size: 16px; line-height: 25.600000381469727px; text-align: center; background-color: rgba(248, 248, 238, 0.4);">&nbsp; to &nbsp;</span><span style="box-sizing: border-box; font-weight: 600; line-height: 25.600000381469727px; color: #333333; font-family: ''Open Sans''; font-size: 16px; text-align: center; background-color: rgba(248, 248, 238, 0.4);">23559</span></p>', '0000-00-00', '', '', '2014-05-30', '2014-06-06', 23, '2014-05-30 20:30:37'),
(120, 'Meeting Monday', '<p>We will be in the library from 6-8. &nbsp;We will watch videos of past competitions to understand how the competition works, and then have a history lecture from a coach. &nbsp;See you there!</p>', '2014-06-02', 'Franklin Library ', '6:00-8:00pm', '2014-05-30', '2014-06-02', 23, '2014-05-30 20:34:12'),
(121, 'Help register voters at graduation!', '<p>This Friday, the Bus Project will have a table in the gym as the seniors are lining up to graduate to register them to vote as they go. &nbsp;If a few juniors are interested in helping out, Tim Moore from that organization will have Pizza. &nbsp;You would need to be in the gym at 5pm on the 6th. &nbsp;You would still make it to graduation to watch afterwards.</p>', '2014-06-06', 'Franklin Gym', '5pm', '2014-06-03', '2014-06-07', 23, '2014-06-03 23:27:56'),
(122, 'Unit 1 Meeting and Readings ', '<p>Monday June 16th from 6-8 will be the Unit 1 meeting, run by Coach Les. &nbsp;He has prepared some readings, which I have put on the team <a href="https://sites.google.com/site/mshallfranklin/Home/constitution-team-2015">webpage</a>. &nbsp;Please check it out before you come.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>The meetings all summer will be at <a href="http://taborspace.org/">TaborSpace</a> (55th and Belmont).</p>', '2014-06-16', 'TaborSpace ', '6:00-8:00pm', '2014-06-10', '2014-06-16', 23, '2014-06-10 23:40:42'),
(123, 'Unit 2 Summer Meeting', '<p>Get ready to learn about the Constitutional Convention and Unit 2. &nbsp;Check out the <a href="https://sites.google.com/site/mshallfranklin/Home/constitution-team-2015">team website</a> to see the readings (shorter this time). &nbsp;At TaborSpace again on June 30th. &nbsp;See you there!</p>', '2014-06-30', 'TaborSpace ', '6:00-8:00pm', '2014-06-18', '2014-06-30', 23, '2014-06-18 23:01:06'),
(124, 'Test announcement', '<p>There is going to be a thing at a certain time!</p>', '2014-06-23', 'FHS Gym', '5:00pm', '2014-06-20', '2014-06-27', 1, '2014-06-21 18:17:47'),
(125, 'Third Summer Meeting', '<p>Unit 5 Meeting on July 14th! &nbsp;The coaches have divided people into 10 teams to research one Supreme Court case. &nbsp;If you don''t remember your team, check the team <a href="https://sites.google.com/site/mshallfranklin/Home/constitution-team-2015">website</a>. &nbsp;If you need an assignment, email or text Ms. Hall.</p>', '2014-07-14', 'TaborSpace ', '6:00-8:00pm', '2014-07-07', '2014-07-14', 23, '2014-07-08 01:15:46'),
(126, '4th Summer Meeting', '<p>Come and learn about Unit 3! &nbsp;The coaches have created a Scavenger Hunt through the pages of Unit 3. &nbsp;You can find the instructions and the scanned textbook on my <a href="https://sites.google.com/site/mshallfranklin/Home/constitution-team-2015">website</a>. &nbsp;You can work in teams that you choose. &nbsp;</p>', '2014-07-28', 'TaborSpace ', '6:00-8:00pm', '2014-07-15', '2014-07-28', 23, '2014-07-15 17:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `anno_subtype`
--

CREATE TABLE IF NOT EXISTS `anno_subtype` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `anno_id` int(10) NOT NULL,
  `subtype_id` int(10) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=461 ;

--
-- Dumping data for table `anno_subtype`
--

INSERT INTO `anno_subtype` (`index`, `anno_id`, `subtype_id`) VALUES
(268, 52, 11),
(269, 52, 12),
(270, 52, 13),
(271, 52, 14),
(272, 52, 15),
(273, 53, 40),
(274, 53, 41),
(275, 53, 42),
(276, 53, 43),
(277, 53, 44),
(278, 53, 45),
(279, 53, 46),
(281, 54, 133),
(282, 55, 137),
(283, 51, 11),
(284, 51, 13),
(285, 51, 15),
(286, 51, 41),
(287, 51, 43),
(288, 51, 46),
(289, 51, 137),
(319, 59, 13),
(320, 59, 44),
(321, 59, 133),
(322, 59, 137),
(338, 60, 13),
(339, 61, 13),
(340, 62, 13),
(342, 63, 13),
(343, 64, 13),
(344, 65, 13),
(346, 66, 13),
(347, 67, 13),
(348, 68, 13),
(349, 69, 13),
(350, 70, 13),
(351, 71, 13),
(352, 72, 13),
(353, 73, 13),
(354, 74, 13),
(355, 75, 13),
(356, 76, 13),
(357, 77, 13),
(358, 78, 13),
(359, 79, 13),
(364, 81, 13),
(365, 82, 13),
(368, 83, 137),
(369, 84, 14),
(373, 85, 159),
(377, 86, 156),
(380, 87, 162),
(381, 87, 166),
(385, 89, 179),
(386, 90, 163),
(387, 90, 164),
(388, 90, 167),
(389, 91, 165),
(390, 92, 13),
(391, 93, 162),
(392, 93, 163),
(393, 93, 164),
(394, 93, 165),
(395, 93, 166),
(396, 93, 167),
(397, 94, 165),
(398, 95, 188),
(399, 96, 163),
(400, 96, 164),
(401, 96, 167),
(402, 97, 165),
(403, 98, 197),
(404, 99, 223),
(405, 99, 224),
(406, 99, 226),
(407, 99, 228),
(409, 101, 179),
(410, 100, 176),
(411, 102, 231),
(412, 102, 235),
(413, 102, 236),
(414, 102, 237),
(415, 102, 238),
(416, 103, 13),
(417, 104, 244),
(418, 104, 246),
(419, 105, 180),
(420, 105, 183),
(421, 105, 185),
(422, 105, 186),
(423, 106, 207),
(424, 106, 209),
(425, 106, 210),
(426, 106, 212),
(427, 106, 213),
(431, 110, 13),
(432, 111, 12),
(433, 111, 13),
(434, 112, 13),
(435, 113, 13),
(436, 114, 257),
(437, 114, 258),
(438, 114, 259),
(439, 114, 260),
(440, 114, 261),
(441, 114, 262),
(442, 114, 263),
(443, 114, 264),
(444, 115, 265),
(445, 116, 277),
(446, 116, 278),
(447, 116, 280),
(448, 117, 279),
(449, 117, 281),
(450, 117, 282),
(451, 118, 286),
(453, 119, 274),
(454, 120, 274),
(455, 121, 274),
(456, 122, 274),
(457, 123, 274),
(458, 124, 255),
(459, 125, 274),
(460, 126, 274);

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `radio` varchar(5) NOT NULL,
  `checkbox` varchar(5) NOT NULL,
  `select` varchar(10) NOT NULL,
  `textarea` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`id`, `text`, `radio`, `checkbox`, `select`, `textarea`) VALUES
(1, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio'),
(2, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `name` varchar(20) NOT NULL,
  `value` varchar(10000) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`name`, `value`, `id`) VALUES
('excluded_dates', '2013-10-11,2013-11-08,2013-11-11,2013-11-25,2013-11-26,2013-11-27,2013-11-28,2013-11-29,2013-12-23,2013-12-24,2013-12-25,2013-12-26,2013-12-27,2013-12-30,2013-12-31,2014-01-01,2014-01-02,2014-01-03,2014-01-20,2014-01-22,2014-01-23,2014-01-24,2014-01-27,2014-02-17,2014-03-24,2014-03-25,2014-03-26,2014-03-27,2014-03-28,2014-04-11,2014-05-26,2014-06-09,2014-06-10,2014-06-11', 1),
('start_date', '2013-09-05', 2),
('end_date', '2014-06-11', 3),
('SurveyUrl', 'http://dialog.fuseinsight.com/topic/start/franklin_app_Dw', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subtype`
--

CREATE TABLE IF NOT EXISTS `subtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type_id` int(100) NOT NULL,
  `author_id` int(11) NOT NULL,
  `period` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=300 ;

--
-- Dumping data for table `subtype`
--

INSERT INTO `subtype` (`id`, `name`, `type_id`, `author_id`, `period`) VALUES
(11, 'College, Career, and Counseling Info', 1, 22, 0),
(12, 'Important Continuing Items', 1, 22, 0),
(13, 'New/Timely Entries', 1, 22, 0),
(14, 'Library', 1, 22, 0),
(15, 'SUN News', 1, 22, 0),
(171, '', 2, 20, 2),
(170, '', 2, 20, 1),
(40, 'Testing', 2, 1, 1),
(41, 'Test', 2, 1, 2),
(42, 'Test Period', 2, 1, 3),
(43, 'More Tests', 2, 1, 4),
(44, 'Testing Testing', 2, 1, 5),
(45, 'Test Period', 2, 1, 6),
(46, 'Still Testing', 2, 1, 7),
(47, 'Tada', 2, 1, 8),
(177, 'Intro to Psych', 2, 20, 8),
(176, 'Intro to Psych', 2, 20, 7),
(175, 'Intro to Psych', 2, 20, 6),
(174, '', 2, 20, 5),
(173, '', 2, 20, 4),
(172, '', 2, 20, 3),
(182, 'African American History', 2, 24, 3),
(181, '', 2, 24, 2),
(180, 'AP Psychology ', 2, 24, 1),
(179, 'FHS Slam', 3, 20, 0),
(178, 'Freshman First iPad', 3, 20, 0),
(154, '', 2, 18, 1),
(155, 'Chemistry', 2, 18, 2),
(156, 'AP Chemistry', 2, 18, 3),
(157, '', 2, 18, 4),
(158, 'Chemistry', 2, 18, 5),
(159, 'AP Chemistry', 2, 18, 6),
(160, 'Chemistry', 2, 18, 7),
(161, 'Chemistry', 2, 18, 8),
(162, 'FST', 2, 19, 1),
(163, 'Algebra 1-2', 2, 19, 2),
(164, 'Algebra 1-2', 2, 19, 3),
(165, 'Algebra 3-4', 2, 19, 4),
(166, 'FST', 2, 19, 5),
(167, 'Algebra 1-2', 2, 19, 6),
(168, '', 2, 19, 7),
(169, '', 2, 19, 8),
(183, 'AP Psychology ', 2, 24, 4),
(184, '', 2, 24, 5),
(185, 'AP Psychology ', 2, 24, 6),
(186, 'AP Psychology ', 2, 24, 7),
(187, 'African American History', 2, 24, 8),
(188, 'Chemistry', 2, 25, 1),
(189, 'Biology', 2, 25, 2),
(190, 'Biology', 2, 25, 3),
(191, '', 2, 25, 4),
(192, '', 2, 25, 5),
(193, 'Biology', 2, 25, 6),
(194, 'Biology', 2, 25, 7),
(195, 'Biology', 2, 25, 8),
(196, 'Science Bowl', 3, 25, 0),
(197, 'One', 2, 27, 1),
(198, 'Two', 2, 27, 2),
(199, 'Three', 2, 27, 3),
(200, 'Four', 2, 27, 4),
(201, 'Five', 2, 27, 5),
(202, 'Six', 2, 27, 6),
(203, 'Seven', 2, 27, 7),
(204, 'Eight', 2, 27, 8),
(205, 'Club', 3, 27, 0),
(206, 'Sport', 4, 27, 0),
(207, 'Biology 1', 2, 34, 1),
(208, 'Basic Science', 2, 34, 2),
(209, 'Biology 3', 2, 34, 3),
(210, 'Biology 4', 2, 34, 4),
(211, '', 2, 34, 5),
(212, 'Biology 6', 2, 34, 6),
(213, 'Science Support', 2, 34, 7),
(214, '', 2, 34, 8),
(215, 'Academy Algebra', 2, 29, 1),
(216, 'Geometry', 2, 29, 2),
(217, '', 2, 29, 3),
(218, '', 2, 29, 4),
(219, 'Academy Algebra', 2, 29, 5),
(220, 'Academy Geometry', 2, 29, 6),
(221, '', 2, 29, 7),
(222, 'Academy Algebra', 2, 29, 8),
(223, '9th grade English', 2, 31, 1),
(224, '9th grade English', 2, 31, 2),
(225, 'prep', 2, 31, 3),
(226, '9th grade English', 2, 31, 4),
(227, '11th grade English', 2, 31, 5),
(228, '9th grade English', 2, 31, 6),
(229, 'Link Crew', 2, 31, 7),
(230, 'prep', 2, 31, 8),
(231, 'English 2', 2, 32, 1),
(232, 'ASB Student Government', 2, 32, 2),
(233, 'Prep', 2, 32, 3),
(234, 'Prep', 2, 32, 4),
(235, 'English 2', 2, 32, 5),
(236, 'English 2', 2, 32, 6),
(237, 'English 4', 2, 32, 7),
(238, 'English 2', 2, 32, 8),
(239, 'Algebra 1/2', 2, 28, 1),
(240, '', 2, 28, 2),
(241, 'Algebra 3/4', 2, 28, 3),
(242, 'Algebra Foundations', 2, 28, 4),
(243, 'Algebra 1/2', 2, 28, 5),
(244, 'FST', 2, 28, 6),
(245, '', 2, 28, 7),
(246, 'FST', 2, 28, 8),
(247, 'Geometry', 2, 30, 1),
(248, 'Foundations of algebra', 2, 30, 2),
(249, 'Algebra', 2, 30, 3),
(250, 'Algebra', 2, 30, 4),
(251, 'Academy geometry', 2, 30, 5),
(252, '', 2, 30, 6),
(253, '', 2, 30, 7),
(254, 'Geometry', 2, 30, 8),
(255, 'Checkers Club', 3, 1, 0),
(256, '', 4, 1, 0),
(257, 'Immersion 5/6', 2, 62, 1),
(258, 'PREP', 2, 62, 2),
(259, 'Spanish 3/4', 2, 62, 3),
(260, 'Spanish 7/8', 2, 62, 4),
(261, 'PREP', 2, 62, 5),
(262, 'Spanish 3/4', 2, 62, 6),
(263, 'Spanish 3/4', 2, 62, 7),
(264, 'Spanish 3/4', 2, 62, 8),
(265, 'Counseling FHS', 3, 63, 0),
(266, '', 2, 23, 1),
(267, '', 2, 23, 2),
(268, '', 2, 23, 3),
(269, '', 2, 23, 4),
(270, '', 2, 23, 5),
(271, '', 2, 23, 6),
(272, '', 2, 23, 7),
(273, '', 2, 23, 8),
(274, 'Constitution Team 2015', 3, 23, 0),
(275, '', 2, 41, 1),
(276, '', 2, 41, 2),
(277, 'Algebra CT', 2, 41, 3),
(278, 'Geometry', 2, 41, 4),
(279, 'AP Stats', 2, 41, 5),
(280, 'Geometry', 2, 41, 6),
(281, 'AP Stats', 2, 41, 7),
(282, 'AP Stats', 2, 41, 8),
(283, 'Esp 1-2', 2, 38, 1),
(284, 'Esp 1-2', 2, 38, 2),
(285, 'Esp 1-2', 2, 38, 3),
(286, 'AP EspaÃ±ol', 2, 38, 4),
(287, '', 2, 38, 5),
(288, 'Esp 1-2', 2, 38, 6),
(289, 'Esp 5-6', 2, 38, 7),
(290, '', 2, 38, 8),
(291, '', 2, 65, 1),
(292, '', 2, 65, 2),
(293, '', 2, 65, 3),
(294, '', 2, 65, 4),
(295, '', 2, 65, 5),
(296, '', 2, 65, 6),
(297, '', 2, 65, 7),
(298, '', 2, 65, 8),
(299, 'Key Club', 3, 65, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Classes'),
(3, 'Clubs'),
(4, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `teacher` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `club` tinyint(1) NOT NULL,
  `sports` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The teachers.' AUTO_INCREMENT=67 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `teacher`, `admin`, `club`, `sports`) VALUES
(1, 'fhsapp', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'dustindiep0@gmail.com', 'Supreme', 'Admin', 1, 1, 1, 1),
(25, 'bbiagini', '81dc9bdb52d04dc20036dbd8313ed055', 'bbiagini@pps.net', 'Beth', 'Biagini', 1, 0, 1, 0),
(24, 'wmcclend', 'f35e5c7e8c4e995b2844905c53e06e8c', 'wmcclend@pps.net', 'William', 'McClendon', 1, 0, 0, 0),
(20, 'sjchilds', 'dbc12e0724fc029fc60ecec5297aeec4', 'sjchilds@pps.net', 'Sandra', 'Childs', 1, 0, 1, 0),
(21, 'mmi', '81dc9bdb52d04dc20036dbd8313ed055', 'mmi@pps.net', 'Marilyn', 'Mi', 1, 0, 0, 0),
(22, 'jregister', 'e2efd9dcfe4f51b771c6026db4273661', 'jregister@pps.net', 'Jill', 'Register', 0, 1, 0, 0),
(23, 'phall', '835f0f96c6baa34eec519d4dbb709224', 'phall@pps.net', 'Portia', 'Hall', 1, 0, 1, 0),
(18, 'msansom', '81dc9bdb52d04dc20036dbd8313ed055', 'msansom@pps.net', 'Merritt', 'Sansom', 1, 0, 0, 0),
(19, 'rjamieson', '60180544767affe7e4fb148a490d4347', 'rjamieson@pps.net', 'Rob', 'Jamieson', 1, 0, 0, 0),
(26, 'hambinde', '81b073de9370ea873f548e31b8adc081', 'hambinde@pps.net', 'Harris', 'Ambinder', 1, 0, 0, 0),
(27, 'btester', 'd93591bdf7860e1e4ee2fca799911215', 'dustindiep0@gmail.com', 'Beta', 'Tester', 1, 0, 1, 1),
(28, 'tbutenho', '0df7a64b0c783c2d0221b499948efdef', 'tbutenho@pps.net', 'Trevor', 'Butenhoff', 1, 0, 0, 0),
(29, 'mbeeber', '87dd2a8944bd74f1e29b1e8c617e2035', 'mbeeber@pps.net', 'Mary Jo', 'Beeber', 1, 0, 0, 0),
(30, 'sewing', '9e26fb7cddc1e625c5252d50041486cd', 'sewing@pps.net', 'Shauna', 'Ewing', 1, 0, 0, 0),
(31, 'pgarrett', 'def7924e3199be5e18060bb3e1d547a7', 'pgarrett@pps.net', 'Pamela', 'Garrett', 1, 0, 0, 0),
(32, 'sbrighou', '16e9210e340ac4fd9d4fd7759ba7464a', 'sbrighou@pps.net', 'Susan', 'Brighouse', 1, 0, 0, 0),
(33, 'dvinger2', '674f3c2c1a8a6f90461e8a66fb5550ba', 'dvinger2@pps.net', 'Dana', 'Vinger', 1, 0, 0, 0),
(34, 'mstewar2', '46d045ff5190f6ea93739da6c0aa19bc', 'mstewar2@pps.net', 'Matt', 'Stewart', 1, 0, 0, 0),
(35, 'gheppner', 'def7924e3199be5e18060bb3e1d547a7', 'gheppner@pps.net', 'Gregg', 'Heppner', 1, 0, 0, 0),
(36, 'lghodsi', '81dc9bdb52d04dc20036dbd8313ed055', 'lghodsi@pps.net', 'Leila', 'Ghodsi', 1, 0, 0, 0),
(37, 'applereview', '81a349e9f10ff7454d0144a930587dee', 'harmonicnw@gmail.com', 'Apple', 'Reviewer', 1, 1, 1, 1),
(38, 'tgrobey', '96f6924772be71a24cb9afe8065b5c5b', 'tgrobey@pps.net', 'Tod', 'Grobey', 1, 0, 0, 0),
(39, 'bthatcher', '81b073de9370ea873f548e31b8adc081', 'bthatcher@pps.net', 'Brieana ', 'Thatcher', 1, 0, 0, 0),
(40, 'ntovar', '962012d09b8170d912f0669f6d7d9d07', 'ntovar@pps.net', 'Nayibe ', 'Tovar', 1, 0, 0, 0),
(41, 'kandrews', 'b517894909d2ef48a66c54389229702e', 'kandrews@pps.net', 'Kelly', 'Andrews', 1, 0, 0, 0),
(42, 'ccook@pps.net', 'cdaeb1282d614772beb1e74c192bebda', 'ccook@pps.net', 'Clara', 'Cook', 1, 0, 0, 0),
(43, 'dstroup', '81b073de9370ea873f548e31b8adc081', 'dstroup@pps.net', 'David', 'Stroup', 1, 0, 0, 0),
(44, 'sbuckmas', '674f3c2c1a8a6f90461e8a66fb5550ba', 'sbuckmas@pps.net', 'Steve', 'Buckmaster', 1, 0, 0, 0),
(45, 'gchin', 'c26820b8a4c1b3c2aa868d6d57e14a79', 'gchin@pps.ent', 'Gary', 'Chin', 1, 0, 0, 0),
(46, 'ttrotter', 'e82c4b19b8151ddc25d4d93baf7b908f', 'ttrotter@pps.net', 'Tristan', 'Trotter', 1, 0, 0, 0),
(47, 'nstremmi', 'def7924e3199be5e18060bb3e1d547a7', 'nstremmi@pps.net', 'Norman', 'Stremming', 1, 0, 0, 0),
(48, 'ayork', 'e2a7555f7cabd6e31aef45cb8cda4999', 'ayork@pps.net', 'Anna', 'York', 1, 0, 0, 0),
(49, 'dsilvernail', '1f262a60600e30c026663a7ccbed6bab', 'dsilvernail@pps.net', 'Dan', 'Silvernail', 1, 0, 0, 0),
(50, 'ewildert', 'cdaeb1282d614772beb1e74c192bebda', 'ewildert@pps.net', 'Elle', 'Wilder', 1, 0, 1, 0),
(51, 'ekirsch', '86109d400f0ed29e840b47ed72777c84', 'ekirsch@pps.net', 'Elizabeth', 'Kirsch', 1, 0, 0, 0),
(52, 'sbartley', '2e92962c0b6996add9517e4242ea9bdc', 'sbartley@pps.net', 'Susan', 'Bartley', 1, 0, 1, 0),
(53, 'imontano', '412758d043dd247bddea07c7ec558c31', 'imontano@pps.net', 'Irene', 'Montano', 1, 0, 0, 0),
(54, 'jtorres', 'f38fef4c0e4988792723c29a0bd3ca98', 'jtorres@pps.net', 'Julana', 'Torres', 1, 0, 0, 0),
(56, 'janderson1', '8af95fe2ab1a54b488ef8efb3f3b0797', 'janderson1@pps.net', 'Jeff', 'Anderson', 1, 0, 0, 0),
(57, 'sreedy', 'b645e524a1512ce68947d3b9c948aa46', 'sreedy@pps.net', 'Seth', 'Reedy', 1, 0, 0, 0),
(61, 'jperez1', '81dc9bdb52d04dc20036dbd8313ed055', 'jperez1@pps.net', 'Javier', 'Perez', 1, 0, 0, 0),
(59, 'tbiamont', 'e615c82aba461681ade82da2da38004a', 'tbiamont@pps.net', 'Tim', 'Biamont', 1, 0, 0, 0),
(60, 'mwhisnan', 'a5a7158118e59ee590424b55bb9aed17', 'mwhisnan@pps.net', 'Megan', 'Whisnand', 1, 0, 0, 0),
(62, 'mperez', '3a847d1f429eddb4644a011cde47d8d0', 'mperez@pps.net', 'Marty', 'Perez', 1, 0, 0, 0),
(63, 'hvedmonds', 'bf84a47e6e9be177655e3d6b10721643', 'hvedmonds@pps.net', 'Holly', 'Vaughn-Edmonds', 0, 0, 1, 0),
(64, 'lstruble', '27d3be7e14da734cb352ebb836e306b6', 'lstruble@pps.net', 'Laura', 'Struble', 1, 0, 1, 0),
(65, 'ewong', 'c8f2089bf1de367d48e68bba5a0c9cfa', 'ewong@pps.net', 'Elisa', 'Wong', 1, 0, 1, 0),
(66, 'kdenney', '9e1e06ec8e02f0a0074f2fcc6b26303b', 'kdenney@pps.net', 'Kevin', 'Denney', 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
