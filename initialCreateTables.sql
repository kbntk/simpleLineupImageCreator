-- team table
-- id, name
-- player table
-- id, name, number, position, team.id
-- lineup table
-- id, date, team.id
-- 
-- lineup_player table
-- lineup.id, player.id
-- 
-- select from linup join player 

create database linup;
use lineup;

create table IF NOT EXISTS team (
  id int not null AUTO_INCREMENT,
  name varchar(50) not null,
  primary key (id)
 );
 
 create table IF NOT EXISTS player (
   id int not null AUTO_INCREMENT,
   name varchar(70) not null,
   number int not null,
   position int not null,
   teamID int,
   primary key (id),
   foreign key (teamID) references team(id) on delete set null
   );
   
create table IF NOT EXISTS lineup (
  id int not null AUTO_INCREMENT,
  date datetime not null default current_timestamp,
  teamID int,
   primary key (id),
   foreign key (teamID) references team(id) on delete set null
   );
   
create table IF NOT EXISTS lineup_player (
  lineupId int not null,
  playerId int not null,
    PRIMARY KEY (lineupId, playerId),
    FOREIGN KEY (lineupId) REFERENCES lineup(id),
    FOREIGN KEY (playerId) REFERENCES player(id)
	);
