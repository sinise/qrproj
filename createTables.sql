DROP TABLE IF EXISTS USERS;
CREATE TABLE USERS(
   UserId      INT            NOT NULL AUTO_INCREMENT,
   FirstName   VARCHAR (30)   NOT NULL,
   LastName    VARCHAR (30)   NOT NULL,
   Email       VARCHAR (70)   NOT NULL,
   Password    VARCHAR (40)   NOT NULL,   
   PRIMARY KEY (UserId)
);

DROP TABLE IF EXISTS PERMISSIONS;
CREATE TABLE PERMISSIONS(
   RankId      INT            NOT NULL AUTO_INCREMENT,
   RankName    VARCHAR (30)   NOT NULL, 
   Organise    BOOLEAN        NOT NULL DEFAULT false, 
   Scannerman  BOOLEAN        NOT NULL DEFAULT false, 
   Scan        BOOLEAN        NOT NULL DEFAULT false, 
   PRIMARY KEY (RankId)
);

DROP TABLE IF EXISTS CATEGORIES;
CREATE TABLE CATEGORIES(
   CategoryId  INT            NOT NULL AUTO_INCREMENT,
   CatName     VARCHAR (40)   NOT NULL,
   PRIMARY KEY (CategoryId)
);

DROP TABLE IF EXISTS ADS;
CREATE TABLE ADS(
   AdId        INT            NOT NULL AUTO_INCREMENT,
   AdName      VARCHAR (40)   NOT NULL,
   AdPicture   VARCHAR (40)   NOT NULL,
   PRIMARY KEY (AdId)
);

DROP TABLE IF EXISTS VISITS;
CREATE TABLE VISITS(
   Page        VARCHAR(20)    NOT NULL,
   IP          VARCHAR(50)    NOT NULL,
   TARDIS      TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS EVENTS;
CREATE TABLE EVENTS(
   EventId     INT            NOT NULL AUTO_INCREMENT,
   CategoryId  INT            NOT NULL,
   AdId        INT            NOT NULL,
   EventName   VARCHAR (30)   NOT NULL,
   EventStart  DATETIME       NOT NULL,
   EventEnd    DATETIME       NOT NULL,
   Description VARCHAR (1000) NOT NULL,
   Location    VARCHAR (50)   NOT NULL,
   Venue       VARCHAR (50)   NOT NULL,
   URLName     VARCHAR (15)   NOT NULL,   
   Publicity   BOOLEAN        NOT NULL DEFAULT false, 
   PRIMARY KEY (EventId),
   FOREIGN KEY (CategoryId) REFERENCES CATEGORIES(CategoryId),
   FOREIGN KEY (AdId)       REFERENCES ADS(AdId)
);

DROP TABLE IF EXISTS TICKETS;
CREATE TABLE TICKETS(
   TicketId    INT            NOT NULL AUTO_INCREMENT,
   UserId      INT            NOT NULL, 
   EventId     INT            NOT NULL, 
   Details     VARCHAR (1000) NOT NULL, 
   QRcode      VARCHAR (20)   NOT NULL,
   IP          VARCHAR (50)   NOT NULL,
   TARDIS      TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (TicketId),
   FOREIGN KEY (UserId)   REFERENCES USERS(UserId),
   FOREIGN KEY (EventId)  REFERENCES EVENTS(EventId)
);

DROP TABLE IF EXISTS ACTORS;
CREATE TABLE ACTORS(
   EventId     INT            NOT NULL,
   UserId      INT            NOT NULL, 
   RankId      INT            NOT NULL, 
   FOREIGN KEY (EventId)  REFERENCES EVENTS(EventId),
   FOREIGN KEY (UserId)   REFERENCES USERS(UserId),
   FOREIGN KEY (RankId)   REFERENCES PERMISSIONS(RankId)
);

# insert sample information to USERS
INSERT INTO users (FirstName, LastName, Email, Password) VALUES('Oscar', 'Roth Andersen', 'oscarrothandersen@gmail.com', 'passw0rd');
INSERT INTO users (FirstName, LastName, Email, Password) VALUES('Vivien', 'verdens-næstlængeste-navn', 'vivien@gmail.com', 'p4ssw0rd');
INSERT INTO users (FirstName, LastName, Email, Password) VALUES('Sebastian', 'Ostenfeldt Jensen', 'sebastian@momentos.dk', 'pa55w0rd');

# insert sample information to PERMISSIONS
INSERT INTO permissions (RankName, Organise, Scannerman, Scan) VALUES('Organiser', TRUE, TRUE, TRUE);
INSERT INTO permissions (RankName, Organise, Scannerman, Scan) VALUES('Scannerman', FALSE, FALSE, TRUE);
INSERT INTO permissions (RankName, Organise, Scannerman, Scan) VALUES('Right hand', FALSE, TRUE, TRUE);
INSERT INTO permissions (RankName, Organise, Scannerman, Scan) VALUES('Guest', FALSE, FALSE, FALSE);

# insert sample information to CATEGORIES
INSERT INTO categories (CatName) VALUES('Fest');
INSERT INTO categories (CatName) VALUES('Koncert');
INSERT INTO categories (CatName) VALUES('Messe');
INSERT INTO categories (CatName) VALUES('Cirkus');

# insert sample information to ADS
INSERT INTO ads (AdName, AdPicture) VALUES('Carlsberg', 'carlsberg.png');
INSERT INTO ads (AdName, AdPicture) VALUES('Bog og Idé', 'relevant.png');
INSERT INTO ads (AdName, AdPicture) VALUES('Tycho Brahe's Studiebod', 'wuuut.png');

# insert sample information to EVENTS
INSERT INTO events (CategoryId, AdId, EventName, EventStart, EventEnd, Description, Location, Venue, URLName, Publicity) 
       VALUES (1, 2, 'Fishing in a pond', '2014-04-20 16:00:00', '2014-04-20 23:00:00', 'Det her bliver for vildt!!!', 'Ved andedammen', 'Andedammen', 'andedam', TRUE);
INSERT INTO events (CategoryId, AdId, EventName, EventStart, EventEnd, Description, Location, Venue, URLName, Publicity) 
       VALUES (2, 2, 'Vivien bliver oldgammel', '2014-04-29 08:00:00', '2014-04-30 23:00:00', '10000 år gammel', 'Under bordet', 'Under bordet', 'vivien', TRUE);

# insert sample information to TICKETS
INSERT INTO tickets (UserId, EventId, Details, QRcode, IP) VALUES(1, 32, '...', 'QRQRQRQR', '234.543.234.543');
INSERT INTO tickets (UserId, EventId, Details, QRcode, IP) VALUES(2, 32, '...', 'QRQRQRQR', '234.543.234.543');
INSERT INTO tickets (UserId, EventId, Details, QRcode, IP) VALUES(3, 32, '...', 'QRQRQRQR', '234.543.234.543');
INSERT INTO tickets (UserId, EventId, Details, QRcode, IP) VALUES(2, 33, '...', 'QRQRQRQR', '234.543.234.543');

# insert sample information to ACTORS
INSERT INTO actors (EventId, UserId, RankId) VALUES(32, 1, 1);
INSERT INTO actors (EventId, UserId, RankId) VALUES(32, 2, 2);
INSERT INTO actors (EventId, UserId, RankId) VALUES(32, 3, 3);
INSERT INTO actors (EventId, UserId, RankId) VALUES(33, 1, 4);
INSERT INTO actors (EventId, UserId, RankId) VALUES(33, 2, 3);