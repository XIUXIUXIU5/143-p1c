create table Movie(
	id int NOT NULL, -- Each movie should have an ID number.
	title varchar(100) NOT NULL, -- Each movie should have a title. 
	year int NOT NULL, -- Each movie should have a release year.
	rating varchar(10) NOT NULL, -- Each movie should have a MPAA reating
	company varchar(50) NOT NULL, -- Each movie should have a production company.
	PRIMARY KEY(id), -- Each movie should have a unique ID.
	CHECK (0 <= year and year <= 2015) -- The release year of each movie should be from 0 to 2015.
	)ENGINE = INNODB;

create table Actor(
	id int NOT NULL, -- Each actor should have an ID number.
	last varchar(20) NOT NULL, -- Each actor should have a last name.
	first varchar(20) NOT NULL, -- Each actor should have a first name.
	sex varchar(6) NOT NULL, -- Each actor should have a gender.
	dob DATE NOT NULL, -- Each actor should have a birth date.
	dod DATE,
	PRIMARY KEY(id), -- Each actor should have a unique ID.
	CHECK (sex = 'Male' OR sex = 'Female') -- Each actor should either be a male or a female.
	)ENGINE = INNODB;

create table Director(
	id int NOT NULL, -- Each director should have an ID number.
	last varchar(20) NOT NULL,  -- Each director should have a last name.
	first varchar(20) NOT NULL, -- Each director should have a first name.
	dob DATE NOT NULL, -- Each director should have a birth date.
	dod DATE,
	PRIMARY KEY(id) -- Each director should have a unique ID.
	)ENGINE = INNODB;

create table MovieGenre(
	mid int NOT NULL, -- Each movie should have an ID.
	genre varchar(20) NOT NULL, -- Each movie should belong to a genre.
	FOREIGN KEY(mid) REFERENCES Movie(id) -- Each movie ID here should also appears in the Movie table.
	)ENGINE = INNODB;

create table MovieDirector(
	mid int NOT NULL, -- Each movie should have an ID.
	did int NOT NULL, -- Each director should have an ID.
	FOREIGN KEY(mid) REFERENCES Movie(id), -- Each movie here should also appears in the Movie table.
	FOREIGN KEY(did) REFERENCES Director(id) -- Each director here should also appears in the Director table.
	)ENGINE = INNODB;

create table MovieActor(
	mid int NOT NULL, -- Each movie should have an ID.
	aid int NOT NULL, -- Each actor should have an ID.
	role varchar(50) NOT NULL,-- Each actor should have a role in the movie.
	FOREIGN KEY(mid) REFERENCES Movie(id),-- Each movie here should also appears in the Movie table.
	FOREIGN KEY(aid) REFERENCES Actor(id) -- Each actor here should also appears in the Actor table.
	)ENGINE = INNODB;

create table Review(
	name varchar(20), 
	time TIMESTAMP, 
	mid int NOT NULL, 
	rating int, 
	comment varchar(500),
	FOREIGN KEY(mid) REFERENCES Movie(id), -- Each movie here should also appears in the Movie table.
	CHECK (rating >= 0) -- The rating of the movie should be non negative.
	)ENGINE = INNODB;

create table MaxPersonID (id int)ENGINE = INNODB;
create table MaxMovieID (id int)ENGINE = INNODB;
