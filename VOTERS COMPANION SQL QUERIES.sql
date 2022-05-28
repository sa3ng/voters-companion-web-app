
# For DELETING TABLES (REMEMBER: turn FK check to 0)
DROP TABLE userTBL;
DROP TABLE accTBL;
DROP TABLE accProfTBL;
DROP TABLE postsTBL;
DROP TABLE candidatesTBL;
DROP TABLE candidatesInfoTBL;

DROP TABLE criminalTBL;
DROP TABLE experienceTBL;
DROP TABLE educationTBL;


SET FOREIGN_KEY_CHECKS = 0;  #set to 0 to be able to drop tables with FK's
SET FOREIGN_KEY_CHECKS = 1;  #Remember to set back to 1 after

# NAMING CONVENTION
# tables - sampleMalupetTBL
# column - sample_variable

# CREATING TABLES

SHOW TABLES;

CREATE TABLE accTBL (
    acc_id int AUTO_INCREMENT NOT NULL,
    name VARCHAR(20) NOT NULL,
    pass VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    type VARCHAR(20) NOT NULL,
    PRIMARY KEY (acc_id)
);

CREATE TABLE accProfileTBL (
    prof_id int AUTO_INCREMENT NOT NULL,
    acc_id INT NOT NULL,
    user_tag VARCHAR(10),
    full_name VARCHAR(100) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    political_label VARCHAR(20) NOT NULL,
    bio VARCHAR(1000),
    birthday VARCHAR(10),
	religion_id int,
    status_id int,
    PRIMARY KEY (prof_id),
    FOREIGN KEY (acc_id) REFERENCES accTBL(acc_id),
    FOREIGN KEY (religion_id) REFERENCES religionTBL(religion_id),
	FOREIGN KEY (status_id) REFERENCES maritalStatusTBL(status_id),
);

