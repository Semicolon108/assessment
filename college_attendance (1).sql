-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 06:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `assessment_id` varchar(255) NOT NULL,
  `assessment_session` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `assessment_subject` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `assessment_id`, `assessment_session`, `term`, `class`, `assessment_subject`, `faculty_id`) VALUES
(60, '1ebe1868-79fc-6806-8fc2-6cc21774b98e', '2020/2021', 'first term', 'primary 12', 'verbal reasoning', '1ebe1814-d135-6838-bbb7-6cc21774b98e'),
(61, '1ebe1869-ac9d-6b42-8e4a-6cc21774b98e', '2020/2021', 'first term', 'primary 12', 'integerated science', '1ebe1814-d135-6838-bbb7-6cc21774b98e'),
(62, '1ebe186b-cc1c-68ea-95ab-6cc21774b98e', '2020/2021', 'first term', 'primary 6', 'integerated science', '1ebe1812-4dfd-66ca-a0c9-6cc21774b98e');

-- --------------------------------------------------------

--
-- Table structure for table `assingment`
--

CREATE TABLE `assingment` (
  `id` int(11) NOT NULL,
  `assignment_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assingment`
--

INSERT INTO `assingment` (`id`, `assignment_id`, `title`, `subject`, `deadline`, `school_id`, `teacher_id`, `status`, `class`, `created_at`) VALUES
(1, '1ebd1a4e-0558-6ea0-a900-247703ae1c78', 'third todo', 'verbal reasoning', '24 / 06 / 2021', '1ebd1259-97fb-6d22-85ed-247703ae1c78', '1ebd127d-1ecf-6326-8888-247703ae1c78', 'draft', 'primary 3', '2021-06-20 14:51:27'),
(2, '1ebd1b35-5649-669c-b926-247703ae1c78', 'fifth todo', 'Integerated science', '17 / 06 / 2021', '1ebd1259-97fb-6d22-85ed-247703ae1c78', '1ebd127d-1ecf-6326-8888-247703ae1c78', 'draft', 'primary 1', '2021-06-20 14:51:27'),
(3, '1ebd1c0b-5412-64a6-bf63-247703ae1c78', 'tittle', 'english', '24 / 06 / 2021', '1ebd1259-97fb-6d22-85ed-247703ae1c78', '1ebd1278-a99a-60aa-a8e0-247703ae1c78', 'draft', 'primary 6', '2021-06-20 14:51:27'),
(4, '1ebd1d68-2619-67e4-88ec-247703ae1c78', 'third todo', 'maths', '30 / 06 / 2021', '1ebd1259-97fb-6d22-85ed-247703ae1c78', '1ebd1278-a99a-60aa-a8e0-247703ae1c78', 'draft', 'primary 3', '2021-06-20 14:51:27'),
(5, '1ebd1d71-b6ac-6a96-9be4-247703ae1c78', 'REST API', 'maths', '27 / 06 / 2021', '1ebd1259-97fb-6d22-85ed-247703ae1c78', '1ebd1278-a99a-60aa-a8e0-247703ae1c78', 'draft', 'primary 6', '2021-06-20 14:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `assingment_questions`
--

CREATE TABLE `assingment_questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `mark` varchar(255) NOT NULL,
  `assingment_id` varchar(255) NOT NULL,
  `answer_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `attendance` varchar(255) NOT NULL,
  `remark` text DEFAULT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(36) NOT NULL,
  `assessment_id` varchar(36) NOT NULL,
  `duration` varchar(18) NOT NULL,
  `exam_date` varchar(255) NOT NULL,
  `exam_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(36) NOT NULL,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_id`, `school_name`) VALUES
(4, '1ebdf816-0b70-6d32-bcbf-247703ae1c78\r\n\r\n\r\n', 'C.M.S'),
(5, '1ebdf816-bbe8-6c00-a8eb-247703ae1c78', 'Grait'),
(6, '1ebdf817-5a5c-697c-9afa-247703ae1c78', 'Middlesex');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `attendance` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `class`, `attendance`) VALUES
(1, '1ebce8cf-bacf-696a-8551-6cc21774b98e', 'Malik', 'primary 1', '{\"monday\":[1,1],\"tuesday\":[0,1],\"wednesday\":[1,1],\"thursday\":[1],\"friday\":[1]}'),
(2, '1ebcec12-abd9-6c62-a8c0-6cc21774b98e', 'Gabriel', 'primary 1', '{\"monday\":[],\"tuesday\":[],\"wednesday\":[],\"thursday\":[],\"friday\":[]}'),
(3, '1ebcec13-43ce-6f22-8901-6cc21774b98e', 'Gabriel john', 'primary 1', '{\"monday\":[],\"tuesday\":[],\"wednesday\":[],\"thursday\":[],\"friday\":[]}'),
(4, '1ebcec48-a76d-64cc-b480-6cc21774b98e', 'Gabriel john', 'primary 2', '{\"monday\":[],\"tuesday\":[],\"wednesday\":[],\"thursday\":[],\"friday\":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `assinged_class` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL,
  `class_to_teach` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `faculty_id`, `name`, `email`, `assinged_class`, `password`, `subjects`, `class_to_teach`, `school_id`) VALUES
(6, '1ebe1812-4dfd-66ca-a0c9-6cc21774b98e', 'Mr Gbenga', 'gbenga@teacher.com', 'primary 3', 'teachergbenga', 'integerated science,verbal reasoning', 'primary 3,primary 6', '1ebdf816-0b70-6d32-bcbf-247703ae1c78'),
(7, '1ebe1814-d135-6838-bbb7-6cc21774b98e', 'Mr Boye', 'boye@teacher.com', 'primary 9', 'teacherboye', 'integerated science,verbal reasoning', 'primary 12,primary 18,primary 15', '1ebdf816-bbe8-6c00-a8eb-247703ae1c78');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assingment`
--
ALTER TABLE `assingment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assingment_questions`
--
ALTER TABLE `assingment_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `assingment`
--
ALTER TABLE `assingment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assingment_questions`
--
ALTER TABLE `assingment_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
