CREATE TABLE Rooms(
    code char(5) PRIMARY KEY,
    open number(1,0)
);

CREATE TABLE Tags(
    room char(5),
    tagname char(20),
    FOREIGN KEY (room)
    	REFERENCES Rooms(code)
    	ON DELETE CASCADE
);
/* Tags table ^^^ should have (room,tagname) as a Primary Key */

CREATE TABLE Questions(
    room char(5),
    tag char(20),
    question_text char(200),
    time_stamp date,
    FOREIGN KEY (room) 
        REFERENCES Rooms(code) 
        ON DELETE CASCADE
);