CREATE TABLE accCandidatesTBL(
	acc_id int,
    candidate_id int,
    FOREIGN KEY(acc_id) REFERENCES accTBL(acc_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);


#is_reply will identify post as a 'reply' or a 'main post'
#is_reply_of will point to 'PostID' of the post replied to
CREATE TABLE postsTBL(
	post_id int AUTO_INCREMENT,
    acc_id int NOT NULL,
    header VARCHAR(200),
    message VARCHAR(1000),
    is_reply BOOLEAN NOT NULL,
    is_reply_of INT,
    PRIMARY KEY (post_id),
    FOREIGN KEY (acc_id) REFERENCES accTBL(acc_id)
);


#BELOW THIS COMMENT: NAMING CONVENTIONS HAVE NOT BEEN APPLIED
CREATE TABLE candidatesTBL(
	candidate_id int AUTO_INCREMENT,
	full_name  VARCHAR(100) NOT NULL,
	position_id VARCHAR(50) NOT NULL,
    PRIMARY KEY (candidate_id)
);

CREATE TABLE candidatesInfoTBL(
	candidate_id int,
    candidate_num int,
    political_party VARCHAR(300) NOT NULL,
    birthday VARCHAR(50) NOT NULL,
    birthplace VARCHAR(100) NOT NULL,
    religion_id int,
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);

CREATE TABLE maritalStatusTBL(
	status_id int NOT NULL,
    marital_status VARCHAR(20),
    PRIMARY KEY (status_id) 
);

CREATE TABLE maritalRecordTBL(
	candidate_id int,
    full_name VARCHAR(100),
    occupation VARCHAR(100),
    year_start VARCHAR(4) NOT NULL,
    year_end VARCHAR(4) NOT NULL,
    status_id int,
    FOREIGN KEY (status_id) REFERENCES maritalStatusTBL(status_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);

CREATE TABLE religionTBL(
	religion_id int,
    religion VARCHAR(20),
    PRIMARY KEY(religion_id)
);

CREATE TABLE criminalTBL(
	candidate_id int,
    criminal_id  int AUTO_INCREMENT NOT NULL,
    criminal_header VARCHAR(500),
    criminal_record VARCHAR(1000),
    year_end VARCHAR(4) NOT NULL,
    PRIMARY KEY(criminal_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);

CREATE TABLE experienceTBL(
	candidate_id int,
    experience_id int AUTO_INCREMENT NOT NULL,
    experience_header VARCHAR(500),
    experience_record VARCHAR(1000),
    year_end VARCHAR(4) NOT NULL,
    PRIMARY KEY(experience_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);


CREATE TABLE educationTBL(
	candidate_id int,
    education_id int AUTO_INCREMENT NOT NULL,
    education_header VARCHAR(500),
    education_record VARCHAR(1000),
    year_end VARCHAR(4) NOT NULL,
    PRIMARY KEY(education_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);

CREATE TABLE relativesTBL(
	candidate_id int,
    full_name VARCHAR(100),
    relationship_id VARCHAR(100),
    PRIMARY KEY (relationship_id),
    FOREIGN KEY (candidate_id) REFERENCES candidatesTBL(candidate_id)
);

# TO DO:
# - CANDIDATES TABLE
# - CANDIDATES-INFO TABLE
# - PARTYLIST TABLE

#HOW TO ADD FK IN EXISTING TABLE via ALTER
ALTER TABLE accprofTBL ADD FOREIGN KEY (acc_id) REFERENCES accTBL(acc_id);
ALTER TABLE accprofTBL DROP FOREIGN KEY acc_id;

#INSERTING VALUES
INSERT INTO accTBL(name, pass, email, type) VALUES('bob', 'sino', 'mama@gmail.com', 'user');
INSERT INTO accProfTBL(acc_id, full_name, gender, political_label) VALUES(1, 'EVANGELISTA, PAULO', 'Male', 'Kaliwete'); 

#candidatesTBL
INSERT INTO candidatesTBL(candidate_id, full_name, position_id) VALUES(1,'ROBREDO, LENI','P');
INSERT INTO candidatesTBL(candidate_id, full_name, position_id) VALUES(2,'MARCOS, BONGBONG','P');
INSERT INTO candidatesTBL(full_name, position_id) VALUES('LACSON, PING','P');

#postsTBL
INSERT INTO postsTBL(acc_id,header,message,is_reply) VALUES(1,'Son of a hecking Pinklawan: The what ba do bee','Wow!! Galing!!', 0);
INSERT INTO postsTBL(acc_id,header,message,is_reply) VALUES(1,'Bruh: Just Bruh','Wow!! Galing!!', 0);
INSERT INTO postsTBL(acc_id,header,message,is_reply) VALUES(1,'I heckin love P-','Wow!! Galing!!', 0);

#maritalStatusTBL
INSERT INTO maritalStatusTBL(status_id, marital_status) VALUES(1, 'Married');
INSERT INTO maritalStatusTBL(status_id, marital_status) VALUES(2, 'Divorced');
INSERT INTO maritalStatusTBL(status_id, marital_status) VALUES(3, 'Widowed');
INSERT INTO maritalStatusTBL(status_id, marital_status) VALUES(4, 'Single');


#religionTBL
INSERT INTO religionTBL(religion_id, religion) VALUES (0, '--No Religion--');
INSERT INTO religionTBL(religion_id, religion) VALUES (1, 'Christian');
INSERT INTO religionTBL(religion_id, religion) VALUES (2, 'Buddhist');
INSERT INTO religionTBL(religion_id, religion) VALUES (3, 'Catholic');
INSERT INTO religionTBL(religion_id, religion) VALUES (4, 'INC');


#candidatesInfoTBL
INSERT INTO candidatesInfoTBL(candidate_id, candidate_num, political_party, birthday, birthplace, religion_id)
VALUES(1, 10, 'Independent', '1965/23/04', 'Imos,Cavite',  3);
INSERT INTO candidatesInfoTBL(candidate_id, candidate_num, political_party, birthday, birthplace, religion_id)
VALUES(2, 7, 'PARTIDO FEDERAL NG PILIPINAS', '1957/13/09', 'Imos,Cavite',  3);
INSERT INTO candidatesInfoTBL(candidate_id, candidate_num,	 political_party, birthday, birthplace, religion_id)
VALUES(3, 5, 'Independent', '1948/01/06', 'Imos,Cavite',  0);


#educationTBL
INSERT INTO educationTBL(candidate_id, education_header, education_record, year_end) 
VALUES(1, 'Bachelor of Arts in Economics', 'B.A. in Economics, University of the Philippines-Diliman', '1986');
INSERT INTO educationTBL(candidate_id, education_header, education_record, year_end) 
VALUES(1, 'Doctor in Public Administration', 'Doctor in Public Administration, Polytechnic University of the Philippines', '2015');
INSERT INTO educationTBL(candidate_id, education_header, education_record, year_end) 
VALUES(2, 'Secondary School, ​​Worth School England', 'Secondary School, ​​Worth School England', '1974');
INSERT INTO educationTBL(candidate_id, education_header, education_record, year_end) 
VALUES(3, 'Bachelor of Science, Philippine Military Academy', 'Secondary School, ​​Worth School England', '1971');

#experienceTBL
INSERT INTO experienceTBL(candidate_id, experience_header, experience_record, year_start , year_end) 
VALUES(1, 'Vice President', 'Vice President of the Philippines', '2016' , 'PRES');
INSERT INTO experienceTBL(candidate_id, experience_header, experience_record, year_start , year_end) 
VALUES(1, 'Branch Coordinator and Lawyer', 'Sentro ng Alternatibong Lingap Panligal (SALIGAN) – Bicol Chapter', '1999' , '2012');
INSERT INTO experienceTBL(candidate_id, experience_header, experience_record, year_start , year_end) 
VALUES(3, 'Senator', 'Senado ng Pilipinas', '2001' , '2013');
INSERT INTO experienceTBL(candidate_id, experience_header, experience_record, year_start , year_end) 
VALUES(2, 'Senator', 'Senado ng Pilipinas', '2010' , '2016');

#criminalTBL
INSERT INTO criminalTBL(candidate_id, criminal_header, criminal_record, year_end) 
VALUES(2, 'Cases handled by the Presidential Commission on Good Government', 
'P125.9 billion in Marcos ill-gotten wealth has yet to be recovered and remains under litigation'
, 'PRES');
INSERT INTO criminalTBL(candidate_id, criminal_header, criminal_record, year_end) 
VALUES(2, 'Tax evasion', 
'Criminal Case No. Q-91-24390 for Violation of NIRC of 1977, RTC, Branch 105, Quezon City - sentencing accused to serve imprisonment of three 3 years and to pay a fine of P30,000'
, '1995');
INSERT INTO criminalTBL(candidate_id, criminal_header, criminal_record, year_end) 
VALUES(2, 'Petition to declare Ferdinand Marcos Jr. a nuisance candidate', 
'A motion for reconsideration was filed on Dec. 22, 2021, but was elevated to the Comelec en banc only on Jan. 27, 2022, to the dismay of Lihaylihay'
, '2022');







#CHECKING CURRENT TABLE VALUES
SELECT * FROM accTBL;
SELECT * FROM accProfileTBL;

SELECT * FROM candidatesTBL;
SELECT * FROM candidatesInfoTBL;

SELECT * FROM postsTBL;
SELECT * FROM maritalStatusTBL;

SELECT * FROM educationTBL;
SELECT * FROM experienceTBL;
SELECT * FROM criminalTBL;



#DELETE
DELETE FROM postsTBL WHERE post_id = 4;