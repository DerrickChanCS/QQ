CREATE TABLE Rooms(
    code char(5) PRIMARY KEY
);

CREATE TABLE Questions(
    room char(5),
    tag char(20),
    question_text char(200),
    time_stamp date,
    FOREIGN KEY (room) 
        REFERENCES Rooms(code) 
        ON DELETE CASCADE
);