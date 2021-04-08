CREATE TABLE `semesters_201818` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `semester_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `semester_name_UNIQUE` (`semester_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `declarations_201818` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `courses_ID` int unsigned DEFAULT NULL,
  `semesters_ID` int unsigned DEFAULT NULL,
  `student_code` varchar(10) DEFAULT NULL,
  `student_name` varchar(45) DEFAULT NULL,
  `remarks` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `test_201818` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `grade` tinyint unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

insert into semesters_201818 (semester_name) VALUES ('autumn'), ('spring'), ('autumn - spring');

INSERT INTO declarations_201818 (courses_ID, semesters_ID, student_code, student_name, remarks) VALUES 
(441, 2, 'IVSB201818', 'Dachi Mshvidobadze', 'Me'),
(400, 1, 'IVSB201818', 'Dachi Mshvidobadze', 'Me, but different course'),
(17, 1, 'IVSB123456', 'Sandro Chkareuli', 'Sandro - a poet'),
(151, 1, 'IVSB123456', 'Sandro Chkareuli', 'Sandro - a tester'),
(43, 1, 'IVSB654321', 'Kominik Dovacs', 'Dominik from other world, with 20 CHA');


ALTER TABLE courses_201818 MODIFY COLUMN old_credits DECIMAL(3,1);
UPDATE courses_201818 SET old_credits=ects_credits * 1.5;

select * from courses_201818 WHERE Semesters_ID = 2 AND course_name LIKE '%programming%';

SELECT ects_credits FROM courses_201818 WHERE course_code = 'ICD0007';

SELECT course_code, course_name, ects_credits FROM courses_201818 WHERE ects_credits >= 5;

SELECT S.student_name, S.student_code, C.course_code, C.ects_credits, N.semester_name
FROM declarations_201818 S INNER JOIN courses_201818 C ON S.courses_ID=C.ID
INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
ORDER BY C.ects_credits DESC,
S.student_name ASC;

SELECT S.student_name, S.student_code, N.semester_name, SUM(C.ects_credits) as semester_credits
FROM declarations_201818 S 
INNER JOIN courses_201818 C
ON S.courses_ID=C.ID
INNER JOIN semesters_201818 N
ON N.ID=C.Semesters_ID
GROUP BY S.student_name, S.student_code, C.Semesters_ID, N.semester_name
ORDER BY semester_credits DESC,
S.student_name ASC;


SELECT COUNT(*) as courses_in_autumn
FROM courses_201818
WHERE Semesters_ID = 1;

DROP TABLE test_201818;
