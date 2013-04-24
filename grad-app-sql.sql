
/*******************************
Student and Capp_report join
********************************/
SELECT 	s.id AS student_id, 
	   	s.first_name AS first_name, 
	   	s.middle_name AS middle_name, 
	   	s.last_name AS last_name,
	   	s.email AS email,
	   	cap.degree AS degree,
	   	cap.catalog AS catalog, 
	   	cap.major_1 AS major,
	   	cap.gpa AS gpa,
	   	cap.total_credits AS total_credits
FROM grad_app.student s
INNER JOIN capp_report cap ON s.id = cap.student_id
WHERE s.id = 900000001; 


/***************************************************************
Student Select 
 ***************************************************************/
SELECT 	s.id AS student_id, 
	   	s.first_name AS student_first_name, 
	   	s.middle_name AS student_middle_name, 
	   	s.last_name AS student_last_name,
	   	s.email AS student_email
FROM grad_app.student s;

/***************************************************************
Displays all Students + Capp_Report + Status = Admin Index View 
 ***************************************************************/
SELECT 	s.id AS id, 
	   	s.first_name AS first_name, 
	   	s.last_name AS last_name,
	   	s.email AS email,
	   	cap.degree AS degree,
	   	cap.catalog AS catalog, 
	   	cap.major_1 AS major,
	   	cap.gpa AS gpa,
	   	cap.total_credits AS total_credits,
	   	report.report_term AS report_term,
	   	stat.status_type AS status
FROM grad_app.student s
LEFT JOIN grad_app.capp_report cap ON s.id = cap.student_id
LEFT JOIN grad_app.app_report_status report ON s.id = report.student_id
LEFT JOIN grad_app.status stat ON report.status_id = stat.id
WHERE report.report_term IS NOT NULL;


/***************************************************************
 Select the classes enrolled in by a specific student
 ***************************************************************/
SELECT  e.student_id,	
		s.first_name,	
		cap.degree,
		cap.major_1,
		e.course_id,
		c.crn_num,
		c.course_name,
		e.class_grade
FROM grad_app.enrolls e
INNER JOIN grad_app.course c ON e.course_id = c.id
INNER JOIN grad_app.student s ON e.student_id = s.id
INNER JOIN grad_app.capp_report cap ON e.capp_report_id = cap.id
WHERE e.student_id = 900000001;

/***************************************************************
 DB TABLES AND DUMBY DATA
 ***************************************************************/

 -- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2013 at 04:03 AM
-- Server version: 5.6.10
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grad_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_report_status`
--

DROP TABLE IF EXISTS `app_report_status`;
DROP TABLE IF EXISTS `capp_report`;
DROP TABLE IF EXISTS `course`;
DROP TABLE IF EXISTS `enrolls`;
DROP TABLE IF EXISTS `status`;
DROP TABLE IF EXISTS `student`;

CREATE TABLE IF NOT EXISTS `app_report_status` (
  `student_id` int(10) unsigned NOT NULL,
  `status_id` tinyint(3) unsigned NOT NULL,
  `report_term` varchar(200) NOT NULL,
  `notes` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`student_id`,`status_id`),
  KEY `fk_app_report_status_student1_idx` (`student_id`),
  KEY `fk_app_report_status_status1_idx` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `capp_report`
--


CREATE TABLE IF NOT EXISTS `capp_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `degree` varchar(200) NOT NULL,
  `catalog` varchar(200) NOT NULL,
  `major_1` varchar(200) NOT NULL,
  `major_2` varchar(200) NOT NULL,
  `gpa` int(11) NOT NULL,
  `total_credits` int(11) NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`student_id`),
  KEY `fk_capp_report_student_idx` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--


CREATE TABLE IF NOT EXISTS `course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `crn_num` varchar(45) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--


CREATE TABLE IF NOT EXISTS `enrolls` (
  `course_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `class_grade` varchar(200) NOT NULL,
  `capp_report_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`course_id`,`student_id`,`capp_report_id`),
  KEY `fk_enroll_student1_idx` (`student_id`),
  KEY `fk_enroll_class1_idx` (`course_id`),
  KEY `fk_enroll_capp_report1_idx` (`capp_report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--


