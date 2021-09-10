-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `sharebox`
--

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `activate_account` ( 
`id`          int(6) NOT NULL,
`email` varchar(100) NOT NULL,
`code` varchar(200) NOT NULL,
`date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Indexes `activate_account`
--
ALTER TABLE `activate_account`
ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(9) NOT NULL,
  `username`    varchar(50)   NOT NULL,
  `password`    varchar(50)   NOT NULL,
  `title`       varchar(20)   NOT NULL,
  `lastname`    varchar(50)   NOT NULL,
  `firstname`   varchar(50)   NOT NULL,
  `location`    varchar(20)   NOT NULL,
  `email`       varchar(100)  NOT NULL,
  `address`     varchar(200)  NOT NULL,
  `country`     varchar(50)   NOT NULL,
  `photo`       varchar(100)  NOT NULL,
  `aboutme`     varchar(2000) NOT NULL,
  `role`        varchar(20)   NOT NULL,
  `activated`   varchar(1)    NOT NULL DEFAULT 'y',
  `datecreated` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

-- Indexes `members`
--
ALTER TABLE `members`
ADD PRIMARY KEY (`id`);
--
-- inserting data `members`
--

INSERT INTO `members` 
(`id`, `username`, `password`, `title`, `lastname`, `firstname`,      `location`,                   `email`, `address`,  `country`, `photo`,           `aboutme`,               `role`, `activated`,         `datecreated`) VALUES
(   1, 'sombra',       'Over',  '',      'Colomar',    'Olivia',   'Chiapas, MX',        'sombra@gmail.com',        '',   'Mexico',      '',         'Hacking the world',      'admin',         'y', '2020-01-14 12:00:00'),
(  90, 'chaima',    'testing',  '',     'Elachkar',    'Chaima',              '',     'chaima369@gmail.com',        '',  'Morocco',      '',                          '', 'teamleader',         'y', '2020-04-16 16:04:18'),
(  91, 'brigitta',  'testing',  '',        'Szabo',  'Brigitta',              '', 'brigittaszabo@gmail.com',        '',  'Hungary',      '',                          '',           '',         'y', '2020-04-16 10:13:15'),
(  92, 'idbk',      'testing',  '',          'Kim',      'Luis',              '',          'idbk@gmail.com',        '',   'Mexico',      '', 'Don´t know what I´m doing', 'teamleader',         'y', '2020-04-19 11:48:45');


-- --------------------------------------------------------

--
-- Table structure `paper_assigned`
--

CREATE TABLE IF NOT EXISTS `paper_assigned` (
`id`       int(9)     NOT NULL,
`paperid`  int(9)     NOT NULL,
`userid`   int(9)     NOT NULL,
`duration` int(9)     NOT NULL,
`status`   varchar(1) NOT NULL,
`dateassigned` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
-- Indexes `paper_assigned`
--
ALTER TABLE `paper_assigned`
ADD PRIMARY KEY (`id`);
--
-- inserting data `paper_assigned`
--

INSERT INTO `paper_assigned` 
(`id`, `paperid`, `userid`, `duration`, `status`,        `dateassigned`) VALUES
(   1,         1,       90,         10,      'c', '2020-02-16 14:22:01'),
(   2,         4,       90,         15,       '', '2020-02-17 12:51:21'),
(   3,         4,       90,         15,       '', '2020-02-17 12:51:30'),
(   4,         8,       92,         40,      'c', '2020-02-20 11:56:17');

-- --------------------------------------------------------

--
-- Table structure `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`id`         int(9) NOT NULL,
`name` varchar(150) NOT NULL,
`code`  varchar(20) NOT NULL,
`datecreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
-- Indexes `projects`
--
ALTER TABLE `projects`
ADD PRIMARY KEY (`id`);
--
-- inserting data `projects`
--

INSERT INTO `projects` 
(`id`,                            `name`,    `code`,          `datecreated`) VALUES
(   1,               'Computer Projects',      'CP', '2019-02-16 14:03:37'),
(   2, 'AI and Machine Learning Project', 'AI & ML', '2019-02-19 18:34:44'),
(   3,  'Data Science and Visualization',     'DSV', '2019-02-20 06:22:30');

-- --------------------------------------------------------

--
-- Table structure `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
`id`        int(9) NOT NULL,
`projectid` int(9) NOT NULL,
`userid`    int(9) NOT NULL,
`datecreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- Indexes `projects_users`
--
ALTER TABLE `projects_users`
ADD PRIMARY KEY (`id`);
--
-- insert data `projects_users`
--

INSERT INTO `projects_users` 
(`id`, `projectid`, `userid`, `datecreated`) VALUES
(   1,           1, 90, '2020-02-16 14:05:02'),
(   2,           1, 92, '2020-02-19 18:26:06');

-- --------------------------------------------------------

--
-- Table structure `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
`id`             int(9) NOT NULL,
`paperid`        int(9) NOT NULL,
`submitedby`     int(9) NOT NULL,
`comment` varchar(3000) NOT NULL,
`file`     varchar(100) NOT NULL,
`datecreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- Indexes `reviews`
--
ALTER TABLE `reviews`
ADD PRIMARY KEY (`id`);
--
-- inserting data `reviews`
--

INSERT INTO `reviews` 
(`id`, `paperid`, `submitedby`, `comment`,                                                                                `file`, `datecreated`) VALUES
(   1,         1,           90, 'It was a great work...I commend the author.', 'Project Work 1 - Research Paper Sharing App.docx', '2020-03-16 14:24:02'),
(   2,         8,           90, 'A well written article on the programmatic and analytic prowess of python in bioinformatics. This is explores intermediate and advance subject areas in bioinformatics.\r\n\r\nI will like to see more of the algorithms analysed to give people more clarity on the implementations.', 'My Review Comments.docx', '2020-03-20 12:22:28');

-- --------------------------------------------------------

--
-- Table structure `submit_papers`
--

CREATE TABLE IF NOT EXISTS `submit_papers` (
`id` int(9) NOT NULL,
`projectid` int(9) NOT NULL,
`title` varchar(150) NOT NULL,
`description` varchar(2000) NOT NULL,
`file` varchar(100) NOT NULL,
`submitedby` int(9) NOT NULL,
`status` varchar(1) NOT NULL DEFAULT 's',
`datesubmitted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
-- Indexes `submit_papers`
--
ALTER TABLE `submit_papers`
ADD PRIMARY KEY (`id`);
--
-- inserting data `submit_papers`
--

INSERT INTO `submit_papers` 
(`id`, `projectid`,                                                  `title`,                                                                                      `description`,                                                                       `file`, `submitedby`, `status`,       `datesubmitted`) VALUES
(   1,           1,                  'Web 2.0: Tools and Applications in Academic Excellence',                          'Web 2.0: Tools and Applications in Academic Excellence',                                                                'The Web.doc',           90,      'r', '2020-04-15 14:11:41'),
(   2,           1,                                                       'About the Project',                                                            'About the project...',                                                  'Educational proposal.docx',           90,      's', '2020-04-16 12:50:30'),
(   3,           1,                                                       'About the Project',                                                            'About the project...',                                                  'Educational proposal.docx',           90,      's', '2020-04-16 12:50:32'),
(   4,           1,                                                       'About the Project',                                                            'About the project...',                                                  'Educational proposal.docx',           90,      'r', '2020-04-16 12:50:33'),
(   5,           1, 'Configuration of Real time System which includes simple physical analog',         'Configuration of real time system which includes simple physical analog', 'configuration of realtime system which includes simple physical analog.doc',           91,      's', '2020-04-17 18:52:16'),
(   6,           1,                                  'Current Trend in Learning Technologies',                               'Learning Technologies in the contemporary world. ',                               'Current Trend in Learning Technologies2.docx',           91,      's', '2020-04-17 18:56:27'),
(   7,           3,                             'Data Science and Visualization Applications', 'This article explores Data Science and Visualization and its application areas.',                           'Data Science and Visualization Applications.docx',           92,      's', '2020-04-19 06:52:15'),
(   8,           3,                                     'Bioinformatics analysis with Python',            'This is data analysis of molecular biology using python programming.',                                 'Bioinformatics with Python Programming.doc',           90,      'r', '2020-04-19 07:45:22');


-- AUTO_INCREMENT `activate_account`
--
ALTER TABLE `activate_account`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT `members`
--
ALTER TABLE `members`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT `paper_assigned`
--
ALTER TABLE `paper_assigned`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT `projects_users`
--
ALTER TABLE `projects_users`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT `submit_papers`
--
ALTER TABLE `submit_papers`
MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
