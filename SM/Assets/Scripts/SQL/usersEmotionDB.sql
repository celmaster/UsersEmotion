DROP DATABASE IF EXISTS usersEmotionsDB;

CREATE DATABASE usersEmotionsDB;

USE usersEmotionsDB;

DROP TABLE IF EXISTS emotion;

CREATE  TABLE emotion (
	name VARCHAR(100) NOT NULL,
	PRIMARY KEY(name)
)ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;

DROP TABLE IF EXISTS provocation;

CREATE TABLE provocation (
	emotionsName VARCHAR(100) NOT NULL,
	color VARCHAR(100) NOT NULL,
	image TEXT NOT NULL,
	FOREIGN KEY(emotionsName) REFERENCES emotion(name) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(emotionsName)
)ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;

DROP TABLE IF EXISTS userEmotion;

CREATE TABLE userEmotion (
	usersEmotionName VARCHAR(100) NOT NULL,
	FOREIGN KEY(usersEmotionName) REFERENCES emotion(name) ON DELETE CASCADE ON UPDATE CASCADE,
	PRIMARY KEY(usersEmotionName)
)ENGINE = InnoDB DEFAULT CHARACTER SET = latin1;