CREATE TABLE IF NOT EXISTS `status` (
  `id` tinyint(3) unsigned NOT NULL,
  `status_type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--


CREATE TABLE IF NOT EXISTS `student` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_report_status`
--
ALTER TABLE `app_report_status`
  ADD CONSTRAINT `fk_app_report_status_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_app_report_status_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `capp_report`
--
ALTER TABLE `capp_report`
  ADD CONSTRAINT `fk_capp_report_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `fk_enroll_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_enroll_class1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_enroll_capp_report1` FOREIGN KEY (`capp_report_id`) REFERENCES `capp_report` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/***************************************************************
DUMBY DATA
 ***************************************************************/
 -- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2013 at 04:06 AM
-- Server version: 5.6.10
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grad_app`
--

--
-- Dumping data for table `app_report_status`
--

INSERT INTO `app_report_status` (`student_id`, `status_id`, `report_term`, `notes`, `created_at`, `updated_at`) VALUES
(900000001, 1, 'Spring 2013', NULL, '2013-04-18 03:16:00', '2013-04-19 05:35:18'),
(900000002, 1, 'Summer 2013', NULL, '2013-04-16 06:17:22', '2013-04-17 06:05:35');

--
-- Dumping data for table `capp_report`
--

INSERT INTO `capp_report` (`id`, `degree`, `catalog`, `major_1`, `major_2`, `gpa`, `total_credits`, `student_id`) VALUES
(1, 'Bachelor of Science', 'Fall 2011', 'Computer Information Systems', '', 3, 120, 900000001),
(2, 'Bachelor of Science', 'Fall 2010', 'Computer Information Systems', '', 3, 117, 900000002),
(3, 'Bachelor of Science', 'Fall 2010', 'Computer Information Systems', '', 2, 110, 900000003),
(4, 'Bachelor of Science', 'Fall 2008', 'Computer Information Systems', '', 3, 117, 900000004),
(5, 'Bachelor of Science', 'Fall 2009', 'Computer Information Systems', '', 2, 90, 900000005),
(6, 'Bachelor of Science', 'Fall 2011', 'Computer Information Systems', '', 3, 100, 900000006);

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `crn_num`, `course_name`) VALUES
(1, '52380', 'CIS 4050 - Systems Analysis and Design'),
(2, '55604', 'CIS 4280 - Windows Server 2008 Administration'),
(3, '52380', 'CIS 4050 - Systems Analysis and Design'),
(4, '55604', 'CIS 4280 - Windows Server 2008 Administration'),
(5, '52381', 'CIS 3500 - Information Systems Security'),
(6, '55605', 'CIS 3145 - Visual Basic OOP '),
(7, '52381', 'CIS 3500 - Information Systems Security'),
(8, '55605', 'CIS 3145 - Visual Basic OOP ');

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`course_id`, `student_id`, `class_grade`, `capp_report_id`) VALUES
(1, 900000001, 'A', 1),
(1, 900000004, 'C', 4),
(1, 900000006, 'B', 6),
(2, 900000001, 'C', 1),
(2, 900000004, 'A', 4),
(2, 900000006, 'B', 6),
(3, 900000002, 'C', 2),
(3, 900000004, 'D', 4),
(3, 900000005, 'A', 5),
(4, 900000002, 'A', 2),
(4, 900000003, 'B', 3),
(4, 900000004, 'A', 4),
(4, 900000005, 'B', 5),
(4, 900000006, 'C', 6),
(5, 900000001, 'D', 1),
(5, 900000002, 'D', 1),
(5, 900000003, 'F', 3),
(5, 900000005, 'B', 5),
(6, 900000001, 'B', 1),
(6, 900000002, 'B', 1),
(6, 900000006, 'C', 6),
(7, 900000003, 'A', 3),
(7, 900000005, 'A', 5),
(8, 900000003, 'C', 3);

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_type`) VALUES
(0, ''),
(1, 'Awaiting Review'),
(2, 'Accept'),
(3, 'Reject');

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `last_name`, `password`, `email`) VALUES
(900000001, 'Pat', NULL, 'Kremer', 'password', 'pkremer@msudenver.edu'),
(900000002, 'Patty', NULL, 'Kremer', 'password', 'pattyk@msudenver.edu'),
(900000003, 'John', NULL, 'Renck', 'password', 'jrenck@msudenver.edu'),
(900000004, 'Justin', 'M', 'Servantez', 'password', 'jservantez@msudenver.edu'),
(900000005, 'John', NULL, 'Renck', 'password', 'jrenck@msudenver.edu'),
(900000006, 'Justin', 'M', 'Servantez', 'password', 'jservantez@msudenver.edu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
