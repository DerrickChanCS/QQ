CREATE TABLE Rooms(
    code varchar(4) PRIMARY KEY,
    open number(1,0)
);

CREATE TABLE Users(
    room varchar(4),
    username varchar(40),
    FOREIGN KEY (room)
        REFRENCES Rooms(code)
        ON DELETE CASCADE
);

CREATE TABLE Tags(
    room varchar(4),
    tagname varchar(20),
    FOREIGN KEY (room)
    	REFERENCES Rooms(code)
    	ON DELETE CASCADE
);
/* Tags table ^^^ should have (room,tagname) as a Primary Key */

CREATE TABLE Questions(
    room varchar(4),
    tag varchar(20),
    question_text varchar(200),
    time_stamp date,
    username varchar(40),
    FOREIGN KEY (room) 
        REFERENCES Rooms(code) 
        ON DELETE CASCADE
);
